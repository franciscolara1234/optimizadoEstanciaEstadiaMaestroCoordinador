<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Exception;

class proceso extends Model
{
    use HasFactory;
    protected $table = 'proceso';
    protected $primaryKey = 'IdProceso';
    public $timestamps = false;

    public static function requestInsertDataProcess($data){
        try{
            $response = self::InsertDataProcess($data);
            if (isset($response["code"]) && $response["code"] == 200) {
                return $response;
            } else {
                return $response;
            }
        }catch(Exception $e){
            return array(
                "code"  => 500,
                "success"   => false,
                "message"   => $e->getMessage()
            );
        }
    }
    public static function InsertDataProcess($data){
        $arrayResponse = array();

        try {
            $ProcessId = DB::table('proceso')->insertGetId($data);

            $arrayResponse = array(
                "code"      => 200,
                "message"   => "Se ha agregado el registro",
                "id"        => $ProcessId
            );
        } catch (Exception $e) {
            $arrayResponse = array(
                "code"      => 500,
                "message"   => "Ocurrió un error al intentar agregar el registro. Error" . $e->getMessage()
            );
        }

        return $arrayResponse;
    }
}
