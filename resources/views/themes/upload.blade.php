<x-tomato-admin-container label="{{__('Upload New Theme File')}}">
    <x-splade-form class="flex flex-col space-y-4" method="POST" action="{{route('admin.themes.upload.new')}}">
        <x-splade-file filepond preview accept="zip,application/octet-stream,application/zip,application/x-zip,application/x-zip-compressed" name="theme" label="Theme ZIP file" placeholder="you can upload your theme file here" />
        <div class="flex jusifiy-start gap-4">
            <x-tomato-admin-submit label="{{__('Upload Theme')}}" spinner/>
        </div>
    </x-splade-form>
</x-tomato-admin-container>
