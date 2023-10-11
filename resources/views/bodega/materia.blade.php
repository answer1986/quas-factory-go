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

@section ('banner')
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<h2 id="materia-prima">Ingreso de Materias Primas</h2>
    <form action="{{ route('materia.store') }}" method="post" id="formulario-materia">
    @csrf
        <label for="tipo_materia">Tipo de Materia Prima:</label>
        <select id="tipo_materia" name="tipo_materia">
            <option value="polietileno_hdpe">Polietileno de Alta Densidad (HDPE)</option>
            <option value="polipropileno_pp">Polipropileno (PP)</option>
            <option value="pvc">Policloruro de Vinilo (PVC)</option>
            <!-- Agrega más opciones según tus necesidades -->
        </select>

        <label for="cantidad" id="titulo-cantidad">Cantidad (en kilogramos):</label>
        <input type="number" id="cantidad" name="cantidad" required>

        <label for="proveedor" id="titulo-proveedor">Proveedor:</label>
        <input type="text" id="proveedor" name="proveedor" required>

        <label for="fecha_ingreso" id="titulo-fecha-ingreso">Fecha de Ingreso:</label>
        <input type="date" id="fecha_ingreso" name="fecha_ingreso" required>

        <label for="descripcion" id="titulo-descripcion">Descripción:</label>
        <textarea id="descripcion" name="descripcion" rows="4"></textarea>
        <br>
        <input type="submit" value="Registrar Ingreso" id="boton materia prima">
    </form>

@endsection






@extends('essencials/footer')