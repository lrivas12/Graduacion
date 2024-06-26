<?php

use App\Http\Controllers\AcercaController;
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
use App\Http\Controllers\OdontoController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\PerfilController;
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


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('/usuario', (UsuarioController::class))->middleware("Roles:Administrador");
Route::resource('/categoria', (categoriaController::class))->middleware("Roles:Administrador,Editor,Vendedor");
Route::resource('/proveedores', (ProveedoresController::class))->middleware("Roles:Administrador,Editor,Vendedor");
Route::resource('/cliente', (clienteController::class))->middleware("Roles:Administrador,Editor,Vendedor");
Route::resource('/producto', (ProductoController::class))->middleware("Roles:Administrador,Editor,Vendedor");
Route::post('usuario/{id}/', [UsuarioController::class, 'DesactivarUsuario'])->name('usuario.desactivate')->middleware("Roles:Administrador");
Route::post('categoria/{id}/', [categoriaController::class, 'DesactivarCategoria'])->name('categoria.desactivate')->middleware("Roles:Administrador");
Route::post('proveedores/{id}/', [ProveedoresController::class, 'DesactivarProveedor'])->name('proveedor.desactivate')->middleware("Roles:Administrador");
Route::post('producto/{id}/', [ProductoController::class, 'DesactivarProducto'])->name('producto.desactivate')->middleware("Roles:Administrador");
Route::resource('/stock', (StockController::class))->middleware("Roles:Administrador, Editor, Vendedor");
Route::resource('/compras', (ComprasController::class))->middleware("Roles:Administrador, Editor, Vendedor");
Route::resource('/pagos', (PagoController::class))->middleware("Roles:Administrador, Editor, Vendedor");
Route::get('api/compras/{producto}', [ComprasController::class, 'apiShowProductos'])->middleware("Roles:Administrador");
Route::get('api/factura/{producto}', [ComprasController::class, 'apiShowProductos'])->middleware("Roles:Administrador");
Route::resource('/factura', (VentaControlller::class))->middleware("Roles:Administrador,Editor,Vendedor");
Route::get('api/factura/{producto}', [VentaControlller::class, 'apiShowProductos']);
Route::resource('/backup', (MantenimientoController::class))->middleware("Roles:Administrador");
Route::resource('/empresa', (EmpresaController::class))->middleware("Roles:Administrador");
Route::get('/obtener-datos-empresa', [EmpresaController::class, 'ObtenerDatos'])->middleware("Roles:Administrador");
Route::get('/obtener-saldo/{clientes_id}', [clienteController::class, 'obtenerSaldo'])->name('obtener-saldo')->middleware("Roles:Administrador");

Route::resource('/nosotros', (AcercaController::class));


Route::resource('/reportes', (ReportesController::class))->middleware("Roles:Administrador,Editor,Vendedor")->except(['show']); // uso except aqui para que la ruta del metodo consultarEstadoCuenta no busque el metodo show (porque eso hace en realidad), ya que el resource esta en el nivel más alto de la jerarquía. Otra solucion sin usar except es mover las custom routes mas arriba en la jerarquia, o sea, mover el resource hasta abajo.
Route::get('/exportarclientes', [MantenimientoController::class, 'exportClientes'])->name('exportarClientes')->middleware("Roles:Administrador");
Route::get('/exportarproveedores', [MantenimientoController::class, 'exportProveedores'])->name('exportarProveedores')->middleware("Roles:Administrador");
Route::get('/exportarproductos', [MantenimientoController::class, 'exportProductos'])->name('exportarProductos')->middleware("Roles:Administrador");
Route::get('/exportarfacturas', [MantenimientoController::class, 'exportSalesWithDetails'])->name('exportarVentas')->middleware("Roles:Administrador");
Route::get('/ventas/{id}/factura', [VentaControlller::class, 'Imprimirfactura'])->name('facturas.Imprimirfactura')->middleware("Roles:Administrador,Editor,Vendedor");
Route::resource('/perfil', (PerfilController::class))->middleware("Roles:Administrador,Editor,Vendedor");
// RUTAS DE REPORTE
Route::get('/productogen-pdf', [ReportesController::class, 'prodgpdf'])->name('productogen-pdf')->middleware("Roles:Administrador");
Route::get('/productoag-pdf', [ReportesController::class, 'GenProdApdf'])->name('GenProdApdf-pdf')->middleware("Roles:Administrador");
Route::get('/listclien-pdf', [ReportesController::class, 'verclientpdf'])->name('verclientpdf-pdf')->middleware("Roles:Administrador");
Route::get('/listfactura-pdf', [ReportesController::class, 'generarVenta'])->name('generarVenta')->middleware("Roles:Administrador");
Route::get('/listcompra-pdf', [ReportesController::class, 'generarcompras'])->name('generarcompras')->middleware("Roles:Administrador");
Route::get('/productoag-pdf', [ReportesController::class, 'GenProdApdf'])->name('GenProdApdf-pdf')->middleware("Roles:Administrador");
Route::get('/comprasrec-pdf', [ReportesController::class, 'generarPDFComprasRecientes'])->name('comprasrec-pdf')->middleware("Roles:Administrador");
Route::get('/comprasfecha-pdf', [ReportesController::class, 'generarComprasFecha'])->name('comprasfecha-pdf')->middleware("Roles:Administrador");
/* Esta es la ruta para reporte de ventas con fecha */
Route::get('/totalventas-pdf', [ReportesController::class, 'generarPDFtotalventas'])->name('totalventas-pdf')->middleware("Roles:Administrador");
Route::get('/comprarec-pdf', [ReportesController::class, 'generarPDFComprasRecientes'])->name('comprarec-pdf');
// Ruta para reportes de credito para clientes
Route::get('reportes/consultarEstadoCuentaCliente/{id}', [ReportesController::class, 'consultarEstadoCuentaCliente'])->name('consultarEstadoCuentaCliente')->middleware("Roles:Administrador,Editor,Vendedor");
Route::get('generarEstadoCuentaClientePDF', [ReportesController::class, 'generarEstadoCuentaClientePDF'])->name('generarEstadoCuentaClientePDF')->middleware("Roles:Administrador,Editor,Vendedor");
// Ruta para reportes de credito global (sin cliente en especifico)
Route::get('reportes/consultarEstadoCuenta', [ReportesController::class, 'consultarEstadoCuenta'])->name('consultarEstadoCuenta')->middleware("Roles:Administrador,Editor,Vendedor");
Route::get('generarEstadoCuentaPDF', [ReportesController::class, 'generarEstadoCuentaPDF'])->name('generarEstadoCuentaPDF')->middleware("Roles:Administrador,Editor,Vendedor");
// RUTAS DE REPORTE

