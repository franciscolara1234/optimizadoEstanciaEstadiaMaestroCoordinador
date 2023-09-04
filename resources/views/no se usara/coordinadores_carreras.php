<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class coordinadores_carreras extends Model
{
    use HasFactory;
        //relacion uno a muchos con la tabla aula proceso asignatura
    public function aula_proceso_asignatura(){
        return $this->hasMany('App\Models\aula_proceso_asignatura');
    }    
    //relacion 1 a 1 con la tabla mensaje asesor academico
    public function mensaje_coordinador_carrera_definicion_proyecto(){
        return $this->hasMany('App\Models\mensaje_coordinador_carrera_definicion_proyecto', 'id_coordinadores_carreras');
    }
}
