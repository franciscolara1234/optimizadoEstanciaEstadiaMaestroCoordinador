<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orm_tipo_proceso extends Model
{
    use HasFactory;
    protected $table = 'tipoproceso';
    protected $primaryKey = 'IdTipoProceso';
    public $timestamps = false;



    //aqui van las relaciones de las cuales esta tabla apunta a las llaves foraneas con  las que se relaciona
    
    //relacion uno a muchos de las tablas tipousuario y procceso
    public function procesos_tipos_procesos(){
        return $this->hasMany('App\Models\Orm_proceso', 'IdTipoProceso', 'IdTipoProceso');
    }

    //relacion uno a muchos de las tablas tipoproceso y aula_asesor_academico
    public function aulas_academicos_tipo_proceso(){
        return $this->hasMany('App\Models\Orm_aula_academico', 'IdTipoProceso', 'IdTipoProceso');
    }

    //aqui van las relaciones de las cuales esta tabla apunta a su llave primaria con las que se relaciona




}
