<div class="flex flex-col gap-4">
    <div class="flex justify-between gap-4">
        <x-splade-input class="w-full" label="{{__('Title [AR]')}}" name="title_ar" placeholder="{{__('Title [AR]')}}" />
        <x-splade-input class="w-full" label="{{__('Title [EN]')}}" name="title_en" placeholder="{{__('Title [AR]')}}" />
    </div>
    <x-splade-textarea label="{{__('Body [AR]')}}" name="body_ar" placeholder="{{__('Body [AR]')}}" />
    <x-splade-textarea label="{{__('Body [EN]')}}" name="body_en" placeholder="{{__('Body [AR]')}}" />
    <x-splade-input label="{{__('Url')}}" name="url" placeholder="{{__('Url')}}" />
    <div class="flex justify-between gap-4">
        <x-splade-input class="w-full" label="{{__('Button [AR]')}}" name="button_ar" placeholder="{{__('Button [AR]')}}" />
        <x-splade-input class="w-full" label="{{__('Button [EN]')}}" name="button_en" placeholder="{{__('Button [EN]')}}" />
    </div>
    <x-tomato-admin-color label="{{__('Background Color')}}" name="bg_color" placeholder="{{__('Background Color')}}" />
    <x-tomato-admin-color label="{{__('Font Color')}}" name="font_color" placeholder="{{__('Font Color')}}" />
    <x-splade-select
        choices
        label="{{__('Features')}}"
        name="features"
        :options="\TomatoPHP\TomatoThemes\Models\Feature::all()"
        option-label="title"
        option-value="id"
        multiple
    />
</div>
