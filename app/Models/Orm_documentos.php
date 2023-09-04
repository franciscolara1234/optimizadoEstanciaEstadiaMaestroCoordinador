<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orm_documentos extends Model
{
    use HasFactory;
    protected $table = 'documentos';
    protected $primaryKey  = 'IdDoc';
    public $timestamps = false;

    //relaciones ansiosas o anidadas de la tabla llamadas por defecto
    protected $with = [
        'comentarios_documentos',
        'tipo_documento',
        'estado_documento'
    ];
    protected $fillable = ['estadoAca'];

    
    //aqui van las relaciones donde esta tabla apunta a la llave foranea con la que se relaciona
    

    //relacion uno a muchos de las tablas documentos y comentarios_docu
    public function comentarios_documentos(){
        return $this->hasMany('App\Models\Orm_comentarios_docu', 'IdDoc', 'IdDoc');
    }
    //relacion uno a muchos de las tablas documentos y detalledoc
    public function detalles_documentos(){
        return $this->hasMany('App\Models\Orm_detalle_doc', 'IdDoc', 'IdDoc');
    }


    //aqui van las relaciones donde esta tabla apunta a la llave primaria con la que se relaciona
    
    //relacion inversa uno a muchos de las tablas documentos y tipodoc
    public function tipo_documento(){
        return $this->belongsTo('App\Models\Orm_tipo_doc', 'IdTipoDoc', 'IdTipoDoc');
    }

    
    //relacion inversa uno a muchos de las tablas documentos y estadoDoc
    public function estado_documento(){
        return $this->belongsTo('App\Models\Orm_estado_docu', 'IdEstado', 'IdEstado');
    }



}
