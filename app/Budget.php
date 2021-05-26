<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'cliente_id',
        'precio_total',
        'fecha_venta',
        'fecha_presupuesto'
    ];

    /**
     * Con este método definimos que un presupuesto puede tener varios vehiculos
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function Vehiculos(){
        return $this->belongsToMany(Vehiculo::class);
    }
}
