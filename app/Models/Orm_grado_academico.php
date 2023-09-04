<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orm_grado_academico extends Model
{
    use HasFactory;
    protected $table = 'gradoacademico';
    protected $primaryKey = 'IdGrado';
    public $timestamps = false;


    //aqui van las relaciones donde esta tabla apuntan a la llave foranea con las que se relacionan

    //relacion uno a muchos con las tablas grado academico y aa
    public function aa_grado_academico(){
        return $this->hasMany('App\Models\Orm_aa_academico', 'IdGrado', 'IdGrado');
    }
    //relacion uno a muchos con las tablas grado academico y coordinadores
    public function coordinadores_grado_academico(){
        return $this->hasMany('App\Models\Orm_coordinador', 'IdGrado', 'IdGrado');
    }


    //aqui van las relaciones que apuntan a las llaves primaria

}
