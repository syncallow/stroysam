<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function() {
   Route::get('/' , function (){
       return view('admin.index');
   })->name('admin.index');

   Route::group(['prefix' => 'pages'], function() {
      Route::get('/', [\App\Http\Controllers\Admin\PageController::class, 'index'])->name('admin.pages.index');
      Route::get('/create', [\App\Http\Controllers\Admin\PageController::class, 'create'])->name('admin.pages.create');
      Route::post('/store', [\App\Http\Controllers\Admin\PageController::class, 'store'])->name('admin.pages.store');
      Route::get('/edit/{page}', [\App\Http\Controllers\Admin\PageController::class, 'edit'])->name('admin.pages.edit');
      Route::patch('/update/{page}', [\App\Http\Controllers\Admin\PageController::class, 'update'])->name('admin.pages.update');
      Route::delete('/delete/{page}', [\App\Http\Controllers\Admin\PageController::class, 'delete'])->name('admin.pages.delete');
   });

    Route::group(['prefix' => 'layouts'], function() {
        Route::get('/', [\App\Http\Controllers\Admin\LayoutController::class, 'index'])->name('admin.layouts.index');
        Route::get('/create', [\App\Http\Controllers\Admin\LayoutController::class, 'create'])->name('admin.layouts.create');
        Route::post('/store', [\App\Http\Controllers\Admin\LayoutController::class, 'store'])->name('admin.layouts.store');
        Route::get('/edit/{layout}', [\App\Http\Controllers\Admin\LayoutController::class, 'edit'])->name('admin.layouts.edit');
        Route::patch('/update/{layout}', [\App\Http\Controllers\Admin\LayoutController::class, 'update'])->name('admin.layouts.update');
    });

    Route::group(['prefix' => 'categories'], function() {
        Route::get('/', [\App\Http\Controllers\Admin\CategoryController::class, 'index'])->name('admin.categories.index');
        Route::get('/create', [\App\Http\Controllers\Admin\CategoryController::class, 'create'])->name('admin.categories.create');
        Route::post('/store', [\App\Http\Controllers\Admin\CategoryController::class, 'store'])->name('admin.categories.store');
        Route::get('/edit/{category}', [\App\Http\Controllers\Admin\CategoryController::class, 'edit'])->name('admin.categories.edit');
        Route::patch('/update/{category}', [\App\Http\Controllers\Admin\CategoryController::class, 'update'])->name('admin.categories.update');
        Route::delete('/delete/{category}', [\App\Http\Controllers\Admin\CategoryController::class, 'delete'])->name('admin.categories.delete');
    });
    Route::group(['prefix' => 'tags'], function() {
        Route::get('/', [\App\Http\Controllers\Admin\TagController::class, 'index'])->name('admin.tags.index');
        Route::get('/create', [\App\Http\Controllers\Admin\TagController::class, 'create'])->name('admin.tags.create');
        Route::post('/store', [\App\Http\Controllers\Admin\TagController::class, 'store'])->name('admin.tags.store');
        Route::get('/edit/{tag}', [\App\Http\Controllers\Admin\TagController::class, 'edit'])->name('admin.tags.edit');
        Route::patch('/update/{tag}', [\App\Http\Controllers\Admin\TagController::class, 'update'])->name('admin.tags.update');
        Route::delete('/delete/{tag}', [\App\Http\Controllers\Admin\TagController::class, 'delete'])->name('admin.tags.delete');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/tag/{slug}', [\App\Http\Controllers\Tag\TagController::class, 'index'])->name('tag.index');
Route::get('{slug?}', [\App\Http\Controllers\Page\PageController::class, 'index'])->where('slug', '.*')->name('page.index');
