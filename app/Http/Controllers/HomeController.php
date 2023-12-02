<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\factura;
use App\Models\detallefactura;
use Illuminate\Support\Facades\DB;
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

        return view('home');
    }
}
