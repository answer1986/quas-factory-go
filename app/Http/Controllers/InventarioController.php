<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Inventario;
use App\Models\IngresoMateriaPrima;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Response;


use Session;

class InventarioController extends Controller
{
    public function index()
    {
        // Verificar si hay una fecha de inicio en la sesión y pasarla a la vista
        $fechaInicio = Session::get('fecha_inicio_inventario', null);
        return view('bodega.inventario');
    }

    public function iniciarInventario()
    {
        // Establecer la fecha de inicio del inventario en la sesión si no existe
        Session::put('fecha_inicio_inventario', now()->toDateString());
        return redirect()->route('inventario.index')->with('success', 'Inventario iniciado.');
    }
    public function procesar(Request $request)
    {
        $barcode = $request->input('codigo_barra');

        try {
            $ingresoMateriaPrima = IngresoMateriaPrima::where('barcode_value', $barcode)->firstOrFail();

            $inventario = new Inventario();
            $inventario->ingreso_materia_prima_id = $ingresoMateriaPrima->id;
            $inventario->cantidad_sacos = $request->input('cantidad_sacos');
            $inventario->fecha_inicio = Session::get('fecha_inicio_inventario', $request->input('fecha_inicio'));
            $inventario->save();

            $this->agregarAlResumen($inventario);

            return back()->with('success', 'Inventario actualizado correctamente.');
        } catch (ModelNotFoundException $e) {
            Log::error('Error de validación: Código de barras no encontrado.', ['barcode' => $barcode]);
            return back()->with('error', 'El código de barras no existe en la base de datos.');
        } catch (Exception $e) {
            Log::error('Error al procesar el inventario.', ['error' => $e->getMessage()]);
            return back()->with('error', 'Se produjo un error al procesar el inventario. Por favor, inténtalo de nuevo.');
        }
    }

   

    private function agregarAlResumen(Inventario $inventario)
    {
        $resumen = Session::get('inventario_resumen', []);
        array_push($resumen, $inventario->toArray());
        Session::put('inventario_resumen', $resumen);
    }

        public function finalizarInventario(Request $request)
    {
        $fechaInicio = Session::get('fecha_inicio_inventario');
        $fechaFin = now()->toDateString();

        $datosInventario = json_decode($request->input('datos_inventario'), true);

        foreach ($datosInventario as $item) {
            $ingresoMateriaPrima = IngresoMateriaPrima::where('barcode_value', $item['codigo'])->first();
            if ($ingresoMateriaPrima) {
                $inventario = new Inventario();
                $inventario->ingreso_materia_prima_id = $ingresoMateriaPrima->id; 
                $inventario->cantidad_sacos = $item['cantidad'];
                $inventario->fecha_inicio = $fechaInicio;
                $inventario->fecha_fin = $fechaFin;
                $inventario->save();
            } else {
                
            }

        // Clear the session data
        Session::forget('fecha_inicio_inventario');
        Session::forget('inventario_resumen');

        return back()->with('success', 'Inventario finalizado correctamente.');
    }
    }

    public function validarCodigoBarra(Request $request)
    {
        $barcode = $request->query('codigo_barra');
        $existe = IngresoMateriaPrima::where('barcode_value', $barcode)->exists();    
        return response()->json(['existe' => $existe]);
    }
    

    
}