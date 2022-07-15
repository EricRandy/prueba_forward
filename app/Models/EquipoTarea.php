<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class EquipoTarea
 *
 * @property $id
 * @property $equipo_id
 * @property $tarea_id
 * @property $created_at
 * @property $updated_at
 *
 * @property Equipo $equipo
 * @property Tarea $tarea
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class EquipoTarea extends Model
{
    
    static $rules = [
		'equipo_id' => 'required',
		'tarea_id' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['equipo_id','tarea_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function equipo()
    {
        return $this->hasOne('App\Models\Equipo', 'id', 'equipo_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function tarea()
    {
        return $this->hasOne('App\Models\Tarea', 'id', 'tarea_id');
    }
    

}
