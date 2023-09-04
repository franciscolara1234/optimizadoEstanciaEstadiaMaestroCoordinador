<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orm_calificaciones extends Model
{
    use HasFactory;
    protected $table = 'calificaciones';
    protected $primaryKey = 'IdCalificaciones';
    public $timestamps = false;
    protected $fillable = [
        'IdUser',
        'IdProceso',
        'TipoCalificaciones',
        'cal1',
        'cal2',
        'cal3',
        'cal4',
        'cal5',
        'cal6',
        'cal7',
        'cal8',
        'cal9',
        'cal10',
        'cal11',
        'cal12',
        'cal_final'
    ];
    protected $with = [

        ];

        public function proceso_calificaciones(){
            return $this->belongsTo('App\Models\Orm_proceso', 'IdProceso', 'IdProceso');
        }
    
}
