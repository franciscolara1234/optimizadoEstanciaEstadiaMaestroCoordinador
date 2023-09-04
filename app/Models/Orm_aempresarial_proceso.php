<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orm_aempresarial_proceso extends Model
{
    use HasFactory;

    protected $table = 'ae_pp';
    public $timestamps = false;
    //relaciones ansiosas o anidadas de la tabla llamadas por defecto
    protected $with = [
        'aemp_pro'
    ];



    public function proceso_aempresarial(){
        return $this->belongsTo('App\Models\Orm_proceso', 'IdProceso', 'IdProceso');
    }
    public function aemp_pro(){
        return $this->belongsTo('App\Models\Orm_aempresarial', 'Idae', 'IdAE');
    }

}
