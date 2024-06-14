<x-splade-link href="{{url('shop/product/' . $product->slug)}}" class="group">
    <div class="h-48 aspect-h-1 aspect-w-1 w-full overflow-hidden border border-zinc-200 dark:border-zinc-600 rounded-lg bg-zinc-200 dark:bg-zinc-800 xl:aspect-h-8 xl:aspect-w-7 relative">
        @if($product->getMedia('featured_image')->first()?->getUrl())
            <img src="{{$product->getMedia('featured_image')->first()?->getUrl() ?? url('placeholder.webp')}}" alt="{{$product->name}}" class="h-full w-full object-cover object-center group-hover:opacity-75">
        @else
            <div class="h-full w-full  flex flex-col justify-center items-center text-zinc-700 dark:text-zinc-200">
                <i class="bx bxs-cart text-7xl"></i>
            </div>
        @endif
            @if($product->category)
            <div class="absolute z-0 top-3 left-3 bg-zinc-800 dark:bg-zinc-200 text-white dark:text-zinc-700 px-2 py-1 rounded-lg bg-opacity-75">
                <span>{{$product->category?->name}}</span>
            </div>
        @endif
    </div>
    <h3 class="mt-2 text-xl text-zinc-700 dark:text-zinc-100 font-bold">{{$product->name}}</h3>
    <p class="mt-1 text-lg font-medium text-zinc-900 dark:text-zinc-100">
        @if($product->discount)
            <small class="text-danger-500 mx-2"><del>{!! dollar($product->price) !!}</del></small>
        @endif
        {!! dollar(($product->price + $product->vat) - $product->discount) !!}

    </p>
</x-splade-link>
