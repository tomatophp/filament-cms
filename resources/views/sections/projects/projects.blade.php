@php $section = $page->meta($section['uuid']); @endphp
<section class="font-main bg-zinc-100 dark:bg-zinc-900 text-zinc-900 dark:text-zinc-100"  style="@isset($section['bg_color']) background-color: {{$section['bg_color'] ?? '#efefef'}} !important; @endisset @isset($section['font_color']) color: {{$section['font_color'] ?? '#000'}} !important; @endisset">
    <div class="max-w-screen-xl px-4 py-12 mx-auto sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="text-4xl font-bold tracking-tight text-center sm:text-3xl text-main">
                {{$section['title_' . app()->getLocale()] ?? __("Best Projects")}}
            </h1>

            <p class="mx-auto mt-4 max-w-[45ch]">
                {{$section['description_' . app()->getLocale()] ?? __("My work speaks for me, and here you will find the best work that I have accomplished over the past years")}}
            </p>
        </div>

        <div class="grid grid-cols-1 gap-4 mt-8 lg:gap-8 sm:grid-cols-2 lg:grid-cols-3">
            @php $projects = \TomatoPHP\TomatoCms\Models\Portfolio::whereIn('id', $section['projects'] ?? [])->get(); @endphp
            @foreach ($projects as $project)
                @php
                    $image = "";
                    if($project->getMedia('feature') && count($project->getMedia('feature'))){
                        $image = $project->getMedia('feature')->first()->getUrl();
                    }
                    else {
                        $image = "https://ui-avatars.com/api/?name=".$project->title;
                    }
                @endphp
                <x-splade-link href="{{url('projects/'. $project->id)}}" class="block">
                    <article
                        class="relative overflow-hidden rounded-lg shadow transition hover:shadow-lg"
                    >
                        <img
                            alt="{{$project->title}}"
                            src="{{$image}}"
                            class="absolute inset-0 h-full w-full object-cover"
                        />

                        <div
                            class="relative bg-gradient-to-t from-zinc-900/50 to-zinc-900/25 pt-32 sm:pt-48 lg:pt-64"
                        >
                            <div class="p-4 sm:p-6">
                                <div class="flex justify-between">
                                    <div>
                                        <time datetime="{{$project->created_at->toDateString()}}" class="block text-xs text-white/90">
                                            {{$project->created_at->diffForHumans()}}
                                        </time>

                                        <a href="#">
                                            <h3 class="mt-0.5 text-lg text-white ">
                                                {{ \Str::limit($project->title, 30, $end='...') }}
                                            </h3>
                                        </a>
                                    </div>
                                    <div class="flex flex-col  justify-end text-white/9">
                                        <div class="flex justify-end text-white">
                                            <i class="bx bxs-show mx-2"></i>
                                            <span class="text-xs">{{$project->views}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </article>
                </x-splade-link>
            @endforeach
        </div>
        <div class="flex justify-start">
            <x-splade-link class="block text-main transition hover:text-sec font-medium py-4 text-lg"  :href="$section['url'] ?? '/projects'">
                {{__("Show More")}}
                @if(app()->getLocale() == 'ar')
                    <span class="text-xl font-bold">←</span>
                @else
                    <span class="text-xl font-bold">→</span>
                @endif
            </x-splade-link>
        </div>
    </div>
</section>
