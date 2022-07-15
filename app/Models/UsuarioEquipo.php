<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class UsuarioEquipo
 *
 * @property $id
 * @property $usuario_id
 * @property $equipo_id
 * @property $lider
 * @property $created_at
 * @property $updated_at
 *
 * @property Equipo $equipo
 * @property Usuario $usuario
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class UsuarioEquipo extends Model
{
    
    static $rules = [
		'usuario_id' => 'required',
		'equipo_id' => 'required',
		'lider' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['usuario_id','equipo_id','lider'];


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
    public function usuario()
    {
        return $this->hasOne('App\Models\Usuario', 'id', 'usuario_id');
    }
    

}
