<div class="relative  text-center border rounded-lg shadow-sm font-main my-4">
    <x-heroicon-m-magnifying-glass class="w-16 h-16 mx-auto my-4 text-center" />
    <h2 class="text-2xl font-medium">
        {{__("Sorry, There is not result for this search")}}
    </h2>

    <p class="mt-4 text-sm text-gray-500">
        {{__("Please try another word or contact us to add an article")}}
    </p>

    <x-splade-link href="{{ \Illuminate\Support\Str::of(url()->current())->explode('?')[0] }}"
                   class="inline-flex items-center px-5 py-3 mt-8 font-medium text-white rounded-lg bg-main mb-4">
        {{__("Back to the main page")}}
    </x-splade-link>
</div>
