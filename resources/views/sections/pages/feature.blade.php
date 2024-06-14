@php $section = $page->meta($section['uuid']); @endphp
<section class="overflow-hidden bg-zinc-200 dark:bg-zinc-700 sm:grid sm:grid-cols-2">
    <div class="p-8 md:p-12 lg:px-16 lg:py-24">
        <div
            class="mx-auto max-w-xl text-center ltr:sm:text-left rtl:sm:text-right"
        >
            <h2 class="text-2xl font-bold text-zinc-900 dark:text-zinc-100 md:text-3xl">
                {{ $section['title_'. app()->getLocale()] ?? "Lorem, ipsum dolor sit amet consectetur adipisicing elit" }}
            </h2>

            <p class="hidden text-zinc-500 dark:text-zinc-300 md:mt-4 md:block">
                {{ $section['description_'. app()->getLocale()] ?? "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Et, egestas tempus tellus etiam sed. Quam a scelerisque amet ullamcorper eu enim et fermentum, augue. Aliquet amet volutpat quisque ut interdum tincidunt duis."}}
            </p>

            <div class="mt-4 md:mt-8">
                <x-splade-link
                    href="{{$section['url'] ?? '#'}}"
                    class="inline-block rounded bg-emerald-600 px-12 py-3 text-sm font-medium text-white transition hover:bg-emerald-700 focus:outline-none focus:ring focus:ring-yellow-400"
                >
                    {{ $section['button_'. app()->getLocale()] ?? "Get Started Today"}}
                </x-splade-link>
            </div>
        </div>
    </div>

    @if(isset($section['image']))
    <img
        alt="{{ $section['button_'. app()->getLocale()] ?? "Get Started Today"}}"
        src="{{$section['image'] ?? url('placeholder.webp')}}"
        class="h-56 w-full object-cover sm:h-full"
    />
    @else
        <div class="h-56 w-full flex flex-col justify-center items-center object-cover sm:h-full bg-zinc-300 dark:bg-zinc-800">
            <i class="bx bxs-spa text-9xl text-zinc-900 dark:text-zinc-100"></i>
        </div>
    @endif
</section>
