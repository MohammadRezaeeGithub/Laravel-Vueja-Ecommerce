<?php

namespace App\Http\Controllers\Api;

use App\Enums\AddressType;
use App\Enums\CustomerStatus;
use App\Enums\OrderStatus;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function activeContomers()
    {
       return Customer::where('status',CustomerStatus::Active->value)->count();
    }

    public function activeProducts()
    {
        return Product::count();
    }

    public function paidOrders()
    {
        return Order::where('status',OrderStatus::Paid->value)->count();
    }

    public function totalIncone()
    {
        return Order::where('status',OrderStatus::Paid->value)->sum('total_price');
    }

    public function orderByCounry()
    {
        $orders = Order::query()
            ->select(['countries.name',DB::raw('count(orders.id) as count')])
            ->join('users','created_by','=','users.id')
            ->join('customer_addresses','users.id','=','customer_addresses.customer_id')
            ->join('countries','customer_addresses.country_code','=','countries.code')
            ->where('status',OrderStatus::Paid->value)
            ->where('customer_addresses.type',AddressType::Billing->value)
            ->groupBy('countries.name')
            ->get();

        return $orders;
    }

    public function latestCustomers()
    {
       return Customer::query()
           ->select(['id','first_name','last_name','users.email','phone','users.created_at','status'])
           ->join('users','users.id','=','customers.user_id')
            ->where('status',CustomerStatus::Active->value)
            ->orderBy('created_at','desc')
            ->limit(5)
            ->get();
    }

    public function latestOrders()
    {
        return Order::query()
            ->select(['o.id AS order_id','o.total_price','o.created_at',DB::raw('COUNT(oi.id) AS items'),'c.user_id AS user_id','c.first_name','c.last_name'])
            ->from('orders AS o')
            ->join('order_items AS oi','oi.order_id','=','o.id')
            ->join('customers AS c','c.user_id','=','o.created_by')
            ->where('o.status',OrderStatus::Paid->value)
            ->orderBy('o.created_at','desc')
            ->limit(10)
            ->groupBy('o.id')
            ->get();
    }
}
