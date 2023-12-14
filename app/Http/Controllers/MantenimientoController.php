<?php

namespace App\Http\Controllers;


use App\Exports\clienteExport;
use App\Exports\proveedorExport;
use App\Exports\productoExport;
use App\Exports\facturaExport;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;


class MantenimientoController extends Controller
{
    public function index() 
    {

        return view('layouts.mantenimiento');
    }

    public function exportProveedores(){
        $fechaDescarga = Carbon::now()->format('d_m_Y');
        return Excel::download(new proveedorExport, 'Proveedores_' . $fechaDescarga . '.xlsx');
    }
    public function exportProductos(){
        $fechaDescarga = Carbon::now()->format('d_m_Y');
        return Excel::download(new productoExport, 'Productos_' . $fechaDescarga . '.xlsx');
    }

    public function exportSalesWithDetails()
    {
        $fechaDescarga = Carbon::now()->format('d_m_Y');
        return Excel::download(new facturaExport, 'ventas_with_details'. $fechaDescarga . '.xlsx');
    }

    public function exportClientes()
    {
        $fechaDescarga = Carbon::now()->format('d_m_Y');
        return Excel::download(new clienteExport, 'clientes_with_details' . $fechaDescarga . '.xlsx');
    }

}
