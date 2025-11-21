<!-- Modal de Actualización de Producto -->
<div class="modal fade" id="modal{{ $producto->Id }}" tabindex="-1" aria-labelledby="modalLabel{{ $producto->Id }}" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="modalLabel{{ $producto->Id }}">Editar Producto</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{ route('productos.update', $producto) }}" method="POST">
          @csrf
          @method('PUT') 
          <div class="form-group mb-3">
            <label for="nombre{{ $producto->id }}" class="form-label">Nombre del producto</label>
            <input type="text" class="form-control" id="nombre{{ $producto->id }}" name="nombre" value="{{ old('nombre', $producto->nombre) }}">
            @error('nombre')
            <div class="text-danger">{{ $message }}</div>
            @enderror
          </div>
          <div class="form-group mb-3">
            <label for="descripcion{{ $producto->id }}" class="form-label">Descripción</label>
            <input type="text" class="form-control" id="descripcion{{ $producto->id }}" name="descripcion" value="{{ old('descripcion', $producto->descripcion) }}">
            @error('descripcion')
            <div class="text-danger">{{ $message }}</div>
            @enderror
          </div>
          <div class="form-group mb-3">
            <label for="precio{{ $producto->id }}" class="form-label">Precio</label>
            <input type="number" step="0.01" class="form-control" id="precio{{ $producto->id }}" name="precio" value="{{ old('precio', $producto->precio) }}">
            @error('precio')
            <div class="text-danger">{{ $message }}</div>
            @enderror
          </div>
          <button type="submit" class="btn btn-primary">Actualizar</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        </form>
      </div>
    </div>
  </div>
</div>