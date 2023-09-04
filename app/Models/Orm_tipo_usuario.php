<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orm_tipo_usuario extends Model
{
    use HasFactory;
    protected $table = 'tipousuario';
    protected $primaryKey = 'IdTipoUsu';
    public $timestamps = false;



    //aqui van las relaciones donde esta tabla apunta a la llave foranea con la que se relaciona
    
    //relacion uno a muchos de las tablas tipousuario y Users
    public function Users_tipos(){
        return $this->hasMany('App\Models\Orm_user', 'IdTipoUsu', 'IdTipoUsu');
    }
    //aqui van las relaciones donde esta tabla apunta a la llave primaria con la que se relaciona



}
