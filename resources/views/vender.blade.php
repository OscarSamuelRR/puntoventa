@extends('layouts.nav')

@section('content')
{{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> --}}
<link rel="stylesheet" href="select2/dist/css/select2.min.css">
<br>
<section>
  <form method="POST" action="{{ route('ventas.store') }}" accept-charset="UTF-8" id="save_producto_venta">
  @csrf
  <div class="row">
    <section class="content" id="main_content_sale">
      <div class="row">
        <div class="col-md-9 " style="padding-left: 30px;">
          <div class="card card-primary card-outline div_radius">
            <div class="card-header">
                <div class="row">
                  <div class="col-md-9">
                    <div class="form-group">
                      <div class="input-group mb-3 ">
                        <label for="producto"><b>PRODUCTO</b></label>
                        <select class="js-example-basic-single form-control" name="producto" id="producto"
                          onchange="get_data_product(this.value);">
                          <option value="">-- SELECCIONA EL PRODUCTO --</option>
                          @foreach ($productos as $producto)
                          <option value="{{ $producto->id }}">{{ $producto->nombre }}</option>
                          @endforeach
                        </select>

                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="cantidad"><b>CANTIDAD</b></label>
                      <input type="number" class="form-control input-sm" id="cantidad" name="cantidad" min="0"
                        step="0.00" placeholder="0"
                        autocomplete="off">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="precio_venta"><b>PRECIO DE VENTA</b></label>
                      <input type="number" class="form-control input-sm" id="precio_venta" name="precio_venta" readonly
                        min="0" step="0.04" placeholder="0.00">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <input type="text" class="form-control input-sm" id="id_producto" name="id_producto" hidden>
                    </div>
                  </div>
                </div><br>
                <button type="button" class="btn btn-dark" id="btn_add_prod_tem_vent" onclick="valida_producto();">
                  {{-- <i class="fas fa-check-circle text-success"></i> --}}
                  Agregar
                </button>

                <div class="alert alert-danger print-save-error-msg" style="display:none">
                  <ul></ul>
                </div>
            </div>
            <div class="card-body" style="margin-top: -18px;">
              <div class="tableFixHead">
                <br>
                <br>
                <table id="detalles" style="width:100%" class="table table-bordered table-sm table-hover text-center">
                  <thead>
                    <tr>
                      <th>Articulo</th>
                      <th>Cantidad</th>
                      <th>Precio venta</th>
                      <th>Subtotal</th>
                      {{-- <th scope="col"><i class="fas fa-trash-alt"></i></th> --}}
                    </tr>
                  </thead>
                  <tbody id="tabla_venta_productos_temp">
                  </tbody>
                </table>
              </div>
              <div class="container" style="border:1px solid #A9A9A9;">
                <div class="row">
                  <div class="col-md-3" style="">
                    <div class="btn-group" role="group" style="width:100%;height:100%;margin-left: -7px;">
                      <button type="button" id="cancelventaproducto" class="btn btn-danger btn-block btn-flat"
                        onclick="cancela_venta();">
                        Cancelar venta
                      </button>
                    </div>
                  </div>
                  <div class="col-md-3" style=""></div>
                  <div class="col-md-3  text-right" style="">
                    <h5 class="" style="margin-top:8px;"><strong>Total $</strong></h5>
                  </div>
                  <div class="col-md-3">

                    <input type="text" name="ventatotal" id="ventatotal" class="form-control input_style_total"
                      value="0" placeholder="00.00" readonly>

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-md-3" style="padding-right: 30px;">
          <!-- /.card -->
          <div class="card div_radius">
            <div class="card-header">
              <h3 class="card-title">Realizar venta</h3>
            </div>
            <div class="card-body p-0">
              <div class="container">
                <div class="mb-3">
                  <div class="form-group"><br>
                    <label for="cliente"><b>CLIENTE</b></label>
                    <input type="text" name="cliente" class="form-control text-center input_style_total" id="cliente" value="Público general">
                  </div>
                  <div class="form-group"><br>
                    <input type="text" name="ids_productos" id="ids_productos" hidden>
                    <input type="text" name="cantidades" id="cantidades" hidden>
                    <label for="total_final"><b>TOTAL</b></label>
                    <input type="text" name="total_final" class="form-control text-center input_style_total"
                      id="total_final" placeholder="00.00" readonly>
                  </div>
                  <div class="form-group"><br>
                    <label for="metodo_pago"><b>MÉTODO DE PAGO</b></label>
                    <select name="metodo_pago" id="metodo_pago" class="form-control">
                      <option value="">-- SELECCIONA --</option>
                      <option value="EFECTIVO">EFECTIVO</option>
                      <option value="TARJETA">TARJETA</option>
                    </select>
                  </div>
                </div>
                <div class="mb-3">
                  <div class="row">
                    <div class="col">
                      <div class="form-group">
                        <label for=""><b>TOTAL RECIBIDO</b></label>
                        <input type="number" id="cantidad_recibida" name="cantidad_recibida"
                          class="form-control input_style" placeholder="$ 0.00" onkeyup="calcula_cambio(this.value);"
                          autocomplete="off">
                      </div>
                    </div>
                    <div class="col">
                      <div class="form-group">
                        <label for=""><b>CAMBIO</b></label>
                        <input type="text" id="cambio" name="cambio" class="form-control input_style" readonly
                          placeholder="$ 0.00">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="mb-3">
                  <div class="form-group">
                  </form>
                    <div class="btn-group" role="group" style="width:100%;height:100%;margin-left: -7px;">
                      <button type="button" id="venta_productos_realizada" class="btn btn-success" onclick="valida_formulario();">{{-- <i class="fas fa-check-circle"></i> --}} Generar venta </button>
                    </div>
                  </div>
                </div>
              </div>
            </div> <!-- /.fin  de card-body -->
          </div> <!-- /.fin card -->
          
        </div><!-- /.fin del col-md-3 -->
      </div><!-- /. fin del row -->
    
    </section><!-- /.fin de la seccion -->
  
  </div>
