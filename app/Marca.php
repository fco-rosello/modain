<?php

namespace modain;

use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
  protected $table = "Marca";
  protected $primaryKey = "cod_marca";
  public $timestamps = false;  
}
