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
use App\Http\Controllers\TableroProduccionController;
use App\Http\Controllers\ProgramacionController;
use App\Http\Controllers\MaquinaReservaController;
use App\Http\Controllers\InventarioController;




//logeo

Route::get('/', [LoginController::class, 'showLoginForm'])->name('login.form')->middleware('guest');
Route::post('/', [LoginController::class, 'login'])->name('login');
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

//recover
Route::get('/password/reset', [ResetPasswordController::class, 'showResetForm'])->name('password.reset.form');
Route::post('/password/reset', [ResetPasswordController::class, 'reset'])->name('password.reset');

Route::get('/inventario/validar-codigo', [InventarioController::class, 'validarCodigoBarra'])->name('inventario.validarCodigo');


// Si necesitas rutas adicionales de autenticación, considera personalizarlas
Auth::routes([
 //   'register' => false,  // Para desactivar la ruta de registro, etc.
]);

Route::middleware(['auth'])->group(function () {
   // Route::get('/dashboard', fn() => view('dashboard'))->name('dashboard');
   Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
 
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

    //BODEGA

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
        Route::get('/scraps/{id}', [ScrapController::class, 'show'])->name('scraps.show');
        Route::get('/scraps/{id}/edit', [ScrapController::class, 'edit'])->name('scraps.edit');
        Route::put('/scraps/{id}', [ScrapController::class, 'update'])->name('scraps.update');
        Route::delete('/scraps/{id}', [ScrapController::class, 'destroy'])->name('scraps.destroy');
        Route::get('/scraps', [ScrapController::class, 'index'])->name('scraps.index');

        //producto terminado
        Route::get('producto-terminado', function () { return view('bodega.producto-terminado');
        })->name('bodega.producto-terminado');
        Route::post('/producto-terminado', [ProductoTerminadoController::class, 'store'])->name('producto-terminado.store');

        //Buscador
        Route::get('buscador', function () { return view('bodega.buscador');
        })->name('bodega.buscador');
        Route::get('buscador/searchByBarcode', [IngresoMateriaPrimaController::class, 'searchByBarcode'])->name('buscador.searchByBarcode');


        Route::get('/inventario', [InventarioController::class, 'index'])->name('inventario.index');
        Route::post('/inventario/iniciar', [InventarioController::class, 'iniciarInventario'])->name('inventario.iniciar');
        Route::post('/inventario/procesar', [InventarioController::class, 'procesar'])->name('inventario.procesar');
        Route::post('/inventario/finalizar', [InventarioController::class, 'finalizarInventario'])->name('inventario.finalizar');
        Route::get('/inventario/validar-codigo', [InventarioController::class, 'validarCodigoBarra'])->name('inventario.validarCodigo')->withoutMiddleware(['auth']);
        
        

    });


    
    //ingreso a producion
    Route::prefix('produccion')->group(function () {
        // Ruta para la vista de ingreso usando el controlador
        Route::get('ingreso', [OrdenDeTrabajoController::class, 'create'])->name('ingreso.create');
        Route::post('ingreso', [OrdenDeTrabajoController::class, 'store'])->name('ingreso.store');
        Route::get('tablero', [TableroProduccionController::class, 'index'])->name('tablero.index');
        Route::get('/programacion', [ProgramacionController::class, 'getEvents'])->name('calendario.getEvents');
        Route::get('/programacion', [ProgramacionController::class, 'showCalendar'])->name('calendario.show');
        Route::get('/programacion/data', [ProgramacionController::class, 'getEvents'])->name('calendario.data');    
        Route::resource('maquina_reservas', MaquinaReservaController::class);     
        Route::get('ingreso/{ingreso}', [OrdenDeTrabajoController::class, 'show'])->name('ingreso.show');
       
    });
    
 });
