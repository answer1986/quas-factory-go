@extends ('layouts/all')
@extends('essencials/nav')
    
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
    <h3 id="panel">Panel de control</h3>
    
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body text-center">
                    <i class="fas fa-users fa-3x mb-3"></i>
                    <h5 class="card-title">Usuarios Totales</h5>
                    <p class="card-text">{{ $usuariosCount ?? '' }}</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card">
                <div class="card-body text-center">
                    <i class="fas fa-user-tie fa-3x mb-3"></i>
                    <h5 class="card-title">Clientes Totales</h5>
                    <p class="card-text">{{ $clientesCount ?? '' }}</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card">
                <div class="card-body text-center">
                    <i class="fas fa-box-open fa-3x mb-3"></i>
                    <h5 class="card-title">Productos Totales</h5>
                    <p class="card-text">{{ $productosCount ?? '' }}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-5">
    <h3>Status de produccion</h3>
    
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Progreso de pedidos</h5>
            <!-- Canvas para el Gráfico -->
            <canvas id="myChart" width="400" height="200"></canvas>
        </div>
    </div>


    <div class="container mt-5">
        <h3>Status de la Bodega</h3>
    </div>
    <div class="row">
        <!-- Caja de Inventario -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Inventario</h5>
                    <p class="card-text">Items en Inventario: 1,500</p>
                    <!-- Puedes agregar un icono de inventario con FontAwesome por ejemplo -->
                    <i class="fas fa-boxes"></i>
                </div>
            </div>
        </div>
        
        <!-- Caja de Almacenes -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Almacenes</h5>
                    <p class="card-text">Total Almacenes: 5</p>
                    <!-- Icono de almacén -->
                    <i class="fas fa-warehouse"></i>
                </div>
            </div>
        </div>

        <!-- Caja de Despacho -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Despacho</h5>
                    <p class="card-text">Items a Despachar: 300</p>
                    <!-- Icono de despacho -->
                    <i class="fas fa-truck-loading"></i>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
@endsection




@extends('essencials/footer')