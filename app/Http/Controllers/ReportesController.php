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

use function Laravel\Prompts\select;

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
            ->select('clientes.id', 'clientes.nombrecliente', 'clientes.apellidocliente')
            ->get();

        // Realizar la consulta para obtener productos próximos a agotarse
        $productosProximosAgotarse = DB::table('productos')
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

        $todoscompra = DB::table('compras')
            ->join('proveedores', 'compras.proveedor_id', '=', 'proveedores.id')
            ->select('compras.*', 'proveedores.razonsocialproveedor')
            ->get();

        $todoventas = DB::table('facturas')
            ->join('clientes', 'facturas.clientes_id', '=', 'clientes.id')
            ->select('facturas.*', 'clientes.nombrecliente', 'clientes.apellidocliente')
            ->get();

        $categorias = DB::table('categorias')
            ->select('categorias.*')
            ->get();


        $fechaInicio = $request->input('fechini');
        $fechaFin = $request->input('fechfin');

        $comprasrecientes = compra::whereBetween('fechacompra', [$fechaInicio, $fechaFin])->get();
        $totalcompras = $comprasrecientes->sum('totalcompra');

        $cantidadporcompra = detallecompra::select('compra_id', DB::raw('SUM(cantidadcompra) as cantidad_total_prod'))
            ->whereIn('compra_id', function ($query) use ($fechaInicio, $fechaFin) {
                $query->select('id')
                    ->from('compras')
                    ->whereBetween('fechacompra', [$fechaInicio, $fechaFin]);
            })
            ->groupBy('compra_id')
            ->get();

        $totalprod = $cantidadporcompra->sum('cantidad_total_prod');
        foreach ($comprasrecientes as $compras) {
            $fechaCompra = $compras->fechacompra;
        }

        /* total de ventas */
        $fechaini = $request->input('fechaini');
        $fechafin = $request->input('fechafin');

        $ventasporfecha = DB::table('facturas')
            ->whereBetween('fechafactura', [$fechaini, $fechafin])
            ->get();

        $credito = pago::whereIn('facturas_id', $venta->pluck('id'))->get();
        $detallepagos = detallepago::whereIn('pagos_id', $pagos->pluck('id'))->get();

        $Estadocuenta = DB::table('pagos')
            ->join('facturas', 'pagos.facturas_id', '=', 'facturas.id')
            ->join('clientes', 'facturas.clientes_id', '=', 'clientes.id')
            ->join('detallepagos', 'detallepagos.pagos_id', '=', 'pagos.id')
            ->select(
                'clientes.nombrecliente',
                'clientes.apellidocliente',
                'pagos.fechapago',
                'facturas.totalventa',
                DB::raw('SUM(detallepagos.cantidaddetallepago) as deuda_pendiente')
            )
            ->groupBy('clientes.nombrecliente', 'clientes.apellidocliente', 'pagos.fechapago', 'facturas.totalventa')
            ->get();

        // CUERPO PARA ESTADO DE CUENTA INICIAL (INICIO)
        $pagos = self::consultarEstadoCuenta();
        // CUERPO PARA ESTADO DE CUENTA INICIAL (FINAL)

        $fechaini = $request->input('fechaini');
        $fechafin = $request->input('fechafin');

        $comprasfecha = DB::table('compras')
            ->whereBetween('fechacompra', [$fechaini, $fechafin])
            ->get();

        return view('reporte.general', compact(
            'productos',
            'categorias',
            'clientes',
            'ventas',
            'detalleventas',
            'proveedores',
            'compras',
            'detallecompras',
            'pagos',
            'detallepagos',
            'users',
            'fechaini',
            'fechafin',
            'fechaInicio',
            'fechaFin',
            'productosProximosAgotarse',
            'Estadocuenta',
            'datocliente',
            'todoscompra',
            'todoventas',
            'venta',
            'detallepagos',
            'compras',
            'comprasfecha',
            'comprasrecientes',
            'cantidadporcompra',
            'totalcompras'
        ));
    }

    public function GenProdApdf()
    {
        // Realizar la consulta para obtener productos próximos a agotarse
        $productosProximosAgotarse = DB::table('productos')
            ->join('categorias', 'productos.id_categoria', '=', 'categorias.id')
            ->select('productos.nombreproducto', 'productos.cantidadproducto', 'productos.stockminimo', 'categorias.nombrecategoria')
            ->where('productos.estadoproducto', true)
            ->whereColumn('productos.cantidadproducto', '<=', 'productos.stockminimo')
            ->get();

        $pdf = PDF::loadview('reporte.prodagot', ['productosProximosAgotarse' => $productosProximosAgotarse]);
        return $pdf->stream();
    }

    public function prodgpdf()
    {
        $productos = DB::table('productos')
            ->join('categorias', 'productos.id_categoria', '=', 'categorias.id')
            ->select('productos.*', 'categorias.nombrecategoria')
            ->get();

        $pdf = PDF::loadview('reporte.productosge', ['productos' => $productos]);
        return $pdf->stream();
    }

    public function verclientpdf()
    {
        $clientes = DB::table('clientes')
            ->select('clientes.*')
            ->get();
        $pdf = PDF::loadview('reporte.verclient', ['clientes' => $clientes]);
        return $pdf->stream();
    }

    public function generarPDFComprasRecientes(Request $request)
    {
        $fechaInicio = $request->input('fechini');
        $fechaFin = $request->input('fechfin');

        $comprasrecientes = compra::whereBetween('fechacompra', [$fechaInicio, $fechaFin])->get();
        $totalcompras = $comprasrecientes->sum('totalcompra');

        $cantidadporcompra = detallecompra::select('compra_id', DB::raw('SUM(cantidadcompra) as cantidad_total_prod'))
            ->whereIn('compras_id', function ($query) use ($fechaInicio, $fechaFin) {
                $query->select('id')
                    ->from('compras')
                    ->whereBetween('fechacompra', [$fechaInicio, $fechaFin]);
            })
            ->groupBy('compra_id')
            ->get();

        $totalprod = $cantidadporcompra->sum('cantidad_total_prod');
        foreach ($comprasrecientes as $compras) {
            $fechaCompra = $compras->fechacompra;
        }

        $pdf = PDF::loadView('reporte.comprasrec', ['fechaInicio' => $fechaInicio, 'fechaFin' => $fechaFin, 'comprasrecientes' => $comprasrecientes, 'totalcompras' => $totalcompras, 'totalprod' => $totalprod, 'fechacompra' => $fechaCompra, 'cantidadporcompra' => $cantidadporcompra]);
        return $pdf->stream();
    }

    public function generarPDFtotalventas(Request $request)
    {
        $fechaini = $request->input('fechaini');
        $fechafin = $request->input('fechafin');

        $ventasporfecha = DB::table('facturas')
            ->join('clientes', 'facturas.clientes_id', '=', 'clientes.id')
            ->select('facturas.*', 'clientes.nombrecliente', 'clientes.apellidocliente')
            ->whereBetween('fechafactura', [$fechaini, $fechafin])
            ->get();

        $pdf = PDF::loadView('reporte.facxfech', ['ventasporfecha' => $ventasporfecha, 'fechaini' => $fechaini, 'fechafin' => $fechafin]);
        return $pdf->stream();
    }

    public function generarEstadoCuentaPDF(Request $request)
    {
        $cliente_id = $request->input('cliente_id') ?? null;
        $pagos = array();
        $datocliente = DB::table('clientes')
            ->when($cliente_id, function ($query) use ($cliente_id) {
                $query->where('clientes.id', $cliente_id);
            })
            ->get();
        foreach ($datocliente as $cliente) {
            $pago = self::consultarEstadoCuenta($cliente->id);
            $pagos[] = $pago;
        }
        $pdf = PDF::loadView('reporte.crediestado', ['pagos' => $pagos, 'datocliente' => $datocliente]);
        // $pdf = PDF::loadView('reporte.crediestado', compact('pagos', 'datocliente'));
        return $pdf->stream();
    }

    public function consultarEstadoCuenta($cliente_id = null)
    {
        $cliente_id = json_decode($cliente_id); // en caso de que no se seleccione ningún cliente, recibiremos un valor NULL desde el frontend, necesitaremos convertirlo en un valor null legible para PHP
        $estadocuenta = pago::join('facturas', 'pagos.facturas_id', '=', 'facturas.id')
            ->join('clientes', 'facturas.clientes_id', '=', 'clientes.id')
            ->join('detallepagos', 'detallepagos.pagos_id', '=', 'pagos.id')
            ->select('clientes.id as cliente_id', 'facturas.id', 'clientes.nombrecliente', 'clientes.apellidocliente', 'detallepagos.fechadetallepago',  'detallepagos.cantidaddetallepago', 'detallepagos.saldodetallepago')
            ->when($cliente_id, function ($query) use ($cliente_id) { // si obtenemos un cliente_id quiere decir que se seleccionó un cliente, y se va a generar un PDF para ESE CLIENTE EN ESPECÍFICO, caso contrario se generará un PDF general.
                $query->where('clientes.id', $cliente_id);
            })
            ->orderBy('clientes.id', 'asc')
            ->get();
        return $estadocuenta;
    }

    // public function consultarEstadoCuenta($cliente_id)
    // {
    //     $cliente_id = json_decode($cliente_id); // en caso de que no se seleccione ningún cliente, recibiremos un valor NULL desde el frontend, necesitaremos convertirlo en un valor null legible para PHP
    //     $estadocuenta = pago::join('facturas', 'pagos.facturas_id', '=', 'facturas.id')
    //         ->join('clientes', 'facturas.clientes_id', '=', 'clientes.id')
    //         ->join('detallepagos', 'detallepagos.pagos_id', '=', 'pagos.id')
    //         ->select(
    //             'clientes.id as id_cliente',
    //             'clientes.nombrecliente',
    //             'clientes.apellidocliente',
    //             'pagos.fechapago',
    //             'facturas.totalventa',
    //             // 'pagos.cantidadpago',
    //             DB::raw('facturas.totalventa - SUM(detallepagos.cantidaddetallepago) as deuda_pendiente')
    //         )
    //         ->when($cliente_id, function ($query) use ($cliente_id) { // si obtenemos un cliente_id quiere decir que se seleccionó un cliente, y se va a generar un PDF para ESE CLIENTE EN ESPECÍFICO, caso contrario se generará un PDF general.
    //             $query->where('clientes.id', $cliente_id);
    //         })
    //         ->groupBy('id_cliente', 'clientes.nombrecliente', 'clientes.apellidocliente', 'pagos.fechapago', 'facturas.totalventa', 'pagos.cantidadpago')
    //         ->get();
    //     return $estadocuenta;
    // }

    public function generarComprasFecha(Request $request)
    {
        $fechaini = $request->input('fechaini');
        $fechafin = $request->input('fechafin');

        $comprasfecha = DB::table('compras')
            ->whereBetween('fechacompra', [$fechaini, $fechafin])
            ->get();

        $pdf = PDF::loadView('reporte.vercom', ['comprasfecha' => $comprasfecha, 'fechaini' => $fechaini, 'fechafin' => $fechafin]);
        return $pdf->stream();
    }

    public function generarVenta()
    {
        $todoventas = DB::table('facturas')
            ->join('clientes', 'facturas.clientes_id', '=', 'clientes.id')
            ->select('facturas.*', 'clientes.nombrecliente', 'clientes.apellidocliente')
            ->get();

        $pdf = PDF::loadview('reporte.totalventas', ['todoventas' => $todoventas]);
        return $pdf->stream();
    }

    public function generarcompras()
    {
        $todoscompra = DB::table('compras')
            ->join('proveedores', 'compras.proveedor_id', '=', 'proveedores.id')
            ->select('compras.*', 'proveedores.razonsocialproveedor')
            ->get();

        $pdf = PDF::loadview('reporte.totalcompras', ['todoscompra' => $todoscompra]);
        return $pdf->stream();
    }
}
