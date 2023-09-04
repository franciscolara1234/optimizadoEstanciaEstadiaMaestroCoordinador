<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orm_comentarios_docu extends Model
{
    use HasFactory;
    protected $table = 'comentarios_docu';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'IdUser',
        'IdDoc',
        'Comentario',
        'TipoComentario'
    ];
    
    //aqui van las relaciones donde esta tabla apunta a la llave foranea con la que se relaciona
    
    


    //aqui van las relaciones donde esta tabla apunta a la llave primaria con la que se relaciona
  
  
    //relacion inversa unos a muchos de las tablas comentarios_docu y users
    public function usersComentarios(){
        return $this->belongsTo('App\Models\Orm_User', 'IdUser', 'id');
    }

    //relacion inversa unos a muchos de las tablas comentarios_docu y Documentos
    public function DocumentosComentarios(){
        return $this->belongsTo('App\Models\Orm_comentarios', 'IdDoc', 'IdDoc');
    }
    public function docuComentarios(){
        return $this->belongsTo('App\Models\documentos', 'IdDoc', 'IdDoc');
    }

}
