@extends ('layouts/all')
@include('essencials/nav')
    
@section('sidebar')
<div id="mySidebar">
    <div class="row">
        <a href="#">Link 1</a>
        <a href="#">Link 2</a>
        <a href="#">Link 3</a>
    </div>
</div>

@endsection




@section('banner')
<div class="container mt-5">
    <h3 id="panel" class="mb-4">Panel de control operativo</h3>
    
    <div class="row mb-5">
        <!-- Usuarios -->
        <div class="col-md-3 mb-4">
            <div class="card h-100">
                <div class="card-body text-center">
                    <i class="fas fa-users fa-3x mb-3"></i>
                    <h5 class="card-title">Usuarios Totales</h5>
                    <p class="card-text">{{ $usuariosCount ?? '' }}</p>
                </div>
            </div>
        </div>
        
        <!-- Clientes -->
        <div class="col-md-3 mb-4">
            <div class="card h-100">
                <div class="card-body text-center">
                    <i class="fas fa-user-tie fa-3x mb-3"></i>
                    <h5 class="card-title">Clientes Totales</h5>
                    <p class="card-text">{{ $clientesCount ?? '' }}</p>
                </div>
            </div>
        </div>
        
        <!-- Ordenes de Trabajo -->
        <div class="col-md-3 mb-4">
            <div class="card h-100">
                <div class="card-body text-center">
                    <i class="fas fa-clipboard-list fa-3x mb-3"></i>
                    <h5 class="card-title">Ordenes de Trabajo</h5>
                    <p class="card-text">{{ $ordenesTrabajoCount ?? '' }}</p>
                </div>
            </div>
        </div>

        <!-- Productos -->
        <div class="col-md-3 mb-4">
            <div class="card h-100">
                <div class="card-body text-center">
                    <i class="fas fa-box-open fa-3x mb-3"></i>
                    <h5 class="card-title">Productos Totales</h5>
                    <p class="card-text">{{ $productosCount ?? '' }}</p>
                </div>
            </div>
        </div>

        <!-- Materia Prima -->
        <div class="col-md-3 mb-4">
            <div class="card h-100">
                <div class="card-body text-center">
                    <i class="fas fa-cubes fa-3x mb-3"></i>
                    <h5 class="card-title">Materia Prima</h5>
                    <p class="card-text">{{ $materiaPrimaCount ?? '' }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Sección de gráfico de eficiencia -->
    <div class="container mt-5 mb-5">
        <h3>Gráfico de Eficiencia</h3>
        <canvas id="eficienciaChart" width="800" height="600"></canvas>
    </div>

    <!-- Sección de tabla de eficiencia -->
    <div class="container mt-5 mb-5">
        <h3>Tabla de Eficiencia</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>OC</th>
                    <th>Porcentaje de Avance</th>
                    <th>Eficiencia</th>
                </tr>
            </thead>
            <tbody>
                @foreach($ordenes ?? [] as $orden)
                    <tr>
                        <td>{{ $orden->numero_oc }}</td>
                        <td>{{ $orden->porcentaje_progreso }}%</td>
                        <td>{{ $orden->porcentaje_progreso / $ordenesTrabajoCount }}%</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Sección de bodega -->
    <div class="container mt-5 mb-5">
        <h3 class="mb-4">Status de la Bodega</h3>
        <div class="row">
            @php
                $bodegaCards = [
                    ['icon' => 'fas fa-boxes', 'title' => 'Inventario', 'text' => 'Items en Inventario', 'count' => $inventarioCount ?? ''],
                    ['icon' => 'fas fa-warehouse', 'title' => 'Almacenes', 'text' => 'Total Almacenes', 'count' => $almacenesCount ?? ''],
                    ['icon' => 'fas fa-truck-loading', 'title' => 'Despacho', 'text' => 'Items a Despachar', 'count' => $despachoCount ?? ''],
                    ['icon' => 'fas fa-trash', 'title' => 'Scrap', 'text' => 'Kilos de Scrap', 'count' => $scrapKilos ?? ''],
                ];
            @endphp

            @foreach($bodegaCards as $card)
            <div class="col-md-3 mb-4">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <i class="{{ $card['icon'] }} fa-3x mb-3"></i>
                        <h5 class="card-title">{{ $card['title'] }}</h5>
                        <p class="card-text">{{ $card['text'] }}: {{ $card['count'] ?? 'N/A' }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection




@include('essencials/footer')

