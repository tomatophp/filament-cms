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

Route::middleware(['web', 'auth', \ProtoneMedia\Splade\Http\SpladeMiddleware::class])->prefix('themes')->name('admin.themes.')->group(static function (){
    Route::get('/page/{model}', [\TomatoPHP\FilamentCms\Http\Controllers\BuilderController::class,'edit'])->name('page.edit');
    Route::post('/page/{model}', [\TomatoPHP\FilamentCms\Http\Controllers\BuilderController::class,'update'])->name('page.update');
    Route::post('/active', [\TomatoPHP\FilamentCms\Http\Controllers\ThemesController::class,'active'])->name('active');
//    if(config('tomato-themes.allow_create')){
//        Route::get('/custom/{theme}', [\TomatoPHP\FilamentCms\Http\Controllers\ThemesController::class,'custom'])->name('custom');
//        Route::post('/custom/{theme}', [\TomatoPHP\FilamentCms\Http\Controllers\ThemesController::class,'customSave'])->name('custom.save');
//        Route::get('/create', [\TomatoPHP\FilamentCms\Http\Controllers\ThemesController::class,'create'])->name('create');
//        Route::post('/', [\TomatoPHP\FilamentCms\Http\Controllers\ThemesController::class,'store'])->name('store');
//    }
//    if(config('tomato-themes.allow_upload')){
//        Route::get('/upload', [\TomatoPHP\FilamentCms\Http\Controllers\ThemesController::class,'upload'])->name('upload');
//        Route::post('/upload', [\TomatoPHP\FilamentCms\Http\Controllers\ThemesController::class,'uploadNew'])->name('upload.new');
//    }
//
//    if(config('tomato-themes.allow_destroy')){
//        Route::delete('/destroy/{theme}', [\TomatoPHP\FilamentCms\Http\Controllers\ThemesController::class,'destroy'])->name('destroy');
//    }
});


Route::fallback(function ($slug){
    $page= \TomatoPHP\TomatoCms\Models\Page::where('slug', $slug)->firstOrFail();
    return view('tomato-themes::pages.html', compact('page'));
})->middleware(['web','splade']);
