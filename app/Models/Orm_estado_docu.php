<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orm_estado_docu extends Model
{
    use HasFactory;
    protected $table = 'estadodoc';
    protected $primaryKey = 'IdEstado';
    public $timestamps = false;


    //aqui van las relaciones donde esta tabla apunta a la llave foranea con la que se relaciona

        //relacion uno a muchos de las tablas estadodoc y documentos
        public function documentosEstadosDocu(){
            return $this->hasMany('App\Models\Orm_documentos', 'IdEstado', 'IdEstado');
        }



    //aqui van las relaciones donde esta tabla apunta a la llave primaria con la que se relaciona
    
    
    // //Relacion inversa uno a muchos de las tablas estadoDoc y documentos 
    // public function documentosEstado(){
    //     return $this->belongsTo('App\Models\Orm_documentos', 'idEstado', 'idEstado');
    // }

    

}
