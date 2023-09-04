<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class calificacion_asesor_academico_alumno extends Model
{
    use HasFactory;
    //relacion uno a uno con la tabla proceso asignatura
    public function procesos_asignaturas_alumno(){
        return $this->belongsTo('App\Models\proceso_asignatura_alumno', 'id_proceso_asignatura_alumnos');
    }
    //relacion uno a uno con la tabla asesor academico
    public function asesor_academico(){
        return $this->belongsTo('App\Models\asesor_academico', 'id_asesor_academico');
    }
    //relacion uno a uno con la tabla estado abierto cerrado
    public function estado_abierto_cerrado(){
        return $this->belongsTo('App\Models\estado_abierto_cerrado', 'id_estado_abierto_cerrado');
    }
}
