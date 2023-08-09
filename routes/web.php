<?php

use App\Http\Controllers\MeowController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TrashedMeowController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::resource('/meows', MeowController::class)->middleware(['auth']);

// Route::get('/trashed', [ TrashedMeowController::class, 'index' ])->middleware('auth')->name('trashed.index');
// Route::get('/trashed/{meow}', [ TrashedMeowController::class, 'show' ])->withTrashed()->middleware('auth')->name('trashed.show');
// Route::put('/trashed/{meow}', [ TrashedMeowController::class, 'update' ])->withTrashed()->middleware('auth')->name('trashed.update');
// Route::delete('/trashed/{meow}', [ TrashedMeowController::class, 'destroy' ])->withTrashed()->middleware('auth')->name('trashed.destroy');

Route::prefix('/trashed')->name('trashed.')->middleware('auth')->group(function() {
    Route::get('/', [ TrashedMeowController::class, 'index' ])->name('index');
    Route::get('/{meow}', [ TrashedMeowController::class, 'show' ])->name('show')->withTrashed();
    Route::put('/{meow}', [ TrashedMeowController::class, 'update' ])->name('update')->withTrashed();
    Route::delete('/{meow}', [ TrashedMeowController::class, 'destroy' ])->name('destroy')->withTrashed();
});

require __DIR__.'/auth.php';
