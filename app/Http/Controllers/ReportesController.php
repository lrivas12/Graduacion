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
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ReportesController extends Controller
{
    public function index()
    {

        $productos = producto::all();
        $clientes = cliente::all();
        $categorias = categoria::all();



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


        $categorias = DB::table('categorias')
        ->select('categorias.*')
        ->get();

        return view('reporte.index', compact('productos'));
    }

        public function GenProdA()
        {
         
            $pdf = PDF::loadview('reporte.prodagot'); 
            return $pdf->stream();
        }

}
