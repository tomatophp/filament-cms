@php $section = $page->meta($section['uuid']); @endphp
<section>
    <div class="px-4 py-16 sm:px-6 lg:px-32 font-main bg-zinc-200 dark:bg-zinc-800" style="@isset($section['bg_color']) background-color: {{$section['bg_color'] ?? '#efefef'}} !important; @endisset @isset($section['font_color']) color: {{$section['font_color'] ?? '#000'}} !important; @endisset">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <h2 class="text-4xl font-bold tracking-tight text-center sm:text-3xl text-zinc-900 dark:text-zinc-100">
                {{ $section['title_'. app()->getLocale()] ?? "Blog" }}
            </h2>

            <div class="mx-auto max-w-2xl mt-16 lg:max-w-none">
                <div class="grid grid-cols-1 gap-4 lg:gap-8 sm:grid-cols-1 lg:grid-cols-2 font-main my-4">
                    @php $posts = \TomatoPHP\TomatoCms\Models\Post::whereIn('id', $section['posts'] ?? [])->get() @endphp
                    @foreach($posts as $post)
                        @include('tomato-sections::sections.blog.parts.blog-card')
                    @endforeach
                </div>
                <div class="flex justify-start">
                    <x-splade-link class="block text-main transition hover:text-sec font-medium py-4 text-lg"  :href="$section['url'] ?? '/blog'">
                        {{__("Show More")}}
                        @if(app()->getLocale() == 'ar')
                            <span class="text-xl font-bold">←</span>
                        @else
                            <span class="text-xl font-bold">→</span>
                        @endif
                    </x-splade-link>
                </div>
            </div>
        </div>
    </div>

</section>
