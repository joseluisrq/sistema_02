<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    protected $table = 'especialidad';
    protected $primaryKey='idespecialidad ';

    protected $fillable=[
        'nombre_es',
        'abreviatura_es',
        'descripcion_es',
        'duracion_es	'
    ];
      
}
