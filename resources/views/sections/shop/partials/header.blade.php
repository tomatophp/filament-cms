<div class="flex items-baseline justify-between border-b border-zinc-200 dark:border-zinc-700 pb-6 pt-8">
    <h1 class="text-4xl font-bold tracking-tight text-zinc-900 dark:text-zinc-100">
        {{$title ?? __('Shop')}}
    </h1>

    <div class="flex items-center">
        <x-splade-toggle>
            <div  class="relative inline-block text-left">
                <x-tomato-admin-dropdown>
                    <x-slot:button>
                        <button @click.prevent="toggle" type="button" class="group inline-flex justify-center text-sm font-medium text-zinc-700 dark:text-zinc-200 dark:hover:text-zinc-400 hover:text-zinc-900" id="menu-button" aria-expanded="false" aria-haspopup="true">
                            {{__('Sort')}}
                            <svg class="ltr:-mr-1 ltr:ml-1 rtl:-ml-1 rtl:mr-1 h-5 w-5 flex-shrink-0 text-zinc-400 group-hover:text-zinc-500" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </x-slot:button>

                    <x-tomato-admin-dropdown-item type="link" :label="__('Most Popular')" :href="url('shop?orderBy=popular')"  method="GET" />
                    <x-tomato-admin-dropdown-item type="link" :label="__('Best Rating')" :href="url('shop?orderBy=rating')"  method="GET" />
                    <x-tomato-admin-dropdown-item type="link" :label="__('Newest')" :href="url('shop?orderBy=newest')"  method="GET" />
                    <x-tomato-admin-dropdown-item type="link" :label="__('Price: Low to High')" :href="url('shop?orderBy=lowToHigh')"  method="GET" />
                    <x-tomato-admin-dropdown-item type="link" :label="__('Price: High to Low')" :href="url('shop?orderBy=highToLow')"  method="GET" />
                </x-tomato-admin-dropdown>
            </div>

        </x-splade-toggle>
        <Link href="#filter" type="button" class="-m-2 ltr:ml-4 rtl:mr-4 p-2 text-zinc-400 hover:text-zinc-500 sm:ml-6 lg:hidden">
            <span class="sr-only">{{__('Filters')}}</span>
            <svg class="h-5 w-5" aria-hidden="true" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M2.628 1.601C5.028 1.206 7.49 1 10 1s4.973.206 7.372.601a.75.75 0 01.628.74v2.288a2.25 2.25 0 01-.659 1.59l-4.682 4.683a2.25 2.25 0 00-.659 1.59v3.037c0 .684-.31 1.33-.844 1.757l-1.937 1.55A.75.75 0 018 18.25v-5.757a2.25 2.25 0 00-.659-1.591L2.659 6.22A2.25 2.25 0 012 4.629V2.34a.75.75 0 01.628-.74z" clip-rule="evenodd" />
            </svg>
        </Link>
    </div>
</div>
