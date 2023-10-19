<header x-data="{
        mobileMenuOpen : false,
        cartItemCount:{{ \App\Http\Helpers\Cart::getCartItemsCount()  }}
        }"
        @cart-change.window="cartItemCount = $event.detail.count"
        class="flex justify-between px-5 bg-slate-800 text-white">
    <!--The Logo-->
    <div>
        <a class="py-navbar-item px-navbar-item block" href="{{ route('home') }}"> Logo </a>
    </div>
    <!--The end of the Logo-->
    <!--The Main Menu in the middle-->
    <nav class="hidden md:block">
    </nav>
    <!--The End of Main Menu-->
    <!--The Right Menu Top for Basket and staff-->
    <nav class="hidden md:block">
        <ul class="grid grid-flow-col items-center">
            <li>
                <a class="py-navbar-item px-navbar-item flex items-center relative" href="{{ route('cart.index') }}">
                    Cart
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="w-6 h-6 ml-2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                    </svg>
                    <small x-show="cartItemCount" x-transition x-text="cartItemCount" x-cloak
                           class="rounded-full bg-red-600 py-[1px] px-[7px] absolute top-1 right-0"></small>
                </a>
            </li>
            @if(!Auth::guest())
            <li x-data="{open:false}" class="relative">
                <a @click="open = !open" class="py-navbar-item px-navbar-item flex items-center cursor-pointer">
                    My Account
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="w-6 h-6 ml-2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                    </svg>
                </a>
                <ul x-cloak @click.outside="open = false" x-show="open" x-transition
                    class="absolute z-20 right-0 w-48 bg-slate-800 py-2">
                    <li class="py-2 px-3 block hover:bg-slate-600">
                        <a class="flex items-center" href="{{ route('profile') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                 stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                            </svg>
                            My Profile
                        </a>
                    </li>
                    <li class="py-2 px-3 block hover:bg-slate-600">
                        <a class="flex items-center justify-between" href="">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                                </svg>

                                Watch list
                            </div>
                            <small x-show="$store.header.watchListItems" x-transition
                                   x-text="$store.header.watchListItems" x-cloak
                                   class="rounded-full bg-red-600 py-[1px] px-[7px]  top-1 right-0"></small>
                        </a>
                    </li>
                    <li class="py-2 px-3 block hover:bg-slate-600">
                        <a class="flex items-center" href="{{ route('order.index') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                 stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                            </svg>

                            Orders</a>
                    </li>
                    <li class="py-2 px-3 block hover:bg-slate-600">
                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                            <button type="submit" class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
                                </svg>

                                Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </li>
            @else
            <li>
                <a class="py-navbar-item px-navbar-item flex items-center" href="{{ route('login') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="w-6 h-6 ml-2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
                    </svg>

                    Login
                </a>
            </li>
            <li>
                <a class="py-1 px-2 rounded flex items-center transition-colors hover:bg-emerald-500 bg-emerald-700"
                   href="{{ route('register') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="w-6 h-6 mr-2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z" />
                    </svg>

                    Sign up For Free
                </a>
            </li>
            @endif
        </ul>
    </nav>
    <!--End of The Right Menu Top for Basket and staff-->
    <!--The buttn for the MobileMenu-->
    <button @click="mobileMenuOpen = !mobileMenuOpen" class="block md:hidden">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
            <path fill-rule="evenodd"
                  d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10zm0 5.25a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75a.75.75 0 01-.75-.75z"
                  clip-rule="evenodd" />
        </svg>
    </button>
    <!--End of The buttn for the MobileMenu-->
    <!--The Mobile menu Body-->
    <div class="block md:hidden z-50 fixed top-0 transition-all duration-700   bottom-0 h-full w-[220px] bg-slate-800 shadow-2xl transition-all" :class="mobileMenuOpen ? 'left-0' : 'left-[-220px]'">

        <ul class="">
            <li>
                <a class="py-navbar-item px-navbar-item flex items-center justify-between relative" href="{{ route('cart.index') }}">
                    <div class="flex items-center">
                        Cart
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" class="w-6 h-6 ml-2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                        </svg>
                    </div>
                    <small x-show="cartItemCount" x-transition x-text="cartItemCount"
                           class="rounded-full bg-red-600 py-[1px] px-[7px]"></small>
                </a>
            </li>
            @if(!Auth::guest())
            <li x-data="{ open : false}" class="relative">
                <a @click="open = !open" class="py-navbar-item px-navbar-item flex justify-between items-center"
                    >
                    My Account
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="w-6 h-6 ml-2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                    </svg>
                    </a>
                    <ul x-show="open" x-transition class="w-full bg-slate-800 py-2">
                        <li class="py-2 px-3 block hover:bg-slate-600">
                            <a class="flex items-center" href="{{ route('profile') }}">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                                </svg>
                                My Profile
                            </a>
                        </li>
                        <li class="py-2 px-3 block hover:bg-slate-600">
                            <a class="flex items-center justify-between" href="">
                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                                    </svg>

                                    Watch list
                                </div>
                                <small x-show="$store.header.watchListItems" x-transition
                                       x-text="$store.header.watchListItems" x-cloak
                                       class="rounded-full bg-red-600 py-[1px] px-[7px]  top-1 right-0"></small>
                            </a>
                        </li>
                        <li class="py-2 px-3 block hover:bg-slate-600">
                            <a class="flex items-center" href="{{ route('order.index') }}">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                </svg>

                                Orders</a>
                        </li>
                        <li class="py-2 px-3 block hover:bg-slate-600">
                            <form action="{{ route('logout') }}}">
                                @csrf
                                <button type="submit" class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
                                    </svg>

                                    Logout
                                </button>
                            </form>
                        </li>
                    </ul>
            </li>
            @else
            <li>
                <a class="py-navbar-item px-navbar-item flex items-center" href="{{ route('login') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="w-6 h-6 mr-2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
                    </svg>

                    Login
                </a>
            </li>
            <li>
                <a class="py-1 px-2 rounded flex items-center transition-colors hover:bg-emerald-500 bg-emerald-700"
                   href="{{ route('register') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="w-6 h-6 mr-2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z" />
                    </svg>

                    Sign up For Free
                </a>
            </li>
            @endif
        </ul>
    </div>
    <!--The end of The Mobile menu -->
</header>
