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
        $venta = factura::all();
        $detallepagos = detallepago::all();
        $datocliente = DB::table('clientes')
        ->select('clientes.nombrecliente', 'clientes.apellidocliente')
        ->get();

    // Realizar la consulta para obtener productos próximos a agotarse
        $productosProximosAgotarse = DB::table('productos')
        ->join('categorias', 'productos.id_categoria', '=', 'categorias.id')
        ->select('productos.*', 'categorias.nombrecategoria')
        ->where('productos.estadoproducto',  true) // Ajusta según tu estructura
        ->where('productos.cantidadproducto', '<=', 'stockminimo')
        ->get();

        $productos = DB::table('productos')
        ->join('categorias', 'productos.id_categoria', '=', 'categorias.id')
        ->select('productos.*', 'categorias.nombrecategoria')
        ->get();
        
        $clientes = DB::table('clientes')
        ->select('clientes.*')
        ->get();

        
        $categorias = DB::table('categorias')
        ->select('categorias.*')
        ->get();
        
        
        $fechaInicio = $request->input('fechini');
        $fechaFin = $request->input('fechfin');

        $comprasrecientes = compra::whereBetween('fechacompra', [$fechaInicio, $fechaFin])->get();
        $totalcompras = $comprasrecientes->sum('totalcompra');

        $cantidadporcompra = detallecompra::select('compra_id', DB::raw('SUM(cantidadcompra) as cantidad_total_prod'))
        ->whereIn('compra_id', function ($query) use ($fechaInicio, $fechaFin){
            $query->select('id')
            ->from('compras')
            ->whereBetween('fechacompra', [$fechaInicio,$fechaFin]);
        })
        ->groupBy('compra_id')
        ->get();

        $totalprod = $cantidadporcompra->sum('cantidad_total_prod');
        foreach($comprasrecientes as $compras)
        {
            $fechaCompra = $compras->fechacompra;
        }

        /* total de ventas */
        $FechIniFact = $request->input('fechini');
        $FechaFinFact = $request->input('fechfin');

        $ventasporfecha = DB::table('facturas')
        ->whereBetween('fechafactura', [$FechIniFact, $FechaFinFact])
        ->get();

        $credito = pago::whereIn('facturas_id', $venta->pluck('id'))->get();
        $detallepagos = detallepago::whereIn('pagos_id', $pagos->pluck('id'))->get();

        
        $FechIniFact = $request->input('fechaini');
        $FechaFinFact = $request->input('fechafin');

        $comprasfecha = DB::table('compras')
        ->whereBetween('fechacompra', [$FechIniFact, $FechaFinFact])
        ->get();

         
        return view('reporte.general', compact('productos', 'categorias', 'clientes', 'ventas', 'detalleventas', 'proveedores', 
        'compras', 'detallecompras', 'pagos', 'detallepagos', 'users',
         'productosProximosAgotarse','datocliente', 'venta','detallepagos', 'compras','comprasfecha', 'comprasrecientes', 'cantidadporcompra', 'totalcompras'));
    }

    public function GenProdApdf()
    {

    // Realizar la consulta para obtener productos próximos a agotarse
        $productosProximosAgotarse = DB::table('productos')
        ->join('categorias', 'productos.id_categoria', '=', 'categorias.id')
        ->select('productos.*', 'categorias.nombrecategoria')
        ->where('productos.estadoproducto',  true) // Ajusta según tu estructura
        ->where('productos.cantidadproducto', '<=', 'stockminimo')
        ->get();

        $pdf = PDF::loadview('reporte.prodagot', ['productosProximosAgotarse'=> $productosProximosAgotarse]); 
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

    public function generarPDFComprasRecientes(Request $request)
    {
        $fechaInicio = $request->input('fechini');
        $fechaFin = $request->input('fechfin');

        $comprasrecientes = compra::whereBetween('fechacompra', [$fechaInicio, $fechaFin])->get();
        $totalcompras = $comprasrecientes->sum('totalcompra');

        $cantidadporcompra = detallecompra::select('compra_id', DB::raw('SUM(cantidadcompra) as cantidad_total_prod'))
        ->whereIn('compras_id', function ($query) use ($fechaInicio, $fechaFin){
            $query->select('id')
            ->from('compras')
            ->whereBetween('fechacompra', [$fechaInicio,$fechaFin]);
        })
        ->groupBy('compra_id')
        ->get();

        $totalprod = $cantidadporcompra->sum('cantidad_total_prod');
        foreach($comprasrecientes as $compras)
        {
            $fechaCompra = $compras->fechacompra;
        }

        $pdf = PDF::loadView('reporte.comprasrec', ['fechaInicio'=> $fechaInicio, 'fechaFIn'=> $fechaFin, 'comprasrecientes' => $comprasrecientes, 'totalcompras'=> $totalcompras, 'totalprod'=> $totalprod, 'fechacompra'=>$fechaCompra, 'cantidadporcompra'=> $cantidadporcompra ]);
        return $pdf->stream();
    }

    public function generarPDFtotalventas(Request $request)
    {
        $FechIniFact = $request->input('fechini');
        $FechaFinFact = $request->input('fechfin');

        $ventasporfecha = DB::table('facturas')
        ->whereBetween('fechafactura', [$FechIniFact, $FechaFinFact])
        ->get();

        $pdf = PDF::loadView('reporte.facxfech', ['ventasporfecha'=> $ventasporfecha, 'fechaInicio'=> $FechIniFact, 'fechaFIn'=> $FechaFinFact]);
        return $pdf->stream();
    }

    public function generarPDFcredito(Request $request)
    {
        $FechIniFact = $request->input('fechini');
        $FechaFinFact = $request->input('fechfin');
        
        $pagos = pago::all();
        $venta = factura::all();
        $credito = pago::whereIn('facturas_id', $venta->pluck('id'))->get();
        $detallepagos = detallepago::whereIn('pagos_id', $pagos->pluck('id'))->get();


        $pdf = PDF::loadView('reporte.crediestado', ['credito'=> $credito,'detallepagos'=> $detallepagos , 'fechaInicio'=> $FechIniFact, 'fechaFIn'=> $FechaFinFact]);
        return $pdf->stream();
    }

    public function generarEstadocuenta()
    {
    }

    public function generarComprasFecha(Request $request)
    {
        $FechIniFact = $request->input('fechaini');
        $FechaFinFact = $request->input('fechafin');

        $comprasfecha = DB::table('compras')
        ->whereBetween('fechacompra', [$FechIniFact, $FechaFinFact])
        ->get();

        $pdf = PDF::loadView('reporte.vercom', ['comprasfecha'=> $comprasfecha, 'fechaInicio'=> $FechIniFact, 'fechaFIn'=> $FechaFinFact]);
        return $pdf->stream();
    }
}
