<?php


use Illuminate\Support\Facades\Route;



Route::middleware(['web', 'auth', \ProtoneMedia\Splade\Http\SpladeMiddleware::class])->name('admin.')->group(function () {
    Route::get('admin/pages/{model}/builder', [\TomatoPHP\FilamentCms\Http\Controllers\BuilderController::class, 'builder'])->name('pages.builder');
    Route::post('admin/pages/{model}/sections', [\TomatoPHP\FilamentCms\Http\Controllers\BuilderController::class, 'sections'])->name('pages.sections');
    Route::post('admin/pages/{model}/sections/remove', [\TomatoPHP\FilamentCms\Http\Controllers\BuilderController::class, 'remove'])->name('pages.remove');
    Route::get('admin/pages/{model}/meta', [\TomatoPHP\FilamentCms\Http\Controllers\BuilderController::class, 'meta'])->name('pages.meta');
    Route::post('admin/pages/{model}/meta', [\TomatoPHP\FilamentCms\Http\Controllers\BuilderController::class, 'metaStore'])->name('pages.meta.store');
    Route::post('admin/pages/{model}/clear', [\TomatoPHP\FilamentCms\Http\Controllers\BuilderController::class, 'clear'])->name('pages.clear');
});
