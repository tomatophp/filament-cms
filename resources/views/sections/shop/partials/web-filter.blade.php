@php
    $loadKeys = [];
    $loadForm = [];
    foreach($options as $option){
        $loadKeys[$option->key] = false;
        if(request()->has($option->key)){
            $loadForm[$option->key] = request()->{$option->key};
        }
        else {
            $loadForm[$option->key] = [];
        }
    }

    $loadForm['categories'] = request()->categories ?? [];
@endphp

<x-splade-form  method="GET" :default="$loadForm" action="{{url()->current()}}" submit-on-change class="bg-zinc-100 dark:bg-zinc-900 hidden lg:block border border-zinc-200 dark:border-zinc-700 rounded-lg shadow-sm p-4">
    <div class="border-b border-zinc-200 dark:border-zinc-700 pb-2 mb-4">
        <h3>{{__('Categories')}}</h3>
    </div>
    <div role="list" class="flex flex-col gap-2 text-sm font-medium text-zinc-900 dark:text-zinc-100">
        @foreach($categories as $category)
            <div class="flex items-center">
                <x-splade-checkbox name="categories[]" value="{{$category->id}}" type="checkbox" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500" />
                <label for="filter-color-0" class="ltr:ml-3 rtl:mr-3  text-sm text-zinc-600 dark:text-zinc-200">{{$category->name}}</label>
            </div>
        @endforeach
    </div>

    @foreach($options as $option)
        <div class="border-b border-zinc-200 dark:border-zinc-700 py-2 my-4">
            <h3>{{$option->name}}</h3>
        </div>
        <div>
            @php $subOptions = \TomatoPHP\TomatoCategory\Models\Type::where('for', 'product-options')->where('type', $option->key)->get(); @endphp
            <div class="flex flex-col gap-2">
                @foreach($subOptions as $item)
                    <div class="flex items-center">
                        <x-splade-checkbox name="{{$option->key}}[]" value="{{$item->key}}" type="checkbox" class="h-4 w-4 rounded border-zinc-300 text-indigo-600 focus:ring-indigo-500" />
                        <label for="filter-color-0" class="ltr:ml-3 rtl:mr-3 text-sm text-zinc-600 dark:text-zinc-200">{{$item->name}}</label>
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach
</x-splade-form>
