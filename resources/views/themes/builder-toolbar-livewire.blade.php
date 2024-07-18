<div>
    @if(auth()->user())
    <div class="py-6 px-6 border-b dark:border-gray-700 flex justify-between">
        <div class="flex justify-start gap-4">
            {{ $this->editPageAction }}
            {{ $this->previewPageAction }}
        </div>
    </div>

    @if($this->preview)
        @if($this->page->meta('sections') && count($this->page->meta('sections')))
            @foreach($this->page->meta('sections') as $section)
                @php $getSection = section($section['type']) @endphp

                @if($getSection)
                    @include($getSection->view, ['section' => $section])
                @endif
            @endforeach
        @else
            {{ $this->page->body }}
        @endif
    @else
        <div class="p-4">
            <form wire:submit="saveSections" id="{{$this->page->id}}">
                {{ $this->form }}

                <x-filament::button wire:click="saveSections">
                    Save Sections
                </x-filament::button>
            </form>
        </div>
    @endif

    <x-filament-actions::modals />
    @else
        @if($this->page->meta('sections') && count($this->page->meta('sections')))
            @foreach($this->page->meta('sections') as $section)
                @php $getSection = section($section['type']) @endphp

                @if($getSection)
                    @include($getSection->view)
                @endif
            @endforeach
        @else
            {{ $this->page->body }}
        @endif
    @endif
</div>
