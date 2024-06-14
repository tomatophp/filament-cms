<x-splade-select
    choices
    label="{{__('Contact Form')}}"
    placeholder="{{__('Select Contact Form')}}"
    name="form_id"
    remote-url="{{route('admin.forms.api')}}"
    remote-root="data"
    option-value="id"
    option-label="name.{{app()->getLocale()}}"
/>
