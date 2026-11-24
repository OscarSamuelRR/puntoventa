@extends('layouts.nav')

@section('content')
<br>
<div class="row">
    <div class="col-md-12">
        <div class="container">
            <div class="row mt-5">
              <div class="col-12 col-md-4">
                <div class="card border border-opacity-10 shadow-sm">
                  <div class="card-body">
                    <div class="float-end">
                      <i class="fa fa-arrow-up text-success"></i>
                    </div>
                    <h5 class="text-muted fw-normal">Total ingresos Tarjeta</h5>
                    <h3 class="m-2">${{ $total_tar }}</h3>
                  </div>
                </div>
              </div>
              <div class="col-12 col-md-4">
                <div class="card border border-opacity-10 shadow-sm">
                  <div class="card-body">
                    <div class="float-end">
                      <i class="fa fa-arrow-up text-success"></i>
                    </div>
                    <h5 class="text-muted fw-normal">Total ingresos Efectivo</h5>
                    <h3 class="m-2">${{ $total_efec }}</h3>
                  </div>
                </div>
              </div>
              <div class="col-12 col-md-4">
                <div class="card border border-opacity-10 shadow-sm">
                  <div class="card-body" style="background-color: rgb(101, 189, 113);">
                    <div class="float-end">
                      <i class="fa fa-arrow-up text-success"></i>
                    </div>
                    <h5>Ganancias Totales</h5>
                    <h3 class="m-2">${{ $total_ganancia }}</h3>
                  </div>
                </div>
              </div> 
            </div>
          </div>
    </div>
</div><br>

<div class="row">
    <div class="col-md-12">
        <div class="container">
            <div class="row mt-5">
                <div class="col-12 col-md-7">
                    <div class="card border border-opacity-10 shadow-sm">
                      <div class="card-body">
                        <div class="float-end">
                          <i class="fa fa-arrow-up text-success"></i>
                        </div>
                        <h5 class="text-muted fw-normal">Ventas Realizadas</h5>
                        <table class="table">
                            <thead>
                                <th>Id</th>
                                <th>Cliente</th>
                                <th>Total</th>
                                <th>Fecha</th>
                                <th>Método de pago</th>
                                <th>Opciones</th>
                            </thead>
                            <tbody>
                                @foreach ($ventas as $venta)
                                    <tr>
                                        <td>{{ $venta->id }}</td>
                                        <td>{{ $venta->cliente }}</td>
                                        <td>${{ $venta->total }}</td>
                                        <td>{{ $venta->fecha }}</td>
                                        <td>{{ $venta->metodo_pago }}</td>
                                        <td>
                                            <a class="btn btn-sm btn-primary" title="Ver Detalles" href="{{ route('ventas.show', $venta->id) }}">Detalles</a>
                                            <a class="btn btn-sm btn-secondary" title="Reimprimir ticket" href="{{ route('ventas.reimprimir', $venta->id) }}" target="_blank">
                                                <i class="fa fa-print"></i> Reimprimir
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                      </div>
                    </div>
                  </div>

                <div class="col-12 col-md-5">
                    <div class="card border border-opacity-10 shadow-sm">
                      <div class="card-body">
                        <div class="float-end">
                          <i class="fa fa-arrow-up text-success"></i>
                        </div>
                        <h5 class="text-muted fw-normal">Total por producto</h5>
                        <table class="table">
                            <thead>
                                <th><b>Producto</b></th>
                                <th><b>Cantidad</b></th>
                                <th><b>Total</b></th>
                            </thead>
                            <tbody>
                                @foreach ($total_productos as $row)
                                <tr>
                                    <td>{{ $row->nombre }}</td>
                                    <td>{{ $row->cantidad }}</td>
                                    <td>{{ $row->total }}</td>
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
</div><br>


{{-- <div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-1"></div>
        <div class="col-md-10">
            <div class="card border-secondary mb-3">
                <div class="card-header">Ventas Realizadas</div>
                <div class="card-body text-secondary">
                    <table class="table">
                        <thead>
                            <th>Id</th>
                            <th>Cliente</th>
                            <th>Total</th>
                            <th>Fecha</th>
                            <th>Método de pago</th>
                            <th>Opciones</th>
                        </thead>
                        <tbody>
                            @foreach ($ventas as $venta)
                                <tr>
                                    <td>{{ $venta->id }}</td>
                                    <td>{{ $venta->cliente }}</td>
                                    <td>${{ $venta->total }}</td>
                                    <td>{{ $venta->fecha }}</td>
                                    <td>{{ $venta->metodo_pago }}</td>
                                    <td>
                                        <a class="btn btn-sm btn-primary" title="Ver Detalles" href="{{ route('ventas.show',$venta->id) }}">Detalles</a>
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
</div> --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

@endsection
