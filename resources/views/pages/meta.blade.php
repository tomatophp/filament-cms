<x-tomato-admin-container label="{{__('Update Section Content')}}">
    <x-splade-form
        method="POST"
        action="{{route('admin.pages.meta.store', $model->id)}}"
        :default="array_merge($model->meta($sectionID) ?? [], ['section' => $sectionID])"
    >
        @include($section['form'])

        <div class="flex justify-start gap-2 pt-3">
            <x-tomato-admin-submit  label="{{__('Save')}}" :spinner="true" />
            <x-tomato-admin-button secondary type="button" @click.prevent="modal.close" label="{{__('Cancel')}}"/>
        </div>
    </x-splade-form>
</x-tomato-admin-container>
