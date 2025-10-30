<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{

  public static function rules($id = null)
  {
    return [
      'ruc' => 'nullable',
      'nombre' => 'required',
      'telefono' => 'required|unique:clientes,nombre,' . $id,
      'direccion' => 'required',
      'credito' => 'nullable',
      'correo' => 'nullable|email',
    ];
  }

  protected $fillable = ['ruc', 'nombre', 'telefono', 'correo', 'credito', 'direccion'];

  public function creditos()
  {
    return $this->hasMany(Creditoventa::class, 'id_cliente');
  }
}
