<?php

namespace App\Http\Controllers;


use App\Models\Orm_user;
use App\Models\Orm_aa_academico;
use App\Models\Orm_aula_academico;
use App\Models\Orm_aacademico_proceso;
use App\Models\documentos;
use App\Models\Orm_comentarios_docu;
use App\Models\aa_pp;
use App\Models\ae_pp;
use App\Models\Asesor_Emp;
use App\Models\emp_pp;
use App\Models\tipodoc;
use App\Models\detalledoc;
use App\Models\estadodoc;
use App\Models\proceso;
use App\Models\periodo;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;
use phpDocumentor\Reflection\Location;
use App\Helpers\Helpers;
use function App\Helpers\verificarPeriodoEscolar;


class Estancia1Controller extends Controller
{
    public function CrearPeriodoAlumno(Request $request, $idUsuario, $procesos)
    {
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
        $periodoExistente = periodo::where('Periodo', $numero)->first();
        $procesoExistente = proceso::where('IdUsuario', $idUsuario)->where('IdTipoProceso', $procesos)->where('IdPeriodo', $periodoExistente->IdPeriodo)->first();
        if (!$periodoExistente) {
            return redirect('estancia1/' . $procesos)->with('error', 'Periodo Actual todavia no existe, contacta con el administrador del sistema');
        } else {
            if ($procesoExistente) {
                return redirect('estancia1/' . $procesos)->with('error', 'ya tienes un proceso con este periodo');
            } else {
                $request->validate([
                    'asesorempresarial' => 'required',
                    'asesoracademico' => 'required',
                    'empresa' => 'required',
                ]);

                $userCarrera = Auth::user()->IdCarrera;
                $userID = Auth::user()->id;


                $asesorEmpresarial = $request->input('asesorempresarial');
                $asesorAcademico = $request->input('asesoracademico');
                $empresa = $request->input('empresa');
                

                $proceso = new proceso;
                $proceso->IdUsuario = $idUsuario;
                $proceso->IdTipoProceso = $procesos;
                $proceso->IdPeriodo = $periodoExistente->IdPeriodo;
                $proceso->IdCarrera = $userCarrera;
                $proceso->save();
                $idProceso = $proceso->IdProceso;
                $relacionAA = new aa_pp;
                $relacionAA->IdAsesor = $asesorAcademico;
                $relacionAA->IdProceso = $idProceso;

                $relacionAA->save();
                
                $AE = new Asesor_emp;
                $AE->Nombre = $asesorEmpresarial;
                $AE->save();
         
                $nomAE = DB::table('ae')->select('IdAE')->orderBy('IdAE', 'desc')->first();
                // ->where('Nombre', $asesorEmpresarial)->first();
                $idAE=$nomAE->IdAE;
        

                // select('rol')->orderBy('usu_id', 'desc')->first();

                $relacionAE = new ae_pp;
                $relacionAE->Idae = $idAE;
                $relacionAE->IdProceso = $idProceso;
                $relacionAE->save();
                
                
                $relacionEmp = new emp_pp;
                $relacionEmp->IdEmp = $empresa;
                $relacionEmp->IdProceso = $idProceso;
                $relacionEmp->save();
                return redirect('estancia1/' . $procesos)->with('success', 'Dado de alta en periodo actual');
            }
        }
        return view('estancia1.index')->with('error', 'error desconocido favor de intentarlo en otro momento');
    }

