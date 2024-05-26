<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\cliente;
use App\Models\detallepago;
use App\Models\factura;
use App\Models\pago;
use Illuminate\Support\Facades\Validator;

class clienteController extends Controller
{
     public function index()
     {
        $cliente = cliente::all();
        return view ('layouts.cliente', compact('cliente')); 
     }

     public function store(Request $request)
     {
        $validator = Validator::make ($request->all(),[
            'nombrecliente' => 'required|string|max:255',
            'apellidocliente' => 'required|string|max:255',
            'direccioncliente' => 'nullable|string|max:255',
            'telefonocliente' => 'required|string|max:8|unique:clientes',
            'correocliente' => 'nullable|string|max:255',
        ]);
        
        $customAttributes =
        [
            'nombrecliente'=>'nombre del cliente',
            'apellidocliente'=>'apellido del cliente',
            'telefonocliente'=>'teléfono del cliente',
            'correocliente'=>'correo del cliente',
        ];
    
    
        $validator->setAttributeNames($customAttributes);
       
        if($validator->fails()){
    
    
            return redirect()->route('cliente.index') ->withErrors($validator)->withInput()->with('errorC','Error al crear la Cliente, revise e intente nuevamente.');
        }
        $clientes = cliente::create([
            'nombrecliente' => $request->input('nombrecliente'),
            'apellidocliente' => $request->input('apellidocliente'),
            'direccioncliente' => $request->input('direccioncliente'),
            'telefonocliente' => $request->input('telefonocliente'),
            'correocliente' => $request->input('correocliente'),

        ]);
    
        $clientes->save();
        return redirect()->route('cliente.index', $clientes)->with('successC','Cliente creado con exito');
        
     }

     public function edit(cliente $cliente, $id)
     {
        $cliente = cliente::findOrFail($id);

        return view('cliente.index', compact('cliente'));
    }

    public function update(Request $request, cliente $id)
    {
        $clientes = cliente::findOrFail($id);
        $validator = Validator::make ($request->all(),[
            'nombrecliente' => 'required|string|max:255',
            'apellidocliente' => 'required|string|max:255',
            'direccioncliente' => 'nullable|string|max:255',
            'telefonocliente' => 'required|string|max:8|unique:clientes,telefonocliente,' . $id,
            'correocliente' => 'nullable|string|max:255',
        ]);
     
        $customAttributes =
        [
            'nombrecliente'=>'nombre del cliente',
            'apellidocliente'=>'apellido del cliente',
            'telefonocliente'=>'teléfono del cliente',
            'correocliente'=>'correo del cliente',
        ];

        $validator->setAttributeNames($customAttributes);
        
    
        if($validator->fails())
        {
            // Almacena el ID en la sesión para poder identificar el cliente
            session(['error_id' => $id]);

            // Redirecciona a la ruta 'cliente.index' con mensajes de error y datos de entrada anteriores
            return redirect()->route('cliente.index', ['id' => $id])->withErrors($validator)->withInput()->with('error', 'Error al actualizar el cliente, revise e intente nuevamente');
        }

       
        $clientes->update([
    
            'nombrecliente' => $request->input('nombrecliente'),
            'apellidocliente' => $request->input('apellidocliente'),
            'direccioncliente' => $request->input('direccioncliente'),
            'telefonocliente' => $request->input('telefonocliente'),
            'correocliente' => $request->input('correocliente'),

           
        ]);
        $clientes->save();
        return redirect()->route('cliente.index')->with('success','Cliente actualizado con exito');   
    }


    public function obtenerSaldo($clientes_id)
    {
        $clientes = cliente::find($clientes_id);

        if(!$clientes)
        {
            return response()->json(['error'=>'Cliente no encontrado'],404);
        }

        $ventasCredito = factura::where('clientes_id', $clientes_id)
        ->where('tipoventa','credito')
        ->get();

        $saldoFinal = 0;

        if($ventasCredito->count() > 0)
        {

            $ventasCreditoIDs = $ventasCredito->pluck('id');

            $montoCredito = pago::whereIn('facturas_id', $ventasCreditoIDs)->sum('cantidadpago');
            $sumapagos = detallepago::whereIn('pagos_id', function ($query) use ($ventasCreditoIDs)
            {
                $query->select('id')
                ->from('pagos')
                ->whereIn('facturas_id', $ventasCreditoIDs);

            })->sum('cantidaddetallepago');
            $saldoFinal = $montoCredito - $sumapagos;
        }

        return response()->json(['saldo'=>$saldoFinal]);

    }
}