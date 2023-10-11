<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\IngresoMateriaPrimaController;
use App\Http\Controllers\ScrapController;
use App\Http\Controllers\OrdenDeTrabajoController;
use App\Http\Controllers\Auth\ResetPasswordController;


//logeo

Route::get('/', [LoginController::class, 'showLoginForm'])->name('login.form')->middleware('guest');
Route::post('/', [LoginController::class, 'login'])->name('login');
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

//recover
Route::get('/password/reset', [ResetPasswordController::class, 'showResetForm'])->name('password.reset.form');
Route::post('/password/reset', [ResetPasswordController::class, 'reset'])->name('password.reset');


// Si necesitas rutas adicionales de autenticación, considera personalizarlas
Auth::routes([
 //   'register' => false,  // Para desactivar la ruta de registro, etc.
]);

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', fn() => view('dashboard'))->name('dashboard');

// Rutas de Registro Personalizadas
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register.form');
Route::post('register', [RegisterController::class, 'register'])->name('register');



    Route::prefix('user')->group(function () {
        Route::get('create', function () {
            return view('user.create');
        })->name('user.create');
        
        Route::post('store', [UserController::class, 'store'])->name('user.store');
        Route::match(['get', 'post'], 'edit', [UserController::class, 'edit'])->name('user.edit');
        Route::delete('{id}', [UserController::class, 'destroy'])->name('user.destroy');
    });

    Route::prefix('productos')->group(function () {
        Route::get('create', function () {
            return view('productos.create');
        })->name('productos.create');
        Route::post('store', [ProductosController::class, 'store'])->name('productos.store');
      
        Route::get('edit', [ProductosController::class, 'edit'])->name('productos.edit');
        Route::post('update', [ProductosController::class, 'update'])->name('productos.update');
        Route::delete('{id}', [ProductosController::class, 'destroy'])->name('productos.destroy');    

    });

    Route::prefix('clientes')->group(function () {
        Route::get('create', function () {
            return view('clientes.create');
        })->name('clientes.create');
        Route::post('store', [ClienteController::class, 'store'])->name('clientes.store');

        Route::get('edit', [ClienteController::class, 'edit'])->name('clientes.edit');
        Route::post('update', [ClienteController::class, 'update'])->name('clientes.update');
        Route::delete('{id}', [ClienteController::class, 'destroy'])->name('clientes.destroy');
        
    });

    Route::prefix('bodega')->group(function () {
        Route::get('materia', function () {
            return view('bodega.materia');
        })->name('bodega.materia');
    
        Route::get('/materia/create', [IngresoMateriaPrimaController::class, 'create'])->name('materia.create');
        Route::post('/materia', [IngresoMateriaPrimaController::class, 'store'])->name('materia.store');
        Route::get('/materia/{id}', [IngresoMateriaPrimaController::class, 'show'])->name('materia.show');
        Route::get('/materia/{id}/edit', [IngresoMateriaPrimaController::class, 'edit'])->name('materia.edit');
        Route::put('/materia/{id}', [IngresoMateriaPrimaController::class, 'update'])->name('materia.update');
        Route::delete('/materia/{id}', [IngresoMateriaPrimaController::class, 'destroy'])->name('materia.destroy');
    });
    
    Route::prefix('bodega')->group(function () {
        Route::get('scrap', function () {
            return view('bodega.scrap');
        })->name('bodega.scrap');
     
    Route::get('/scraps/create', [ScrapController::class, 'create'])->name('scraps.create');
    Route::post('/scraps', [ScrapController::class, 'store'])->name('scraps.store');

    // Rutas para ver detalles, editar y eliminar scrap
    Route::get('/scraps/{id}', [ScrapController::class, 'show'])->name('scraps.show');
    Route::get('/scraps/{id}/edit', [ScrapController::class, 'edit'])->name('scraps.edit');
    Route::put('/scraps/{id}', [ScrapController::class, 'update'])->name('scraps.update');
    Route::delete('/scraps/{id}', [ScrapController::class, 'destroy'])->name('scraps.destroy');
    // Ruta para listar todos los scraps
    Route::get('/scraps', [ScrapController::class, 'index'])->name('scraps.index');

    //producto terminado
    Route::get('producto-terminado', function () { return view('bodega.producto-terminado');
    })->name('bodega.producto-terminado');

    Route::post('/producto-terminado', [ProductoTerminadoController::class, 'store'])->name('producto-terminado.store');



    });

    //ingreso a producion
Route::prefix('produccion')->group(function () {
    // Ruta para la vista de ingreso
    Route::get('ingreso', function () {
        return view('produccion.ingreso');
    })->name('produccion.ingreso');



    // Rutas relacionadas con las Ordenes de Trabajo
    Route::prefix('ordenes')->group(function () {
        Route::get('/', [OrdenDeTrabajoController::class, 'index'])->name('produccion.ordenes.index');
        Route::get('create', [OrdenDeTrabajoController::class, 'create'])->name('produccion.ordenes.create');
        Route::post('/', [OrdenDeTrabajoController::class, 'store'])->name('produccion.ordenes.store');
        Route::get('{orden}', [OrdenDeTrabajoController::class, 'show'])->name('produccion.ordenes.show');
        Route::get('{orden}/edit', [OrdenDeTrabajoController::class, 'edit'])->name('produccion.ordenes.edit');
        Route::put('{orden}', [OrdenDeTrabajoController::class, 'update'])->name('produccion.ordenes.update');
        Route::delete('{orden}', [OrdenDeTrabajoController::class, 'destroy'])->name('produccion.ordenes.destroy');
    });
});

    

});