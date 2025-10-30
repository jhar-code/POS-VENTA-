<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Detalleventa extends Model
{
  protected $table = 'detalleventa';
  protected $fillable = ['nombre_producto', 'precio', 'cantidad', 'id_producto', 'id_venta'];

  public function venta()
  {
    return $this->belongsTo(Venta::class, 'id_venta', 'id');
  }

  public function producto()
  {
    return $this->belongsTo(Producto::class, 'id_producto');
  }
}
