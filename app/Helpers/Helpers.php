<?php
namespace App\Helpers;
use Carbon\Carbon;
use App\Models\Periodo;
use App\Models\Orm_proceso;



    //comprueba que el periodo escolar exista
    function  verificarPeriodoEscolar(){
        $date = Carbon::now();
        $anio = Carbon::parse($date)->year;
        $mes = Carbon::parse($date)->month;

        if ($mes >= 1 && $mes <= 4) {
            $numero = $anio . '01';
        } elseif ($mes >= 5 && $mes <= 8) {
            $numero = $anio . '02';
        } else {
            $numero = $anio . '03';
        }
        $validacionPeriodo = Periodo::where('Periodo', $numero)->first();
        $comprobarPeriodo = Periodo::where('Periodo', $numero)->exists();
        // $comprobarPeriodo = false;

        // $validacionPeriodo = 1;
        return array($validacionPeriodo, $comprobarPeriodo);
    }
    //asigna el titulo de la pagina
    function  asignarTituloPagina($identificadorProceso){
        // $tituloPagina = "";
        $arrayTituloProceso =["ESTANCIA 1","ESTANCIA 2","ESTADÍAS","SERVICIO SOCIAL","ESTADÍAS NACIONALES"] ;
        $tituloProceso = $arrayTituloProceso[$identificadorProceso-1];
        // $validacionPeriodo = 1;
        return $tituloProceso;
    }
    //asigna el proceso que la pagina
    function  asignarProcesoPagina($identificadorDocumento){
        $tituloPagina = "";
        if($identificadorDocumento == 6)
        {
                    $tituloPagina = "CÉDULA DE REGISTRO";
        }
        elseif($identificadorDocumento == 7)
        {
                   $tituloPagina = "DEFINICIÓN DE PROYECTO";
        }
        return $tituloPagina;
    }

    //asigna el color de estado del progreso de Vinculacion asigne.
    function progresoVinculacion($informacionProcesoElejido){
        $informacionProcesoElejido = $informacionProcesoElejido;
        // Orm_proceso::where('IdProceso', $identificadorProcesoAlumno)->get();
        $observaciones = '#F18989';//color hexadecimal rojo
        $aceptado = '#4FB420';//color hexadecimal verde
        $pediente = '#FEEED2';//color hexadecimal 
        $pedientsinIntento = '#E2BBF2';//color hexadecimal 
        //array con los documentos que se pueden usar, esta inicializado con el color sin intento.
        $documentos = [
        $document1 = $pedientsinIntento,
        $document2 = $pedientsinIntento,
        $document3 = $pedientsinIntento,
        $document4 = $pedientsinIntento,
        $document5 = $pedientsinIntento,
        $document6 = $pedientsinIntento,
        $document7 = $pedientsinIntento,
        $document8 = $pedientsinIntento,
        $document9 = $pedientsinIntento,
        $document10 = $pedientsinIntento,
        $document11 = $pedientsinIntento,
        $document12 = $pedientsinIntento,
        $document13 = $pedientsinIntento,
        $document14 = $pedientsinIntento,
        $document15 = $pedientsinIntento,
        $document16 = $pedientsinIntento,
        $document17 = $pedientsinIntento,
        $document18 = $pedientsinIntento
    ];
        //////prueba empieza aqui
        for ($i = 0; $i <= 17; $i++) {
            if(isset($informacionProcesoElejido[0]->detalle_doc_proceso[$i]->documentos_detallesDoc->IdEstado))//si existe un documento en el array con un IdEstado de parte de Vinculacion ingresa a la comprobacion de cual documento es 
            {
                // if(isset($informacionProcesoElejido[0]->detalle_doc_proceso[$i]->documentos_detallesDoc->IdEstado))
                // {
                    for ($j = 4; $j <= 21; $j++) {// for para comprobar que tipo de documento es y asignarle un color dependiendo del tipo del documento, el for epieza desde el 4 ya que el idtipoDoc empieza desde el id 4 hasta el id 21, SI SE reasigna los tippos de documentos este for debera reasignarse desde el 1 al 18.
                        if($informacionProcesoElejido[0]->detalle_doc_proceso[$i]->documentos_detallesDoc->IdTipoDoc==$j){//se veridfica cuan es el tipop de documento dependiendo de tipo de documento dado por el indice del for se asigna el color dependiendo del estado. 
                            $documentos[$j-4] = $informacionProcesoElejido[0]->detalle_doc_proceso[$i]->documentos_detallesDoc->IdEstado;// se puede quitar esta linea de codigo, pero se hace mas legible con la variable para no perderse.
                            if ($documentos[$j-4] == 2) {$documentos[$j-4] = $pediente;} 
                            else{if($documentos[$j-4] == 1){$documentos[$j-4] = $aceptado;}else{$documentos[$j-4]=$observaciones;}}///comprobacion de If anidados para saber que tipo de color se le asigna al Documento elejido. existen 4 tipos de estado, por default los documentos tendran el color por default de SinIntento, 2 es pendienter, 1 aceptado, y 3 rechazado con observaciones.
                        }  
                    }
                // }
            }
        }
        return $documentos;
    }



