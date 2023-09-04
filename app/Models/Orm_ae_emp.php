<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orm_ae_emp extends Model
{
    use HasFactory;
    protected $table = 'ae_emp';
    // protected $primaryKey = 'IdProceso';
    public $timestamps = false;
    
    //relaciones ansiosas o anidadas de la tabla llamadas por defecto
    protected $with = [
        'empresa_aempresarial:IdEmp,Nombre'
    ];
    public function emp_ae(){
        return $this->belongsTo('App\Models\Orm_aempresarial', 'IdAE', 'IdAE');
    }

    public function empresa_aempresarial(){
        return $this->belongsTo('App\Models\Orm_empresa', 'IdEmp', 'IdEmp');
    }

}
