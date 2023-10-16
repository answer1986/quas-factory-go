<?php

namespace App\Http\Controllers;

use App\Models\OrdenDeTrabajo;
use App\Models\Cliente;
use App\Models\Producto;
use Illuminate\Http\Request;

class OrdenDeTrabajoController extends Controller
{
    public function index()
    {
        $ordenes = OrdenDeTrabajo::with(['cliente', 'producto'])->get();
        return view('produccion.ingreso', compact('ordenes'));
    }

    public function create()
    {
        $clientes = Cliente::all();
        $productos = Producto::all();
        return view('produccion.ingreso', compact('clientes', 'productos'));
    }

    public function store(Request $request)
    {
        $this->validateRequest($request);
        $this->adjustOrderStatus($request);

        $orden = OrdenDeTrabajo::create($request->all());
        return redirect()->route('ingreso.create')->with('success', 'Orden creada exitosamente.');

    }

    public function show(OrdenDeTrabajo $orden)
    {
        return view('ordenes.show', compact('orden'));
    }

    public function edit(OrdenDeTrabajo $orden)
    {
        $clientes = Cliente::all();
        $productos = Producto::all();
        return view('ordenes.edit', compact('orden', 'clientes', 'productos'));
    }

    public function update(Request $request, OrdenDeTrabajo $orden)
    {
        $this->validateRequest($request, $orden->id);
        $this->adjustOrderStatus($request);

        $orden->update($request->all());
        return redirect()->route('ingreso.create')->with('success', 'Orden actualizada exitosamente.');
    }

    public function destroy(OrdenDeTrabajo $orden)
    {
        $orden->delete();
        return redirect()->route('ordenes.index')->with('success', 'Orden eliminada exitosamente.');
    }

    private function validateRequest($request, $id = null)
    {
        $rules = [
            'numero_oc' => 'required|unique:orden_trabajo,numero_oc,' . $id,
            'tipo_proceso' => 'required|in:estruccion,sellado,micro perforado',
            'cliente_id' => 'required|exists:clientes,id',
            'producto_id' => 'required|exists:productos,id',
            'fecha' => 'required|date',
            'cantidad' => 'required|integer',
            'fecha_comprometida' => 'required|date',
            'status_oc' => 'required|string',
            'porcentaje_progreso' => 'required|numeric|between:0,100',
            'observaciones' => 'nullable|string',
        ];
        
        $messages = [
            'numero_oc.required' => 'El número OC es requerido.',
            'numero_oc.unique' => 'El número OC ya ha sido tomado.',
            // ... puedes continuar con los mensajes personalizados para las demás validaciones
        ];

        $request->validate($rules, $messages);
    }

    private function adjustOrderStatus($request) {
    $tipoProceso = $request->input('tipo_proceso');
    $statusOC = $request->input('status_oc');

    // Matriz de transición
    $transitions = [
        'estruccion' => [
            'En Progreso' => 'Detenida',
            'Iniciada' => 'Finalizada',
            // ...otros estados...
        ],
        'sellado' => [
            'En Progreso' => 'Iniciada',
            'Iniciada' => 'En Proceso',
            // ...otros estados...
        ],
        'micro perforado' => [
            'En Progreso' => 'Detenida',
            'Iniciada' => 'Finalizada',
            // ...otros estados...
        ],
    ];

    // Cambiar el estado basado en la matriz de transición
    if (isset($transitions[$tipoProceso][$statusOC])) {
        $newStatus = $transitions[$tipoProceso][$statusOC];
        $request->merge(['status_oc' => $newStatus]);
    }
}

}
