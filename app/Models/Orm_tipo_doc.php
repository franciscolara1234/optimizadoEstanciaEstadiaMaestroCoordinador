<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orm_tipo_doc extends Model
{
    use HasFactory;
    protected $table = 'tipodoc';
    protected $primaryKey = 'IdTipoDoc';
    public $timestamps = false;
    
    
    //aqui van las relaciones donde esta tabla apunta a la llave foranea con la que se relaciona

    
        //relacion uno a muchos de las tablas tipoDoc y documentos
        public function DocumentosTipos(){
            return $this->hasMany('App\Models\Orm_documentos', 'IdTipoDoc', 'IdTipoDoc');
        }




    //aqui van las relaciones inversas donde esta tabla apunta a la llave primaria con la que se relaciona
    
    //Relacion inversa uno a muchos de las tablas estadoDoc y documentos 
    // public function documentosTipo(){
    //     return $this->belongsTo('App\Models\Orm_documentos', 'idTipoDoc', 'idTipoDoc');
    // }


}
