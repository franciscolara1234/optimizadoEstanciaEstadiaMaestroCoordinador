<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class aula_proceso_asignatura extends Model
{
    use HasFactory;

    //relacion uno a muchos con la tabla proceso asignatura
    public function procesos_asignaturas_alumno(){
        return $this->hasMany('App\Models\proceso_asignatura_alumno', 'id_aula_proceso_asignaturas');
    }
    //relacion 1 a 1 con la tabla  proceso
    public function proceso(){
        return $this->belongsTo('App\Models\proceso', 'id_proceso');
    }
    //relacion 1 a 1 con la tabla coordinador carrera
    public function coordinador_carrera(){
        return $this->belongsTo('App\Models\coordinadores_carreras', 'id_coordinador_carrera');
    }
        //relacion 1 a 1 con la tabla  carrera
    public function carrera(){
        return $this->belongsTo('App\Models\carrera', 'id_carrera');
    }
     //relacion 1 a 1 con la tabla mensaje asesor academico
    public function asesor_academico(){
        return $this->belongsTo('App\Models\asesor_academico', 'id_asesor_academico');
    }
         //relacion 1 a 1 con la tabla mensaje asesor academico
         public function periodo_escolar(){
            return $this->belongsTo('App\Models\periodo_escolar', 'id_periodo_escolars');
        }
         //relacion 1 a 1 con la tabla mensaje asesor academico
         public function estado_abierto_cerrado(){
            return $this->belongsTo('App\Models\estado_abierto_cerrado', 'id_estado_abierto_cerrado');
        }
}
