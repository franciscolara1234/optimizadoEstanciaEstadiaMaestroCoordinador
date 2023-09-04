<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orm_aula_academico extends Model
{
    use HasFactory;
    protected $table = 'aula_asesor_academico';
    protected $primaryKey = 'IdAulaAsesorAcademico';
    public $timestamps = false;
    protected $with = [
        'user_aula_academico:id,Matricula,IdCarrera',
        'tipo_proceso_aula_academico',
        'periodo_aula_academica:IdPeriodo,Periodo'
        ];
    //aqui van las relaciones de las cuales esta tabla apunta a las llaves foraneas con  las que se relaciona




    //aqui van las relaciones de las cuales esta tabla apunta a su llave primaria con las que se relaciona

    //relacion inversa de las tablas tipoproceso y aula_asesor_academico
    public function tipo_proceso_aula_academico(){
        return $this->belongsTo('App\Models\Orm_tipo_proceso', 'IdTipoProceso', 'IdTipoProceso');
    }


    //relacion unversa uno a muchos de las tablas Periodo y aula_asesor_academico
    public function periodo_aula_academica(){
        return $this->belongsTo('App\Models\Orm_periodo_escolar', 'IdPeriodo', 'IdPeriodo');
    }

    //relacion inversa uno a muchos de las tablas aula_asesor_academico y users
    public function user_aula_academico(){
        return $this->belongsTo('App\Models\Orm_user', 'IdUser', 'id');
    }
    //relacion inversa uno a muchos de las tablas aula_asesor_academico y carrera
    public function carrera_aula_academico(){
        return $this->belongsTo('App\Models\Orm_carrera');
    }


}
