<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $table = 'ventas';
    protected $primaryKey = 'id';

    protected $fillable = [
        'producto_id',
        'cantidad_vendida',
        'precio_unitario',
        'total',
        'fecha',
    ];

    public $timestamps = false;

    // Relación con producto
    public function producto()
    {
        return $this->belongsTo(Producto::class, 'producto_id', 'codigo');
    }
}
