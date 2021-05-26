<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Modelo extends Model
{
    //Definimos los campos que se pueden rellenar de un modelo
    protected $fillable = [
        'id_modelo',
        'nombre_modelo',
        'observaciones',
        'fecha_modelo',
        'image'
    ];

    /**
     * Con este método definimos que un modelo puede estar en muchos
     * vehiculos diferentes y obtenerlos
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function Vehiculos(){
        return $this->hasMany(Vehiculo::class);
    }
}