    //ver todos los procesos
    public function ver($proces)
    { 

        //se busca la funcion del helper verificarPeriodoEscolar para saber si el periodo escolar existe y traer los datos del periodo

        list($periodoExistente, $periodoExistenteComprobacion) = verificarPeriodoEscolar();

        //Se obtiene el IdCarrera del usuario para Obtener la consulta  
        $userCarrera = Auth::user()->IdCarrera;
        // se crea la consulta buscando el aula del proceso con el profesor elejido. filtrando con el IdCarrera del usuario, IdPeriodo Actual abierto, IdTipoProceso que el usuario selecciono con la consulta anidada usando la funcion User_aula_academico que se ncuentra en el Orm_aula_academico, donde solo se pide el Id del user, y el user trae consigo mismo por defecto la consulta anidada del perfil del User que esta ingresado en el registro de la tabla aula_asesor_academico
        $AulaDisponibleCarera = Orm_aula_academico::select('IdCarrera', 'IdPeriodo', 'IdUser')->where('IdCarrera', $userCarrera)->where('IdPeriodo', $periodoExistente->IdPeriodo)->where('IdTipoProceso', $proces)->with("user_aula_academico:id")->get();

        //Se creea consulta para saber si existe un aula del proceso seleccionado con el profesor.
        $existeAulaCarrera = Orm_aula_academico::where('IdCarrera', $userCarrera)->where('IdPeriodo', $periodoExistente->IdPeriodo)->where('IdTipoProceso', $proces)->exists();

        // $idPeriodo = $periodoExistente->IdPeriodo;
        // $idAseAcademico = 9;

        // $procesosAlumno = Orm_aacademico_proceso::with(['proceso' => function ($query) use($idPeriodo){
        //     $query->where('IdPeriodo', $idPeriodo);
        // }])->with(['aa_academico'  => function ($query) use($idAseAcademico){
        //     $query->where('IdAsesor', $idAseAcademico);
        // }])->get();

        // $cantidadProcesos = Orm_aacademico_proceso::with(['proceso' => function ($query) use($idPeriodo){
        //     $query->where('IdPeriodo', $idPeriodo);
        // }])->with(['aa_academico'  => function ($query) use($idAseAcademico){
        //     $query->where('IdAsesor', $idAseAcademico);
        // }])->count();
        

        // dump($AulaDisponibleCarera);
        // dump($procesosAlumno);
        // dump($cantidadProcesos);
        // dump($userCarrera);

        //se crea condicional para saber si existe un periodo actual activo y un aula con profesor abierto
        if($periodoExistenteComprobacion===true and $existeAulaCarrera==true){

 //*funcional
        $userID = Auth::user()->id;
        $name = ['Estancia I', 'Estancias II', 'Estadía', 'Servicio Social', 'Estadías Nacionales'];
        //!cambiar este numero si se quiere agregar un nuevo proceso y tambien agregar el nombre en $name
        if ($proces > 0 && $proces <= 5) { //comprueba si el numero es de algun proceso del 1...5
            $var = [$proces, $name[$proces - 1]]; //guarda el numero y nombre del proceso
        
          

        } else return redirect('inicio');

        $tiposdocumentos = DB::table('tipodoc')->get();

        $documentos = DB::table('documentos')
            ->join('detalledoc', 'documentos.IdDoc', "=", 'detalledoc.IdDoc')
            ->join('proceso', 'proceso.IdProceso', "=", "detalledoc.IdProceso")->where('IdPeriodo', $periodoExistente->IdPeriodo)
            ->where('IdTipoProceso', $proces)
            ->where('IdUsuario', $userID)
            ->get();

        $proceso = DB::table('proceso')
        ->where('IdTipoProceso',$proces)
        ->where('IdUsuario', $userID)
        ->get();

        $asesoresEmpresariales = DB::table('ae')->get();
        $asesoresAcademicos = DB::table('aa')->get();
        $empresas = DB::table('empresa')->get();





        if ($proceso->count() == 0) {

        } else {
            $tipoProcesoSeleccionado = intval($var[0]);

            // dump($var);
            // dump((int)$var[0]);
            // dump($tipoProcesoSeleccionado);
            $procesoActual = DB::table('periodo')
                ->where('IdPeriodo', $proceso[0]->IdPeriodo)->get()->first();

            return view('estancia1', ['proceso' => $var, 'documentos' => $tiposdocumentos, 'documentacion' => $documentos, 'ae' => $asesoresEmpresariales, 'aa' => $asesoresAcademicos, 'periodoActual'=>$procesoActual,'empresas'=>$empresas, 'AulaDisponibleCarera' =>$AulaDisponibleCarera, 'tipoProcesoSeleccionado'=>$tipoProcesoSeleccionado]);
        }

        // dump($periodoExistente);
        // dump($periodoExistenteComprobacion);
        
   

        return view('estancia1', ['proceso' => $var, 'documentos' => $tiposdocumentos, 'documentacion' => $documentos, 'ae' => $asesoresEmpresariales, 'aa' => $asesoresAcademicos, 'periodoActual' =>null,'empresas'=>$empresas, 'AulaDisponibleCarera' =>$AulaDisponibleCarera]);

        }
        else
        {
            // return view('/inicio');
            return redirect('inicio/')->with('error', 'No hay periodo o aula abiertas.');
        }
       
    }

