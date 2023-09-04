<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orm_alumnos_perfil extends Model
{
    use HasFactory;
    Protected $table = 'alumno';
    public $timestamps = false;
    protected $primaryKey = 'idAlumno';
    protected $fillable = [
        'IdUser',
        'Nombre',
        'APP',
        'APM', 
    ];


    //tabla inversa unos a muchos de las tablas users y tipousuario
    public function user_alumno_perfil(){
        return $this->belongsTo('App\Models\Orm_user', 'IdUser', 'id');
    }


}
