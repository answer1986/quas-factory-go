<?php
namespace App\Http\Controllers;

use App\Models\OrdenDeTrabajo;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OrdenDeTrabajoController extends Controller
{
    public function index()
    {
        $ordenes = OrdenDeTrabajo::all();
        return view('ordenes.index', compact('ordenes'));
    }

    public function create()
    {
        $clientes = Cliente::all();
        dd($clientes);
        //Log::info('Clientes:', ['clientes' => $clientes]);

        return view('ordenes.create', compact('clientes'));
    }

    

    public function edit(OrdenDeTrabajo $orden)
    {
        $clientes = Cliente::all();
        return view('ordenes.edit', compact('orden', 'clientes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'numero_oc' => 'required|unique:orden_trabajo',
            'fecha' => 'required|date',
            'cantidad' => 'required|integer|numeric|between:0,11',
            'fecha_comprometida' => 'required|date',
            'status_oc' => 'required|string',
            'porcentaje_progreso' => 'required|numeric|between:0,100',
            'observaciones' => 'nullable|string',
            'nombre' => 'required|string|max:255',
            'foto' => 'nullable|image|max:2048',
        ]);

        $path = $request->file('foto') ? $request->file('foto')->store('fotos_cliente', 'public') : null;

        $cliente = Cliente::create([
            'nombre' => $request->nombre,
            'foto' => $path,
        ]);

        $orden = OrdenDeTrabajo::create(array_merge($request->all(), ['cliente_id' => $cliente->id]));

        return redirect()->route('ordenes.index')->with('success', 'Orden y Cliente creados exitosamente.');
    }

    public function show(OrdenDeTrabajo $orden)
    {
        return view('ordenes.show', compact('orden'));
    }

    

    public function update(Request $request, OrdenDeTrabajo $orden)
    {
        $request->validate([
            'numero_oc' => 'required|unique:orden_trabajo,numero_oc,' . $orden->id,
            'fecha' => 'required|date',
            'cantidad' => 'required|integer',
            'fecha_comprometida' => 'required|date',
            'status_oc' => 'required|string',
            'porcentaje_progreso' => 'required|numeric|between:0,100',
            'observaciones' => 'nullable|string',
        ]);

        $orden->update($request->all());

        return redirect()->route('ordenes.index')->with('success', 'Orden actualizada exitosamente.');
    }

    public function destroy(OrdenDeTrabajo $orden)
    {
        $orden->delete();
        return redirect()->route('ordenes.index')->with('success', 'Orden eliminada exitosamente.');
    }
}
