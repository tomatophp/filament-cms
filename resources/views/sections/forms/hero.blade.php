<div class="flex flex-col gap-4">
    <div class="flex justify-between gap-4">
        <x-splade-input class="w-full" label="{{__('Title [AR]')}}" name="title_ar" placeholder="{{__('Title [AR]')}}" />
        <x-splade-input class="w-full" label="{{__('Title [EN]')}}" name="title_en" placeholder="{{__('Title [AR]')}}" />
    </div>
    <x-splade-textarea label="{{__('Description [AR]')}}" name="description_ar" placeholder="{{__('Description [AR]')}}" />
    <x-splade-textarea label="{{__('Description [EN]')}}" name="description_en" placeholder="{{__('Description [AR]')}}" />
    <x-splade-input label="{{__('Url')}}" name="url" placeholder="{{__('Url')}}" />
    <div class="flex justify-between gap-4">
        <x-splade-input class="w-full" label="{{__('Button [AR]')}}" name="button_ar" placeholder="{{__('Button [AR]')}}" />
        <x-splade-input class="w-full" label="{{__('Button [EN]')}}" name="button_en" placeholder="{{__('Button [EN]')}}" />
    </div>
</div>
