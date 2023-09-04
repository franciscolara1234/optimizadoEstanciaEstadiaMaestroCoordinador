<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orm_aempresarial extends Model
{
    use HasFactory;
    
    protected $table = 'ae';
    protected $primaryKey = 'IdAE';
    public $timestamps = false;
    
    //relaciones ansiosas o anidadas de la tabla llamadas por defecto
    protected $with = [
        'ae_emp'
    ];


    public function pro_aemp(){
        return $this->hasOne('App\Models\Orm_aempresarial_proceso', 'Idae', 'IdAE');
    }
    public function ae_emp(){
        return $this->hasOne('App\Models\Orm_ae_emp', 'IdAE', 'IdAE');
    }


}
