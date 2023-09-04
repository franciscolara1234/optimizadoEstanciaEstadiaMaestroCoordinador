<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orm_user extends Model
{
    use HasFactory;
    Protected $table = 'users';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'IdTipoUsu',
        'email',
        'password',
        'Nombre',
        'Matricula',
        'IdCarrera',
         
    ];
    protected $with = [
        'aa_academico_user',
        'coordinadores_users',
        'alumno_perfil_user',
        'carrera_user'
        ];




    //aqui van las relaciones donde esta tabla apunta a la llave foranea con la que se relaciona
    
    //relacion uno a muchos de las tablas Users y comentarios_docu
    public function comentariosDocumentosUsers(){
        return $this->hasMany('App\Models\Orm_comentarios_docu', 'IdUser', 'id');
    }

    //relacion uno a uno de las tablas users y aa(asesor academico)
    public function aa_academico_user(){
        return $this->hasOne('App\Models\Orm_aa_academico', 'IdUser', 'id');
    }
    //relacion uno a muchos de las tablas users y proceso
    public function procesos_users(){
        return $this->hasMany('App\Models\Orm_Proceso', 'IdUsuario', 'id');
    }

    //relacion uno a muchos de las tablas Users y Aula_asesor_academico
    public function aulas_academicos_user(){
        return $this->hasMany('App\Models\Orm_aula_academico', 'IdUser', 'id');
    }


    //relacion uno a uno de las tablas users y coordinadores 
    public function coordinadores_users(){
        return $this->hasOne('App\Models\Orm_coordinador', 'IdUser', 'id');
    }
    //relacion uno a uno de las tablas users y alumno 
    public function alumno_perfil_user(){
        return $this->hasOne('App\Models\Orm_alumnos_perfil', 'IdUser', 'id');
    }




    //aqui van las relaciones donde esta tabla apunta a la llave primaria con la que se relaciona

    //tabla inversa unos a muchos de las tablas users y tipousuario
    public function tipo_usuario(){
        return $this->belongsTo('App\Models\Orm_tipo_usuario', 'IdTipoUsu', 'IdTipoUsu');
    }

    //relacion inversa uno a muchos de las tablas carrera y users
    public function carrera_user(){
        return $this->belongsTo('App\Models\Orm_carrera', 'IdCarrera', 'IdCarrera');
    }
    
    
}
