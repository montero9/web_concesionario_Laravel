<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    //Definimos los campos que se pueden rellenar de un vehiculo
    protected $fillable = [
        'modelo_id',
        'matricula',
        'caballos',
        'puertas',
        'tipo_cambio',
        'combustible',
        'color',
        'fecha_registro',
        'precio'
    ];

    /**
     *Define que un vehículo solo puede estar en una venta
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function Venta(){
        return $this->belongsTo(Venta::class);
    }

    /**
     *Define que un vehiculo pertenece a un único modelo
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function Modelo(){
        return $this->belongsTo(Modelo::class);
    }

    /**
     * Con este método definimos que una vehiculo puede estar en varios presupuesto
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function Budgets(){
        return $this->belongsToMany(Budget::class);
    }

}
