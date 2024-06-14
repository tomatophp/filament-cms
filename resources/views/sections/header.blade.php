@php $section = $page->meta($section['uuid']); @endphp
<x-splade-data
    default="{
        dark: false,
        lang: {
            id: 'en',
            name: 'English'
        }
    }"

    remember="admin"
    local-storage
>
<header class="bg-white dark:bg-zinc-800 dark:border-zinc-700 border-b border-zinc-200">
    <div
        class="mx-auto flex h-16 max-w-screen-xl items-center gap-8 px-4 sm:px-6 lg:px-8 z-10"
    >
        <x-splade-link class="block text-teal-600" :href="route('home.index')">
            <span class="sr-only">{{__('Home')}}</span>
            @if(setting('site_logo'))
                <img src="{{setting('site_logo')}}" class="h-8" />
            @else
                <x-tomato-application-logo class="w-8 h-8"/>
            @endif
        </x-splade-link>

        <div class="flex flex-1 items-center justify-end md:justify-between">
            <nav aria-label="Global" class="hidden md:block">
                <ul class="flex items-center gap-6 text-sm">
                    @foreach(menu($section['menu_id'] ?? 'main') as $item)
                        <li>
                            <x-splade-link :href="$item->url" class="text-zinc-500 dark:text-zinc-100 transition hover:text-zinc-500/75">
                                {{$item->name}}
                            </x-splade-link>
                        </li>
                    @endforeach
                </ul>
            </nav>

            <div class="flex items-center gap-4">
                <div class="flex items-center gap-4">
                    <x-splade-form method="GET" action="{{url('shop')}}" class="hidden lg:block relative border border-zinc-500 dark:border-zinc-700 dark:border-zinc-600 rounded-full" :default="['search' => request()->search ?? '']">
                        <label class="sr-only" for="search"> {{__('Search')}} </label>

                        <input

                            class="h-10 w-full rounded-full border-none bg-white dark:bg-zinc-700 pe-10 ps-4 text-sm shadow-sm sm:w-56"
                            id="search"
                            v-model="form.search"
                            type="search"
                            placeholder="{{__('Search website...')}}"
                        />

                        <button
                            type="button"
                            class="absolute end-1 top-1/2 -translate-y-1/2 rounded-full bg-zinc-50 dark:bg-zinc-800 p-2 text-zinc-600 dark:text-zinc-200   transition hover:text-zinc-700"
                        >
                            <span class="sr-only">{{__('Search')}}</span>
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-4 w-4"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="2"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
                                />
                            </svg>
                        </button>
                    </x-splade-form>

                    @php $langs = collect(config('tomato-admin.langs')) @endphp
                    <x-tomato-admin-dropdown>
                        <x-slot:button>
                            <button class="hidden lg:flex flex-col justify-center items-center rounded-full border border-zinc-500 dark:border-zinc-700 p-2 text-zinc-600 shadow-sm hover:text-zinc-700 relative group w-9 h-9 text-center ">
                                {{ isset($langs->where('key', app()->getLocale())->first()['flag']) ? $langs->where('key', app()->getLocale())->first()['flag'] : __('Lang') }}
                            </button>
                        </x-slot:button>

                        @foreach($langs as $lang)
                            <Link href="{{route('home.lang', ['lang' => $lang])}}" method="POST"  class="@if($lang['key'] === app()->getLocale())  text-primary-600 dark:text-primary-200 hover:text-zinc-500  @else text-zinc-600 dark:text-zinc-200 hover:text-primary-500 @endif whitespace-nowrap block w-full px-4 py-2  text-sm leading-5 text-zinc-700 dark:text-zinc-300 hover:bg-zinc-100 dark:hover:bg-zinc-800 focus:outline-none focus:bg-zinc-100 dark:focus:bg-zinc-800 transition duration-150 ease-in-out">
                            <div class="flex justify-start gap-2">
                                <div class="flex flex-col items-center justify-center">
                                    {{$lang['flag']}}
                                </div>
                                <div>
                                    {{$lang['label'][app()->getLocale()]}}
                                </div>
                            </div>
                            </Link>
                        @endforeach
                    </x-tomato-admin-dropdown>

                    <button
                        @click.prevent="data.dark = !data.dark; $splade.refresh()"
                        class="hidden md:block shrink-0 rounded-full border border-zinc-500 dark:border-zinc-700 p-2 text-zinc-600 shadow-sm hover:text-zinc-700 relative group"
                    >
                        <div class="flex flex-col justify-center items-center text-zinc-500 group-hover:text-primary-500 cursor-pointer transition-colors ease-in-out duration-30">
                            <x-heroicon-s-sun v-if="data.dark" class="filament-icon-button-icon w-4 h-4"/>
                            <x-heroicon-s-moon v-else class="filament-icon-button-icon w-4 h-4"/>
                        </div>
                    </button>

                    <x-splade-link
                        modal
                        :href="route('cart.cart')"
                        class="hidden md:block shrink-0  dark:border-zinc-700 rounded-full border border-zinc-500 p-2 text-zinc-600 shadow-sm hover:text-zinc-700 relative group"
                    >
                        @php
                            $cart = \TomatoPHP\TomatoEcommerce\Models\Cart::where('session_id', \Illuminate\Support\Facades\Cookie::get('cart'))->count();
                        @endphp
                        @if($cart)
                            <div class="absolute top-0 font-bold left-6 bg-white border border-zinc-500 shadow-sm text-zinc-500 rounded-full text-[10px] w-4 h-4 text-center">
                                {{ $cart }}
                            </div>
                        @endif
                        <span class="sr-only">{{__('Cart')}}</span>
                        <div class="flex flex-col justify-center items-center text-zinc-500 group-hover:text-warning-500 cursor-pointer transition-colors ease-in-out duration-30">
                            <i class="bx bxs-cart text-lg"></i>
                        </div>
                    </x-splade-link>


                    @if(auth('accounts')->user())
                        <x-splade-link
                            modal
                            :href="route('profile.wishlist.index')"
                            class="hidden md:block shrink-0 dark:border-zinc-700 rounded-full border border-zinc-500 p-2 text-zinc-600 shadow-sm hover:text-zinc-700 relative group"
                        >
                            @php
                                $wishlist = \TomatoPHP\TomatoEcommerce\Models\Wishlist::where('account_id', auth('accounts')->user()->id)->count();
                            @endphp
                            @if($wishlist)
                                <div class="absolute top-0 font-bold left-6 bg-white border border-zinc-500 shadow-sm text-zinc-500 rounded-full text-[10px] w-4 h-4 text-center">
                                    {{ $wishlist }}
                                </div>
                            @endif
                            <span class="sr-only">{{__('Wishlist')}}</span>
                            <div class="flex flex-col justify-center items-center text-zinc-500 group-hover:text-danger-500 cursor-pointer transition-colors ease-in-out duration-30">
                                <i class="bx bxs-heart text-md"></i>
                            </div>
                        </x-splade-link>

                        <x-splade-link
                            modal
                            :href="route('profile.notifications.index')"
                            class="hidden md:block shrink-0 dark:border-zinc-700 rounded-full border border-zinc-500 p-2 text-zinc-600 shadow-sm hover:text-zinc-700 relative group"
                        >
                            @php
                                $notifications = \TomatoPHP\TomatoNotifications\Models\UserNotification::where('model_id', auth('accounts')->user()->id)->where('model_type', config('tomato-crm.model'))->whereDoesntHave('userRead')->count();
                            @endphp
                            @if($notifications)
                                <div class="absolute top-0 font-bold left-6 bg-white border border-zinc-500 shadow-sm text-zinc-500 rounded-full text-[10px] w-4 h-4 text-center">
                                    {{ $notifications }}
                                </div>
                            @endif
                            <span class="sr-only">{{__('Notifications')}}</span>
                            <div class="flex flex-col justify-center items-center text-zinc-500 group-hover:text-primary-500 cursor-pointer transition-colors ease-in-out duration-30">
                                <i class="bx bxs-bell text-md"></i>
                            </div>
                        </x-splade-link>
                    @endif
                </div>

                @if(auth('accounts')->user())
                    <span
                        aria-hidden="true"
                        class="hidden md:block h-6 w-px rounded-full bg-zinc-200 md:hidden"
                    ></span>

                    @php
                        $email = auth('accounts')->user()->email;
                        $default = url('placeholder.webp');
                        $size = 40;
                        $grav_url = "https://www.gravatar.com/avatar/" . md5( strtolower( trim( $email ) ) ) . "?d=mp&s=" . $size;
                    @endphp



                    <x-tomato-admin-dropdown id="profile-dropdown">
                        <x-slot:button>
                            <div class="hidden md:block shrink-0">
                                <span class="sr-only">{{__('Profile')}}</span>
                                <img
                                    alt="{{auth('accounts')->user()->name}}"
                                    src="{{$grav_url}}"
                                    class="h-10 w-10 rounded-full object-cover"
                                />
                            </div>
                        </x-slot:button>

                        <x-tomato-admin-dropdown-item icon="bx bxs-user" type="link" label="{{__('Profile')}}" :href="route('profile.index')" />
                        <x-tomato-admin-dropdown-item warning icon="bx bxs-map" type="link" label="{{__('Address')}}" :href="route('profile.address.index')" />
                        <x-tomato-admin-dropdown-item warning icon="bx bxs-rocket" type="link" label="{{__('Orders')}}" :href="route('profile.orders.index')" />
                        <x-tomato-admin-dropdown-item success icon="bx bxs-wallet" type="link" label="{{__('Wallet')}}" :href="route('profile.wallet.index')" />
                        <x-tomato-admin-dropdown-item icon="bx bxs-cog" type="link" label="{{__('Settings')}}" :href="route('profile.edit')" />
                        <x-tomato-admin-dropdown-item danger icon="bx bxs-user" type="link" label="{{__('Logout')}}" :href="route('profile.logout')" />

                    </x-tomato-admin-dropdown>
                @else

                    <div class="hidden md:flex sm:gap-4">
                        <x-tomato-admin-button :href="route('accounts.login')">
                            {{__('Login')}}
                        </x-tomato-admin-button>
                        <x-tomato-admin-button secondary :href="route('accounts.register')">
                            {{__('Register')}}
                        </x-tomato-admin-button>
                    </div>

                @endif

                <Link
                    href="#menu"
                    class="block rounded bg-zinc-100 dark:bg-zinc-700  p-2.5 text-zinc-600 dark:text-zinc-200 transition hover:text-zinc-600/75 md:hidden"
                >
                    <span class="sr-only">{{__('Toggle menu')}}</span>
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="2"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M4 6h16M4 12h16M4 18h16"
                        />
                    </svg>
                </Link>
                <x-splade-modal name="menu" slideover>
                    <x-splade-data
                        default="{
                            dark: false,
                            lang: {
                                id: 'en',
                                name: 'English'
                            }
                        }"

                        remember="admin"
                        local-storage
                    >
                    <x-splade-form method="GET" action="{{url('shop')}}" class="block mt-12 mb-4 relative border border-zinc-500 dark:border-zinc-700 dark:border-zinc-600 rounded-full" :default="['search' => request()->search ?? '']">
                        <label class="sr-only" for="search"> {{__('Search')}} </label>

                        <input

                            class="h-10 w-full rounded-full border-none bg-white dark:bg-zinc-700 pe-10 ps-4 text-sm shadow-sm sm:w-56"
                            id="search"
                            v-model="form.search"
                            type="search"
                            placeholder="{{__('Search website...')}}"
                        />

                        <button
                            type="button"
                            class="absolute end-1 top-1/2 -translate-y-1/2 rounded-full bg-zinc-50 dark:bg-zinc-800 p-2 text-zinc-600 dark:text-zinc-200   transition hover:text-zinc-700"
                        >
                            <span class="sr-only">{{__('Search')}}</span>
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-4 w-4"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="2"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
                                />
                            </svg>
                        </button>
                    </x-splade-form>
                    <div class="flex justify-center mb-8">
                        <div class="flex justify-center items-center gap-4">
                            @php $langs = collect(config('tomato-admin.langs')) @endphp
                            <div>
                                <x-tomato-admin-dropdown>
                                    <x-slot:button>
                                        <button class="flex flex-col justify-center items-center rounded-full border border-zinc-500 dark:border-zinc-700 p-2 text-zinc-600 shadow-sm hover:text-zinc-700 relative group w-9 h-9 text-center ">
                                            {{ isset($langs->where('key', app()->getLocale())->first()['flag']) ? $langs->where('key', app()->getLocale())->first()['flag'] : __('Lang') }}
                                        </button>
                                    </x-slot:button>

                                    @foreach($langs as $lang)
                                        <Link href="{{route('home.lang', ['lang' => $lang])}}" method="POST"  class="@if($lang['key'] === app()->getLocale())  text-primary-600 dark:text-primary-200 hover:text-zinc-500  @else text-zinc-600 dark:text-zinc-200 hover:text-primary-500 @endif whitespace-nowrap block w-full px-4 py-2  text-sm leading-5 text-zinc-700 dark:text-zinc-300 hover:bg-zinc-100 dark:hover:bg-zinc-800 focus:outline-none focus:bg-zinc-100 dark:focus:bg-zinc-800 transition duration-150 ease-in-out">
                                        <div class="flex justify-start gap-2">
                                            <div class="flex flex-col items-center justify-center">
                                                {{$lang['flag']}}
                                            </div>
                                            <div>
                                                {{$lang['label'][app()->getLocale()]}}
                                            </div>
                                        </div>
                                        </Link>
                                    @endforeach
                                </x-tomato-admin-dropdown>
                            </div>

                            <button
                                @click.prevent="data.dark = !data.dark; $splade.refresh()"
                                class="block shrink-0 rounded-full border border-zinc-500 dark:border-zinc-700 p-2 text-zinc-600 shadow-sm hover:text-zinc-700 relative group"
                            >
                                <div class="flex flex-col justify-center items-center text-zinc-500 group-hover:text-primary-500 cursor-pointer transition-colors ease-in-out duration-30">
                                    <x-heroicon-s-sun v-if="data.dark" class="filament-icon-button-icon w-4 h-4"/>
                                    <x-heroicon-s-moon v-else class="filament-icon-button-icon w-4 h-4"/>
                                </div>
                            </button>

                            <x-splade-link
                                modal
                                :href="route('cart.cart')"
                                class="block shrink-0  dark:border-zinc-700 rounded-full border border-zinc-500 p-2 text-zinc-600 shadow-sm hover:text-zinc-700 relative group"
                            >
                                @php
                                    $cart = \TomatoPHP\TomatoEcommerce\Models\Cart::where('session_id', \Illuminate\Support\Facades\Cookie::get('cart'))->count();
                                @endphp
                                @if($cart)
                                    <div class="absolute top-0 font-bold left-6 bg-white border border-zinc-500 shadow-sm text-zinc-500 rounded-full text-[10px] w-4 h-4 text-center">
                                        {{ $cart }}
                                    </div>
                                @endif
                                <span class="sr-only">{{__('Cart')}}</span>
                                <div class="flex flex-col justify-center items-center text-zinc-500 group-hover:text-warning-500 cursor-pointer transition-colors ease-in-out duration-30">
                                    <i class="bx bxs-cart text-lg"></i>
                                </div>
                            </x-splade-link>


                            @if(auth('accounts')->user())
                                <x-splade-link
                                    modal
                                    :href="route('profile.wishlist.index')"
                                    class="block shrink-0 dark:border-zinc-700 rounded-full border border-zinc-500 p-2 text-zinc-600 shadow-sm hover:text-zinc-700 relative group"
                                >
                                    @php
                                        $wishlist = \TomatoPHP\TomatoEcommerce\Models\Wishlist::where('account_id', auth('accounts')->user()->id)->count();
                                    @endphp
                                    @if($wishlist)
                                        <div class="absolute top-0 font-bold left-6 bg-white border border-zinc-500 shadow-sm text-zinc-500 rounded-full text-[10px] w-4 h-4 text-center">
                                            {{ $wishlist }}
                                        </div>
                                    @endif
                                    <span class="sr-only">{{__('Wishlist')}}</span>
                                    <div class="flex flex-col justify-center items-center text-zinc-500 group-hover:text-danger-500 cursor-pointer transition-colors ease-in-out duration-30">
                                        <i class="bx bxs-heart text-md"></i>
                                    </div>
                                </x-splade-link>

                                <x-splade-link
                                    modal
                                    :href="route('profile.notifications.index')"
                                    class="block shrink-0 dark:border-zinc-700 rounded-full border border-zinc-500 p-2 text-zinc-600 shadow-sm hover:text-zinc-700 relative group"
                                >
                                    @php
                                        $notifications = \TomatoPHP\TomatoNotifications\Models\UserNotification::where('model_id', auth('accounts')->user()->id)->where('model_type', config('tomato-crm.model'))->whereDoesntHave('userRead')->count();
                                    @endphp
                                    @if($notifications)
                                        <div class="absolute top-0 font-bold left-6 bg-white border border-zinc-500 shadow-sm text-zinc-500 rounded-full text-[10px] w-4 h-4 text-center">
                                            {{ $notifications }}
                                        </div>
                                    @endif
                                    <span class="sr-only">{{__('Notifications')}}</span>
                                    <div class="flex flex-col justify-center items-center text-zinc-500 group-hover:text-primary-500 cursor-pointer transition-colors ease-in-out duration-30">
                                        <i class="bx bxs-bell text-md"></i>
                                    </div>
                                </x-splade-link>
                            @endif

                            @if(auth('accounts')->user())
                                <span
                                    aria-hidden="true"
                                    class="block h-6 w-px rounded-full bg-zinc-200"
                                ></span>

                                @php
                                    $email = auth('accounts')->user()->email;
                                    $default = url('placeholder.webp');
                                    $size = 40;
                                    $grav_url = "https://www.gravatar.com/avatar/" . md5( strtolower( trim( $email ) ) ) . "?d=mp&s=" . $size;
                                @endphp



                                <x-tomato-admin-dropdown id="profile-dropdown">
                                    <x-slot:button>
                                        <div class="block shrink-0">
                                            <span class="sr-only">{{__('Profile')}}</span>
                                            <img
                                                alt="{{auth('accounts')->user()->name}}"
                                                src="{{$grav_url}}"
                                                class="h-10 w-10 rounded-full object-cover"
                                            />
                                        </div>
                                    </x-slot:button>

                                    <x-tomato-admin-dropdown-item icon="bx bxs-user" type="link" label="{{__('Profile')}}" :href="route('profile.index')" />
                                    <x-tomato-admin-dropdown-item warning icon="bx bxs-map" type="link" label="{{__('Address')}}" :href="route('profile.address.index')" />
                                    <x-tomato-admin-dropdown-item warning icon="bx bxs-rocket" type="link" label="{{__('Orders')}}" :href="route('profile.orders.index')" />
                                    <x-tomato-admin-dropdown-item success icon="bx bxs-wallet" type="link" label="{{__('Wallet')}}" :href="route('profile.wallet.index')" />
                                    <x-tomato-admin-dropdown-item icon="bx bxs-cog" type="link" label="{{__('Settings')}}" :href="route('profile.edit')" />
                                    <x-tomato-admin-dropdown-item danger icon="bx bxs-user" type="link" label="{{__('Logout')}}" :href="route('profile.logout')" />

                                </x-tomato-admin-dropdown>
                            @endif
                        </div>
                    </div>
                    <nav aria-label="Global">
                        <ul class="flex flex-col items-center gap-6 text-lg">
                            @foreach(menu($section['menu_id'] ?? 'main') as $item)
                                <li>
                                    <x-splade-link :href="$item->url" class="text-zinc-500 dark:text-zinc-100 transition hover:text-zinc-500/75">
                                        {{$item->name}}
                                    </x-splade-link>
                                </li>
                            @endforeach
                        </ul>
                    </nav>
                        @if(!auth('accounts')->user())
                            <div class="flex justify-center items-center gap-4 my-4">
                                <x-tomato-admin-button
                                    :href="route('accounts.login')"
                                >
                                    {{__('Login')}}
                                </x-tomato-admin-button>

                                <x-tomato-admin-button
                                    secondary
                                    :href="route('accounts.register')"
                                >
                                    {{__('Register')}}
                                </x-tomato-admin-button>
                            </div>
                        @endif
                    </x-splade-data>
                </x-splade-modal>
            </div>
        </div>
    </div>
</header>
</x-splade-data>
<x-splade-script>
    if(localStorage.getItem("splade") && typeof document !== undefined){
    let spladeStorage = JSON.parse(localStorage.getItem("splade"));
    let dark = spladeStorage?.admin?.dark;
    document.body.classList[dark ? "add" : "remove"]("dark-scrollbars");
    document.documentElement.classList[dark ? "add" : "remove"]("dark");
    let htmlEl = document.querySelector("html");

    if ("{{app()->getLocale()}}" === "ar") {
    htmlEl.setAttribute("dir", "rtl");
    } else {
    htmlEl.setAttribute("dir", "ltr");
    }
    }
</x-splade-script>
