<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orm_proceso extends Model
{
    use HasFactory;
    protected $table = 'proceso';
    protected $primaryKey = 'IdProceso';
    public $timestamps = false;
    
    //relaciones ansiosas o anidadas de la tabla llamadas por defecto
    protected $with = [
        'aa_academico_procesos',
        'detalle_doc_proceso', 
        'user_proceso:id,name,Nombre,Matricula,IdCarrera',
        'carreras_procesos',
        'tipo_procesos_proceso',
        'periodo_proceso:IdPeriodo,Periodo',
        'calificaciones_proceso',
        'aempresarial_procesos'
        
    ];


    
    //aqui van las relaciones de las cuales esta tabla apunta a las llaves foraneas con  las que se relaciona
 
    
    //relacion con las tablas aa_pp(asesor academico proceso) y proceso
    public function aa_academico_procesos(){
        return $this->hasMany('App\models\Orm_aacademico_proceso', 'IdProceso', 'IdProceso');
    }

    //relacion con las tablas aa_pp(asesor academico proceso) y proceso
    public function aempresarial_procesos(){
        return $this->hasOne('App\Models\Orm_aempresarial_proceso', 'IdProceso', 'IdProceso');
    }

    //relacion con las tablas proceso y detalledoc
    public function detalle_doc_proceso(){
        return $this->hasMany('App\Models\Orm_detalle_doc', 'IdProceso', 'IdProceso');
    }
   
    public function calificaciones_proceso(){
        return $this->hasMany('App\Models\Orm_calificaciones', 'IdProceso', 'IdProceso');
    }
    

    //aqui van las relaciones de las cuales esta tabla apunta a su llave primaria con las que se relaciona

    //relacion inversa uno a muchos de las tablas proceso y users
    public function user_proceso(){
        return $this->belongsTo('App\Models\Orm_user', 'IdUsuario', 'id');
    }
    //relacion inversa uno a muchos de las tablas carrera y Proceso
    public function carreras_procesos(){
        return $this->belongsTo('App\Models\Orm_carrera', 'IdCarrera', 'IdCarrera');
    }
    
    //relacion inversa uno a muchos de las tablas proceso y tipoproceso
    public function tipo_procesos_proceso(){
        return $this->belongsTo('App\Models\Orm_tipo_proceso', 'IdTipoProceso', 'IdTipoProceso');
    }
    //relacion inversa uno a muchos de las tablas proceso y periodo
    public function periodo_proceso(){
        return $this->belongsTo('App\Models\Orm_periodo_escolar', 'IdPeriodo', 'IdPeriodo');
    }


}
