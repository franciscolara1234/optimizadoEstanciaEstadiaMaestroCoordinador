<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class proceso_asignatura_alumno extends Model
{
    use HasFactory;




//relacion 1 a 1 con la tabla mensaje asesor academico
    public function mensaje_asesor_academico_definicion_proyecto(){
        return $this->hasOne('App\models\mensaje_asesor_academico_definicion_proyecto', 'id_proceso_asignatura_alumnos');

   }

//relacion 1 a 1 con la tabla mensaje asesor academico
public function mensaje_coordinador_carrera_definicion_proyecto(){
    return $this->hasOne('App\models\mensaje_coordinador_carrera_definicion_proyecto', 'id_proceso_asignatura_alumnos');

}

//relacion 1 a 1 con la tabla calificacion asesor academico
public function calificacion_asesor_academico_alumno(){
    return $this->hasOne('App\models\calificacion_asesor_academico_alumno', 'id_proceso_asignatura_alumnos');

}
//relacion 1 a 1 con la tabla calificacion asesor empresarial
public function calificacion_asesor_empresarial_alumno(){
    return $this->hasOne('App\models\calificacion_asesor_empresarial_alumno', 'id_proceso_asignatura_alumnos');

}

//relaciones de tablas uno a uno 

    //relacion con tabla alumno (inversa)
    public function alumno(){
        //retornar el modelo y si las llaveves primarias y foranes 
        //tienen otro nombre diferente a tabla_id se le pone como segundo
        //parametro o un tercer parametro si igual la llave foranea pasa
        //lo mismo
        return $this->belongsTo('App\Models\alumno', 'id_alumno');
    }
    //relacion de tablas uno a muchos tabla alumnos (inversa)

    public function proceso(){
        return $this->belongsTo('App\Models\proceso', 'id_proceso');
    } 

    //relacion de tablas uno a muchos tabla carreras (inversa)

    public function carrera(){
        return $this->belongsTo('App\Models\carrera', 'id_carrera');
    }

    //relacion de tablas uno a muchos tabla aula procesos (inversa)

    public function aula_proceso_asignatura(){
        return $this->belongsTo('App\Models\aula_proceso_asignatura', 'id_aula_proceso_asignaturas');
    }

        //relacion de tablas uno a muchos tabla asesor empresarial (inversa)

        public function asesor_empresarial(){
            return $this->belongsTo('App\Models\asesor_empresarial', 'id_asesor_empresarial');
        }

        //relacion de tablas uno a muchos tabla empresa (inversa)

        public function empresa(){
           return $this->belongsTo('App\Models\empresa', 'id_empresa');
        }
        
        //relacion de tablas uno a muchos tabla estatus aprobacion reprobacion (inversa)

        public function estatus_aprobacion_reprobacion(){
            return $this->belongsTo('App\Models\estatus_aprobacion_reprobacion', 'id_estatus_aprobacion_reprobacions');
        }


        //relacion de tablas uno a muchos tabla periodo escolar (inversa)

        public function periodo_escolar(){
            return $this->belongsTo('App\Models\periodo_escolar', 'id_periodo_escolars');
        }
        //relacion de tablas uno a muchos tabla estatus estatus abierto cerrado (inversa)

        public function estado_abierto_cerrado(){
            return $this->belongsTo('App\Models\estado_abierto_cerrado', 'id_estado_abierto_cerrado');
        }


}


