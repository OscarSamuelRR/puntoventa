@extends('layouts.nav')

@section('content')
<style>
    body{
    background:#eee;
}
.ui-w-40 {
    width: 40px !important;
    height: auto;
}

.card{
    box-shadow: 0 1px 15px 1px rgba(52,40,104,.08);    
}

.ui-product-color {
    display: inline-block;
    overflow: hidden;
    margin: .144em;
    width: .875rem;
    height: .875rem;
    border-radius: 10rem;
    -webkit-box-shadow: 0 0 0 1px rgba(0,0,0,0.15) inset;
    box-shadow: 0 0 0 1px rgba(0,0,0,0.15) inset;
    vertical-align: middle;
}
</style>
<div class="container px-3 my-5 clearfix">
    <!-- Shopping cart table -->
    <div class="card">
        <div class="card-header">
            <h3>Detalle de venta</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                @foreach ($info_venta as $venta)
                <label for=""><b>CLIENTE: </b>{{ $venta->cliente }}</label>
                
                <br><br>
              <table class="table table-bordered m-0">
                <thead>
                  <tr>
                    <!-- Set columns width -->
                    <th class="text-center py-3 px-4" style="min-width: 400px;">Nombre de producto &amp; Descripción</th>
                    <th class="text-right py-3 px-4" style="width: 100px;">Precio</th>
                    <th class="text-center py-3 px-4" style="width: 120px;">Cantidad</th>
                    <th class="text-right py-3 px-4" style="width: 100px;">Subtotal</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($detalle_venta as $detalle)
                    <tr>
                        <td class="p-4">
                          <div class="media align-items-center">
                            <div class="media-body">
                              <a href="#" class="d-block text-dark">{{ $detalle->producto }}</a>
                              <small>
                                <span class="text-muted">Descripcion:</span>
                                <span>{{ $detalle->descripcion }}</span> &nbsp;
                              </small>
                            </div>
                          </div>
                        </td>
                        <td class="text-right font-weight-semibold align-middle p-4">{{ $detalle->precio }}</td>
                        <td class="align-middle p-4">{{ $detalle->cantidad }}</td>
                        <td class="text-right font-weight-semibold align-middle p-4">${{ $detalle->subtotal }}</td>
                      </tr>
                    @endforeach
                          
                </tbody>
              </table>
            </div>
            <br>
                <p style="text-align: right;">
                      <label">Total: </label>
                      <strong>${{ $venta->total }}.00</strong>
                </p>
                @endforeach
   
          </div>
      </div>
  </div>


@endsection
