<div class="grid grid-cols-1 md:grid-cols-3 gap-4 p-4">
    @foreach($records as $item)
        <div class="bg-white border border-gray-100 dark:border-gray-700 overflow-hidden dark:bg-gray-800 rounded-lg flex flex-col shadow-sm" >

            @if($item['placeholder'] !== 'placeholder.webp')
                <div class="h-40 overflow-hidden">
                    <img class="bg-cover bg-center" onerror="this.onerror=null; this.src='{{url('placeholder.webp')}}'" src="{{$item['placeholder']}}" />
                </div>
            @else
                <div class="overflow-hidden flex flex-col rounded-t-lg justify-center items-center" style="background-color: {{$item['color']}}; height: 150px;">
                    <div>
                        <x-icon name="{{$item['icon']}}" class="text-white w-12 h-16" />
                    </div>
                </div>
            @endif
            <div class="flex justifiy-between gap-4 px-4 my-2">
                <div class="w-full">
                    <h1 class="font-bold">{{ json_decode($item['name'])->{app()->getLocale()} }}</h1>
                </div>
                <div>
                    <h1>{{ $item['version'] }}</h1>
                </div>
            </div>
            <div class="h-30 px-4">
                <p class="text-gray-600 dark:text-gray-300 text-sm h-30 truncate ...">
                    {{ json_decode($item['description'])->{app()->getLocale()} }}
                </p>
            </div>
            <div class="flex justifiy-between gap-1 my-4 px-4 border-t border-gray-100 dark:border-gray-700 pt-4">
                <div class="flex justifiy-start w-full gap-2">
                    @if($item['type'] !== 'lib')
                        @if((bool)config('filament-plugins.allow_toggle'))
                            @if($item->active)
                                {{ ($this->disableAction)(['item' => $item]) }}
                            @else
                                {{ ($this->activeAction)(['item' => $item]) }}
                            @endif

                        @endif
                        @if((bool)config('filament-plugins.allow_destroy'))
                            {{ ($this->deleteAction)(['item' => $item])}}
                        @endif
                    @endif
                </div>
                <div class="w-full flex justify-end gap-4">
                    @if($item->github)
                        <x-filament::icon-button :tooltip="trans('filament-plugins::messages.plugins.actions.github')" href="{{$item->github}}" target="_blank" tag="a">
                            <x-slot name="icon">
                                <x-heroicon-s-globe-asia-australia class="w-5 h-5" />
                            </x-slot>
                        </x-filament::icon-button>
                    @endif
                    @if($item->docs)
                        <x-filament::icon-button :tooltip="trans('filament-plugins::messages.plugins.actions.docs')" href="{{$item->docs}}" target="_blank" tag="a">
                            <x-slot name="icon">
                                <x-heroicon-s-document-text class="w-5 h-5" />
                            </x-slot>
                        </x-filament::icon-button>
                    @endif
                </div>
            </div>
        </div>
    @endforeach
</div>
