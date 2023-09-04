<?php

namespace App\Models;

use App\Models\Procesos;
use App\Models\Documentos;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Exception;

class detalledoc extends Model
{
    protected $table = 'detalledoc';
    protected $primaryKey='IdDoc';
    public $timestamps = false;

    use HasFactory;

    public static function requestInsertDetailsDocs($data) {

        try{

            $response = self::InsertDetailsDocs($data);
            if (isset($response["code"]) && $response["code"] == 200) {
                return $response;
            } else {
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

    public static function InsertDetailsDocs($data) {

        $arrayResponse = array();

        try{
            
            $detailsDocId = DB::table('detalledoc')->insertGetId($data);
            
            $arrayResponse = array(
                "code"      => 200,
                "message"   => "Se ha agragado el registro",
                "IdDoc" => $detailsDocId
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