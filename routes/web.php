<?php

use App\Http\Controllers\{
    ArticleController,
    DashboardController,
    SettingController,
    CategoryController,
    GalleryController
};
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified'
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });

Route::group([
    'middleware' => ['auth', 'role:admin,author']
], function() {
    Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard');

    Route::group([
        'middleware' => 'role:admin'
    ], function() {
        Route::resource('/category', CategoryController::class);

        Route::get('/setting', [SettingController::class, 'index'])
            ->name('setting.index');
    });
        Route::get('/article/data', [ArticleController::class, 'data'])
            ->name('article.data');
        Route::resource('/article', ArticleController::class);
        Route::get('/gallery/data', [GalleryController::class, 'data'])
            ->name('gallery.data');
        Route::resource('/gallery', GalleryController::class);
        
    
    Route::group([
        'middleware' => 'role:author'
    ], function() {
        //
    });
});
