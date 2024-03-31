<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TodoController;
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

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

// Route::get('/dashboard', function () {
//     return Inertia::render('Dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

//Home
Route::get('/', [HomeController::class, 'index'])->name('dashboard');

//Todo

Route::prefix('todo')->group(function () {
    Route::get('/', [TodoController::class, 'index'])->name('todo');
    Route::get('/list', [TodoController::class, 'list'])->name('todo.list');
    Route::get('/get/{id}', [TodoController::class, 'get'])->name('todo.get');
    Route::post('/store', [TodoController::class, 'store'])->name('todo.store');
    Route::get('/edit', [TodoController::class, 'edit'])->name('todo.edit');
    Route::post('/update/{id}', [TodoController::class, 'update'])->name('todo.update');
    Route::get('/done/{id}', [TodoController::class, 'done'])->name('todo.done');
    Route::delete('/delete/{id}', [TodoController::class, 'delete'])->name('todo.delete');
});


require __DIR__.'/auth.php';
