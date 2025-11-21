@extends('layouts.app')
@section('content')

<div class="card mt-5" >
    <h3 class="card-title "> Añadir un producto </h3>
    <div class="card-body">
        <form action="{{ route('productos.almacen')}}" method="POST">
            @csrf
            <div class="form-group mb-3">
                <label for="nombre" class="form-label">Nombre del producto</label>
                <input type="text" class="form-control" id="nombre" name="nombre">

            </div>
            <div class="form-group mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <input type="text" class="form-control" id="descripcion" name="descripcion">

            </div>
            <div class="form-group mb-3">
                <label for="precio" class="form-label">Precio</label>
                <input type="number" step="0.01" class="form-control" id="precio" name="precio">

            </div>
            <button type="submit" class="btn btn-primary form-control mb-3 mt-3">Guardar</button>
        </form>
        @if(session('success'))
        <div class="mt-3 alert alert-success">
            {{ session('success') }}
        </div>
        @endif
    </div>
</div>


@endsection