<x-app-layout>
    <div class="container mx-auto lg:w-2/3 p-5">
        <h1 class="text-3xl font-bold mb-3">My Cart Items</h1>
        <div x-data="{
            items:{{
                json_encode(
                    $products->map(fn($product)=>[
                        'id'=>$product->id,
                        'slug'=>$product->slug,
                        'image'=>$product->image,
                        'title'=>$product->title,
                        'price'=>$product->price,
                        'quantity'=>$cartItems[$product->id ]['quantity'],
                        'href'=>route('product.view',$product->slug),
                        'removeUrl'=>route('cart.remove',$product),
                        'updateQuantityUrl'=>route('cart.updateQuantity',$product)
                    ])
                )
            }},
{{--            get items(){--}}
{{--            return  Object.values(this.$store.header.cartItemObject);--}}
{{--            },--}}
            get total(){
            return this.items.reduce((accum,next) => accum += next.price * next.quantity,0).toFixed(2);
            }
        }" class="bg-white rounded-lg shadow p-3">
            <template  x-if="items.length">
            <template x-for="item in items">
                <!--the product item-->
                <article x-data="productItem(item)" class="flex items-center flex-col sm:flex-row gap-4 p-2 flex-1">
                    <a :href="item.href" class="w-32 h-32 flex items-center justify-center overflow-hidden">
                        <img :src="item.image" class="object-cover" alt="">
                    </a>
                    <div class="flex flex-col w-full justify-between flex-1">
                        <div class="flex justify-between items-center">
                            <h3 class="m-0" x-text="item.title"></h3>
                            <span class="text-lg font-bold" x-text="`$${item.price}`"></span>
                        </div>
                        <div class="flex justify-between items-center mt-6">
                            <div>
                                Qty:
                                <input type="number"
                                       x-model="item.quantity"
                                       @change="changeQuantity()"
                                       id=""
                                       class="ml-3 py-1 border-gray-200 focus:border-purple-600 focus:ring-purple-600 w-16">
                            </div>
                            <a @click.prevent="removeItemFromTheCart()" href="" class="text-purple-700 hover:text-purple-500">Remove</a>
                        </div>
                    </div>
                </article>
                <hr class="my-3">
                <!--the end of the  product item-->
            </template>
            </template>
            <template x-if="!items.length">
                <div class="text-center py-2 text-gray-500 font-bold ">
                    There is nothing in your basket!
                </div>
            </template>
            <form action="{{ route('cart.checkout') }}" method="post">
                @csrf
                <div class="flex justify-between pt-5">
                    <span class="font-bold">Subtotal</span>
                    <span x-text="`$${total}`"></span>
                </div>
                <!--the end of the subtotal section-->
                <div class="flex justify-center flex-col">
                    <p class="mx-auto mb-3">Shipping and tax will be applied on checkout!!</p>
                    <button class="btn-primary">Checkout</button>
                </div>
            </form>

        </div>

    </div>
</x-app-layout>
