<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class VentaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $ventas = Venta::all();
        $query_total_tarjeta = "SELECT SUM(total) AS total FROM ventas WHERE metodo_pago = 'TARJETA'";
        $total_tarjeta = DB::select($query_total_tarjeta);
        $total_tar = $total_tarjeta[0]->total;
        $query_total_efectivo = "SELECT SUM(total) AS total FROM ventas WHERE metodo_pago = 'EFECTIVO'";
        $total_efectivo = DB::select($query_total_efectivo);
        $total_efec = $total_efectivo[0]->total;

        $query_total_productos = "SELECT productos.nombre, SUM(detalleventa.cantidad) AS cantidad, SUM(productos.precio * detalleventa.cantidad) AS total
        FROM ventas
        LEFT JOIN detalleventa ON detalleventa.venta_id = ventas.id
        LEFT JOIN productos ON productos.id = detalleventa.producto_id
        GROUP BY productos.id";
        $total_productos = DB::select($query_total_productos);

        $query_total_ganancia = "SELECT SUM(total) AS total FROM ventas";
        $total_gan = DB::select($query_total_ganancia);
        $total_ganancia = $total_gan[0]->total;
        
        return view('ventas.index', compact('ventas', 'total_tar', 'total_efec', 'total_productos', 'total_ganancia'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $venta = new Venta;
        $venta->cliente = $request->cliente;
        $venta->total = $request->total_final;
        $venta->recibido = $request->cantidad_recibida;
        $venta->cambio = $request->cambio;
        $venta->fecha = date('Y-m-d H:i:s');
        $venta->metodo_pago = $request->metodo_pago;
        $venta->save();

        $id_venta = $venta->id;
        $ids_pro = explode(",", $request->ids_productos);
        $array_cantidades = explode(",", $request->cantidades);

        for ($i=0; $i < count($ids_pro); $i++) {
            DB::table('detalleventa')->insert([
                ['venta_id' => $id_venta, 
                 'producto_id' => $ids_pro[$i],
                 'cantidad' => $array_cantidades[$i]
                ],
            ]);
        }

        $query_infoventa = "SELECT * FROM ventas WHERE ventas.id = $id_venta";

        $query_detalle = "SELECT detalleventa.*, productos.nombre AS producto, productos.precio AS precio, detalleventa.cantidad * productos.precio AS subtotal
        FROM detalleventa
        INNER JOIN ventas ON detalleventa.venta_id = ventas.id
        INNER JOIN productos ON detalleventa.producto_id = productos.id
        WHERE ventas.id = $id_venta";

        $info_venta = DB::select($query_infoventa);
        $detalle_venta = DB::select($query_detalle);
        
        $data = compact('info_venta', 'detalle_venta');

        /* $pdf = PDF::loadView('pdf.ticket', $data);
        return $pdf->stream(); */

        return view('pdf.ticket', compact('info_venta', 'detalle_venta'));

    }

    public function genera_ticket(Request $request){
        $query_infoventa = "SELECT * FROM ventas WHERE ventas.id = 1";

        $query_detalle = "SELECT detalleventa.*, productos.precio AS precio, detalleventa.cantidad * productos.precio AS subtotal
        FROM detalleventa
        INNER JOIN ventas ON detalleventa.venta_id = ventas.id
        INNER JOIN productos ON detalleventa.producto_id = productos.id
        WHERE ventas.id = 1";

        $info_venta = DB::select($query_infoventa);
        $detalle_venta = DB::select($query_detalle);
        
        $data = compact('info_venta', 'detalle_venta');

        $pdf = PDF::loadView('pdf.ticket', $data);
        return $pdf->stream();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Venta $venta){
        
        $query_infoventa = "SELECT * FROM ventas WHERE ventas.id = $venta->id";

        $query_detalle = "SELECT detalleventa.*, productos.nombre AS producto, productos.precio AS precio, productos.descripcion, detalleventa.cantidad * productos.precio AS subtotal
        FROM detalleventa
        INNER JOIN ventas ON detalleventa.venta_id = ventas.id
        INNER JOIN productos ON detalleventa.producto_id = productos.id
        WHERE ventas.id = $venta->id";

        $info_venta = DB::select($query_infoventa);
        $detalle_venta = DB::select($query_detalle);
        
        return view('ventas.show', compact('info_venta', 'detalle_venta'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
