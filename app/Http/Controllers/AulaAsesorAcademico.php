<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Periodo;
use App\Models\Orm_aa_academico;
use App\Models\Orm_aula_academico;
use App\Models\Orm_carrera;
use App\Models\Orm_tipo_usuario;
use App\Models\Orm_periodo_escolar;
use App\Models\Orm_tipo_proceso;
use App\Models\Orm_grado_academico;
use App\Models\Orm_proceso;
use App\Models\Orm_user; 
use function App\Helpers\Helpers;

use function App\Helpers\verificarPeriodoEscolar;

class AulaAsesorAcademico extends Controller
{


    // controlador comentado para filtrar los academicos y aulas ya no disponibles

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function AbrirAulaFormulario()
    // {
    //     //inicializacion para verificar que un periodo este abierto 
    //     $date = Carbon::now();
    //     $anio = Carbon::parse($date)->year;
    //     $mes = Carbon::parse($date)->month;

    //     if ($mes >= 1 && $mes <= 4) {
    //         $numero = $anio . '01';
    //     } elseif ($mes >= 5 && $mes <= 8) {
    //         $numero = $anio . '02';
    //     } else {
    //         $numero = $anio . '03';
    //     }


    //     // list($prueba1, $prueba2)= verificarPeriodoEscolar();
    //     $lista = verificarPeriodoEscolar();
    //     // list($periodoExistente, $periodoExistenteComprobacion) = verificarPeriodoEscolar();
    //     list($periodoExistente, $periodoExistenteComprobacion) = verificarPeriodoEscolar();

    //     // $periodoExistente = Periodo::where('Periodo', $numero)->first();
    //     // $periodoExistenteComprobacion = Periodo::where('Periodo', $numero)->exists();
    //     //verificacion en caso de existir periodo abierto se procede en realizar el filtro de de aulas sin asignar por carrera
    //     if ($periodoExistenteComprobacion=true) {
    //         //se crea variables para saber los tamaños de las tablas para crear un array multidimensional
    //         $procesosDisponibles = Orm_tipo_proceso::get()->count();
    //         $procesosSelect = Orm_tipo_proceso::get();
    //         $carrerasDisponibles = Orm_carrera::get()->count();

    //         // $totalMAxDeAulasPorPerido = (($carrerasDisponibles-1) * $procesosDisponibles ) ;

    //         //se crea el array multidimensional para saber que procesos con carreras aun no estan asignados 
    //         $carrerasConTipoProcesoDisponibles = [
    //             // $aulaSinAsignar = [ 
    //             //     'idCarrera'=>'',
    //             //     'idTipoProceso'=>'',
    //             //     'tipoProcesoConCarreraDisponibleSinAsignar' =>''
    //             // ]
    //         ];
    //         //ciclo for para recorrer el array e ingresar los filtros de las tablas 
    //         //primer recorrido se basa en el tamaño de la tabla tipo proceso, como se usara una tabla con los id de corrido la variable $i siempre sera tomada como el id de la tabla tipo proceso
    //         for($i=1; $i <= $procesosDisponibles; $i++){
    //             // el segundo ciclo se basa en el tamaño de la tabla carreras, cmo se utilizara una tabla con los ids de corrido, la variable $c se usara como el id de la tabla carrera
    //             for($c=1; $c<=($carrerasDisponibles-1); $c++){
                  
    //                 //se verifica que exista una registro en la tabla aula_asesor_academico, mediante el id de la tabla tipo proceso, el id carrera, combinado que pertenezca con el periodo actual que esta activo.
    //                 $verificarAulasExistentes = Orm_aula_academico::where('IdTipoProceso', $i)->where('IdPeriodo', $periodoExistente->IdPeriodo)->where('IdCarrera', $c)->get();


    //                 // $verificarAulasExistentes = Orm_aula_academico::where('IdTipoProceso', 3)->where('IdPeriodo', $periodoExistente->IdPeriodo)->where('IdCarrera', 3)->get()->count();

