<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $productos = Producto::all();
        return view('productos.index', compact('productos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('productos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $campos = ['nombre' => 'required',
                    'precio' => 'required',
            ];
        $mensaje = ['required' => ':attribute es requerido',];
        $this->validate($request, $campos, $mensaje);

        $data = request()->except('_token');

        Producto::insert($data);
        return redirect()->route('productos.index')->with('registro_prod', 'Producto registrado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Producto $producto)
    {
        return view('productos.edit', compact('producto'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Producto $producto)
    {
        $campos = ['nombre' => 'required',
        'precio' => 'required',
        ];
        $mensaje = ['required' => ':attribute es requerido',];
        $this->validate($request, $campos, $mensaje);

        $data = request()->except('_token');


        $producto->update($data);
        return redirect()->route('productos.index')->with('actualizado', 'Empleado actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Producto::destroy($id);
        return redirect('productos')->with('eliminado', 'Eliminado Correctamente');
    }

    public function venta(){
        $productos = Producto::all();
        return view('vender', compact('productos'));
    }

    public function get_data_producto(Request $request){
        $producto = Producto::where('id', $request->id_producto)->first();
        echo json_encode($producto);
    }
}
