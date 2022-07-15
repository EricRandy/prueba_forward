<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Tarea
 *
 * @property $id
 * @property $nombre
 * @property $descripcion
 * @property $archivo
 * @property $created_at
 * @property $updated_at
 *
 * @property EquipoTarea[] $equipoTareas
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Tarea extends Model
{
    
    static $rules = [
		'nombre' => 'required',
    'archivo' => 'required|mimes:pdf|max:10048',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['nombre','descripcion','archivo'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function equipoTareas()
    {
        return $this->hasMany('App\Models\EquipoTarea', 'tarea_id', 'id');
    }
    

}
