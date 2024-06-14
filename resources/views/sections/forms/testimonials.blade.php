<div class="flex flex-col gap-4">
    <div class="flex justify-between gap-4">
        <x-splade-input class="w-full" label="{{__('Title [AR]')}}" name="title_ar" placeholder="{{__('Title [AR]')}}" />
        <x-splade-input class="w-full" label="{{__('Title [EN]')}}" name="title_en" placeholder="{{__('Title [AR]')}}" />
    </div>
    <x-tomato-admin-color label="{{__('Background Color')}}" name="bg_color" placeholder="{{__('Background Color')}}" />
    <x-tomato-admin-color label="{{__('Font Color')}}" name="font_color" placeholder="{{__('Font Color')}}" />
    <x-splade-select
        choices
        label="{{__('Projects')}}"
        name="projects"
        :options="\TomatoPHP\TomatoCms\Models\Testimonial::all()"
        option-label="name"
        option-value="id"
        multiple
    />
    <x-splade-checkbox label="{{__('Is Random')}}" name="is_random" />
</div>
