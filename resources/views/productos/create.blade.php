@extends('layouts.nav')

@section('content')
<br>
<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-1"></div>
        <div class="col-md-10">
            <div class="card border-secondary mb-3">
                <div class="card-header">Registrar Producto</div>
                <div class="card-body text-secondary">
                    <form action="{{ route('productos.store') }}" method="POST">
                        @csrf
                    <div class="row">
                        
                            <div class="col-md-3">
                                <label for="nombre">NOMBRE</label>
                                <input type="text" name="nombre" id="nombre" class="form-control">
                                @error('nombre')
									<strong style="color: red;">El nombre es requerido</strong>
								    @enderror
                            </div>
                            <div class="col-md-3">
                                <label for="precio">PRECIO</label>
                                <input type="number" name="precio" id="precio" class="form-control">
                                @error('precio')
									<strong style="color: red;">El precio es requerido</strong>
								@enderror
                            </div>
                            <div class="col-md-6">
                                <label for="descripcion">DESCRIPCIÓN</label>
                                <textarea name="descripcion" id="descripcion" cols="30" rows="3" class="form-control" style="resize: none;"></textarea>
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