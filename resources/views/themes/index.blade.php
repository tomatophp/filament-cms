<x-tomato-admin-layout>
    <x-slot:header>
        {{ trans('tomato-themes::messages.title') }}
    </x-slot:header>
    <x-slot:buttons>
        <div class="flex justify-end">
            <x-splade-form class="mx-2" action="{{route('admin.themes.index')}}" method="GET">
                <x-splade-input @change="form.submit()" placeholder="Search By Theme Name" name="search" type="search"></x-splade-input>
            </x-splade-form>
            @if(config('tomato-themes.allow_upload'))
                <Link modal href="{{route('admin.themes.upload')}}" class="filament-button inline-flex items-center justify-center py-1 gap-1 font-medium rounded-lg border transition-colors focus:outline-none focus:ring-offset-2 focus:ring-2 focus:ring-inset dark:focus:ring-offset-0 min-h-[2.25rem] px-4 text-sm text-white shadow focus:ring-white border-transparent bg-primary-600 hover:bg-primary-500 focus:bg-primary-700 focus:ring-offset-primary-700 filament-page-button-action">
                    {{__('Upload Theme')}}
                </Link>
            @endif
        </div>
    </x-slot:buttons>

    <div>
        <x-splade-data default="{show: false}">
            <div class="grid grid-cols-2 gap-4">
                @foreach($themes as $theme)
                    <div>
                        <div class="border border-zinc-300 bg-center bg-cover w-full h-60" style="background-image: url('{{ str($theme['info']->placeholder)->contains('http') ? $theme['info']->placeholder :theme_assets('images/'. $theme['info']->placeholder)}}')"></div>
                        @if(setting('theme_name') === $theme['info']->name)
                            <div class="flex justify-between bg-zinc-900 text-white">
                            <div class="px-4 py-3 flex flex-col justify-center">
                                <div>
                                    <span class="font-bold">{{__('Active:')}}</span>
                                    <span class="mx-1">{{$theme['info']->title->{app()->getLocale()} }}</span>
                                </div>
                            </div>
                            <div class="bg-zinc-800 px-4 py-3">
                                <a href="{{url('/')}}" target="_blank" class=" mx-2 filament-button inline-flex items-center justify-center py-1 gap-1 font-medium rounded-lg border transition-colors focus:outline-none focus:ring-offset-2 focus:ring-2 focus:ring-inset dark:focus:ring-offset-0 min-h-[2.25rem] px-4 text-sm text-white shadow focus:ring-white border-transparent bg-primary-600 hover:bg-primary-500 focus:bg-primary-700 focus:ring-offset-primary-700 filament-page-button-action">
                                    {{__('Preview')}}
                                </a>
                                @if(config('tomato-themes.allow_create') && isset($theme['info']->settings))
                                <Link href="{{route('admin.themes.custom', $theme['name'])}}" class="filament-button inline-flex items-center justify-center py-1 gap-1 font-medium rounded-lg border transition-colors focus:outline-none focus:ring-offset-2 focus:ring-2 focus:ring-inset dark:focus:ring-offset-0 min-h-[2.25rem] px-4 text-sm text-white shadow focus:ring-white border-transparent bg-primary-600 hover:bg-primary-500 focus:bg-primary-700 focus:ring-offset-primary-700 filament-page-button-action">
                                    {{__('Customize')}}
                                </Link>
                                @endif
                            </div>
                        </div>
                        @else
                            <div class="flex justify-between border-r border-b border-l bg-white border-zinc-300">
                                <div class="px-4 py-4 flex flex-col justify-center">
                                    <div>
                                        <span class="mx-1">{{$theme['info']->title->{app()->getLocale()} }}</span>
                                    </div>
                                </div>
                                <div class="bg-zinc-100 px-4 py-3 border-l rtl:border-r">
                                    <x-splade-link confirm href="{{route('admin.themes.active')}}" method="POST" data="{
                                            theme: '{{$theme['info']->alias}}',
                                            name: '{{$theme['info']->name}}'
                                        }" class="filament-button inline-flex items-center justify-center py-1 gap-1 font-medium rounded-lg border transition-colors focus:outline-none focus:ring-offset-2 focus:ring-2 focus:ring-inset dark:focus:ring-offset-0 min-h-[2.25rem] px-4 text-sm text-white shadow focus:ring-white border-transparent bg-primary-600 hover:bg-primary-500 focus:bg-primary-700 focus:ring-offset-primary-700 filament-page-button-action">
                                        {{__('Activate')}}
                                    </x-splade-link>
                                    @if(config('tomato-themes.allow_destroy'))
                                    <x-splade-link confirm-danger href="{{route('admin.themes.destroy',$theme['name'])}}" method="DELETE" class="filament-button inline-flex items-center justify-center py-1 gap-1 font-medium rounded-lg border transition-colors focus:outline-none focus:ring-offset-2 focus:ring-2 focus:ring-inset dark:focus:ring-offset-0 min-h-[2.25rem] px-4 text-sm text-white shadow focus:ring-white border-transparent bg-red-600 hover:bg-red-500 focus:bg-red-700 focus:ring-offset-red-700 filament-page-button-action">
                                        {{__('Delete')}}
                                    </x-splade-link>
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>
                @endforeach

                @if(config('tomato-themes.allow_create'))
                <Link href="{{route('admin.themes.create')}}" class="h-[300px] border border-dashed hover:border-solid hover:border-primary-500 border-4 border-zinc-200 hover:border-none hover:bg-primary-500 text-zinc-300 hover:text-white">
                    <div class="flex flex-col justify-center h-full items-center">
                        <x-heroicon-s-plus-circle class="w-32 h-32"/>
                        <h1>{{__('Add New Theme')}}</h1>
                    </div>
                </Link>
                @endif
            </div>
        </x-splade-data>
    </div>
</x-tomato-admin-layout>
