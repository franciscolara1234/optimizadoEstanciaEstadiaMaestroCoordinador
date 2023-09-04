<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orm_detalle_doc extends Model
{
    use HasFactory;
    protected $table = 'detalledoc';
    public $timestamps = false;

    //relaciones ansiosas o anidadas de la tabla llamadas por defecto
    protected $with = [
        'documentos_detallesDoc'
    ];

    

    //aqui van las relaciones de las cuales esta tabla apunta a las llaves foraneas con  las que se relaciona


    //aqui van las relaciones de las cuales esta tabla apunta a su llave primaria con las que se relaciona
    

    //relacion uno a muchos de las tablas proceso y detalledoc
    public function procesos_detallesdoc(){
        return $this->belongsTo('App\Models\Orm_proceso', 'IdProceso', 'IdProceso');
    }

    //relacion uno a muchos de las tablas documentos y detalledoc
    public function documentos_detallesDoc(){
        return $this->belongsTo('App\Models\Orm_documentos', 'IdDoc', 'IdDoc');
    }


}
