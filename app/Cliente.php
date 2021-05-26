<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    //Definimos los campos que se pueden rellenar de un cliente
    protected $fillable = [
        'id_cliente',
        'dni',
        'nombre',
        'apellidos',
        'fecha_nacimiento',
        'direccion',
        'localidad',
        'cod_postal',
        'provincia',
        'pais',
        'email',
        'telefono',
        'fecha_registro',
        'observaciones'
    ];

    /**
     * Con este método definimos que un cliente puede estar en muchas
     * ventas diferentes
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function Ventas(){
        return $this->hasMany(Venta::class);
    }
}
