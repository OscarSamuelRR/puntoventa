@extends('layouts.nav')

@section('content')
<br>
<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-1"></div>
        <div class="col-md-10">
            <p style="text-align: right;"><a href="{{ url('productos/create') }}" class="btn btn-dark btn-sm">Registrar Producto</a></p>
            
            @if (Session::has('actualizado'))
            <br>
            <div class="alert alert-success" role="alert">
                Producto Actualizado
              </div>
            @endif
            @if (Session::has('registro_prod'))
            <br>
            <div class="alert alert-success" role="alert">
                Producto Registrado
              </div>
            @endif
            @if (Session::has('eliminado'))
            <br>
            <div class="alert alert-success" role="alert">
                Producto Eliminado
              </div>
            @endif
            <div class="card border-secondary mb-3">
                <div class="card-header">Productos Registrados</div>
                <div class="card-body text-secondary">
                    <table class="table">
                        <thead>
                            <th>Id</th>
                            <th>Nombre</th>
                            <th>Precio</th>
                            <th>Descripcion</th>
                            <th>Opciones</th>
                        </thead>
                        <tbody>
                            @foreach ($productos as $producto)
                                <tr>
                                    <td>{{ $producto->id }}</td>
                                    <td>{{ $producto->nombre }}</td>
                                    <td>${{ $producto->precio }}</td>
                                    <td>{{ $producto->descripcion }}</td>
                                    <td>
                                        <form action="{{url('/productos/'.$producto->id)}}" class="eliminar-registro-producto" id="form_borrar{{ $producto->id }}" method="post">
                                            @csrf
                                            {{ method_field('DELETE') }}
                                            {{-- <a type="button" href="{{ route('departamentos.edit', $departamento) }}"
                                                class="btn btn-sm btn-success"><i class="fas fa-edit"></i></a> --}}
                                            <a type="button" href="{{ route('productos.edit', $producto) }}" class="btn btn-sm btn-success">Editar</a>
                                            {{-- <button type="submit" class="btn btn-sm btn-danger">Eliminar</button> --}}
                                        </form>
                                    </td>
                                </tr>
                                
                            @endforeach
                            
                        </tbody>
                    </table>
                </div>
              </div>
        </div>
        </div>
        
          
    </div>
</div>
{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script> --}}
<script src="{{ asset('js/jquery.js') }}"></script>
<script>
    function delete_producto(id){
        const form = document.getElementById("form_borrar"+id);

        Swal.fire({
            title: '¿Estas Seguro?',
            text: "¡No podrás revertir esto!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '¡Sí, Eliminar!',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        })

    }
</script>
@endsection
