@php $section = $page->meta($section['uuid']); @endphp
<div class="font-main py-8 px-16 bg-zinc-100 dark:bg-zinc-900"  style="@if(isset($section['bg_color'])) background-color: {{$section['bg_color'] ?? '#fff'}} !important; @endif @if(isset($section['font_color'])) color: {{$section['font_color'] ?? '#000'}} !important; @endif">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-y-8 lg:gap-x-16 lg:items-center">
        <div class="max-w-lg mx-auto  lg:mx-0">
            <h2 class="text-3xl font-bold sm:text-4xl text-main">
                {{$section['title_' . app()->getLocale()] ??  __("Summary about me")}}
            </h2>

            <p class="mt-4">
                {{$section['body_' . app()->getLocale()] ?? __("I'm Fady, Egyptian Graphics Designer, Marketer, Programmer with more than 13 years of experience in many fields like Graphics, Programming, Security Systems, Cyber Security and Content Writing")}}
            </p>

            <x-tomato-admin-button :href="$section['url'] ?? '/about'" class="my-4">
                     <span class="text-sm font-medium">
                        {{$section['button_' . app()->getLocale()] ?? __("About Me")}}
                    </span>
                @if(app()->getLocale() == 'ar')
                    <x-heroicon-o-arrow-left class="w-4 h-4 mr-4" />
                @else
                    <x-heroicon-o-arrow-right class="w-4 h-4 ml-4" />
                @endif
            </x-tomato-admin-button>
        </div>

        <div class="grid grid-cols-2 gap-4 text-center lg:grid-cols-3 sm:grid-cols-2">
            @php $features = \TomatoPHP\TomatoThemes\Models\Feature::whereIn('id', $section['features'] ?? [])->get(); @endphp
            @foreach($features as $feature)
                <div class="
                            bg-white
                            dark:bg-zinc-900
                            block
                            p-4
                            border
                            border-zinc-100
                            dark:border-zinc-700
                            shadow-sm
                            rounded-xl
                            focus:outline-none
                            focus:ring
                            hover:border-zinc-200
                            dark:hover:border-zinc-600
                            transition
                            duration-300
                        ">

                        <span class="inline-block p-3 text-white dark:text-zinc-900 rounded-lg bg-zinc-900 dark:bg-zinc-200 w-12 h-12" style="background-color: {{$feature->icon_bg_color}}; color: {{$feature->icon_color}}">
                            <i class="{{$feature->icon}} bx-sm"></i>
                        </span>

                    <h6 class="mt-2 font-bold text-zinc-900 dark:text-zinc-100">
                        {{$feature->title}}
                    </h6>

                    <p class="hidden sm:mt-1 sm:text-sm text-zinc-600 dark:text-zinc-300 sm:block">
                        {{$feature->description}}
                    </p>
                </div>
            @endforeach

        </div>
    </div>
</div>
