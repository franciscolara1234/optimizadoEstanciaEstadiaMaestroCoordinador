<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class asesor_academico extends Model
{
    use HasFactory;
    protected $table = 'aa';
    protected $primaryKey = 'IdAsesor';


    // //relacion uno a muchos con la tabla aula proceso asignatura
    // public function aula_proceso_asignatura(){
    //     return $this->hasMany('App\Models\aula_proceso_asignatura');
    // }
    //relacion 1 a 1 con la tabla mensaje asesor academico
    public function aula_proceso_asignatura(){
        return $this->hasOne('App\models\aula_proceso_asignatura', 'id_asesor_academico'); 
    }
    //relacion 1 a 1 con la tabla mensaje asesor academico
    public function mensaje_asesor_academico_definicion_proyecto(){
        return $this->hasOne('App\models\mensaje_asesor_academico_definicion_proyecto', 'id_asesor_academico'); 
    }

   //relacion 1 a 1 con la tabla calificacion asesor academico
    public function calificacion_asesor_academico_alumno(){
        return $this->hasOne('App\models\calificacion_asesor_academico_alumno', 'id_proceso_asignatura_alumnos');

    }
}
