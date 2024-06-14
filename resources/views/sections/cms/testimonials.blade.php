@php $section = $page->meta($section['uuid']); @endphp
<section class="relative font-main dark:bg-zinc-800 bg-zinc-200 text-zinc-900 dark:text-zinc-100"  style="@isset($section['bg_color']) background-color: {{$section['bg_color'] ?? '#efefef'}} !important; @endisset @isset($section['font_color']) color: {{$section['font_color'] ?? '#000'}} !important; @endisset">
    <div class="max-w-screen-xl px-4 py-16 mx-auto sm:px-6 lg:px-8 sm:py-24">
        <h2 class="text-4xl font-bold tracking-tight text-center sm:text-3xl text-main">
            {{$section['title_'.app()->getLocale()] ?? __("What is clients say about me?")}}
        </h2>

        <div class="mt-12 swiper-container">
            @php
                if($section['is_random'] ?? false){
                    $reviews = \TomatoPHP\TomatoCms\Models\Testimonial::inRandomOrder()->limit(6)->get();
                }
                else {
                    $reviews = \TomatoPHP\TomatoCms\Models\Testimonial::whereIn('id', $section['reviews'] ?? [])->get();
                }
            @endphp
            <x-tomato-admin-slider type="slider">
                @foreach($reviews as $review)
                    <x-tomato-admin-slider-item>
                        <section class="dark:text-zinc-100">
                            <div class="container flex flex-col items-center p-4 mx-auto space-y-6 md:p-8">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" fill="currentColor" class="w-16 h-16 dark:text-violet-400">
                                    <polygon points="328.375 384 332.073 458.999 256.211 406.28 179.924 459.049 183.625 384 151.586 384 146.064 496 182.756 496 256.169 445.22 329.242 496 365.936 496 360.414 384 328.375 384"></polygon>
                                    <path d="M415.409,154.914l-2.194-48.054L372.7,80.933,346.768,40.414l-48.055-2.2L256,16.093,213.287,38.219l-48.055,2.2L139.3,80.933,98.785,106.86l-2.194,48.054L74.464,197.628l22.127,42.715,2.2,48.053L139.3,314.323l25.928,40.52,48.055,2.195L256,379.164l42.713-22.126,48.055-2.195,25.928-40.52L413.214,288.4l2.195-48.053,22.127-42.715Zm-31.646,76.949L382,270.377l-32.475,20.78-20.78,32.475-38.515,1.76L256,343.125l-34.234-17.733-38.515-1.76-20.78-32.475L130,270.377l-1.759-38.514L110.5,197.628,128.237,163.4,130,124.88,162.471,104.1l20.78-32.474,38.515-1.76L256,52.132l34.234,17.733,38.515,1.76,20.78,32.474L382,124.88l1.759,38.515L401.5,197.628Z"></path>
                                </svg>
                                <p class="px-6 py-2 text-2xl font-semibold text-center sm:font-bold sm:text-3xl md:text-4xl lg:max-w-2xl xl:max-w-4xl dark:text-zinc-300">
                                    "{{ $review->comment }}"
                                </p>
                                <div class="flex justify-center gap-4">
                                    <img src="https://ui-avatars.com/api/?name={{ $review->name }}" alt="" class="w-20 h-20 bg-center bg-cover rounded-md dark:bg-zinc-500 dark:bg-zinc-700">
                                    <div>
                                        <p class="text-main">{{ $review->name }}</p>
                                        <p class="text-sm leadi dark:text-zinc-300">{{ $review->position }}, {{ $review->company }}</p>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </x-tomato-admin-slider-item>
                @endforeach
            </x-tomato-admin-slider>
        </div>
    </div>
</section>
