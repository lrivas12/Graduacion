<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\factura;
use App\Models\detallefactura;
use App\Models\producto;
use App\Models\cliente;
use App\Models\detallepago;
use App\Models\empresa;
use App\Models\pago;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use TCPDF;

class VentaControlller extends Controller
{
    public function index()
    {

        $productos = producto::where('estadoproducto', '1')->get();
        $clientes = cliente::all();
        $pagos = pago::all();
        $ventas = factura::orderBy('id', 'desc')->get();
        return view('layouts.facturav', compact('productos', 'pagos', 'clientes', 'ventas'));
    }

    public function create()
    {
        $clientes = cliente::all();
        $productos = producto::all();
        $ventas = factura::orderBy('id', 'desc')->get();
        return view('layouts.factura', compact('ventas', 'productos', 'clientes'));
    }

    public function show($id)
    {
        $ventas = factura::findOrFail($id);
        $productos = producto::all();
        $clientes = cliente::all();
        $detalleventas = detallefactura::where('facturas_id', $ventas->id)->get();
        return view('layouts.facturam', compact('ventas', 'productos', 'clientes', 'detalleventas'));
    }
    public function store(Request $request)
    {
        $users = Auth::user();
        $products = json_decode($request->detalleVenta);
        $validator = Validator::make($request->all(), [
            'fechafactura' => 'required|date',
            'tipoventa' => 'required|string',
            'clientes_id' => 'required|exists:clientes,id',
        ]);
        if ($validator->fails()) {
            return redirect()->route('factura.create')->withErrors($validator)->withInput()->with('errorC', 'Error al crear venta, revise e intente nuevamente.');
        }
        $ventas = new factura();
        $ventas->fechafactura = $request->fechafactura;
        $ventas->descuentoventa = $request->descuento;
        $ventas->tipoventa = $request->tipoventa;
        $ventas->clientes_id = $request->clientes_id;
        $totaldescuento = $products->total - $ventas->descuentoventa;
        $ventas->totalventa = $totaldescuento;
        $ventas->users_id = $users->id;
        $ventas->save();
        foreach ($products->datos as $key => $value) {
            $detalleventas = new detallefactura();
            $detalleventas->productos_id = $value->id;
            $detalleventas->cantidadventa = $value->cantidadventa;
            $detalleventas->subtotalventa = $value->subtotalventa;
            $detalleventas->facturas_id = $ventas->id;
            $detalleventas->save();

            $prod = producto::findOrFail($value->id);
            $prod->cantidadproducto -= $value->cantidadventa;
            $prod->precioproducto = $value->precioproducto;
            $prod->save();
        }

        if ($request->tipoventa === 'credito') {
            $pagos = new pago();
            $pagos->facturas_id = $ventas->id;
            $pagos->cantidadpago = $ventas->totalventa;
            $pagos->fechapago = $ventas->fechafactura;
            $pagos->estadopago = 1;
            $pagos->save();

            $detallepago = new detallepago();
            $detallepago->fechadetallepago = $ventas->fechafactura;
            $detallepago->cantidaddetallepago = $request->adelanto;
            $detallepago->saldodetallepago = $request->saldo;
            $detallepago->pagos_id = $pagos->id;
            $detallepago->save();
        }
        if ($ventas) {
            if ($request->input('guardarImp') == true) {
                // Si se presionó el botón "Guardar e Imprimir"
                return [
                    'id' => $ventas->id
                ];
                // return response()->json(['id' => $ventas->id]); // RETORNAR LA RESPUESTA COMO JSON PROVOCA EL ERROR DE 'body stream already read', o sea que se hace response.json aqui, y response.json en el PRIMER .then del client-side (jquery/javascript). Entonces se resuelve retornando el valor que necesitamos de la venta, en este caso el id y ya en el jquery lo transformamos a JSON, funciona al reves tambien, .json() aqui y no usar .json() en el jquery.
            } else {
                // Si se presionó el botón "Guardar"
                return redirect()->route('factura.create')->with('successC', 'Venta creada con éxito.');
            }
        } else {
            // Error al guardar la venta
            return response()->json(['error' => 'Error al guardar la venta.'], 500);
        }
    }


    public function apiShowProductos(producto $producto)
    {

        return $producto;
    }

    public function pdf($id)
    {
        $ventas = factura::findOrFail($id);

        $productos = producto::all();
        $clientes = cliente::all();
        // Obtén los detalles de la compra
        $detalles = detallefactura::where('facturas_id', $ventas->id)->get();

        return view('layouts.facturav', compact('ventas', 'detalles', 'productos', 'clientes'));
    }

    public function imprimirFactura($idVenta)
    {
        $ventas = factura::with('detallefactura', 'cliente', 'User')->find($idVenta);
        $empresa = empresa::first();

        $cantidadpagos = null;
        $detallepagos = [];

        if ($ventas && $ventas->tipoventa === 'credito') {
            $pagos = pago::where('facturas_id', $ventas->id)->first();
            if ($pagos) {
                $cantidadpagos = $pagos->cantidadpago;

                $detallepagos = detallepago::where('pagos_id', $pagos->id)->get();
                $detallepagos = $pagos->saldodetallepago;
            }
        }
        if (!$ventas) {
            abort(404, 'Venta no encontrado');
        }
        
        $pdf = new TCPDF('p', 'mm', 'A4', true, 'UTF-8', false); // unicode era falso (4to argumento en la creación de objeto TCPDF), esto provocaba la aparición de caracteres extraños en la vista.
        // UNICODE lo que hace es dar la posibilidad de renderizas cualquier caracter de cualquier idioma correctamente, entonces es clave setearlo a TRUE
        // $pdf->setPrintHeader(false);
        // $pdf->setPrintFooter(false);
        $pdf->SetAutoPageBreak(false, 0);
        $pdf->SetMargins(2, 0.5, 2);
        $pdf->AddPage();
        $pdf->SetFont('helvetica', '', 8);
        $html = view('layouts.pdf', compact('ventas', 'empresa', 'cantidadpagos', 'detallepagos'))->render();

        $altura = $this->obtenerAlturaPdf($html);
        $pdf->setPageFormat([56, $altura]); // este metodo es protected por defecto, lo cual impide usarlo aun incluso instanciando el metodo, se puede usar en la misma clase o subclase. Lo que hice fue convertirlo a public ese metodo en la clase y ya.
        $pdf->writeHTML($html, true, false, true, false, '');

        // Salida del archivo
        return $pdf->Output('recibo.pdf', 'I');
    }

    public function obtenerAlturaPdf($html)
    {
        $pdf = new TCPDF('p', 'mm', 'A4', true, 'UTF-8', false);

        $pdf->SetAutoPageBreak(false, 0);
        $pdf->AddPage();
        $pdf->SetFont('helvetica', '', 8);

        $pdf->writeHTML($html, true, false, true, false, '');
        return $pdf->GetY();
    }
}
