
@props([
    'livewire' => null,
])

@if($allowLayout)
    <!doctype html>
<html
    lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    dir="{{ __('filament-panels::layout.direction') ?? 'ltr' }}"
    @class([
        'fi min-h-screen',
        'dark' => filament()->hasDarkModeForced(),
    ])

>
<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />


    @if ($favicon = filament()->getFavicon())
        <link rel="icon" href="{{ $favicon }}" />
    @endif

    <title>
        {{ filled($title = strip_tags(($livewire ?? null)?->getTitle() ?? '')) ? "{$title} - " : null }}
        {{ strip_tags(filament()->getBrandName()) }}
    </title>


    <style>
        [x-cloak=''],
        [x-cloak='x-cloak'],
        [x-cloak='1'] {
            display: none !important;
        }

        @media (max-width: 1023px) {
            [x-cloak='-lg'] {
                display: none !important;
            }
        }

        @media (min-width: 1024px) {
            [x-cloak='lg'] {
                display: none !important;
            }
        }
    </style>

    @filamentStyles

    {{ filament()->getTheme()->getHtml() }}
    {{ filament()->getFontHtml() }}

    <style>
        :root {
            --font-family: '{!! filament()->getFontFamily() !!}';
            --sidebar-width: {{ filament()->getSidebarWidth() }};
            --collapsed-sidebar-width: {{ filament()->getCollapsedSidebarWidth() }};
            --default-theme-mode: {{ filament()->getDefaultThemeMode()->value }};
        }
    </style>

    @stack('styles')

    @livewireStyles
</head>
<body class="fi-body fi-panel-admin min-h-screen bg-gray-50 font-normal text-gray-950 antialiased dark:bg-gray-950 dark:text-white">
    @livewire(\TomatoPHP\FilamentCms\Livewire\BuilderToolbar::class, ['page'=>$page])
@else
    @livewire(\TomatoPHP\FilamentCms\Livewire\BuilderToolbar::class, ['page'=>$page])
@endif



@if($allowLayout)
    @livewire(Filament\Livewire\Notifications::class)

    @filamentScripts(withCore: true)

    @if (config('filament.broadcasting.echo'))
        <script data-navigate-once>
            window.Echo = new window.EchoFactory(@js(config('filament.broadcasting.echo')))

            window.dispatchEvent(new CustomEvent('EchoLoaded'))
        </script>
    @endif

    @stack('scripts')
    @stack('modals')

    @livewireScripts
    </body>
    </html>
@else
    @livewire(\TomatoPHP\FilamentCms\Livewire\BuilderToolbar::class, ['page'=>$page])
@endif
