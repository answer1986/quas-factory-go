<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Cliente;
use App\Models\Producto;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $usuariosCount = User::count();
        $clientesCount = Cliente::count();
        $productosCount = Producto::count();

        Log::info('Counts:', [
            'usuarios' => $usuariosCount,
            'clientes' => $clientesCount,
            'productos' => $productosCount
        ]);

        return view('dashboard', compact('usuariosCount', 'clientesCount', 'productosCount'));
    }

    public function showStatus()
{
    $inventarioCount = Inventario::count();
    $almacenesCount = Almacen::count();
    $despachoCount = Despacho::count();

    return view('status_bodega', compact('inventarioCount', 'almacenesCount', 'despachoCount'));
}
}
