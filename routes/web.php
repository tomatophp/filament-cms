<?php


use Illuminate\Support\Facades\Route;
use TomatoPHP\FilamentCms\Http\Controllers\BuilderController;
use ProtoneMedia\Splade\Http\SpladeMiddleware;

Route::middleware(['web', 'auth', SpladeMiddleware::class])
    ->name('admin.')
    ->controller(BuilderController::class)->group(function () {
        Route::get('admin/pages/{model}/builder', 'builder')->name('pages.builder');
        Route::post('admin/pages/{model}/sections', 'sections')->name('pages.sections');
        Route::post('admin/pages/{model}/sections/remove',  'remove')->name('pages.remove');
        Route::get('admin/pages/{model}/meta',  'meta')->name('pages.meta');
        Route::post('admin/pages/{model}/meta',  'metaStore')->name('pages.meta.store');
        Route::post('admin/pages/{model}/clear',  'clear')->name('pages.clear');
    });