    public function actualizarDocumento(){
        
    }

    //subir documento sin datos carga horaria
    //subir documenos de cualquier proceso
    public function subir_carga_horaria_estancia1(Request $request, $name, $proces, $IdTipoDoc)
    {
        $userID = Auth::user()->id;
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
        $periodoExistente = periodo::where('Periodo', $numero)->first();
        $procesoExistente = proceso::where('IdUsuario', $userID)->where('IdTipoProceso', $proces)->where('IdPeriodo', $periodoExistente->IdPeriodo)->first();

        if ($procesoExistente) {
            $Ndoc = [
                'carga_horaria', 'constancia_derecho', 'carta_responsiva', 'f01', 'f02', 'f03', 'f04', 'f05', 'carta_compromiso', 'reporte_mensual', 'reporte_mensual', 'reporte_mensual', 'reporte_mensual', 'reporte_mensual', 'reporte_mensual',
                'reporte_mensual', 'reporte_mensual', 'reporte_mensual', 'reporte_mensual', 'reporte_mensual', 'reporte_mensual'
            ];
            $arrayResult = array();
            try {
                if ($request->hasFile('docs_archivo')) {
                    $archivo = $request->file('docs_archivo');
                    $nombreDoc = $name . $Ndoc[$IdTipoDoc - 1] . $proces . '.pdf';
                    $RutaDeGuardado = public_path() . '\documentos';
                    $archivo->move($RutaDeGuardado, $nombreDoc);
                    $data5 = array('ruta' => $nombreDoc, 'IdEstado' => 2, 'IdTipoDoc' => $IdTipoDoc, 'Usuario' => $userID);
                    $response = documentos::requestInsertDoc($data5);
                    if (isset($response["code"]) && $response["code"] == 200) {
                        $arrayResult = array(
                            'Response'  => array(
                                'ok'        => true,
                                'message'   => "Se ha guardado el registro",
                                'code'      => "200",
                            ),
                        );
                    } else {
                        $arrayResult = array(
                            'Response'  => array(
                                'ok'        => false,
                                'message'   => $response['message'],
                                'code'      => $response['code']
                            ),
                        );
                    }
                    //controlador de estatus
                    $data6 = array(
                        'IdDoc' =>  $response['IdDoc'],
                        'IdProceso' =>  $procesoExistente->IdProceso,
                    );
                    $response_documentos = detalledoc::requestInsertDetailsDocs($data6);

                    if (isset($response_documentos["code"]) && $response_documentos["code"] == 200) {
                    } else {
                        $arrayResult = array(
                            'Response_2'  => array(
                                'ok'        => false,
                                'message'   => $response_documentos['message'],
                                'code'      => $response_documentos['code']
                            ),
                        );
                    }
                }
            } catch (\Illuminate\Database\QueryException $ex) {
                $arrayResult = array(
                    'Response_3'  => array(
                        'message'   => "Error: " . " - " . "Fallo :v",
                        "code"      => "500"
                    )
                );
            } catch (Exception $ex) {
                $arrayResult = array(
                    'Response_3' => array(
                        'message' => "Error: " . " - " . $ex->getMessage(),
                        "code"    => "500"
                    )
                );
            }
            $msj = json_encode($arrayResult);
            if ($msj == '{"Response":{"ok":true,"message":"Se ha guardado el registro","code":"200"}}') {
                return redirect('estancia1/' . $proces)->with('success', 'Documento agregado');
            } else {
                return redirect('estancia1/' . $proces)->with('errorPDF', 'Hay un error en el nombre de tu pdf' . $msj);
            }
        } else {
            return redirect('estancia1/' . $proces)->with('error', 'Favor de darse de alta en periodo');
        }
    }
    //actualizar documento carga horaria



