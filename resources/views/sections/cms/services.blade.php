@php $section = $page->meta($section['uuid']); @endphp
<section class="font-main bg-zinc-200 dark:bg-zinc-800" style="@isset($section['bg_color']) background-color: {{$section['bg_color'] ?? '#efefef'}} !important; @endisset @isset($section['font_color']) color: {{$section['font_color'] ?? '#000'}} !important; @endisset">
    <div class="w-full px-4 py-16 mx-auto sm:px-6 lg:px-8">
        <div class="grid grid-cols-12 gap-2 lg:gap-16 lg:items-start">
            <div class="max-w-sm mx-auto lg:col-span-4 col-span-12">
                <h2 class="text-2xl font-bold sm:text-3xl text-zinc-900 dark:text-zinc-100">
                    {{$section['title_'.app()->getLocale()] ?? __("My Services")}}
                </h2>

                <p class="mt-4 text-sm text-zinc-600 dark:text-zinc-300">
                    {{$section['description_'.app()->getLocale()] ??  __("I can help you with any digital service or services related to information technology, programming, computing and protection")}}
                </p>
            </div>

            <div class="grid grid-cols-1 gap-8 sm:grid-cols-3 lg:grid-cols-4 col-span-6 lg:col-span-8">
                @php
                    if($section['is_random'] ?? false){
                        $services = \TomatoPHP\TomatoCms\Models\Service::inRandomOrder()->limit(6)->get();
                    }
                    else {
                        $services = \TomatoPHP\TomatoCms\Models\Service::whereIn('id', $section['services'] ?? [])->get();
                    }
                @endphp
                @foreach ($services as $service)
                    <x-splade-link :href="url('/services/' . $service->slug)" class="group relative block h-64 sm:h-60 lg:h-80">
                        <span class="absolute inset-0 border border-dashed rounded-lg border-zinc-300 dark:border-zinc-900"></span>

                        <div
                            class="relative flex h-full transform rounded-lg shadow-sm items-end border border-zinc-300 dark:border-zinc-900 bg-white dark:bg-zinc-800 transition-transform group-hover:-translate-x-2 group-hover:-translate-y-2"
                        >
                            <div
                                class="p-4 !pt-0 transition-opacity group-hover:absolute group-hover:opacity-0 sm:p-6 lg:p-8"
                            >
                                @if($service->getMedia('icon')->first())
                                    <img src="{{$service->getMedia('icon')->first()?->getUrl()}}" alt="{{$service->name}}" class="h-10 w-10 sm:h-12 sm:w-12" />
                                @endif

                                <h2 class="mt-4 text-xl font-bold sm:text-2xl text-main">{{$service->name}}</h2>
                            </div>

                            <div
                                class="absolute p-4 opacity-0 transition-opacity group-hover:relative group-hover:opacity-100 sm:p-6 lg:p-8"
                            >
                                <h3 class="mt-4 text-xl font-medium sm:text-2xl text-main">{{$service->name}}</h3>

                                <p class="mt-4 text-sm sm:text-base">
                                    {{$service->short_description}}
                                </p>

                                <p class="mt-8 font-bold">{{__("Show More")}}</p>
                            </div>
                        </div>
                    </x-splade-link>
                @endforeach
            </div>
        </div>
    </div>
</section>
