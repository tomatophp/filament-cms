<x-tomato-admin-container label="{{__('Create New Theme')}}">
    <x-slot:buttons>
        <x-tomato-admin-button  href="{{route('admin.themes.index')}}">
            {{__('Back')}}
        </x-tomato-admin-button>
    </x-slot:buttons>

    <x-splade-form  method="POST" action="{{route('admin.themes.store')}}">
        <div class="flex flex-col space-y-4">
            <x-splade-input name="name" label="Theme Name" placeholder="Theme Name" />
            <x-splade-textarea name="description" label="Theme Description" placeholder="Theme Description" />

            <div class="flex justifiy-start gap-4">
                <x-tomato-admin-submit label="{{__('Create Theme')}}" spinner/>
            </div>
        </div>
    </x-splade-form>
</x-tomato-admin-container>
