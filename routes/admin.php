<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\categoriaController;
use App\Http\Controllers\clienteController;
use App\Http\Controllers\ProveedoresController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ComprasController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\MantenimientoController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\ReportesController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\VentaControlller;

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
    return view('home');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('/usuario', (UsuarioController::class));
Route::resource('/categoria', (categoriaController::class));
Route::resource('/proveedores', (ProveedoresController::class));
Route::resource('/cliente', (clienteController::class));
Route::resource('/producto', (ProductoController::class));
Route::post('usuario/{id}/', [UsuarioController::class, 'DesactivarUsuario'])->name('usuario.desactivate');
Route::resource('/stock', (StockController::class));
Route::resource('/compras', (ComprasController::class));
Route::resource('/pago', (PagoController::class));
Route::get('api/compras/{producto}', [ComprasController::class, 'apiShowProductos']);
Route::get('api/factura/{producto}', [ComprasController::class, 'apiShowProductos']);
Route::resource('/factura', (VentaControlller::class));
Route::get('api/factura/{producto}', [VentaControlller::class, 'apiShowProductos']);
Route::resource('/reportes', (ReportesController::class));
Route::resource('/backup', (MantenimientoController::class));
Route::resource('/empresa', (EmpresaController::class));
Route::get('/obtener-datos-empresa', [ClinicaController::class, 'ObtenerDatos']);
Route::get('/productogen-pdf',[ReportesController::class, 'prodgpdf'])->name('productogen-pdf');
Route::get('/productoag-pdf',[ReportesController::class, 'GenProdApdf'])->name('GenProdApdf-pdf');
Route::get('/listclien-pdf',[ReportesController::class, 'verclientpdf'])->name('verclientpdf-pdf');
Route::get('/productoag-pdf',[ReportesController::class, 'GenProdApdf'])->name('GenProdApdf-pdf');
Route::get('/obtener-saldo/{clientes_id}', [clienteController::class, 'obtenerSaldo'])->name('obtener-saldo');