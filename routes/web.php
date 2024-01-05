<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\MovieRequestController;
use App\Http\Controllers\PayrollItemController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TVShowController;
use App\Http\Controllers\TVShowRequestController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Auth/Login', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

// Route::get('/dashboard', function () {
//     return Inertia::render('Dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');



    Route::middleware('can:manage_payroll')->group(function(){
        Route::get('/logs', [LogController::class, 'index'])->name('logs.index');

        Route::get('/users',[UserController::class, 'index'])->name('user.index');
        Route::get('/users/create', [UserController::class, 'create'])->name('user.create');
        Route::post('/users',[UserController::class, 'store'])->name('user.store');
        Route::get('/users/edit/{user}', [UserController::class, 'edit']);
        Route::put('/users/{user}',[UserController::class, 'update']);
        Route::delete('/users/{user}', [UserController::class, 'destroy']);

        Route::get('/tvshows', [TVShowController::class, 'index'])->name('tvshow.index');
        Route::get('/tvshows/request', [TVShowRequestController::class, 'create'])->name('tvshowrequest.request');
        Route::post('/tvshows/request', [TVShowRequestController::class, 'store'])->name('tvshowrequest.store');
        Route::get('/tvshows/create', [TVShowController::class, 'create'])->name('tvshow.create');
        Route::post('/tvshows', [TVShowController::class, 'store'])->name('tvshow.store');
        Route::get('/tvshows/edit/{tvshow}', [TVShowController::class, 'edit'])->name('tvshow.edit');
        Route::put('/tvshows/{tvshow}', [TVShowController::class, 'update'])->name('tvshow.update');
        Route::delete('/tvshows/delete/{tvshow}', [TVShowController::class, 'destroy'])->name('tvshow.destroy');

        Route::get('/movies', [MovieController::class, 'index'])->name('movie.index');
        Route::get('/movies/request', [MovieRequestController::class, 'create'])->name('movierequest.request');
        Route::post('/movies/request', [MovieRequestController::class, 'store'])->name('movierequest.store');
        // Route::get('/movies/create', [MovieController::class, 'create'])->name('movies.create');
        // Route::post('/movies', [PayrollItemController::class, 'store'])->name('movies.create');
        // Route::get('/movies/{movie}',[MovieController::class,'show']);
    });
});


require __DIR__.'/auth.php';
