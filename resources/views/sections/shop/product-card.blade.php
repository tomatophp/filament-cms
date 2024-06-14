<x-splade-link href="{{url('shop/product/' . $product->slug)}}" class="group">
    <div class="h-48 aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-lg bg-gray-200 xl:aspect-h-8 xl:aspect-w-7 relative">
        <img src="{{$product->getMedia('featured_image')->first()?->getUrl() ?? url('placeholder.webp')}}" alt="{{$product->name}}" class="h-full w-full object-cover object-center group-hover:opacity-75">
        <div class="absolute z-0 top-3 left-3 bg-gray-800 text-white px-2 py-1 rounded-sm bg-opacity-75">
            <span>{{$product->category->name}}</span>
        </div>
    </div>
    <h3 class="mt-4 text-xl text-gray-700 font-bold">{{$product->name}}</h3>
    <p class="mt-1 text-lg font-medium text-gray-900">{!! dollar(($product->price + $product->vat) - $product->discount) !!}
        @if($product->discount)
            <small class="text-danger-500 mx-2"><del>{!! dollar($product->price) !!}</del></small>
        @endif
    </p>
</x-splade-link>
