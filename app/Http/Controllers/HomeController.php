<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\factura;
use App\Models\detallefactura;
use Illuminate\Support\Facades\DB;
use App\Models\producto;
use Carbon\Carbon;
use App\Models\compra;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        /* $data = detallefactura::join('productos', 'detallefactura.productos_id', '=', 'productos.id')
        ->groupBy('productos.id', 'productos.nombreproducto')
        ->select('productos.nombreproducto as productos', \DB::raw('SUM(detallefactura.cantidadventa) as total_cantidad'))
        ->orderBy('total_cantidad', 'desc')
        ->take(5)
        ->get();

        // Formatear los datos para el gráfico de Chart.js
        $labels = $data->pluck('productos');
        $values = $data->pluck('total_cantidad'); */

        $fechaHoy = Carbon::now();

        $ingresosHoy = factura::whereDate('fechafactura', $fechaHoy)
        ->sum('totalventa');

        
        $ingresosGenerales = factura::sum('totalventa');

        $productosMasVendidos = DB::table('detallefacturas')
        ->join('productos', 'detallefacturas.productos_id', '=', 'productos.id')
        ->select('productos.nombreproducto', DB::raw('SUM(detallefacturas.cantidadventa) as totalVentas'))
        ->groupBy('productos.id', 'productos.nombreproducto')
        ->orderByDesc('totalVentas')
        ->limit(5)
        ->get();

    // Preparar datos para el gráfico de tipo pie
    $labels = $productosMasVendidos->pluck('nombreproducto');
    $data = $productosMasVendidos->pluck('totalVentas');

        $totalFacturasCredito = Factura::where('tipoventa', 'credito')->count();

        $totalFacturas = Factura::count();

        $montoFacturasCredito = Factura::where('tipoventa', 'credito')->sum('totalventa');
        $totalCompras = compra::sum('totalcompra');

        return view('home', compact('fechaHoy', 'totalCompras', 'ingresosHoy', 'ingresosGenerales',
        'totalFacturasCredito', 'totalFacturas', 'montoFacturasCredito', 'productosMasVendidos','labels','data'));
    }
}
