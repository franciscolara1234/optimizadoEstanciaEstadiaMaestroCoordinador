<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orm_empresa extends Model
{
    use HasFactory;
    protected $table = 'empresa';
    protected $primaryKey = 'IdEmp';
    public $timestamps = false;
    //relaciones ansiosas o anidadas de la tabla llamadas por defecto
    protected $with = [

        
    ];

    public function aempresarial_empresa(){
        return $this->hasOne('App\Models\Orm_ae_emp', 'IdEmp', 'IdEmp');
    }


}