    public function actualizar_carga_horaria_estancia1(Request $request, $name, $proces, $idDoc)
    { //*funcional
        //!Al subir un documento se actualiza el registro de la tabla documentos
        $Ndoc = [
            'carga_horaria', 'constancia_derecho', 'carta_responsiva', 'f01', 'f02', 'f03', 'f04', 'f05', 'carta_compromiso',
            'reporte_mensual', 'reporte_mensual', 'reporte_mensual', 'reporte_mensual', 'reporte_mensual', 'reporte_mensual',
            'reporte_mensual', 'reporte_mensual', 'reporte_mensual', 'reporte_mensual', 'reporte_mensual', 'reporte_mensual'
        ];
        $request->validate([
            $Ndoc[$idDoc - 1] => "required|mimetypes:application/pdf|max:30000"
        ]);
        $arrayResult = array();
        try {
            if ($request->hasFile($Ndoc[$idDoc - 1])) {
                
                $archivo = $request->file($Ndoc[$idDoc - 1]);
                $nombreAF = $name . $Ndoc[$idDoc - 1] . $proces . $idDoc . '.pdf'; //!ej. 202000052Carga_horaria1
                $archivo->move(public_path() . '/documentos/', $nombreAF);
            }
            switch ($idDoc) {
                case '1':
                    $data5 = array('nombre_c_h'   => $nombreAF, 'estado_c_h' => 1);
                    $response = documentos::requestInsertcargaH($data5);
                    break;
                case '2':
                    $data5 = array('nombre_c_d'   => $nombreAF, 'estado_c_d' => 1);
                    $response = documentos::requestInsertconstanciaD($data5);
                    break;
                case '3':
                    $data5 = array('nombre_c_r'   => $nombreAF, 'estado_c_r' => 1);
                    $response = documentos::requestInsertcartaR($data5);
                    break;
                case '4':
                    $data5 = array('nombre_c_p'   => $nombreAF, 'estado_c_p' => 1);
                    $response = documentos::requestInsertcartaP($data5);
                    break;
                case '5':
                    $data5 = array('nombre'   => $nombreAF, 'estado' => 1);
                    $response = documentos::requestInsertcartaA($data5);
                    break;
                case '6':
                    $data5 = array('nombre_c_r'   => $nombreAF, 'estado_c_r' => 1);
                    $response = documentos::requestInsertCedulaR($data5);
                    break;
                case '7':
                    $data5 = array('nombre_d_p'   => $nombreAF, 'estado_d_p' => 1);
                    $response = documentos::requestInsertDefinicionP($data5);
                    break;
                case '8':
                    $data5 = array('nombre_c_l'   => $nombreAF, 'estado_c_l' => 1);
                    $response = documentos::requestInsertcartaL($data5);
                    break;
                case '9':
                    $data5 = array('nombre_c_c'   => $nombreAF, 'estado_c_c' => 1);
                    $response = documentos::requestInsertcargaC($data5);
                    break;
                case '10':
                    $data5 = array('nombre_r_m'   => $nombreAF, 'estado_r_m' => 1);
                    $response = documentos::requestInsertcargarp($data5);
                    break;
                case '11':
                    $data5 = array('nombre_r_m'   => $nombreAF, 'estado_r_m' => 1);
                    $response = documentos::requestInsertcargarp($data5);
                    break;
                case '12':
                    $data5 = array('nombre_r_m'   => $nombreAF, 'estado_r_m' => 1);
                    $response = documentos::requestInsertcargarp($data5);
                    break;
                case '13':
                    $data5 = array('nombre_r_m'   => $nombreAF, 'estado_r_m' => 1);
                    $response = documentos::requestInsertcargarp($data5);
                    break;
                case '14':
                    $data5 = array('nombre_r_m'   => $nombreAF, 'estado_r_m' => 1);
                    $response = documentos::requestInsertcargarp($data5);
                    break;
                case '15':
                    $data5 = array('nombre_r_m'   => $nombreAF, 'estado_r_m' => 1);
                    $response = documentos::requestInsertcargarp($data5);
                    break;
                case '16':
                    $data5 = array('nombre_r_m'   => $nombreAF, 'estado_r_m' => 1);
                    $response = documentos::requestInsertcargarp($data5);
                    break;
                case '17':
                    $data5 = array('nombre_r_m'   => $nombreAF, 'estado_r_m' => 1);
                    $response = documentos::requestInsertcargarp($data5);
                    break;
                case '18':
                    $data5 = array('nombre_r_m'   => $nombreAF, 'estado_r_m' => 1);
                    $response = documentos::requestInsertcargarp($data5);
                    break;
                case '19':
                    $data5 = array('nombre_r_m'   => $nombreAF, 'estado_r_m' => 1);
                    $response = documentos::requestInsertcargarp($data5);
                    break;
                case '20':
                    $data5 = array('nombre_r_m'   => $nombreAF, 'estado_r_m' => 1);
                    $response = documentos::requestInsertcargarp($data5);
                    break;
                case '21':
                    $data5 = array('nombre_r_m'   => $nombreAF, 'estado_r_m' => 1);
                    $response = documentos::requestInsertcargarp($data5);
                    break;
                default:
                    # code...
                    break;
            }

            if (isset($response["code"]) && $response["code"] == 200) {
                $arrayResult = array(
                    'Response'  => array(
                        'ok'        => true,
                        'message'   => "Se ha guardado el registro",
                        'code'      => "200",
                    ),
                );
            } else {
                $arrayResult = array(
                    'Response'  => array(
                        'ok'        => false,
                        'message'   => $response['message'],
                        'code'      => $response['code']
                    ),
                );
            }
            //$NcolBD=['id_c_horaria','id_c_derecho','id_c_responsiva','id_c_presentacion',
            //'id_c_aceptacion','id_c_registro','id_d_proyecto','id_c_liberacion'];
            $carta = documentos::find($request->get('id_docs'));
            switch ($idDoc) {
                case 1:
                    $carta->id_c_horaria = $response['id'];
                    break;
                case 2:
                    $carta->id_c_derecho = $response['id'];
                    break;
                case 3:
                    $carta->id_c_responsiva = $response['id'];
                    break;
                case 4:
                    $carta->id_c_presentacion = $response['id'];
                    break;
                case 5:
                    $carta->id_c_aceptacion = $response['id'];
                    break;
                case 6:
                    $carta->id_c_registro = $response['id'];
                    break;
                case 7:
                    $carta->id_d_proyecto = $response['id'];
                    break;
                case 8:
                    $carta->id_c_liberacion = $response['id'];
                    break;
                case 9:
                    $carta->id_c_compromiso = $response['id'];
                    break;
                case 10:
                    $carta->id_r_mensual = $response['id'];
                    break;
                case 11:
                    $carta->id_r_mensual2 = $response['id'];
                    break;
                case 12:
                    $carta->id_r_mensual3 = $response['id'];
                    break;
                case 13:
                    $carta->id_r_mensual4 = $response['id'];
                    break;
                case 14:
                    $carta->id_r_mensual5 = $response['id'];
                    break;
                case 15:
                    $carta->id_r_mensual6 = $response['id'];
                    break;
                case 16:
                    $carta->id_r_mensual7 = $response['id'];
                    break;
                case 17:
                    $carta->id_r_mensual8 = $response['id'];
                    break;
                case 18:
                    $carta->id_r_mensual9 = $response['id'];
                    break;
                case 19:
                    $carta->id_r_mensual10 = $response['id'];
                    break;
                case 20:
                    $carta->id_r_mensual11 = $response['id'];
                    break;
                case 21:
                    $carta->id_r_mensual12 = $response['id'];
                    break;
                default:
                    # code...
                    break;
            }
            //$carta->id_proceso=1;
            $carta->save();
        } catch (\Illuminate\Database\QueryException $ex) {
            $arrayResult = array(
                'Response'  => array(
                    'message'   => "Error: " . " - " . "Fallo :v",
                    "code"      => "500"
                )
            );
        } catch (Exception $ex) {
            $arrayResult = array(
                'Response' => array(
                    'message' => "Error: " . " - " . $ex->getMessage(),
                    "code"    => "500"
                )
            );
        }
        $msj = json_encode($arrayResult);
        if ($msj == '{"Response":{"ok":true,"message":"Se ha guardado el registro","code":"200"}}') {
            return redirect('estancia1/' . $proces)->with('success', 'Documento agregado');
        } else {
            return redirect('estancia1/' . $proces)->with('errorPDF', 'Hay un error en el nombre de tu pdf');
        }
    }
    //ver observaciones del documento

