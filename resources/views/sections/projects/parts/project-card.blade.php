@php
    $image = "";
    if($project->getMedia('feature') && count($project->getMedia('feature'))){
        $image = $project->getMedia('feature')->first()->getUrl();
    }
    else {
        $image = "https://ui-avatars.com/api/?name=".$project->title;
    }
@endphp
<x-splade-link href="{{ url('/projects/' . $project->id) }}" class="block">
    <article
        class="relative overflow-hidden rounded-lg shadow transition hover:shadow-lg"
    >
        <img
            alt="{{$project->title}}"
            src="{{$image}}"
            class="absolute inset-0 h-full w-full object-cover"
        />

        <div
            class="relative bg-gradient-to-t from-gray-900/50 to-gray-900/25 pt-32 sm:pt-48 lg:pt-64"
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
