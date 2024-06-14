@php
    $section = $page->meta($section['uuid']);
    if(!isset($questions)){
        $questions = \TomatoPHP\TomatoSupport\Models\Question::query()->paginate(10);
    }
@endphp
<div>
    <main class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex items-baseline justify-between border-b border-gray-200 pb-6 pt-8">
            <h1 class="text-4xl font-bold tracking-tight text-gray-900">
                {{$section['title_'.app()->getLocale()] ?? __('FAQ')}}
            </h1>

            <div>
                <x-splade-form method="GET" action="{{url()->current()}}" :default="['search' => request()->get('search') ?? '']">
                    <x-splade-input type="search" name="search" placeholder="{{__('Search ...')}}">
                        <x-slot:prepend>
                            <div class="flex flex-col justify-center items-center text-black">
                                <i class="bx bx-search"></i>
                            </div>
                        </x-slot:prepend>
                    </x-splade-input>
                </x-splade-form>
            </div>
        </div>

        <div class="grid pt-8 text-left border-gray-200 md:gap-16 dark:border-gray-700 md:grid-cols-2">
            @foreach($questions as $qa)
                <div class="mb-10">
                    <h3 class="flex items-center mb-4 text-lg font-medium text-gray-900 dark:text-white">
                        <svg class="flex-shrink-0 mr-2 w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"></path></svg>
                        {{$qa->qa}}
                    </h3>
                    <p class="text-gray-500 dark:text-gray-400">
                        {{$qa->answer}}
                    </p>
                </div>
            @endforeach
        </div>

        {!! $questions->links('tomato-sections::sections.pagination') !!}
    </main>
</div>
