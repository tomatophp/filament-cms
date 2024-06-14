<x-splade-select
    choices
    label="{{__('Footer Menu')}}"
    placeholder="{{__('Select Footer Menu')}}"
    name="menu_id"
    remote-url="{{route('admin.menus.api')}}"
    remote-root="data"
    option-value="key"
    option-label="name.{{app()->getLocale()}}"
/>
