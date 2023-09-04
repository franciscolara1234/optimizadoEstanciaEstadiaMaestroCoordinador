<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orm_carrera extends Model
{
    use HasFactory;
    protected $table = 'carrera';
    protected $primaryKey = 'IdCarrera';

    //aqui van las relaciones donde esta tabla apunta a la llave foranea con la que se relaciona

    //relacion uno a muchos de las tablas Users y carrera
    public function users_carrera(){
        return $this->hasMany('App\Models\Orm_user', 'idCarrera', 'IdCarrera');
    }

    //relacion uno a muchos de las tablas Users y carrera
    public function users_carreras(){
        return $this->hasMany('App\Models\Orm_user', 'IdCarrera', 'IdCarrera');
    } 
    //relacion uno a muchos de las tablas Carrera y Aula_asesor_academico
    public function aula_academico_carrera(){
        return $this->hasMany('App\Models\Orm_aula_academico');
    }

    //aqui van las relaciones donde esta tabla apunta a la llave primaria con la que se relaciona

    



}
