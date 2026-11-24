<!DOCTYPE html>
<html>

<head>
    <style>

        * {
            font-size: 14px;
            font-family: 'Times New Roman';
        }

        td,
        th,
        tr,
        table {
            border-top: 1px solid black;
            border-collapse: collapse;
        }

        td.producto,
        th.producto {
            width: 125px;
            max-width: 125px;
        }

        td.cantidad,
        th.cantidad {
            width: 45px;
            max-width: 45px;
            word-break: break-all;
        }

        td.precio,
        th.precio {
            width: 50px;
            max-width: 50px;
            word-break: break-all;
        }

        .centrado {
            text-align: center;
            align-content: center;
        }

        .ticket {
            width: 220px;
            max-width: 220px;
        }

        img {
            max-width: inherit;
            width: inherit;
        }

        @media print {
    .oculto-impresion,
    .oculto-impresion * {
        display: none !important;
    }
}

.button {
  background-color: #3ceb42 !important; /* Green */
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
}

        
    </style>
</head>

<body>
    <div class="ticket">
        <div class="centrado">
            <img style="width: 90% !important;" src="images/logo.png" alt="Logotipo">
        </div>
        @foreach ($info_venta as $venta)
            
        
        <p class="centrado">Ticket de Compra
            <br><b>Folio:</b> LM-{{ $venta->id }}
            <br>{{ $venta->fecha }}
            <br>Cliente: {{ $venta->cliente }}
        </p>
        <div class="centrado">
            <table>
                <thead>
                    <tr>
                        <th class="cantidad">CANT</th>
                        <th class="producto">PRODUCTO</th>
                        <th class="precio">$$</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($detalle_venta as $detalle)
                    <tr>
                        <td class="cantidad">{{ $detalle->cantidad }}</td>
                        <td class="producto">{{ $detalle->producto }}</td>
                        <td class="precio">${{ $detalle->subtotal }}</td>
                    </tr>
                    @endforeach
                    <tr>
                        <td class="cantidad"></td>
                        <td class="producto"><b>TOTAL</b></td>
                        <td class="precio"><b>${{ $venta->total }}</b></td>
                    </tr>
    
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <p class="centrado">¡GRACIAS POR SU COMPRA!
            <img style="width: 70% !important;" src="images/paginaspa.png" alt="Logotipo">
            <br>El presente documento no es un comprobante fiscal. Si requiere factura favor de mandar su folio de venta al correo: callcenter@lasmananitas.com.mx junto con su constancia de identificación fiscal, forma de pago y el uso del CFDI.
            <br><br><b>https://lasmananitas.com.mx</b>
        </p>
        <br>
         
    </div>
    <button class="oculto-impresion" onclick="imprimir()" style="background-color: #4CAF50 !important;
    border: none;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;">Imprimir ticket</button>
    <button class="oculto-impresion button" onclick="location.href='/'" style="background-color: #008CBA !important;
    border: none;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;">Generar nueva venta</button>
    <script>
        function imprimir(){
            window.print();
            window.print();
        }
    </script>
</body>
</html>