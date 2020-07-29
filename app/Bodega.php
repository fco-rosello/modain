<?php

namespace modain;

use ExistenciaProducto;
use Illuminate\Database\Eloquent\Model;

class Bodega extends Model
{
    protected $table = "Bodega";
    protected $primaryKey = "cod_bodega";
    
    public $timestamps = false;

    public function productos(){
      return $this->belongsToMany('modain\Producto','existencia-producto','cod_bodega','cod_producto');
    }
    public function tallas(){
      return $this->belongsToMany('modain\Talla','existencia-producto','cod_bodega','cod_talla');
    }
    public function tiendas(){
      return $this->belongsToMany('modain\Tienda','existencia-producto','cod_bodega','cod_tienda');
    }
}
