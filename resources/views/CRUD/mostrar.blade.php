@extends('layouts.app')
@section('content')

<h1>Listado de Productos Registrados</h1>
<table class="table">
    <thead>
        <tr>
            <th scope="col">Producto</th>
            <th scope="col">Descripcion</th>
            <th scope="col">Precio</th>
            <th scope="col">Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($productos as $producto)
        <tr>
            <td>{{ $producto->nombre }}</td>
            <td>{{ $producto->descripcion }}</td>
            <td>{{ $producto->precio }}</td>
            <td>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal{{ $producto->Id }}">Editar</button>

                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalConfirmDelete"
                    onclick="setDeleteForm('{{ route('productos.destroy', $producto) }}','{{ $producto->nombre }}')">Eliminar</button>
            </td>
        </tr>
        @include('CRUD.Actualizar')

        @endforeach
    </tbody>
</table>
@if(session('success'))
<div class="mt-3 alert alert-success">
    {{ session('success') }}
</div>
@endif

<!-- Modal de Confirmación de Eliminación -->
<div class="modal fade" id="modalConfirmDelete" tabindex="-1" aria-labelledby="modalConfirmDeleteLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalConfirmDeleteLabel">Confirmacion de eliminacion</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>¿Estás seguro de que deseas eliminar el producto "<strong id="productNameToDelete"></strong>"?</p>
                <p>Esta acción es <strong class="text-danger">irreversible</strong> y no se puede deshacer.</p>
            </div>
            <div class="modal-footer">
                <form id="deleteForm" action="" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function setDeleteForm(action, productName) {
        document.getElementById('deleteForm').action = action;
        document.getElementById('productNameToDelete').textContent = productName;
    }
</script>

@endsection