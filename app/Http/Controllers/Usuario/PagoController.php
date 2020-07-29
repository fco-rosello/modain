<?php

namespace modain\Http\Controllers\Usuario;

use Illuminate\Http\Request;
use modain\Http\Controllers\Controller;
use modain\TipoProducto;
use modain\Talla;
use modain\Marca;
use modain\Ciudad;

class PagoController extends Controller
{
    public function __construct(){
      $this->middleware('auth');
    }

    public function index()
    {
        $TipoProductos = TipoProducto::all();
        $Marcas = TipoProducto::all();
        $Tallas = Talla::all();
        $Ciudades = Ciudad::all();
        return view('Home.pago', compact('TipoProductos','Marcas','Tallas','Ciudades'));
        //,'DetallesPedido'
    }
}
