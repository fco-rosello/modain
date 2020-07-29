<?php

namespace modain;

use ExistenciaProducto;
use Illuminate\Database\Eloquent\Model;

class Talla extends Model
{
    protected $table = "Talla";
    protected $primaryKey = "cod_talla";
    protected $keyType = 'string';
    public $timestamps = false;

    public function bodegas(){
      return $this->belongsToMany('modain\Bodega','existencia-producto','cod_talla','cod_bodega');
    }
    
    public function productos(){
      return $this->belongsToMany('modain\Producto','existencia-producto','cod_talla','cod_producto');
    }

    public function tiendas(){
      return $this->belongsToMany('modain\Tienda','existencia-producto','cod_talla','cod_tienda');
    }


}
