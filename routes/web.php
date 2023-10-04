<?php

use App\Http\Controllers\MainController;
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
// redirect to login
Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [MainController::class, 'dashboard'])->name('dashboard');
    Route::get('/diagrama/crear', [MainController::class, 'crear_digrama'])->name('new_diagrama');
    Route::post('/diagrama/guardar', [MainController::class, 'guardar_diagrama'])->name('guardar_diagrama');
    Route::get('/diagrama/{id}', [MainController::class, 'diagrama'])->name('show_diagrama');
    Route::delete('/diagrama/{id}', [MainController::class, 'eliminar_diagrama'])->name('eliminar_diagrama');
    Route::put('/diagrama/{id}', [MainController::class, 'actualizar_diagrama'])->name('actualizar_diagrama');
});