    //recuperar las observaciones en caso de haber 

    public function verObservaciones1_carga_horaria($proces, $idDoc, $id)
    { //*funcional
        $Ntab = [
            'carga_horaria', 'constancia_derecho', 'carta_responsiva', 'carta_presentacion', 'carta_aceptacion',
            'cedula_registro', 'definicion_proyecto', 'carta_liberacion', 'carta_compromiso', 'reporte_mensual', 'reporte_mensual2'
        ];
        $Ncol = [
            'observaciones_c_h', 'observaciones_c_d', 'observaciones_c_r', 'observaciones_c_p', 'observaciones',
            'observaciones_c_r', 'observaciones_d_p', 'observaciones_c_l', 'observaciones_c_c', 'observaciones_r_m', 'observaciones_r_m'
        ];
        $observ = DB::table($Ntab[$idDoc - 1])
            ->select($Ncol[$idDoc - 1] . ' as observacion')
            ->where('id', $id)
            ->get();
        //dd($observ);
        return view('usuario.observaciones_carga_horaria', ['datos' => $observ, 'proceso' => $proces]);
    }


    //cancelar el documento enviado 

    public function cancelar_documento_alumno(Request $request, $proces, $idDoc)
    {
        $nombreDoc = $request->input('nombreDoc');
        $documento = documentos::find($idDoc);
        $relacionDocumentos = detalledoc::where('IdDoc', $idDoc)->first();
        $documento->delete();
        $relacionDocumentos->delete();
        $path = public_path() . '/documentos/' . $nombreDoc;
        if (File::exists($path)) {
            File::delete($path);
            return redirect('estancia1/' . $proces)->with('success', 'Documento Cancelada: ' . $nombreDoc);
        } else {
            return redirect('estancia1/' . $proces)->with('error', 'error cancelando: ' . $nombreDoc . ' Favor de intentarlo mas tarde');
        }
    }

