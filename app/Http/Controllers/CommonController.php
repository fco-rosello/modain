<?php

namespace modain\Http\Controllers;

use modain\Talla;
use modain\Bodega;
use modain\Tienda;
use modain\Producto;
use Illuminate\Http\Request;

class CommonController extends Controller
{
    public function __construct(){
         $this->middleware('auth');
         $this->middleware('permisos');
    }
    public function createExistenciaProducto(Producto $Producto)
    {
      $Tallas = Talla::all();
      $Bodegas = Bodega::all();
      $Tiendas = Tienda::all();
      return view('Existencia-Producto.create',compact('Tiendas','Tallas','Bodegas','Producto'));
    }
}
