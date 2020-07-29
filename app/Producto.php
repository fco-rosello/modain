<?php

namespace modain;

use ExistenciaProducto;
use Illuminate\Database\Eloquent\Model;
use DB;

class Producto extends Model
{
  protected $table = "Producto";
  protected $primaryKey = "cod_producto";
  public $timestamps = false;

  public function allProductos(){
    return DB::table('producto')->where('estado', '=', '0')->get();
  }

  public function tallas(){
    return $this->belongsToMany('modain\Talla','existencia-producto','cod_producto','cod_talla');
  }

  public function bodegas(){
    return $this->belongsToMany('modain\Bodega','existencia-producto','cod_producto','cod_bodega');
  }

  public function tiendas(){
    return $this->belongsToMany('modain\Tienda','existencia-producto','cod_producto','cod_tienda');
  }
  public function existencias(){
    return $this->belongsToMany('modain\Producto','existencia-producto','cod_producto','cod_producto')->withPivot('cod_talla','proveedor','precio_compra','cantidad','created_at', 'updated_at');
  }
}
