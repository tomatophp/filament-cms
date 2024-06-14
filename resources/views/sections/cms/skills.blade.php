@php $section = $page->meta($section['uuid']); @endphp
<section>
    <div class="px-4 py-16 sm:px-6 lg:px-32 font-main dark:bg-zinc-900 bg-zinc-100"  style="@isset($section['bg_color']) background-color: {{$section['bg_color'] ?? '#efefef'}} !important; @endisset @isset($section['font_color']) color: {{$section['font_color'] ?? '#000'}} !important; @endisset">
        <h2 class="text-4xl font-bold tracking-tight text-center sm:text-3xl text-zinc-900 dark:text-zinc-100">
            {{$section['title_'.app()->getLocale()] ?? __("My Skills")}}
        </h2>
        <p class="mx-auto mt-4 max-w-[80ch] dark:text-zinc-200 text-zinc-800">
            {{$section['description_'.app()->getLocale()] ?? __("Working for 13 years in one field makes you learn a lot and a lot, so I have a lot of different skills in the fields of information security, marketing, software and graphic design")}}
        </p>
        <div class="grid grid-cols-2 gap-4 my-10 text-center lg:grid-cols-4">
            @php
                if($section['is_random'] ?? false){
                    $skills = \TomatoPHP\TomatoCms\Models\Skill::inRandomOrder()->get();
                }
                else {
                    $skills = \TomatoPHP\TomatoCms\Models\Skill::whereIn('id', $section['skills'] ?? [])->get();
                }
            @endphp
            @foreach ($skills as $skill)
                <a class="block p-4 bg-white dark:bg-zinc-800 border dark:border-zinc-700 shadow-sm rounded-xl focus:outline-none focus:ring hover:border-zinc-200 dark:hover:border-zinc-600 transition duration-300"
                   href="{{$skill->url}}" target="_blank">
                <span class="inline-block p-3 w-12 h-12 text-white rounded-lg bg-primary-500 dark:bg-zinc-700">
                    @if($skill->getMedia('image')->first())
                        <img src="{{ $skill->getMedia('image')->first()->getUrl() }}" alt="{{ $skill->name }}" class="w-full h-full" />
                    @else
                        @if($skill->icon)
                            <i class="{{ $skill->icon }} bx-sm"></i>
                        @else
                            <i class="bx bxs-star bx-sm"></i>
                        @endif
                    @endif
                </span>

                    <h6 class="mt-2 font-bold text-black dark:text-zinc-100">{{ $skill->name }}</h6>

                    <p class="hidden sm:mt-1 sm:text-sm sm:text-zinc-500 dark:text-zinc-300 sm:block">
                        {{ $skill->description }}
                    </p>

                    <div class="relative pt-1">
                        <div class="flex items-center justify-between mb-2">
                            <div>
                            <span
                                class="inline-block px-2 py-1 text-xs font-semibold text-zinc-900 dark:text-zinc-100 uppercase rounded-full bg-sec">
                                {{__("Level")}}
                            </span>
                            </div>
                            <div class="text-right">
                            <span class="inline-block text-xs font-semibold text-zinc-900 dark:text-zinc-100 ">
                                {{ $skill->exp }}%
                            </span>
                            </div>
                        </div>
                        <div class="flex h-2 mb-4 overflow-hidden text-xs rounded bg-success-500">
                            <div style="width: {{ $skill->exp }}%"
                                 class="flex flex-col justify-center text-center text-white shadow-none bg-main whitespace-nowrap">
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>
