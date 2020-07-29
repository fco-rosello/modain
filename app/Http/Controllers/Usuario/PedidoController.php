<?php

namespace modain\Http\Controllers\Usuario;

use Illuminate\Http\Request;
use modain\Http\Controllers\Controller;
use modain\TipoProducto;
use modain\Talla;
use modain\Marca;
use modain\Pedido;
use modain\DetallePedido;
use DB;

class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function __construct(){
          $this->middleware('auth');
     }
    public function index()
    {
        $TipoProductos = TipoProducto::all();
        $Marcas = TipoProducto::all();
        $Tallas = Talla::all();

        $cod_pedido = auth()->user()->getCodPedido(auth()->user()->rut_cliente);
        $DetallesPedido = DB::table('detalle-pedido')->where('cod_pedido', '=', $cod_pedido)->get();

        return view('Home.carro', compact('TipoProductos', 'DetallesPedido','Marcas','Tallas'));

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
        //
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
