<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orm_coordinador extends Model
{
    use HasFactory;
    Protected $table = 'coordinadores';
    protected $primaryKey = 'IdCordinador';
    public $timestamps = false;
    protected $fillable = [
        'IdUser',
        'Nombre',
        'APP',
        'APM',
        'IdGrado'
    ];
        //aqui van las relaciones donde esta tabla apuntan a la llave foranea con las que se relacionan

    //relacion uno a muchos con las tablas grado academico y aa



    //aqui van las relaciones que apuntan a las llaves primaria

    //relacion inversa unoa a uno de las tablas coordinadores y users
    public function User_coordinador(){
        return $this->belongsTo('App\Models\Orm_user', 'IdUser', 'id');
    }

    //relacion inversa uno a muchos de la tablas coordinadores y gradoacademico
    public function grado_academico_coordinador(){
        return $this->belongsTo('App\Models\Orm_grado_academico');
    }

}
