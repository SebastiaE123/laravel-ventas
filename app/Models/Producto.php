<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'productos';
    protected $primaryKey = 'codigo';
    public $incrementing = false; // porque el código es varchar
    protected $keyType = 'string';

    protected $fillable = [
        'codigo',
        'nombre',
        'descripcion',
        'cantidad',
        'precio',
    ];

    public $timestamps = false;

    // Relación con ventas
    public function ventas()
    {
        return $this->hasMany(Venta::class, 'producto_id', 'codigo');
    }
}
