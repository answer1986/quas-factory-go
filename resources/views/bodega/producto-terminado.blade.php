@extends('layouts.all')
@include('essencials.nav')

@section('banner')

    <!-- recursos/views/tuVista.blade.php -->
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
    <h2 id="producto-terminado">Agregar Producto terminado</h2>
    <form method="POST" action="{{ route('producto-terminado.store') }}" enctype="multipart/form-data" id="contenedor-oc">
        @csrf
        
        <!-- Numero de OC -->
        <label for="numero_oc">Número OC:</label>
        <input type="text" name="numero_oc" required>
        
        <!-- Cantidad de Kilos -->
        <label for="kilos">Kilos:</label>
        <input type="number" name="kilos" required>

        <!-- Tipo de Producto -->
        <label for="producto_id">Tipo de Producto:</label>
        <select name="producto_id" required>
            @foreach($productos ?? [] as $producto)
                <option value="{{ $producto->id }}">{{ $producto->nombre }}</option>
            @endforeach
        </select>

        <!-- Unidades -->
        <label for="unidades">Unidades:</label>
        <input type="number" name="unidades" required>
        
        <!-- Fecha -->
        <label for="fecha">Fecha:</label>
        <input type="date" name="fecha" required>

        <!-- Hora -->
        <label for="hora">Hora:</label>
        <input type="time" name="hora" required>

        <!-- Observaciones -->
        <label for="observaciones">Observaciones:</label>
        <textarea name="observaciones" id="observaciones"></textarea>

        <!-- Porcentaje de Avance -->
        <label for="porcentaje_avance">Porcentaje de Avance:</label>
        <input type="number" name="porcentaje_avance" required>
        <br>
        <button type="submit" id="boton-prterminado">Crear OC</button>
    </form>



@endsection





@include('essencials.footer')