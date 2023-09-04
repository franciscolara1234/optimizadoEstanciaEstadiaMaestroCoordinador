<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orm_aacademico_proceso extends Model
{
    use HasFactory;
    protected $table = 'aa_pp';
    public $timestamps = false;
 

    //aqui van las relaciones que apuntan a las que esta tabla apunta a las llaves foraneas con las que se relaciona


    //aqui van las relaciones don esta tabla apunta a las llaves primarias con las que se relacionan 
    
    //relacion con las tablas aa y aa_pp
    public function aa_academico(){
        return $this->belongsTo('App\Models\Orm_aa_academico', 'IdAsesor', 'IdAsesor');
    }
    
    //relacion con las tablas aa_pp y proceso
    public function proceso(){
        return $this->belongsTo('App\Models\Orm_proceso', 'IdProceso', 'IdProceso');
    }

}
