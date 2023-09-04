<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orm_aa_academico extends Model
{
    use HasFactory;
    protected $table = 'aa';
    protected $primaryKey = 'IdAsesor';
    public $timestamps = false;
    protected $fillable = [
        'IdUser',
        'Nombre',
        'APP',
        'APM',
        'IdGrado'
    ];

    //aqui van las relaciones donde esta tabla apuntan a la llave foranea con las que se relacionan

    //relacion uno a muchos de las tablas aa(asesoracademico) y aa_pp(AcademicoProceso)
    public function aacademico_procesos(){
        return $this->hasMany('App\models\Orm_aacademico_proceso', 'IdAsesor', 'IdAsesor');
    }


    //aqui van las relaciones que apuntan a las llaves primaria

    //relacion inversa uno a muchos con las tablas aa y gradoacademico
    public function grado_aa_academico(){
        return $this->belongsTo('App\Models\Orm_grado_academico');
    }

    //relacion inversa uno a uno de las tablas aa(asesoracademico) y users
    public function user_aa_academico(){
        return $this->belongsTo('App\Models\Orm_User', 'IdUser', 'id');
    }

}
