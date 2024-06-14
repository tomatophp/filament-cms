@php
    $section = $page->meta($section['uuid']);
@endphp
<div class="bg-white dark:bg-zinc-900 min-h-screen">
    <div>
        <main class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex items-baseline justify-between border-b border-zinc-200 dark:border-zinc-700 pb-6 pt-8">
                <h1 class="text-4xl font-bold tracking-tight text-zinc-900 dark:text-zinc-100">
                    {{ $page->title }}
                </h1>
            </div>

            <div class="my-4">
                <x-tomato-markdown-viewer :content="$page->body" />
            </div>
        </main>
    </div>
</div>
