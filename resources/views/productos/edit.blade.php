@extends('layouts.nav')

@section('content')
<br>
<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-1"></div>
        <div class="col-md-10">
            <div class="card border-secondary mb-3">
                <div class="card-header">Ediatr Producto</div>
                <div class="card-body text-secondary">
                    <form action="{{ route('productos.update', $producto->id) }}" method="POST">
                        @csrf
                        {{ method_field('PUT') }}
                    <div class="row">
                        
                            <div class="col-md-3">
                                <label for="nombre">NOMBRE</label>
                                <input type="text" name="nombre" id="nombre" class="form-control" value="{{ $producto->nombre }}">
                                @error('nombre')
									<strong style="color: red;">El nombre es requerido</strong>
								@enderror
                            </div>
                            <div class="col-md-3">
                                <label for="precio">PRECIO</label>
                                <input type="number" name="precio" id="precio" class="form-control" value="{{ $producto->precio }}">
                                @error('precio')
									<strong style="color: red;">El precio es requerido</strong>
								@enderror
                            </div>
                            <div class="col-md-6">
                                <label for="descripcion">DESCRIPCIÓN</label>
                                <textarea name="descripcion" id="descripcion" cols="30" rows="3" class="form-control" style="resize: none;">{{ $producto->descripcion }}</textarea>
                            </div>
                             
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <input type="submit" class="btn btn-success" value="Guardar">
                        </div> 
                    </div>
                </form>
                </div>
              </div>
        </div>
        </div>
    </div>
</div>

@endsection