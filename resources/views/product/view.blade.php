<x-app-layout>
    <!--The product item-->
    <section x-data="productItem({{
    json_encode([
    'id'=> $product->id,
    'image' => $product->image,
    'title' => $product->title,
    'price' => $product->price,
    'addToCartUrl' => route('cart.add',$product)
    ])
  }})" class="grid grid-cols-5 gap-6 py-16 px-14">
        <!--The main section for photos-->
        <div x-data="{
            images : ['{{ $product->image  }}','img/1_2.jpg','img/1_3.jpg','img/1_4.jpg'],
        activeImage : null,
        prev(){
            let index = this.images.indexOf(this.activeImage);
            if(index == 0) {
                index = this.images.length;
            }
            this.activeImage = this.images[index - 1];
        },
        next(){
            let index = this.images.indexOf(this.activeImage);
            if(index == this.images.length - 1){
                index = -1;
            }
            this.activeImage = this.images[index + 1];
        },
        init(){
            this.activeImage = this.images.length > 0 ? this.images[0] : null;
        }
        }" class="md:col-span-3 col-span-5">
            <!--The main Photo-->
            <template x-for="image in images" class="aspect-square flex items-center">
                <div x-show="activeImage === image" x-transition class="aspect-w-3 aspect-h-2">
                    <img :src="image" alt="" class="object-cover"/>
                </div>
            </template>
            <!--End of The main Photo-->
            <!--The thumbnails-->
            <div class="flex relative">
                <!-- The Arrows for the icons         -->
                <a @click.prevent="prev" href=""
                   class="absolute flex items-center cursor-pointer z-20 h-full top-0 left-0 px-2 bg-black/10 hover:bg-black/20 text-white font-bold">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5"/>
                    </svg>
                </a>
                <a @click.prevent="next" href=""
                   class="absolute flex items-center cursor-pointer z-20 h-full top-0 right-0 px-2 bg-black/10 hover:bg-black/20 text-white font-bold">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/>
                    </svg>
                </a>
                <!-- The end of Arrows for the icons         -->
                <!--the start of the thumbnails-->
                <div class="flex">
                    <template x-for="image in images">
                        <a @click.prevent="activeImage = image"
                           class="cursor-pointer flex items-center justify-center border border-gray-200 transition-colors hover:border-purple-600 m-2">
                            <img :src="image" class="w-24 object-cover" alt=""
                                 :class="{border-purple-600 : activeImage == image}"/>
                        </a>
                    </template>

                    <!-- <a href="#" class="border border-gray-200 hover:border-purple-600 m-2"><img src="img/1_2.jpg"
                            class="w-24" alt="" /></a>
                    <a href="#" class="border border-gray-200 hover:border-purple-600 m-2"><img src="img/1_3.jpg"
                            class="w-24" alt="" /></a>
                    <a href="#" class="border border-gray-200 hover:border-purple-600 m-2"><img src="img/1_4.jpg"
                            class="w-24" alt="" /></a> -->
                </div>
                <!--the end of the thumbnails-->
            </div>
            <!--the end of the thumbnails-->
        </div>
        <!--The End of  main section for photos-->
        <!--The sidebar-->
        <div class="col-span-5 md:col-span-2">
            <h1 class="text-bold font-semibold">
                {{ $product->title }}
            </h1>
            <p class="text-xl font-bold mb-3">${{ $product->price }}</p>
{{--            <!--The Review Section-->--}}
{{--            <div class="flex items-center mb-3">--}}
{{--                <p class="flex flex-row text-orange-400 mr-5">--}}
{{--                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">--}}
{{--                        <path fill-rule="evenodd"--}}
{{--                              d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z"--}}
{{--                              clip-rule="evenodd"/>--}}
{{--                    </svg>--}}
{{--                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">--}}
{{--                        <path fill-rule="evenodd"--}}
{{--                              d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z"--}}
{{--                              clip-rule="evenodd"/>--}}
{{--                    </svg>--}}
{{--                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">--}}
{{--                        <path fill-rule="evenodd"--}}
{{--                              d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z"--}}
{{--                              clip-rule="evenodd"/>--}}
{{--                    </svg>--}}
{{--                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">--}}
{{--                        <path fill-rule="evenodd"--}}
{{--                              d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z"--}}
{{--                              clip-rule="evenodd"/>--}}
{{--                    </svg>--}}
{{--                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"--}}
{{--                         stroke="currentColor" class="w-6 h-6">--}}
{{--                        <path stroke-linecap="round" stroke-linejoin="round"--}}
{{--                              d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z"/>--}}
{{--                    </svg>--}}
{{--                </p>--}}
{{--                <a href="" class="text-purple-700 hover:text-purple-500">--}}
{{--                    64 Reviews</a>--}}
{{--            </div>--}}
{{--            <!--The End of Review Section-->--}}
            <!--The Quantity Section-->
            <div class="flex justify-between mb-3">
                <label for="">Quantity</label>
                <input type="number"
                       class="focus:border-purple-600 focus:ring-purple-600 py-1 px-2 border-gray-400 rounded w-20"
                       value="1" name="quantity" x-ref="quantityEl"/>
            </div>
            <!--The End of Quantity Section-->
            <!--Add to cart Button-->
            <button class="btn-primary flex items-center justify-center w-full" @click="addToCart($refs.quantityEl.value)">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor" class="w-6 h-6 mr-2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z"/>
                </svg>
                Add to cart
            </button>
            <!--End of the Add to cart Button-->
            <hr class="my-5 border-white"/>
            <!--The information Section-->
            <div class="mb-3" x-data="{expanded : false}">
                <div x-show="expanded" x-collapse.min.120px class="wysiwyg-editor">
                    {{ $product->description }}
{{--                    <table>--}}
{{--                        <tbody>--}}
{{--                        <tr>--}}
{{--                            <td>Connectivity Technology</td>--}}
{{--                            <td>USB</td>--}}
{{--                        </tr>--}}
{{--                        <tr>--}}
{{--                            <td>Recommended Uses For Product</td>--}}
{{--                            <td>Gaming</td>--}}
{{--                        </tr>--}}
{{--                        <tr>--}}
{{--                            <td>Brand</td>--}}
{{--                            <td>Logitech G</td>--}}
{{--                        </tr>--}}
{{--                        <tr>--}}
{{--                            <td>Compatible Devices</td>--}}
{{--                            <td>Personal Computer</td>--}}
{{--                        </tr>--}}
{{--                        <tr>--}}
{{--                            <td>Series</td>--}}
{{--                            <td>Logitech G502 HERO High Performance Gaming Mouse</td>--}}
{{--                        </tr>--}}
{{--                        </tbody>--}}
{{--                    </table>--}}
{{--                    <p class="">--}}
{{--                        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Deserunt--}}
{{--                        suscipit natus quisquam optio voluptatem quo beatae ex similique,--}}
{{--                        pariatur laborum asperiores explicabo delectus culpa cumque corrupti--}}
{{--                        quasi incidunt at quos!--}}
{{--                    </p>--}}
{{--                    <h4>About the item</h4>--}}
{{--                    <ul class="list-disc pl-6">--}}
{{--                        <li>--}}
{{--                            Hero 25K sensor through a software update from G HUB, this upgrade--}}
{{--                            is free to all players: Our most advanced, with 1:1 tracking,--}}
{{--                            400-plus ips, and 100 - 25,600 max dpi sensitivity plus zero--}}
{{--                            smoothing, filtering, or acceleration--}}
{{--                        </li>--}}
{{--                        <li>--}}
{{--                            11 customizable buttons and onboard memory: Assign custom commands--}}
{{--                            to the buttons and save up to five ready to play profiles directly--}}
{{--                            to the mouse--}}
{{--                        </li>--}}
{{--                        <li>--}}
{{--                            Adjustable weight system: Arrange up to five removable 3.6 grams--}}
{{--                            weights inside the mouse for personalized weight and balance--}}
{{--                            tuning--}}
{{--                        </li>--}}
{{--                        <li>--}}
{{--                            Programmable RGB Lighting and Lightsync technology: Customize--}}
{{--                            lighting from nearly 16.8 million colors to match your team's--}}
{{--                            colors, sport your own or sync colors with other Logitech G gear--}}
{{--                        </li>--}}
{{--                        <li>--}}
{{--                            Mechanical switch button tensioning: Metal spring tensioning--}}
{{--                            system and pivot hinges are built into left and right gaming mouse--}}
{{--                            buttons for a crisp, clean click feel with rapid click feedback--}}
{{--                        </li>--}}
{{--                    </ul>--}}
                </div>
                <p class="text-right">
                    <a @click="expanded = !expanded" href="javascript:void(0)"
                       class="text-purple-500 hover:text-purple-700" x-text="expanded ? 'Read less' : 'Read more'"></a>
                </p>
            </div>

            <!--The End of information Section-->
        </div>
        <!--End of The sidebar-->
    </section>
    <!--The end of Product item-->
</x-app-layout>
