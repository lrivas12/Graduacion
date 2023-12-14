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
        
        $fechaInicio = $request->fechaInicio; 
        $fechaFin = $request->fechaFin;
        
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
        $FechInFact = $request->input('fechini');
        $FechFinFact = $request->input('fechfin');

        $facturas = Factura::select(
            'facturas.fechafactura',
            DB::raw('SUM(CASE WHEN pagos.estadopago = "Credito" THEN detallepagos.cantidaddetallepago ELSE facturas.totalventa END) as total_pagar')
        )
            ->leftJoin('pagos', 'facturas.id', '=', 'pagos.facturas_id')
            ->leftJoin('detallepagos', 'pagos.id', '=', 'detallepagos.pagos_id')
            ->whereBetween('facturas.fechafactura', [$FechInFact, $FechFinFact])
            ->groupBy('facturas.id', 'facturas.fechafactura')
            ->get();

        // Sumar los totales a pagar
        $totalVentasRangoFechas = $facturas->sum('total_pagar');

        // Obtener la cantidad de facturas
        $cantidadFacturas = $facturas->count();

        // Puedes cargar relaciones adicionales según tus necesidades
        $facturas->load('facturas','clientes.id', '=', 'facturas.clientes_id', 'facturas','users.id', '=', 'facturas.users_id');


        return view('reporte.general', compact('productos', 'categorias', 'clientes', 'ventas', 'detalleventas', 'proveedores', 
        'compras', 'detallecompras', 'pagos', 'detallepagos', 'users', 'FechInFact','FechFinFact','facturas','totalVentasRangoFechas',
        'cantidadFacturas', 'productosProximosAgotarse', 'compras', 'comprasrecientes', 'cantidadporcompra', 'totalcompras'));
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

        $pdf = PDF::loadview('reporte.prodagot', ['productos'=> $productosProximosAgotarse]); 
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
        $FechInFact = $request->input('fechini');
        $FechFinFact = $request->input('fechfin');

        $facturas = Factura::select(
            'facturas.fechafactura',
            DB::raw('SUM(CASE WHEN pagos.estadopago = "Credito" THEN detallepagos.cantidaddetallepago ELSE facturas.totalventa END) as total_pagar')
        )
            ->leftJoin('pagos', 'facturas.id', '=', 'pagos.facturas_id')
            ->leftJoin('detallepagos', 'pagos.id', '=', 'detallepagos.pagos_id')
            ->whereBetween('facturas.fechafactura', [$FechInFact, $FechFinFact])
            ->groupBy('facturas.id', 'facturas.fechafactura')
            ->get();

        // Sumar los totales a pagar
        $totalVentasRangoFechas = $facturas->sum('total_pagar');

        // Obtener la cantidad de facturas
        $cantidadFacturas = $facturas->count();

        // Puedes cargar relaciones adicionales según tus necesidades
        $facturas->load('facturas','clientes.id', '=', 'facturas.clientes_id', 'facturas','users.id', '=', 'facturas.users_id');

        $pdf = PDF::loadView('reporte.verventas', [
            'facturas' => $facturas,
            'FechInFact' => $FechInFact,
            'FechFinFact' => $FechFinFact,
            'totalVentasRangoFechas' => $totalVentasRangoFechas,
            'cantidadFacturas' => $cantidadFacturas, // Pasar la cantidad de facturas al reporte
        ]);

        return $pdf->stream();
    }

}
