<x-splade-modal>
    <x-slot:title>
        {{__('Edit Page Content')}}
    </x-slot:title>

    <x-splade-form class="flex flex-col space-y-4 overflow-scroll-x" action="{{route('admin.themes.page.update', $model->id)}}" method="post" :default="[
        'body' => [
            'ar' => $model->getTranslation('body', 'ar') ?? '',
            'en' => $model->getTranslation('body', 'en') ?? '',
        ]
    ]">
        <div class="flex flex-col gap-4">
            <x-tomato-translation type="markdown" :label="__('Body')" name="body"/>
        </div>
        <div class="flex justify-start gap-2 pt-3">
            <x-tomato-admin-submit  label="{{__('Save')}}" :spinner="true" />
            <x-tomato-admin-button secondary type="button" @click.prevent="modal.close" label="{{__('Cancel')}}"/>
        </div>
    </x-splade-form>
</x-splade-modal>
