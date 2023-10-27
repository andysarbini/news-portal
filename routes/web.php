<?php

use App\Http\Controllers\{
    DashboardController,
    SettingController,
    CategoryController
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
    
    Route::group([
        'middleware' => 'role:author'
    ], function() {
        //
    });
});
