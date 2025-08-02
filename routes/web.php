<?php
    
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\LibroController;
use App\Http\Controllers\PrestamoController;
use App\Http\Controllers\MultaController;
use Illuminate\Support\Facades\Route;

// 🔹 Rutas públicas (accesibles sin login)
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// 🔹 Rutas protegidas (requieren estar logueado)
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Dashboard como página principal solo si estás logueado
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('usuarios', UsuarioController::class);
    Route::resource('libros', LibroController::class);
    Route::resource('prestamos', PrestamoController::class);
    Route::resource('multas', MultaController::class);
});