    public function editar_documento_alumno(Request $request,  $idDoc, $idProceso)
    {

        $request->validate([
            'docs_archivo' => "required|mimetypes:application/pdf|max:30000"
        ]);


        $documento = documentos::find($idDoc);
        $nombreDoc = $documento->ruta;

        // $archivo = $request->file($Ndoc[$idDoc - 1]);
        // $relacionDocumentos = detalledoc::where('IdDoc', $idDoc)->first();
        if(($documento->estadoAca) == 2)
        {
                    // $comentario = Orm_comentarios_docu::where('IdDoc', $idDoc)->where('TipoComentario', 1)->first();
                    // $comentario->delete(); // Elimina el comentario
                    $path = public_path() . '/documentos/' . $nombreDoc; //ruta donde se encuentra el archivo actual a eliminar
                    // $path2 = public_path().'/documentos/';
                    if (File::exists($path)) 
                    { //existe el archivo 
                        $documento->estadoAca = NULL;
                        $documento->save();
                        File::delete($path); //se elimina el archivo 

                        if ($request->hasFile('docs_archivo')) //existe archivo en el formulario enviado 
                        {
                            $archivo = $request->file('docs_archivo');//se recupera el archivo 
                            if ($archivo != null) 
                            {//si archivo existe o es diferente de null
                                $RutaDeGuardado = public_path().'/documentos/';//se obtiene la ruta donde se guardara el archivo
                                $archivo->move($RutaDeGuardado, $nombreDoc);//se guarda el archivo en la ruta y con el nombre seleccionado
                            }
                            else
                            {
                                return redirect('estancia1/' . $idProceso)->with('error', 'segundo error NO existe el archivo: ' . $nombreDoc . ' Favor de intentarlo mas tarde');
                            }
                        }
                        // else
                        // {
                        //     return redirect('estancia1/' . $idProceso)->with('error', 'error NO existe el archivo: ' . $nombreDoc . ' Favor de intentarlo mas tarde');
                        // }
                        return redirect('estancia1/' . $idProceso)->with('success', 'Documento Académico Cambiado Con Exito: ' . $nombreDoc);
                    }
        }
        elseif($documento->IdEstado == 3)
        {
            $path = public_path() . '/documentos/' . $nombreDoc; //ruta donde se encuentra el archivo actual a eliminar
            if (File::exists($path))//existe el archivo en la carpeta public/documentos dentro del path 
            {  
                $documento->IdEstado = 2; //se cambia el estado de de vinculacion
                $documento->comentario = '';
                $documento->save(); //se guarda el cambio 
                File::delete($path); //se elimina el archivo 
                if ($request->hasFile('docs_archivo')) //existe archivo en el formulario enviado 
                {
                    $archivo = $request->file('docs_archivo');//se recupera el archivo del formulario 
                    if ($archivo != null) //existe el archivo
                    {//si archivo existe o es diferente de null
                        $RutaDeGuardado = public_path().'/documentos/';//se obtiene la ruta donde se guardara el archivo
                        // $nombreDoc = 'nombrePersonalizado.pdf';
                        $archivo->move($RutaDeGuardado, $nombreDoc);//se guarda el archivo en la ruta y con el nombre seleccionado
                    }
                    else
                    {
                        return redirect('estancia1/' . $idProceso)->with('error', 'segundo error NO existe el archivo: ' . $nombreDoc . ' Favor de intentarlo mas tarde');
                    }
                }

                return redirect('estancia1/' . $idProceso)->with('success', 'Documento Académico Cambiado Con Exito: ' . $nombreDoc);
            }   
        }
        elseif($documento->IdEstado == 2 && $documento->estadoAca == NULL || $documento->IdEstado == 2 && $documento->estadoAca == 1)
        {  
            $path = public_path() . '/documentos/' . $nombreDoc; //ruta donde se encuentra el archivo actual a eliminar
            if (File::exists($path))//existe el archivo en la carpeta public/documentos dentro del path 
            {  
                // $documento->IdEstado = 2; //se cambia el estado de de vinculacion
                // $documento->save(); //se guarda el cambio 

                File::delete($path); //se elimina el archivo 
                if ($request->hasFile('docs_archivo')) //existe archivo en el formulario enviado 
                {
                    $archivo = $request->file('docs_archivo');//se recupera el archivo del formulario 
                    if ($archivo != null) //existe el archivo
                    {//si archivo existe o es diferente de null
                        $RutaDeGuardado = public_path().'/documentos/';//se obtiene la ruta donde se guardara el archivo
                        // $nombreDoc = 'nombrePersonalizado.pdf';
                        $archivo->move($RutaDeGuardado, $nombreDoc);//se guarda el archivo en la ruta y con el nombre seleccionado
                    }
                    else
                    {
                        return redirect('estancia1/' . $idProceso)->with('error', 'segundo error NO existe el archivo: ' . $nombreDoc . ' Favor de intentarlo mas tarde');
                    }
                }
                return redirect('estancia1/' . $idProceso)->with('success', 'Documento Cambiado Con Exito: ' . $nombreDoc);
            } 
        }
        
        return redirect('estancia1/' . $idProceso)->with('error', 'error cancelando: ' . $nombreDoc . ' Favor de intentarlo mas tarde');

    }
}
                    // elseif(($documento->IdEstado) == 3) 
                    // {

                    //     $documento->IdEstado = 2;
                    //     $documento->save();
            
                    //     $comentario = Orm_comentarios_docu::where('IdDoc', $idDoc)->where('TipoComentario', 2)->first();
            
                    //     $comentario->delete(); // Elimina el registro
            
                        
                    //     $path = public_path() . '/documentos/' . $nombreDoc;
                    //     $path2 = public_path().'/documentos/';
            
                    //     if (File::exists($path)) 
                    //     {
            
            
                    //         File::delete($path);
            
            
                    //         $documento = documentos::find($idDoc);
                    //         $nombreDoc = $documento->ruta;
            
            
                    //         if ($request->hasFile('docs_archivo')) 
                    //         {
                    //             $archivo = $request->file('docs_archivo');
                    //             if ($archivo != null) 
                    //             {
                    //                 $RutaDeGuardado = public_path().'/documentos/';
                    //                 // $nombreDoc = 'nombrePersonalizado.pdf';
                    //                 $archivo->move($RutaDeGuardado, $nombreDoc);
                    //             }
                    //             else
                    //             {
                    //                 return redirect('estancia1/' . $idProceso)->with('error', 'segundo error NO existe el archivo: ' . $nombreDoc . ' Favor de intentarlo mas tarde');
                    //             }
                    //         }
                    //         else
                    //         {
                    //             return redirect('estancia1/' . $idProceso)->with('error', 'error NO existe el archivo: ' . $nombreDoc . ' Favor de intentarlo mas tarde');
                    //         }
            
                                            
                    //         return redirect('estancia1/' . $idProceso)->with('success', 'Documento Vinculación Cambiado Con Exito: ' . $nombreDoc);
            
                        
                    //     }

                    // }

            // $relacionDocumentos->delete();




