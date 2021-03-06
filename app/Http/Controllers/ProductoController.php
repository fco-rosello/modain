<?php

namespace modain\Http\Controllers;

use modain\Marca;
use modain\TipoProducto;
use modain\Producto;
use Illuminate\Http\Request;
use modain\Http\Requests\StoreProductoRequest;
use modain\Http\Requests\UpdateProductoRequest;
use File;
use Illuminate\Filesystem\Filesystem;
use DB;
class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(){
        $this->middleware('auth');
        $this->middleware('permisos');
    }

    public function index()
    {
        //$Productos = Producto::all();
        return view('Producto.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $TipoProductos = TipoProducto::all();
        $Marcas = Marca::all();
        return view('Producto.create',compact('TipoProductos','Marcas'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductoRequest $request)
    {

      if($request->hasFile('foto_producto')){
        $file = $request->file('foto_producto');
        $name = time().$file->getClientOriginalName();
        $ruta = public_path('img').'\\'.$request->input('nombre').'\\';
        $file->move(public_path('img').'\\'.$request->input('nombre').'\\', $name);
      }
        $Producto = new Producto();

        $Producto->cod_tipo_producto = $request->input('tipo_de_producto');
        $Producto->cod_marca = $request->input('marca');
        $Producto->nom_producto = $request->input('nombre');
        $Producto->precio_venta = $request->input('precio_venta');
        $Producto->detalle_producto = $request->input('detalle_producto');
        $Producto->estado = 0;
        $Producto->ruta = $ruta;
        $Producto->save();

        return redirect()->route('producto.index')->with('status','El producto "'.$Producto->nom_producto.'" ha sido creado exitosamente.')
                                                  ->with('modal_existencia','¿Desea agregar la existencia de este producto?')
                                                  ->with('cod_producto',$Producto->cod_producto)
                                                  ->with('nom_producto',$Producto->nom_producto);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Producto = Producto::find($id);
        return view('Producto.show', compact('Producto'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Producto $Producto)
    {
      $TipoProductos = TipoProducto::all();
      $Marcas = Marca::all();
      return view('Producto.edit', compact('Producto','Marcas','TipoProductos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductoRequest $request, Producto $Producto)
    {

      $Producto->cod_tipo_producto = $request->input('tipo_de_producto');
      $Producto->cod_marca = $request->input('marca');
      $Producto->nom_producto = $request->input('nombre');
      $Producto->precio_venta = $request->input('precio_venta');
      $Producto->detalle_producto = $request->input('detalle_producto');

      rename($Producto->ruta, public_path('img').'\\'.$request->input('nombre'));
      $Producto->ruta = public_path('img').'\\'.$request->input('nombre');

      if($request->hasFile('foto_producto')){
          $file = $request->file('foto_producto');
          $name = time().$file->getClientOriginalName();
          $ruta = public_path('img').'\\'.$request->input('nombre').'\\';
          $file->move(public_path('img').'\\'.$request->input('nombre').'\\', $name);
      }

      $Producto->save();

        return redirect()->route('producto.show', [$Producto])->with('status','El producto "'.$Producto->nom_producto.'" ha sido actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Producto $Producto)
    {

      $delete_exi = DB::table('existencia-producto')
              ->select(DB::raw('count(*) as suma'))
              ->where('cod_producto', '=', $Producto->cod_producto)->value('cant');

      $descontinuar = DB::table('existencia-producto')
              ->select(DB::raw('sum(cantidad)'))
              ->where('cod_producto','=',$Producto->cod_producto)->value('suma');

      if ($descontinuar == 0 && $delete_exi >= 1) {

        $Producto->estado = 2;
        $Producto->save();
        return redirect()->route('producto.index')->with('status','El producto "'.$Producto->nom_producto.'" ha sido descontinuado exitosamente.');

      }else if($delete_exi == 0){

        File::deleteDirectory(public_path('img').'\\'.$Producto->nom_producto);
        $Producto->delete();
        return redirect()->route('producto.index')->with('status','El producto "'.$Producto->nom_producto.'" ha sido eliminado exitosamente.');

      }else if($delete_exi == 1){

        return redirect()->route('producto.index')->with('status_error','El producto "'.$Producto->nom_producto.'" esta asociado a una existencia de producto.');

      }else{

        return redirect()->route('producto.index')->with('status_error','El producto "'.$Producto->nom_producto.'" esta asociado a existencias de productos.');

      }

    }

}
