<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Usuario
 *
 * @property $id
 * @property $nombre
 * @property $primer_apellido
 * @property $segundo_apellido
 * @property $email
 * @property $created_at
 * @property $updated_at
 *
 * @property UsuarioEquipo $usuarioEquipo
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Usuario extends Model
{
    
    static $rules = [
		'nombre' => 'required',
		'primer_apellido' => 'required',
		'email' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['nombre','primer_apellido','segundo_apellido','email'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function usuarioEquipo()
    {
        return $this->hasOne('App\Models\UsuarioEquipo', 'usuario_id', 'id');
    }
    

}
