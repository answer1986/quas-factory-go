<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IngresoMateriaPrima;
use Milon\Barcode\DNS1D;


class IngresoMateriaPrimaController extends Controller
{
  

    public function create()
    {
        return view('bodega.materia.create');
    }

    public function store(Request $request)
    {
        // Validación de los datos del formulario
        $request->validate([
            'tipo_materia' => 'required|string',
            'cantidad' => 'required|numeric',
            'proveedor' => 'required|string',
            'fecha_ingreso' => 'required|date',
            'descripcion' => 'nullable|string',
        ]);
    
        // Crear el registro
        $ingreso = IngresoMateriaPrima::create($request->all());

        // Generar el código de barras y guardar la ruta del archivo PNG
        $barcodePath = DNS1D::getBarcodePNGPath(strval($ingreso->id), "C128", 3, 33);
        $ingreso->barcode_path = $barcodePath;
        $ingreso->save();
        session(['barcode' => $barcodePath]);
    
        return redirect()->route('bodega.materia')->with('success', 'Ingreso de materia prima registrado exitosamente');
        
    }
    
    

    public function show($id)
    {
        $ingreso = IngresoMateriaPrima::findOrFail($id);
        return view('bodega.materia.show', ['ingreso' => $ingreso]);
    }

    public function edit($id)
    {
        $ingreso = IngresoMateriaPrima::findOrFail($id);
        return view('bodega.materia.edit', ['ingreso' => $ingreso]);
    }

    public function update(Request $request, $id)
    {
        // Validación de los datos del formulario
        $request->validate([
            'tipo_materia' => 'required|string',
            'cantidad' => 'required|numeric',
            'proveedor' => 'required|string',
            'fecha_ingreso' => 'required|date',
            'descripcion' => 'nullable|string',
        ]);

        // Buscar el ingreso de materia prima por ID
        $ingreso = IngresoMateriaPrima::findOrFail($id);

        // Actualizar los datos del ingreso de materia prima en la base de datos
        $ingreso->tipo_materia = $request->input('tipo_materia');
        $ingreso->cantidad = $request->input('cantidad');
        $ingreso->proveedor = $request->input('proveedor');
        $ingreso->fecha_ingreso = $request->input('fecha_ingreso');
        $ingreso->descripcion = $request->input('descripcion');
        $ingreso->save();

        return redirect()->route('materia.index')->with('success', 'Ingreso de materia prima actualizado exitosamente');
    }

    public function destroy($id)
    {
        // Buscar el ingreso de materia prima por ID y eliminarlo de la base de datos
        $ingreso = IngresoMateriaPrima::findOrFail($id);
        $ingreso->delete();

        return redirect()->route('materia.index')->with('success', 'Ingreso de materia prima eliminado exitosamente');
    }
}