</section>
<form action="" method="POST" id="form_data">
  @csrf
</form>
{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script> --}}
{{--
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> --}}
{{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> --}}
<script src="{{ asset('js/jquery.js') }}"></script>
<script src="{{ asset('select2/dist/js/select2.min.js') }}"></script>
<script>
  window.onload = document.getElementById("ventatotal").value = "0";
  $(document).ready(function () {
    $('.js-example-basic-single').select2();
  });

  let carrito_ids = [];
  let carrito_precios = [];
  let cantidades = [];

  function get_data_product(id_producto) {
    var form_data = document.forms['form_data'];
    let _token = form_data['_token'].value;

    $.ajax({
      url: '{{ route("get_data_producto") }}',
      method: 'POST',
      data: {
        id_producto: id_producto,
        _token: _token,
      },
      success: function (response) {
        var res = JSON.parse(response);
        console.log(response);

        document.getElementById('precio_venta').value = res['precio'];
        document.getElementById('id_producto').value = res['id'];


      },
      error: function () {
        alert("ERROR AL CONSULTAR INFORMACIÓN");
      },
    });
  }

  function valida_producto() {
    var cantidad = document.getElementById('cantidad').value;
    var precio_venta = document.getElementById('precio_venta').value;
    var id_producto = document.getElementById('id_producto').value;

    if (cantidad == null || cantidad == "") {
      /* Swal.fire({
        icon: 'error',
        title: 'Error',
        text: 'Debes ingresar la cantidad'
      }) */
      alert("DEBES INGRESAR LA CANTIDAD");
    } else if (precio_venta == null || precio_venta == "") {
      /* Swal.fire({
        icon: 'error',
        title: 'Error',
        text: 'Debes seleccionar un producto'
      }) */
      alert("DEBES SELECCIONAR UN PRÓDUCTO");
    } else if (id_producto == null || id_producto == "") {
      /* Swal.fire({
        icon: 'error',
        title: 'Error',
        text: 'Debes seleccionar un producto'
      }) */
      alert("DEBES SELECCIONAR UN PRÓDUCTO");
    } else {
      carrito_ids.push(id_producto);
      carrito_precios.push(precio_venta);
      cantidades.push(cantidad);

      pinta_tabla(id_producto, cantidad);
    }

  }

  function pinta_tabla(id_producto, cantidad) {
    var form_data = document.forms['form_data'];
    let _token = form_data['_token'].value;

    $.ajax({
      url: '{{ route("get_data_producto") }}',
      method: 'POST',
      data: {
        id_producto: id_producto,
        _token: _token,
      },
      success: function (response) {
        var res = JSON.parse(response);
        var contenido = '<tr>' +
          '<td>' + res['nombre'] + '</td>' +
          '<td>' + cantidad + '</td>' +
          '<td>' + '$' + res['precio'] + '</td>' +
          '<td>' + '$' + parseInt(cantidad * res['precio']) + '</td>' +
          '</tr>';
        $("#detalles").append(contenido);

        var total_parcial = parseInt(cantidad * res['precio']);

        document.getElementById("producto").value = "";
        document.getElementById("cantidad").value = "";
        document.getElementById('precio_venta').value = "";
        document.getElementById("id_producto").value = "";



        var total_acumulado = parseInt(document.getElementById("ventatotal").value);


        var total_final = parseInt(total_parcial + total_acumulado);


        document.getElementById("ventatotal").value = total_final;

        document.getElementById("total_final").value = total_final;

        document.getElementById("ids_productos").value = carrito_ids;
        document.getElementById("cantidades").value = cantidades;

      },
      error: function () {
        alert("ERROR AL CONSULTAR INFORMACIÓN");
      },
    });
  }

  function cancela_venta() {
    document.getElementById("ids_productos").value = "";
    document.getElementById("cantidades").value = "";
    document.getElementById("total_final").value = "";
    location.reload();
  }

  function calcula_cambio(cantidad_recibida) {
    let total = document.getElementById("total_final").value;
    let cambio = parseInt(cantidad_recibida - total);
    document.getElementById("cambio").value = cambio;
  }

  function valida_formulario(){
    let cliente = document.getElementById("cliente").value;
    let total = document.getElementById("total_final").value;
    let recibido = document.getElementById("cantidad_recibida").value;
    let cambio = document.getElementById("cambio").value;
    let metodo_pago = document.getElementById("metodo_pago").value;

    if (cliente == "" || total == "" || recibido == "" || cambio == "" || metodo_pago == "") {
      /* Swal.fire({
        icon: 'error',
        title: 'Error',
        text: 'Debes llenar correctamente el formulario'
      }) */
      alert("DEBES LLENAR CORRECTAMENTE EL FORMULARIO");
    }else{
      document.getElementById("save_producto_venta").submit();
    }
  }
</script>
@endsection