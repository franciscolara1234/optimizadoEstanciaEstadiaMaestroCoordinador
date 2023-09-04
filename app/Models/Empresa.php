<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use Exception;

class Empresa extends Model
{
    protected $table = 'empresa';
    protected $primaryKey='IdEmp';
    public $timestamps = false;

    /**
     * LLamada a la peticion para agregar un nuevo marcador
     * Tambien devuelve la llamada si Ocurrió algun error
    */

    protected $fillable = [
        // 'IdEmp',
        'Nombre',
        'Direccion',
        'Correo',
        'Telefono',
        'RFC',
        'Giro',
        'URLemp',
        'fk_TipoEmp',
        'fk_TamañoEmp'
    ];

    public function tipoEmp()
    {
        return $this->belongsTo(TipoEmp::class, 'fk_TipoEmp', 'id_Tipo_Emp');
    }

    public function tipoEmpresa()
    {
        return $this->belongsTo(TipoEmp::class, 'fk_TipoEmp');
    }

    public function tamañoEmpresa()
    {
        return $this->belongsTo(TipoEmp::class, 'fk_TamañoEmp');
    }

    public static function requestInsertEmpresa($data) {

        try{

            $response = self::insertEmpresa($data);
            if (isset($response["code"]) && $response["code"] == 200) {
                return $response;
            }else{
                return $response;
            }
        }catch(Exception $e) {
            return array(
                "code" => 500,
                "success" => false,
                "message" => $e->getMessage()
            );
        }
    }

    /**
     * Agrega una marca nueva
    */

    public static function insertEmpresa($data) {

        $arrayResponse = array();

        try{
            $empresaId = DB::table('empresa')->insertGetId($data);

            $arrayResponse = array(
                "code"      => 200,
                "message"   => "Se ha agragado el registro",
                "id" => $empresaId
            );
        }catch (Exception $e) {
            $arrayResponse = array(
                "code"      => 500,
                "message"   => "Ocurrio un error al intentar agregar el registro. Error" . $e->getMessage()
            );
        }

        return $arrayResponse;
    }
}
