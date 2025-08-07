    <?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\LibroController;
use App\Http\Controllers\PrestamoController;
use App\Http\Controllers\MultaController;
use Illuminate\Support\Facades\Route;

// Rutas públicas
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Rutas protegidas solo por autenticación (sin control de roles)
Route::middleware('auth')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Usuarios y libros completos para todos los autenticados
    Route::resource('usuarios', UsuarioController::class);
    Route::resource('libros', LibroController::class)->except(['index', 'show']);

    // Libros accesibles para todos
    Route::get('/libros', [LibroController::class, 'index'])->name('libros.index');
    Route::get('/libros/{libro}', [LibroController::class, 'show'])->name('libros.show');
    Route::get('/libros/buscar', [LibroController::class, 'buscar'])->name('libros.buscar');

    // Préstamos y multas accesibles para todos (sin restricción por rol)
    Route::resource('prestamos', PrestamoController::class);
    Route::resource('multas', MultaController::class);

    // Ruta para que usuario vea sus propios préstamos y multas (se debe filtrar en controlador)
    Route::get('/mis-prestamos', [PrestamoController::class, 'misPrestamos'])->name('prestamos.mis');
    Route::get('/mis-multas', [MultaController::class, 'misMultas'])->name('multas.mis');

    Route::get('/mis-multas', [MultaController::class, 'misMultas'])->name('multas.mis');
    Route::post('/pagar-multa/{multa}', [MultaController::class, 'pagar'])->name('multas.pagar');
});

