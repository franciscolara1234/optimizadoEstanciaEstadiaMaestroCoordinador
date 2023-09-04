<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orm_periodo_escolar extends Model
{
    use HasFactory;
    protected $table = 'periodo';
    protected $primaryKey = 'IdPeriodo';
    public $timestamps = false;


    //aqui van las relaciones de las cuales esta tabla apunta a las llaves foraneas con  las que se relaciona

    //relacion unos a muchos de las tablas periodo y proceso
    public function procesos_periodos(){
        return $this->hasMany('App\Models\Orm_proceso', 'IdPerido', 'IdPeriodo');
    }
    //relacion uno a muchos de las tablas periodo y aula_asesor_academico
    public function aulas_academicas_periodos(){
        return $this->hasMany('App\Models\Orm_aula_academico', 'IdPeriodo', 'IdPeriodo');
    }







    //aqui van las relaciones de las cuales esta tabla apunta a su llave primaria con las que se relaciona





}
