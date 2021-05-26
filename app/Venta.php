<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_user',
        'cliente_id',
        'precio_total',
        'fecha_venta',
        'fecha_presupuesto'
    ];

    /**
     *Define que una venta pertenece a un único usuario
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function User(){
        return $this->belongsTo(User::class);
    }

    /**
     *Define que una venta pertenece a un único cliente
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function Cliente(){
        return $this->belongsTo(Cliente::class);
    }

    /**
     * Con este método definimos que una venta puede tener varios vehiculos
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function Vehiculos(){
        return $this->hasMany(Vehiculo::class);
    }
}
