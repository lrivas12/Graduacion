<?php

namespace App\Http\Controllers;
use App\Models\factura;
use App\Models\detallefactura;
use App\Models\compra;
use App\Models\detallecompra;
use Illuminate\Support\Facades\DB;
use App\Models\cliente;
use App\Models\producto;
use App\Models\categoria;
use App\Models\pago;
use App\Models\detallepago;
use App\Models\proveedores;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ReportesController extends Controller
{
    public function index(Request $request)
    {
        $productos = producto::all();
        $clientes = cliente::all();
        $categorias = categoria::all();
        $ventas = factura::all();
        $detalleventas = detallefactura::all();
        $proveedores = proveedores::all();
        $compras = compra::all();
        $detallecompras = detallecompra::all();
        $pagos = pago::all();
        $detallepagos = detallepago::all();
        $users = User::all();


        $productosProximosAgotar = DB::table('productos')
        ->join('categorias', 'productos.id_categoria', '=', 'categorias.id')
        ->select('productos.nombreproducto', 'productos.cantidadproducto', 'productos.stockminimo', 'categorias.nombrecategoria')
        ->where('productos.estadoproducto', true)
        ->whereColumn('productos.cantidadproducto', '<=', 'productos.stockminimo')
        ->get();

        $productos = DB::table('productos')
        ->join('categorias', 'productos.id_categoria', '=', 'categorias.id')
        ->select('productos.*', 'categorias.nombrecategoria')
        ->get();
        
        $clientes = DB::table('clientes')
        ->select('clientes.*')
        ->get();

        /* $ventas = DB::table('facturas')
        ->join('detalle_facturas', 'facturas.id', '=', 'detalle_facturas.facturas_id')
        ->join('productos', 'detalle_facturas.productos_id', '=', 'productos.id')
        ->select('facturas.*', 'detalle_facturas.*', 'productos.nombreproducto')
        ->get(); */

        $categorias = DB::table('categorias')
        ->select('categorias.*')
        ->get();
        
        
        /* $fechaInicio = $request->fechaInicio; 
        $fechaFin = $request->fechaFin;

        $totalVentas = DB::table('facturas')
        ->whereBetween('fechafactura', [$fechaInicio, $fechaFin])
        ->sum('totalventa');

        $compras = DB::table('compras')
        ->join('proveedores', 'compras.proveedor_id', '=', 'proveedores.id')
        ->select('compras.*', 'proveedores.razonsocialproveedor')
        ->get();

        $ventasus = DB::table('facturas')
        ->where('users_id', '=', 'users.id')
        ->join('detalle_facturas', 'facturas.id', '=', 'detalle_facturas.facturas_id')
        ->join('productos', 'detalle_facturas.productos_id', '=', 'productos.id')
        ->select('facturas.*', 'detalle_facturas.*', 'productos.nombreproducto')
        ->get(); */

        return view('reporte.index', compact('productos', 'categorias', 'clientes', 'ventas', 'detalleventas', 'proveedores', 'compras', 'detallecompras', 'pagos', 'detallepagos', 'users'));
    }

    public function GenProdApdf()
    {
        $productosProximosAgotar = DB::table('productos')
        ->join('categorias', 'productos.id_categoria', '=', 'categorias.id')
        ->select('productos.nombreproducto', 'productos.cantidadproducto', 'productos.stockminimo', 'categorias.nombrecategoria')
        ->where('productos.estadoproducto', true)
        ->whereColumn('productos.cantidadproducto', '<=', 'productos.stockminimo')
        ->get();

        $pdf = PDF::loadview('reporte.prodagot', ['productos'=> $productosProximosAgotar]); 
        return $pdf->stream();
    }

    public function prodgpdf()
    {
        $productos = DB::table('productos')
        ->join('categorias', 'productos.id_categoria', '=', 'categorias.id')
        ->select('productos.*', 'categorias.nombrecategoria')
        ->get();

        $pdf = PDF::loadview('reporte.productosge', ['productos'=> $productos]);
        return $pdf->stream();
    }

    public function verclientpdf()
    {
        $clientes = DB::table('clientes')
        ->select('clientes.*')
        ->get();
        $pdf = PDF::loadview('reporte.verclient', ['clientes'=> $clientes]);
        return $pdf->stream();
    }


     /*   public function verventaspdf()
    {   
        $ventas = DB::table('facturas')
        ->join('detalle_facturas', 'facturas.id', '=', 'detalle_facturas.facturas_id')
        ->join('productos', 'detalle_facturas.productos_id', '=', 'productos.id')
        ->select('facturas.*', 'detalle_facturas.*', 'productos.nombreproducto')
        ->get();
        
        $pdf = PDF::loadview('reporte.verventas', ['facturas'=> $ventas]);
        return $pdf->stream();
    }
    
    public function vercompraspdf()
    {
        $compras = DB::table('compras')
        ->join('proveedores', 'compras.proveedor_id', '=', 'proveedores.id')
        ->select('compras.*', 'proveedores.razonsocialproveedor')
        ->get();
            
        $pdf = PDF::loadview('reporte.vercom', ['compras'=> $compras]);
        return $pdf->stream();
    }

    public function verfacturaxusuarpdf()
    {
        $ventasus = DB::table('facturas')
        ->where('users_id', '=', 'users.id')
        ->join('detalle_facturas', 'facturas.id', '=', 'detalle_facturas.facturas_id')
        ->join('productos', 'detalle_facturas.productos_id', '=', 'productos.id')
        ->select('facturas.*', 'detalle_facturas.*', 'productos.nombreproducto')
        ->get();
        $pdf = PDF::loadview('reporte.facturaxusua', ['ventas'=> $ventasus]);
        return $pdf->stream();
    }

    public function totalventasxfech(Request $request)
    {
        $fechaInicio = $request->fechaInicio; 
        $fechaFin = $request->fechaFin;
        $totalVentas = DB::table('facturas')
        ->whereBetween('fechafactura', [$fechaInicio, $fechaFin])
        ->sum('totalventa');
        $pdf = PDF::loadview('reporte.facxfech', ['ventas'=> $totalVentas]);
        return $pdf->stream();

    } */

}
