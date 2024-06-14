@php $section = $page->meta($section['uuid']); @endphp
<section class="font-main">
    <div class="max-w-screen-xl px-4 py-12 mx-auto sm:px-6 lg:px-8">
        <x-splade-form :default="['filter' => request()->get('filter') ?? 'popular', 'search'=> request()->get('search')?? null]" action="{{url()->current()}}" method="GET" class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between mb-4">
            <div class="flex items-center space-x-4">
                <div>
                    <label class="sr-only" for="search">
                        {{__('Search')}}
                    </label>

                    <div class="relative group">
                    <span class="absolute inset-y-0 left-0 flex items-center justify-center w-10 h-10 text-zinc-400 transition pointer-events-none group-focus-within:text-primary-600">
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </span>
                        <input v-model="form.search" id="search" placeholder="{{__('Search')}}" type="search" class="block w-full h-10 pl-10 placeholder-zinc-400 transition duration-75 border-zinc-300 dark:border-zinc-700 dark:bg-zinc-700 rounded-lg shadow-sm focus:border-primary-600 focus:ring-1 focus:ring-inset focus:ring-primary-600">
                    </div>
                </div>
            </div>
            <div>
                <label class="sr-only" for="sort">
                    {{__('Sort')}}
                </label>

                <select @change="form.submit()" v-model="form.filter" id="sort" class="text-zinc-900 dark:bg-zinc-700 dark:text-zinc-100 block w-full transition duration-75 border-zinc-300 dark:border-zinc-700 rounded-lg shadow-sm focus:border-primary-600 focus:ring-1 focus:ring-inset focus:ring-primary-600">
                    <option value="popular">{{__('Popular')}}</option>
                    <option value="recent">{{__('Recently added')}}</option>
                    <option value="alphabetical">{{__('Alphabetical')}}</option>
                </select>
            </div>
        </x-splade-form>
        <div class="flex flex-wrap gap-2">
            <span class="font-medium">
                {{__('Services:')}}
            </span>
            @php $services = \TomatoPHP\TomatoCms\Models\Service::all(); @endphp
            @foreach($services as $service)
                <x-splade-link href="{{ url('/projects?service=' . $service->slug) }}"  class="inline-flex items-center justify-center space-x-1 text-primary-700 bg-primary-500/10 min-h-6 px-2 py-0.5 text-sm font-medium tracking-tight rounded-xl whitespace-normal">
                    {{  $service->name }}
                </x-splade-link>
            @endforeach
        </div>

        @php
            if(!isset($projects)){
                $projects = \TomatoPHP\TomatoCms\Models\Portfolio::query();
                $projects->where('activated', 1);
                if($section['is_random'] ?? false){
                    $projects = $projects->inRandomOrder()->paginate(9);
                }
                else {
                    $projects = $projects->paginate(9);
                }
            }
        @endphp
        @if(!count($projects))
            @include('tomato-sections::components.empty')
        @else
            <div class="grid grid-cols-1 gap-4 mt-8 lg:gap-8 sm:grid-cols-2 lg:grid-cols-3">
                @php
                    if(!isset($projects)){
                        if($section['is_random'] ?? false){
                            $projects = \TomatoPHP\TomatoCms\Models\Portfolio::with('service')->where('activated', 1)->inRandomOrder()->paginate(9);
                        }
                        else {
                            $projects = \TomatoPHP\TomatoCms\Models\Portfolio::with('service')->where('activated', 1)->paginate(9);
                        }
                    }
                @endphp
                @foreach ($projects as $project)
                    @include('tomato-sections::sections.projects.parts.project-card')
                @endforeach
            </div>
            <div class="mx-auto my-6">
                {!! $projects->links('tomato-sections::sections.pagination') !!}
            </div>
        @endif


    </div>
</section>
