@php
    $section = $page->meta($section['uuid']);
    if(!isset($options)){
        $options = \TomatoPHP\TomatoCategory\Models\Type::where('for', 'product-options')->where('type', 'type')->get();
    }
    if(!isset($categories)){
        $categories = \TomatoPHP\TomatoCategory\Models\Category::where('for', 'product-categories')->where('menu', true)->where('activated', true)->get();
    }
    if(!isset($products)){
        $products = \TomatoPHP\TomatoProducts\Models\Product::where('is_activated', true)->paginate(9);
    }
@endphp
<section  class="bg-white dark:bg-zinc-900 min-h-screen">
    <div>
        <div>
            @include('tomato-sections::sections.shop.partials.mobile-filter')

            <main class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                @include('tomato-sections::sections.shop.partials.header', ['title' => $section['title_'.app()->getLocale()] ?? __('Shop')])

                <section aria-labelledby="products-heading" class="pb-24 pt-6">
                    <h2 id="products-heading" class="sr-only">{{__('Products')}}</h2>

                    <div class="grid grid-cols-1 gap-x-8 gap-y-10 lg:grid-cols-4">
                        <x-splade-form method="GET" action="{{url('shop')}}" submit-on-change>
                            @include('tomato-sections::sections.shop.partials.web-filter', ['options' => $options])
                        </x-splade-form>

                        <!-- Product grid -->
                        <div class="lg:col-span-3">
                            <div>
                                <div class="mx-auto max-w-2xl px-4 sm:px-6 lg:max-w-7xl lg:px-8">
                                    <h2 class="sr-only">{{__('Products')}}</h2>

                                    <div class="grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3 xl:gap-x-8">
                                        @foreach($products as $product)
                                            @include('tomato-sections::sections.shop.partials.product-card')
                                        @endforeach
                                    </div>

                                    <div class="my-4">
                                        {!! $products->links('tomato-sections::sections.pagination') !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </main>
        </div>
    </div>
</section>
