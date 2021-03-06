<?php

namespace modain\Http\Controllers\Usuario;

use Illuminate\Http\Request;
use modain\Http\Controllers\Controller;
use modain\Producto;
use modain\Pedido;
use modain\DetallePedido;
use modain\TipoProducto;
use modain\Http\Requests\StoreDetallePedidoRequest;
use DB;

class DetallePedidoController extends Controller
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
        //
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
    public function store(StoreDetallePedidoRequest $request)
    {

      $Producto = Producto::find($request->cod_producto);
      $cod_pedido = auth()->user()->getCodPedido(auth()->user()->rut_cliente);

      $DP =  DetallePedido::whereColumn([
                   ['cod_pedido', '=',  DB::raw((int)$cod_pedido)],
                   ['cod_producto', '=', DB::raw((int)$request->cod_producto)],
                   ['cod_talla', '=',  DB::raw('\''.$request->cod_talla.'\'')]
                   ])->first();

      if($DP != null){
        $DP->cantidad = $DP->cantidad + 1;
        $DP->subtotal = $DP->subtotal + $Producto->precio_venta;

        $DP->updateDp($DP);

      }else{
          $DP = new DetallePedido();

          $DP->cod_pedido = $cod_pedido;
          $DP->cod_producto = $request->cod_producto;
          $DP->cod_talla = $request->cod_talla;
          $DP->cantidad = 1;
          $DP->precio_venta = $Producto->precio_venta;
          $DP->subtotal = $Producto->precio_venta;

          $DP->saveDp($DP);
      }

      $sumProductos =  DB::table('detalle-pedido')
                    ->select(DB::raw('sum(subtotal) as total'))
                    ->where('cod_pedido', '=', DB::raw((int)$cod_pedido))->value('total');

      if ($sumProductos == null) {
        $sumProductos = 0;
      }

      DB::table('pedido')
          ->where('cod_pedido', '=',  DB::raw((int)$cod_pedido))
          ->update(
            [
            'total' => $sumProductos,
            ]
      );

      return redirect()->route('home');
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

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($cod_producto, $cod_talla)
    {
        $cod_pedido = auth()->user()->getCodPedido(auth()->user()->rut_cliente);

        $DP =  DetallePedido::whereColumn([
                     ['cod_pedido', '=',  DB::raw((int)$cod_pedido)],
                     ['cod_producto', '=', DB::raw((int)$cod_producto)],
                     ['cod_talla', '=',  DB::raw('\''.$cod_talla.'\'')]
                     ])->first();

        $DP->deleteDp($DP);

        $sumProductos =  DB::table('detalle-pedido')
                      ->select(DB::raw('sum(subtotal) as total'))
                      ->where('cod_pedido', '=', DB::raw('\''.$cod_pedido.'\''))->value('total');

        if ($sumProductos == null) {
          $sumProductos = 0;
        }

        DB::table('pedido')
            ->where('cod_pedido', '=',  DB::raw((int)$cod_pedido))
            ->update(
              [
              'total' => $sumProductos,
              ]
        );

        return redirect()->route('carro');
    }
}
