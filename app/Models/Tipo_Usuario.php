<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class usuarios extends Model
{
    protected $table = 'tipousuario';
    use HasFactory;

    public static function getAdmins() {
        return DB::table('tipousuario as tu') //llama a bd a la tabla "tipousuario" y asigna nombre "tu"
            ->select('tu.IdTipoUsu')
            ->whereRaw("(tu.NombreTipo = 'Admin'")
            ->get();
    }
    
    public static function getAsesorEmpresarial() {
        return DB::table('tipousuario as tu') //llama a bd a la tabla "tipousuario" y asigna nombre "tu"
            ->select('tu.IdTipoUsu')
            ->whereRaw("(tu.NombreTipo = 'Asesor Empresarial'")
            ->get();
    }
    public static function getAsesorAcademico() {
        return DB::table('tipousuario as tu') //llama a bd a la tabla "tipousuario" y asigna nombre "tu"
            ->select('tu.IdTipoUsu')
            ->whereRaw("(tu.NombreTipo = 'Asesor Academico'")
            ->get();
    }
    public static function getDirectorVinculacion() {
        return DB::table('tipousuario as tu') //llama a bd a la tabla "tipousuario" y asigna nombre "tu"
            ->select('tu.IdTipoUsu')
            ->whereRaw("(tu.NombreTipo = 'Director de Vinculacion'")
            ->get();
    }
    public static function getAlumno() {
        return DB::table('tipousuario as tu') //llama a bd a la tabla "tipousuario" y asigna nombre "tu"
            ->select('tu.IdTipoUsu')
            ->whereRaw("(tu.NombreTipo = 'Alumno'")
            ->get();
    }

}
