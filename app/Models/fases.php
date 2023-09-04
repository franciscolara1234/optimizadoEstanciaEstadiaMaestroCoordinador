<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fase extends Model
{
    protected $table = 'fases';

    protected $primaryKey = 'Idfase';

    protected $fillable = [
        'Nombre'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];
}