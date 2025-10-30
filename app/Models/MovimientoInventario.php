<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovimientoInventario extends Model
{
    use HasFactory;

    protected $table = 'movimiento_inventarios';

    protected $fillable = [
        'id_producto',
        'tipo_movimiento',
        'cantidad',
        'precio_unitario',
        'origen',
        'stock_anterior',
        'stock_actual'
    ];

    // Relación con Producto
    public function producto()
    {
        return $this->belongsTo(Producto::class, 'id_producto');
    }

    // Relación con Compras o Ventas según el origen
    public function origen()
    {
        return $this->morphTo();
    }
}

