<x-splade-select
    choices
    label="{{__('Header Menu')}}"
    placeholder="{{__('Select Header Menu')}}"
    name="menu_id"
    remote-url="{{route('admin.menus.api')}}"
    remote-root="data"
    option-value="key"
    option-label="name.{{app()->getLocale()}}"
/>
