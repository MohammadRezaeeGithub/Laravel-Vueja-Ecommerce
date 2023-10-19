<x-app-layout>
    <div class="container mx-auto lg:w-2/3 p-5">
        <h1 class="text-3xl font-bold mb-3">Order #{{ $order->id }}</h1>
        <div class="bg-white rounded-lg p-3">
            <table class="table-auto w-full">
                <tbody>
                <tr>
                    <td class="font-semibold py-1 px-2">Order #</td>
                    <td>{{ $order->id }}</td>
                </tr>
                <tr>
                    <td class="font-semibold py-1 px-2">Order Date</td>
                    <td>{{ $order->created_at }}</td>
                </tr>
                <tr>
                    <td class="font-semibold py-1 px-2">Order Status</td>
                    <td class="p-2">
                        @if($order->status == \App\Enums\OrderStatus::Paid->value) <span class="bg-green-500 rounded-lg p-1 text-white px-2">Paid</span> @endif
                        @if($order->status == \App\Enums\OrderStatus::Unpaid->value) <span class="bg-red-500 rounded-lg p-1 text-white px-2">Unpaid</span> @endif
                        @if($order->status == \App\Enums\OrderStatus::Completed->value) <span class="bg-orange-400 rounded-lg p-1 text-white px-2">Pending</span> @endif
                    </td>
                </tr>
                <tr>
                    <td class="font-semibold py-1 px-2">Subtotal</td>
                    <td>${{ $order->total_price }}</td>
                </tr>
                </tbody>
            </table>

            <hr class="my-3">
            @foreach($order->items as $item)
                <!--the product item-->
                <article class="flex flex-col sm:flex-row items-center gap-4 p-2">
                    <a href="{{ route('product.view',$item->product) }}" class="w-32 h-32 flex items-center justify-center overflow-hidden">
                        <img src="{{ $item->product->image }}" class="object-cover" alt="">
                    </a>
                    <div class="flex flex-col w-full justify-between">
                        <div class="flex justify-between items-center">
                            <h3 class="m-0">{{ $item->product->title }}</h3>
                            <span class="text-lg font-bold">${{ $item->unit_price }}</span>
                        </div>
                        <div class="flex justify-between items-center mt-6">
                            <div>
                                Qty: {{ $item->quantity }}
                            </div>
                        </div>
                    </div>
                </article>
                <hr class="my-3">
                <!--the end of the  product item-->
            @endforeach


            <div class="w-full">
                @if(!$order->isPaid())
                    <form action="{{ route('cart.checkoutWithSession' , $order) }}" method="post">
                        @csrf
                        <button type="submit" class="btn-primary flex items-center whitespace-nowrap w-full justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="w-6 h-6 mr-2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z"/>
                            </svg>
                            Make a Payment
                        </button>
                    </form>

                @endif
            </div>

        </div>
    </div>

</x-app-layout>