    //                 //se verifica que el tamaño del resultado de la consulta sea igual a 0, esta dira que aun no se ha creado un proceso con los id de las tablas carrera y tipo proceso en el periodo actual. 
    //                 if(sizeof($verificarAulasExistentes)==0){
    //                     $carreraSinAula = Orm_carrera::where('IdCarrera', $c)->get();
    //                     $tipoProcesoDisponibleDeCarrera = Orm_tipo_proceso::where('IdTipoProceso', $i)->get();
    //                     //se guarda la informacion necesaria para asignar un tipo de proceso al profesor
    //                     $carrerasConTipoProcesoDisponibles[$i-1][$c-1] = 
    //                     [
    //                         'idCarrera'=> $carreraSinAula[0]->IdCarrera,
    //                         'idTipoProceso' => $tipoProcesoDisponibleDeCarrera[0]->IdTipoProceso,
    //                         'tipoProcesoConCarreraDisponibleSinAsignar' => $tipoProcesoDisponibleDeCarrera[0]->nombreProceso.' '.$carreraSinAula[0]->NombreCarrera 
    //                     ];
    //                 }
    //                 //en caso de se encuentre un proceso con maestro academico asignado no se guarda nada pero se crea un array vacio
    //                 else{

    //                     $carreraSinAula = Orm_carrera::where('IdCarrera', $c)->get();

    //                     $tipoProcesoDisponibleDeCarrera = Orm_tipo_proceso::where('IdTipoProceso', $i)->get();
    //                     $carrerasConTipoProcesoDisponibles[$i-1][$c-1] = 
    //                     [

    //                     ];
    //                 } 
    //             }                        
    //         } 
    //         // dump($a);
    //         // dump($b);
    //         // dump($lista);
    //         return view('vistasCoordinadoresCarrera.coordinadoresAbrirAulasPeriodo')->with(['carrerasConTipoProcesoDisponibles' => $carrerasConTipoProcesoDisponibles])->with(['procesosSelect' => $procesosSelect]);

    //     }else{
    //         // return redirect()->to('/Periodo')->with('error', 'Periodo: ' . $numero . 'No hay periodo abierto para abrir Aulas, favor de iniciar un Periodo  ');
    //     }
    // }

    /**
     * Store a newly created resource in storage.
     *
      * @param  \Illuminate\Http\Request  $request
      * @return \Illuminate\Http\Response
      */
    // public function AsignarMaestroAulaProceso(Request $request)
    // {
    //     //se valida campos enviados 
    //     $this->validate(request(), [
    //         'select-tipo-proceso' => 'required|numeric',
    //         'select-carrera'  => 'required|numeric'
    //     ]);

    //     $userCarrera = Auth::user()->IdCarrera;

    //     //se procesan los campos enviados y se manda todos los usuarios que estan dados de alta con el tipo de usuario 4 que es el usuario de maestros o asesores academicos es con la funcion dentro del modelo Orm_ser de la tabla users que apunta al modelo Orm_aa-academico que hace referancia a la tabla relacionada aa (asesor academico) que esta relacionada con la tabla users
    //     $tipoProcesoSeleccionado = Orm_tipo_proceso::where('IdTipoProceso', $request->input('select-tipo-proceso'))->get();
    //     $carreraSeleccionada =  Orm_carrera::where('IdCarrera', $request->input('select-carrera'))->get();
    //     $maestros = Orm_user::select('id')->where('IdTipoUsu', 4)->with(['aa_academico_user'])->get();







    //     ///retorna la vista con los datos necesarios del formulario
    //     return view('admin.Asignar_maestro_aula_proceso')->with(['tipoProcesoSeleccionado'=>$tipoProcesoSeleccionado])->with(['carreraSeleccionada'=>$carreraSeleccionada])->with(['maestros'=>$maestros]);
    // }



