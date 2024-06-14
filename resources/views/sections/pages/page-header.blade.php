@php $section = $page->meta($section['uuid']); @endphp
<section class="relative bg-zinc-200 dark:bg-zinc-800 overflow-hidden text-zinc-900 dark:text-zinc-200 font-main" style="@if(isset($section['bg_color'])) background-color: {{$section['bg_color'] ?? 'transparent'}} !important; @endif @if(isset($section['font_color'])) color: {{$section['font_color'] ?? '#000'}} !important; @endif">
    <div class="max-w-screen-xl px-8 py-32 mx-auto lg:items-center lg:flex">
        <div class="max-w-3xl mx-auto text-center">
            <h1 class="py-2 text-3xl font-extrabold sm:text-5xl">
                {{$section['title_'.app()->getLocale()] ?? __('Page Title')}}
            </h1>
            @if(isset($section['description_'.app()->getLocale()]))
                <p class="my-1 text-lg text-zinc-700 dark:text-zinc-400">
                    {{$section['description_'.app()->getLocale()] }}
                </p>
            @endif
        </div>
    </div>
</section>
