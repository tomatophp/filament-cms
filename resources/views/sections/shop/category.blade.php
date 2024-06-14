@php $section = $page->meta($section['uuid']); @endphp
<section class="bg-zinc-200 dark:bg-zinc-800">
    <div style="background-color: {{$section['bg_color'] ?? 'transparent'}}; color: {{$section['font_color'] ?? '#000'}}">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-2xl py-16 sm:py-24 lg:max-w-none lg:py-32">
                <h2 class="text-2xl font-bold text-zinc-900 dark:text-zinc-100">{{ $section['title_'. app()->getLocale()] ?? "Categories" }}</h2>

                <div class="mt-6 gap-12 lg:grid lg:grid-cols-3 lg:gap-x-6 lg:gap-4">
                    @php $categories = \TomatoPHP\TomatoCategory\Models\Category::whereIn('id', $section['categories'] ?? [])->get() @endphp
                    @foreach($categories as $category)
                        <x-splade-link href="{{url('/shop?categories[]=' . $category->id)}}" class="group relative">
                            <div class="relative h-80 w-full overflow-hidden border border-zinc-200 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-700 sm:aspect-h-1 sm:aspect-w-2 lg:aspect-h-1 lg:aspect-w-1 group-hover:opacity-75 sm:h-64">
                                @if($category->getMedia('image')->first())
                                <img src="{{$category->getMedia('image')->first()?->getUrl() ?? url('placeholder.webp')}}" alt="Desk with leather desk pad, walnut desk organizer, wireless keyboard and mouse, and porcelain mug." class="h-full w-full object-cover object-center">
                                @else
                                    <div class="h-full w-full bg-zinc-300 dark:bg-zinc-700 text-zinc-900 dark:text-zinc-100 flex justify-center items-center">
                                        <i class="bx bxs-category text-7xl"></i>
                                    </div>
                                @endif
                            </div>
                            <h3 class="mt-6 text-sm text-zinc-500 dark:text-zinc-300">
                                <a href="#">
                                    <span class="absolute inset-0"></span>
                                    {{ $category->description }}
                                </a>
                            </h3>
                            <p class="text-base font-semibold text-zinc-900 dark:text-zinc-100">{{$category->name}}</p>
                        </x-splade-link>
                    @endforeach

                </div>
            </div>
        </div>
    </div>

</section>
