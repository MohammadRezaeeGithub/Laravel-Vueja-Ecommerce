<?php

namespace App\Http\Controllers;

use App\Enums\OrderStatus;
use App\Enums\PaymentStatus;
use App\Http\Helpers\Cart;
use App\Mail\NewOrderEmail;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Stripe\Checkout\Session;
use Stripe\Customer;
use Stripe\Stripe;

class CheckoutController extends Controller
{

    public function checkout(Request $request)
    {
        $user = $request->user();

        Stripe::setApiKey($_ENV['STRIP_SECRET_KEY']);

        list($products,$cartItems) = Cart::getProductsAndCartitems();

        $orderItems= [];
        $lineItems = [];
        $totalPrice = 0;
        foreach ($products as $product){
            $quantity = $cartItems[$product->id]['quantity'];
            $totalPrice += $product->price * $quantity;
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => $product->title,
                        'images' => [$product->image],
                    ],
                    'unit_amount_decimal' => $product->price * 100,
                ],
                'quantity' => $cartItems[$product->id]['quantity'],
            ];
            $orderItems[] = [
                'product_id' => $product->id,
                'quantity' => $quantity,
                'unit_price'=> $product->price,
            ];
        }

        $checkout_session = Session::create([
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => route('checkout.success',[],true) . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('checkout.failure',[],true),
        ]);

        $orderData = [
            'total_price' => $totalPrice,
            'status' => OrderStatus::Unpaid,
            'created_by' => $user->id,
            'updated_by' => $user->id,
        ];

        $order = Order::create($orderData);

        // Create order items
        foreach ($orderItems as $orderItem){
            $orderItem['order_id'] = $order->id;
            OrderItem::create($orderItem);
        }

        $paymentData = [
            'order_id' => $order->id,
            'amount' => $totalPrice,
            'status' => PaymentStatus::Pending,
            'type' => 'cc',
            'created_by'=> $user->id,
            'updated_by'=>$user->id,
            'session_id' => $checkout_session->id
        ];

        $payment = Payment::create($paymentData);
        return redirect($checkout_session->url);
    }
    public function success(Request $request)
    {
        $user = $request->user();
        Stripe::setApiKey($_ENV['STRIP_SECRET_KEY']);

        try {
            $session = Session::retrieve($request->get('session_id'));
            //$customer = Customer::retrieve($session->customer_details);

            if (!$session){
                return view('checkout.failure',['message'=>'Ivalid session ID']);
            }

            $payment = Payment::query()->where(['session_id'=>$session->id,'status'=>PaymentStatus::Pending])->first();
            if (!$payment){
                return view('checkout.failure',['message'=>'Payment does not exist!']);
            }

            $payment->status = PaymentStatus::Paid;
            $payment->update();

            $order = $payment->order;
            $order->status = OrderStatus::Paid;
            $order->update();

            //after creating a new order, we are going to send a new email to admin
            $adminUser = User::where('is_admin',1)->get();
            //Mail::to($adminUser)->send(new NewOrderEmail($order));


            CartItem::where(['user_id'=>$user->id])->delete();

            $customer = $session->customer_details;
            return view('checkout.success',compact('customer'));
        }catch (\Exception $e){
            return view('checkout.failure',['message'=>$e->getMessage()]);
        }

    }

    public function failure(Request $request){
        return view('checkout.failure',['message'=>'Payment was not successful']);
    }

    public function checkoutOrder(Order $order,Request $request)
    {
        $user = $request->user();

        Stripe::setApiKey($_ENV['STRIP_SECRET_KEY']);

        $lineItems = [];

        foreach ($order->items as $item){
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => $item->product->title,
                        //'images' => [$product->image],
                    ],
                    'unit_amount_decimal' => $item->unit_price * 100,
                ],
                'quantity' => $item->quantity,
            ];
        }

        $checkout_session = Session::create([
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => route('checkout.success',[],true) . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('checkout.failure',[],true),
        ]);

        $order->payment->session_id = $checkout_session->id;
        $order->payment->save();

        return redirect($checkout_session->url);
    }
}