    public function AsignarMaestroAulaCoordinacion()
    {
        //se valida campos enviados 
        // $this->validate(request(), [
        //     'select-tipo-proceso' => 'required|numeric',
        //     'select-carrera'  => 'required|numeric'
        // ]);

        
        list($periodoExistente, $periodoExistenteComprobacion) = verificarPeriodoEscolar();
        if($periodoExistenteComprobacion==true)
        {
                    //se procesan los campos enviados y se manda todos los usuarios que estan dados de alta con el tipo de usuario 4 que es el usuario de maestros o asesores academicos es con la funcion dentro del modelo Orm_ser de la tabla users que apunta al modelo Orm_aa-academico que hace referancia a la tabla relacionada aa (asesor academico) que esta relacionada con la tabla users
        $coordinadorCarrera = Auth::user()->IdCarrera;
        $procesosNombres = Orm_tipo_proceso::select('IdTipoProceso', 'nombreProceso')->get();
        $carreraSeleccionada =  Orm_carrera::where('IdCarrera', $coordinadorCarrera)->get();

        $maestros = Orm_user::select('id')->where('IdTipoUsu', 4)->with(['aa_academico_user'])->get();

        
        ///retorna la vista con los datos necesarios del formulario
        return view('vistasCoordinadoresCarrera.coordinadoresAbrirAulasPeriodo')->with(['carreraSeleccionada'=>$carreraSeleccionada])->with(['maestros'=>$maestros])->with(['procesosNombres'=>$procesosNombres]);

        }
        else
        {
            return view('vistasCoordinadoresCarrera.coordinadoresNOexistePeriodo');
        }
 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function CrearAulaProcesoAcademico(Request $request)
    {


        list($periodoExistente, $periodoExistenteComprobacion) = verificarPeriodoEscolar();
        if($periodoExistenteComprobacion==true)
        {
            
        //
        //inicializacion para verificar que un periodo este abierto que esta en este momento
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


        $periodoExistente = Periodo::where('Periodo', $numero)->first();

        //validando los datos que se enviaron desde el anterior formulario
        $this->validate(request(), [
            'select-id-maestro' => 'required|numeric',
            'select-tipo-proceso'  => 'required|numeric',
            'select-carrera'  => 'required|numeric'
        ]);

        //se busca si existe algun aula con los datos seleccionados 

        $comprobarExistenciaAula = Orm_aula_academico::where('IdTipoProceso',$request->input('select-tipo-proceso') )->where('IdCarrera', $request->input('select-carrera'))->Where('IdPeriodo', $periodoExistente->IdPeriodo)->where('IdUser', $request->input('select-id-maestro'))->exists();

        //si no existe un aula con los datos seleccionados se crea el registro
        if(($comprobarExistenciaAula)==false){
            $aula = new Orm_aula_academico;
            $aula->IdUser = $request->input('select-id-maestro');
            $aula->IdTipoProceso = $request->input('select-tipo-proceso');
            $aula->IdPeriodo = $periodoExistente->IdPeriodo;
            $aula->IdCarrera = $request->input('select-carrera');
            $aula->save();
            // dump($periodoExistente->IdPeriodo);
            return redirect()->to('AsignarMaestroAulaCoordinacion')->with('aulaCreada','Aula Creada');
        }
        //en caso de que ya exista se redirecciona y avisa al usuario que ya existe este registro de aula-proceso-academico
        else{
            return redirect()->to('AsignarMaestroAulaCoordinacion')->with('error','Aula Ya Existente');
        }

        }
        else
        {
            return view('vistasCoordinadoresCarrera.coordinadoresNOexistePeriodo');
        }




    }



    public function aulasDisponibles(){


        list($periodoExistente, $periodoExistenteComprobacion) = verificarPeriodoEscolar();
        if($periodoExistenteComprobacion==true)
        {
           
        //se llama a la funcion del helpers para saber la el actual periodo 
        list($periodoExistente, $periodoExistenteComprobacion) = verificarPeriodoEscolar();
        //se crea las variables que se usaran para las consultas 
        $idPeriodo = $periodoExistente->IdPeriodo;
        $idAseAcademico = Auth::user()->id;
        $tituloInicio = "Procesos Anteriores";
        $userCarrera = Auth::user()->IdCarrera;
        $aulasDisponibles = Orm_aula_academico::where('IdCarrera', $userCarrera)->where('IdPeriodo', $idPeriodo)->get();


        $maestroDiferenteCarrera = Orm_aula_academico::where('IdCarrera', $userCarrera)->whereHas('user_aula_academico.carrera_user', function ($query) use($userCarrera){
            $query->where('IdCarrera', '!=',  $userCarrera);
        })->whereHas('periodo_aula_academica', function ($query) use($idPeriodo){
            $query->where('IdPeriodo', $idPeriodo);
        })->count();


        $maestrosMismaCarrera = Orm_aula_academico::where('IdCarrera', $userCarrera)->whereHas('user_aula_academico.carrera_user', function ($query) use($userCarrera){
            $query->where('IdCarrera', $userCarrera);
        })->whereHas('periodo_aula_academica', function ($query) use($idPeriodo){
            $query->where('IdPeriodo', $idPeriodo);
        })->count();

        $conteoAulas = $aulasDisponibles->count();


        return view('vistasCoordinadoresCarrera.coordinadoresAulasDisponible')->with(['aulasDisponibles'=>$aulasDisponibles])->with(['maestrosMismaCarrera'=>$maestrosMismaCarrera])->with(['maestroDiferenteCarrera'=>$maestroDiferenteCarrera])->with(['conteoAulas'=>$conteoAulas]);
 
        }
        else
        {
            return view('vistasCoordinadoresCarrera.coordinadoresNOexistePeriodo');
        }

         
    }


}
