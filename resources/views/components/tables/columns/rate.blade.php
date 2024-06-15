<div class="flex justify-center gap-2">
    @for($i=0; $i<$getState(); $i++)
        <x-heroicon-s-star class="w-5 h-5 text-primary-600" />
    @endfor
    @for($i=0; $i<(5-(int)$getState()); $i++)
        <x-heroicon-s-star class="w-5 h-5" />
    @endfor
</div>
