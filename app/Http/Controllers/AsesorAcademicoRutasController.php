<?php

namespace App\Http\Controllers;

use Exception;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\proceso_asignatura_alumno;
use App\Models\Orm_aa_academico;
use App\Models\Orm_aula_academico;
use App\Models\Orm_carrera;
use App\Models\Orm_user;
use App\Models\Orm_comentarios_docu;
use App\Models\Orm_calificaciones;
use App\Models\Orm_documentos;
use App\Models\Orm_detalles_doc;
use App\Models\Orm_alumnos_perfil;
use App\Models\Orm_aacademico_proceso;
use App\Models\Orm_aempresarial_proceso;
use App\Models\Orm_estado_docu;
use App\Models\Orm_grado_academico;
use App\Models\Orm_periodo_escolar;
use App\Models\Orm_proceso;
use App\Models\Orm_tipo_doc;
use App\Models\Orm_tipo_proceso;
use App\Models\Orm_tipo_usuario;
use App\Models\User;

use function App\Helpers\verificarPeriodoEscolar;
use function App\Helpers\asignarTituloPagina;
use function App\Helpers\asignarProcesoPagina;
use function App\Helpers\progresoVinculacion;

use App\Models\calificacion_asesor_academico_alumno;

class AsesorAcademicoRutasController extends Controller
{
    //esta parte se tiene que mejorar usando ajax para evitar la carga lenta del datatable y el datable se rellene de parte del servidor
    public function homeAseAca($procesoElegido){

        //se llama a la funcion del helpers para saber la el actual periodo 
        list($periodoExistente, $periodoExistenteComprobacion) = verificarPeriodoEscolar();
        
        $userCarrera = Auth::user()->IdCarrera;
        
        //EL TITULO DE PAGIAN SE PUEDE SIMPLIFICAR CON UN HELPER ENVIANDo AL HELPER EL PROCESO ELEGIDO
        
        $tituloPagina = asignarTituloPagina($procesoElegido);
 
        //se crea las variables que se usaran para las consultas 
        // $idPeriodo = $periodoExistente->IdPeriodo;
        $idAseAcademico = Auth::user()->id;
        $tituloInicio = "Procesos Anteriores";
        //se busca el IdAsesor de la tabla aa que es el perfil del la tabla User que le pertenecen a los usarios con el tipo de usuario 4 o usuario asesorAcademico
        $idPerfilAcademico = Orm_aa_academico::where('IdUser', $idAseAcademico)->select('IdAsesor')->first();
        // $procesosAsignadosAnteriores = Orm_aacademico_proceso::where('IdAsesor', $idPerfilAcademico->IdAsesor)->with(['proceso'])->get();
        //se busca los procesos donde el usuario Asesor academico esta registrado.
        // $procesosAsignados5 = Orm_aacademico_proceso::with(['proceso' => function ($query) use($idPeriodo){
        //         $query->where('IdPeriodo', $idPeriodo);
        //     }])->with(['aa_academico'  => function ($query) use($idPerfilAcademico){
        //             $query->where('IdAsesor', $idPerfilAcademico->IdAsesor);
        //     }])->get();
            
        // $procesosAsignadosAnteriores = Orm_aacademico_proceso::where('IdAsesor', $idPerfilAcademico->IdAsesor)->with(['proceso'])->get();
    // $procesoSeleccionado = 1;
   
    $alumnosAprobados = Orm_aacademico_proceso::where('IdAsesor', $idPerfilAcademico->IdAsesor)->whereHas('proceso', function($query) use($procesoElegido){
        $query->where('IdTipoProceso', $procesoElegido);
    })->whereHas('proceso.calificaciones_proceso', function ($query) {
        $query->where('cal_final', ">=" , 70);
    })->count();
    $alumnosReprobados = Orm_aacademico_proceso::where('IdAsesor', $idPerfilAcademico->IdAsesor)->whereHas('proceso', function($query) use($procesoElegido){
        $query->where('IdTipoProceso', $procesoElegido);
    })->whereHas('proceso.calificaciones_proceso', function ($query) {
        $query->where('cal_final', "<=" , 70);
    })->count();


        $procesosAsignadosAnteriores = Orm_aacademico_proceso::where('IdAsesor', $idPerfilAcademico->IdAsesor)->whereHas('proceso', function($query) use($procesoElegido){
            $query->where('IdTipoProceso', $procesoElegido);
        })->with(['proceso'])->get();


        // $idProceso2 = $procesosAsignadosAnteriores[0]->proceso->IdProceso;
        $idAsesorConteo = $idPerfilAcademico->IdAsesor;
        //se crea la consulta para saber cuantos registros de la tabla Ae_pp (AsesorEmpresarialProceso) existen con el que esten relacionadas conla tabla periodo que contenga la tabla periodo una relacion con la tabla aa_pp(AsesorAcademicoProceso) donde la tabla aa_pp tenga el identificadopr del Asesor empresarial que este logueado
        $alumnosConEmpresa = Orm_aempresarial_proceso::whereHas('proceso_aempresarial.aa_academico_procesos', function ($query)use($idAsesorConteo){
                $query->where('IdAsesor',  $idAsesorConteo);
            })->whereHas('proceso_aempresarial', function ($query)use( $procesoElegido){
                $query->where('IdTipoProceso', $procesoElegido);
            })->count();

            
        $alumnosSinEmpresa = ($procesosAsignadosAnteriores->count())-$alumnosConEmpresa;

        // $procesosAsignados2 = Orm_aacademico_proceso::with(['proceso' => function ($query) use($idPeriodo){
        //         $query->where('IdPeriodo', $idPeriodo);
        //     }])->with(['aa_academico'  => function ($query) use($idPerfilAcademico){
        //             $query->where('IdAsesor', $idPerfilAcademico->IdAsesor);
        //     }])->exists();

        // dump($procesosAsignadosAnteriores);


         return view('vistasAsesoresAcademicos.inicioProcesoAsesorAcademico')->with(['procesosAsignados' => $procesosAsignadosAnteriores])->with(['alumnosConEmpresa'=>$alumnosConEmpresa])->with(['alumnosSinEmpresa'=>$alumnosSinEmpresa])->with(['tituloInicio'=>$tituloInicio])->with(['tituloPagina'=>$tituloPagina])->with(['alumnosReprobados'=>$alumnosReprobados])->with(['alumnosAprobados'=>$alumnosAprobados])->with(['procesoElegido'=>$procesoElegido]);
         
        
    }

    public function progreso($identificadorProceso){

        //se llama a la funcion del helpers para saber la el actual periodo 
        // list($periodoExistente, $periodoExistenteComprobacion) = verificarPeriodoEscolar();

        list($periodoExistente, $periodoExistenteComprobacion) = verificarPeriodoEscolar();

        if($periodoExistenteComprobacion==true)
        {
                    
        $tituloPagina = asignarTituloPagina($identificadorProceso);
        
        $userCarrera = Auth::user()->IdCarrera;
        //se crea las variables que se usaran para las consultas 
        $idPeriodo = $periodoExistente->IdPeriodo;
        $idAseAcademico = Auth::user()->id;
        $tituloInicio = "Procesos Anteriores";
        //se busca el IdAsesor de la tabla aa que es el perfil del la tabla User que le pertenecen a los usarios con el tipo de usuario 4 o usuario asesorAcademico
        $idPerfilAcademico = Orm_aa_academico::where('IdUser', $idAseAcademico)->select('IdAsesor')->first();
        $procesosAsignadosAnteriores = Orm_aacademico_proceso::where('IdAsesor', $idPerfilAcademico->IdAsesor)->with(['proceso'])->get();
        //se busca los procesos donde el usuario Asesor academico esta registrado.
        $procesosAsignadosAnteriores = Orm_aacademico_proceso::where('IdAsesor', $idPerfilAcademico->IdAsesor)->whereHas('proceso', function ($query) use($idPeriodo, $identificadorProceso){
            $query->where('IdPeriodo', $idPeriodo)->where('IdTipoProceso', $identificadorProceso);
        })->with(['proceso'])->get();
        $idAsesorConteo = $idPerfilAcademico->IdAsesor;
        //se crea la consulta para saber cuantos registros de la tabla Ae_pp (AsesorEmpresarialProceso) existen con el que esten relacionadas conla tabla periodo que contenga la tabla periodo una relacion con la tabla aa_pp(AsesorAcademicoProceso) donde la tabla aa_pp tenga el identificadopr del Asesor empresarial que este logueado
        $alumnosConEmpresa = Orm_aempresarial_proceso::whereHas('proceso_aempresarial.aa_academico_procesos', function ($query)use($idAsesorConteo){
                $query->where('IdAsesor',  $idAsesorConteo);
            })->whereHas('proceso_aempresarial', function ($query)use($idPeriodo, $identificadorProceso){
                $query->where('IdPeriodo',  $idPeriodo)->where('IdTipoProceso', $identificadorProceso);
            })->count();

        $alumnosSinEmpresa = ($procesosAsignadosAnteriores->count())-$alumnosConEmpresa;
        // $procesosAsignados2 = Orm_aacademico_proceso::with(['proceso' => function ($query) use($idPeriodo){
        //         $query->where('IdPeriodo', $idPeriodo);
        //     }])->with(['aa_academico'  => function ($query) use($idPerfilAcademico){
        //             $query->where('IdAsesor', $idPerfilAcademico->IdAsesor);
        //     }])->exists();
         return view('vistasAsesoresAcademicos.asesoresAcademicosProgreso')->with(['procesosAsignados' => $procesosAsignadosAnteriores])->with(['alumnosConEmpresa'=>$alumnosConEmpresa])->with(['alumnosSinEmpresa'=>$alumnosSinEmpresa])->with(['tituloInicio'=>$tituloInicio])->with(['tituloPagina'=>$tituloPagina]);
         
       
        }
        else
        {
            return view('vistasAsesoresAcademicos.asesorAcademicoNoExistePeriodo');
        }
         

    }
    //
    public function progresoDocumentacion($identificadorProcesoAlumno){
        list($periodoExistente, $periodoExistenteComprobacion) = verificarPeriodoEscolar();

        // list($periodoExistente, $periodoExistenteComprobacion) = verificarPeriodoEscolar();
        // if($periodoExistenteComprobacion==true)
        // {
           
        $userCarrera = Auth::user()->IdCarrera;
        
            $informacionProcesoElejido = Orm_proceso::where('IdProceso', $identificadorProcesoAlumno)->get();
            //se usa el helper progresoVinculacion, para no repetir codigo en los 2 controladores
            $documentos = progresoVinculacion($informacionProcesoElejido);
//el if sirve para saber si elijio el proceso de Servicio Social, ya que tiene un vista diferente con 18 documentos en vez de 5
            if($informacionProcesoElejido[0]->IdTipoProceso==4)
            {
                return view('vistasAsesoresAcademicos.asesoresAcademicosServicoSocial')->with(['informacionProcesoElejido'=>$informacionProcesoElejido])->with(['documentos'=>$documentos]);
            }
            else
            {
                return view('vistasAsesoresAcademicos.asesoresAcademicosInformacionAlumno')->with(['informacionProcesoElejido'=>$informacionProcesoElejido])->with(['documentos'=>$documentos]);
            }


    }

    public function cedulas($identificadorProceso, $identificadorDocumento){
        
        //se llama a la funcion del helpers para saber la el actual periodo 
        // list($periodoExistente, $periodoExistenteComprobacion) = verificarPeriodoEscolar();
        
        list($periodoExistente, $periodoExistenteComprobacion) = verificarPeriodoEscolar();
        if($periodoExistenteComprobacion==true)
        {
           
        $userCarrera = Auth::user()->IdCarrera;

        //obetener el titulo de la pagina dependiendo la seleccion del usuario
        $tituloPagina = asignarTituloPagina($identificadorProceso);
        $tituloProceso = asignarProcesoPagina($identificadorDocumento);
        
        //se crea las variables que se usaran para las consultas 
        $idPeriodo = $periodoExistente->IdPeriodo;
        $idUserAcademico = Auth::user()->id;
        // $tituloInicio = "Procesos Anteriores";
        //se busca el IdAsesor de la tabla aa que es el perfil del la tabla User que le pertenecen a los usarios con el tipo de usuario 4 o usuario asesorAcademico
        $idPerfilAcademico = Orm_aa_academico::where('IdUser', $idUserAcademico)->select('IdAsesor')->get();

        // $procesosAsignados = Orm_aacademico_proceso::where('IdAsesor', $idPerfilAcademico[0]->IdAsesor)->with(['proceso' => function ($query) use($idPeriodo, $identificadorProceso){
        //     $query->where('IdPeriodo', $idPeriodo)->where('IdTipoProceso', $identificadorProceso);
        // }])->get();


        //se crea la consulta para traer solo los registros asociados con el periodo seleccionado existente, con el filtro de la tabla proceso
        $documentosProcesosAsignados = Orm_aacademico_proceso::where('IdAsesor', $idPerfilAcademico[0]->IdAsesor)->whereHas('proceso', function ($query)use($idPeriodo, $identificadorProceso){
            $query->where('IdPeriodo',  $idPeriodo)->where('IdTipoProceso', $identificadorProceso);
        })->with('proceso')->get();


        //conteo de alumnos que tiene el asesor dentro del periodo
        $totalAlumnos = $documentosProcesosAsignados->count();
        //total de documentos que los alumnos han subido
        $totalDocumentosEnLinea = Orm_aacademico_proceso::where('IdAsesor', $idPerfilAcademico[0]->IdAsesor)->whereHas('proceso', function($query) use($idPeriodo, $identificadorProceso){
            $query->where('IdPeriodo',  $idPeriodo)->where('IdTipoProceso', $identificadorProceso);
        })->whereHas('proceso.detalle_doc_proceso.documentos_detallesDoc', function($query) use( $identificadorDocumento){
            $query->where('IdTipoDoc', $identificadorDocumento);
        })->count();
        //total de documentos aprobados
        $totalDocumentosApro = Orm_aacademico_proceso::where('IdAsesor', $idPerfilAcademico[0]->IdAsesor)->whereHas('proceso', function($query) use($idPeriodo, $identificadorProceso){
            $query->where('IdPeriodo',  $idPeriodo)->where('IdTipoProceso', $identificadorProceso);
        })->whereHas('proceso.detalle_doc_proceso.documentos_detallesDoc', function($query) use( $identificadorDocumento){
            $query->where('estadoAca', 1)->where('IdTipoDoc', $identificadorDocumento);
        })->count();
        //total de documentos rechazados con observaciones
        $totalDocumentosRechazados = Orm_aacademico_proceso::where('IdAsesor', $idPerfilAcademico[0]->IdAsesor)->whereHas('proceso', function($query) use($idPeriodo, $identificadorProceso){
            $query->where('IdPeriodo',  $idPeriodo)->where('IdTipoProceso', $identificadorProceso);
        })->whereHas('proceso.detalle_doc_proceso.documentos_detallesDoc', function($query) use( $identificadorDocumento){
            $query->where('estadoAca', 2)->where('IdTipoDoc', $identificadorDocumento);
        })->count();

        return view('vistasAsesoresAcademicos.asesoresAcademicosCedulasTotal')->with(['documentosProcesosAsignados' => $documentosProcesosAsignados])->with(['tituloPagina'=>$tituloPagina])->with(['totalAlumnos'=>$totalAlumnos])->with(['totalDocumentosEnLinea'=>$totalDocumentosEnLinea])->with(['totalDocumentosApro'=>$totalDocumentosApro])->with(['totalDocumentosRechazados'=>$totalDocumentosRechazados])->with(['identificadorDocumento'=>$identificadorDocumento])->with(['tituloProceso'=>$tituloProceso]);

        }
       else
       {
           return view('vistasAsesoresAcademicos.asesorAcademicoNoExistePeriodo');
       }

           
    }
        //ver documento
        public function ver_documentoAcademico($name, $proces)
        { //*funcion optimizada 

            
            $nombre = '/documentos/' . $name;
            $nombreD = public_path($nombre);
            $resp = file_exists($nombreD);
            if ($resp == true) {
                return response()->file($nombreD);
            } else return redirect('estancia1_Documentos/' . $proces)->with('error', 'Documento no encontrado, favor de revisar con el usuario');
        }


    public function cambiarEstadoDoc(Request $request, $idDoc, $idProceso){
        $this->validate(request(), [
            'estadoDeseado' => 'required|numeric|digits:1',
        ]);
        $idEstado = $request->post('estadoDeseado');
        //se valida si se elijio aceptar documento o observaciones con el switch
        switch($idEstado){
            case 1:
                $documentoEstado = Orm_documentos::findOrFail($idDoc);

                $identificadorProceso = $idProceso;
                $identificadorDocumento = $documentoEstado->IdTipoDoc;

                $documentoEstado->estadoAca = $idEstado; 
                $documentoEstado->save();

                $comentario = Orm_comentarios_docu::where('IdDoc', $idDoc)->where('TipoComentario', 1)->first();
                if(!empty($comentario)){
                    $comentario->delete(); // Elimina el comentario
                }
                return redirect()->route('cedulas', ['identificadorProceso'=>$identificadorProceso, 'identificadorDocumento'=>$identificadorDocumento])->with('aceptadoDoc', 'Documento guardado');
            break;
            case 2:
                return redirect()->route('observaciones', ['idDoc' => $idDoc, 'idProceso'=>$idProceso]);
            break;

            default:

            break;
        }


    }


    public function observaciones($idDoc, $idProceso){

        list($periodoExistente, $periodoExistenteComprobacion) = verificarPeriodoEscolar();
        if($periodoExistenteComprobacion==true)
        {
          

        $documento = Orm_documentos::where('IdDoc', $idDoc)->first();
        $alumno = Orm_user::where('id', $documento->usuario)->select('id','name','Matricula','IdCarrera')->first();

                //obetener el titulo de la pagina dependiendo la seleccion del usuario

                $tituloPagina = asignarTituloPagina($idProceso);
                $tituloProceso = asignarProcesoPagina($documento->IdTipoDoc);

                $estatusDocumento = "";
                switch($documento->estadoAca){
                    case Null:
                        $estatusDocumento = "PENDIENTE DE REVISION";
                        break;
                    case 2:
                        $estatusDocumento = "RECHAZADA EN ESPERA DE CAMBIOS";
                        break;
                }

        return view('vistasAsesoresAcademicos.asesoresAcademicosIngresarMensajeCedulaDefinicionProyecto')->with(['tituloPagina'=>$tituloPagina])->with(['alumno'=>$alumno])->with(['documento'=>$documento])->with(['estatusDocumento'=>$estatusDocumento])->with(['idProceso'=>$idProceso])->with(['tituloProceso'=>$tituloProceso]);
 
        }
       else
       {
           return view('vistasAsesoresAcademicos.asesorAcademicoNoExistePeriodo');
       }


    }

    public function guardarMensaje(Request $request, $idDoc, $idProceso){


        $this->validate(request(), [
            'estadoDeseado' => 'required|integer',
            'Comentario' => 'required',
        ]);

    //se usa el metodo create or update, el primer array comprueba si existe algun registro en la base de datos con los datos proporcionados, si existe se busca ekl registro con estos datos y se actualiza en el siguiente array de la funcion, donde se pone lo que se va a querer actualizar, si no se busca se crea un nuevo registro con todos los datos de los 2 arrays de la funcion.

        $idUserAcademico = Auth::user()->id;
            
        //tipo de comentario, 1 MaestrosAcademicos, 2 Vinculacion
        $idUserAcademico = Auth::user()->id;
        $comentario = Orm_comentarios_docu::updateOrCreate([
            'IdUser'=>$idUserAcademico,
            'IdDoc'=>$idDoc,
            'TipoComentario'=>1
        ],[
            'Comentario'=>$request->input('Comentario'),
        ]);

        //se cambia el estado estadoAca del documento
        $idEstado = 2;
        $documentoEstado = Orm_documentos::findOrFail($idDoc);
        $identificadorProceso = $idProceso;
        $identificadorDocumento = $documentoEstado->IdTipoDoc;
        $documentoEstado->estadoAca = $idEstado; 
        $documentoEstado->save();
        return redirect()->route('cedulas', ['identificadorProceso'=>$identificadorProceso, 'identificadorDocumento'=>$identificadorDocumento])->with('documento', 'Mensaje Guardado con Éxito');


    }

    public function calificaciones($identificadorProceso){
        // list($periodoExistente, $periodoExistenteComprobacion) = verificarPeriodoEscolar();


        list($periodoExistente, $periodoExistenteComprobacion) = verificarPeriodoEscolar();
        if($periodoExistenteComprobacion==true)
        {
           
        $userCarrera = Auth::user()->IdCarrera;

        //obetener el titulo de la pagina dependiendo la seleccion del usuario
        $tituloPagina = asignarTituloPagina($identificadorProceso);

            //se crea las variables que se usaran para las consultas 
            $idPeriodo = $periodoExistente->IdPeriodo;
            $idAseAcademico = Auth::user()->id;
            // $tituloInicio = "Procesos Anteriores";
            //se busca el IdAsesor de la tabla aa que es el perfil del la tabla User que le pertenecen a los usarios con el tipo de usuario 4 o usuario asesorAcademico
            $idPerfilAcademico = Orm_aa_academico::where('IdUser', $idAseAcademico)->select('IdAsesor')->first();
            
            //se busca los procesos donde el usuario Asesor academico esta registrado.
            $procesosAsignados = Orm_aacademico_proceso::where('IdAsesor', $idPerfilAcademico->IdAsesor)->whereHas('proceso', function ($query) use($idPeriodo, $identificadorProceso){
                $query->where('IdPeriodo', $idPeriodo)->where('IdTipoProceso', $identificadorProceso);
            })->with(['proceso'])->get();
    
    
            $idAsesor = $idPerfilAcademico->IdAsesor;    
            //se crea la consulta para saber cuantos registros de la tabla Ae_pp (AsesorEmpresarialProceso) existen con el que esten relacionadas conla tabla periodo que contenga la tabla periodo una relacion con la tabla aa_pp(AsesorAcademicoProceso) donde la tabla aa_pp tenga el identificadopr del Asesor empresarial que este logueado
            $alumnosConCalificacion = Orm_aacademico_proceso::where('IdAsesor', $idPerfilAcademico->IdAsesor)->whereHas('proceso.calificaciones_proceso', function ($query)use($idAsesor){
                    $query->where('IdAsesor',  $idAsesor);
                })->whereHas('proceso', function ($query)use($idPeriodo, $identificadorProceso){
                    $query->where('IdPeriodo',  $idPeriodo)->where('IdTipoProceso', $identificadorProceso);
                })->count();

            $alumnosAprobados = Orm_aacademico_proceso::where('IdAsesor', $idPerfilAcademico->IdAsesor)->whereHas('proceso.calificaciones_proceso', function ($query)use($idAsesor){
                    $query->where('IdAsesor',  $idAsesor)->where('cal_final', '>=', 70);
                })->whereHas('proceso', function ($query)use($idPeriodo, $identificadorProceso){
                    $query->where('IdPeriodo',  $idPeriodo)->where('IdTipoProceso', $identificadorProceso);
                })->count();

            $alumnosReprobados = Orm_aacademico_proceso::where('IdAsesor', $idPerfilAcademico->IdAsesor)->whereHas('proceso.calificaciones_proceso', function ($query)use($idAsesor){
                    $query->where('IdAsesor',  $idAsesor)->where('cal_final', '<=', 69);
                })->whereHas('proceso', function ($query)use($idPeriodo, $identificadorProceso){
                    $query->where('IdPeriodo',  $idPeriodo)->where('IdTipoProceso', $identificadorProceso);
                })->count();

                // dump($procesosAsignados);
                // dump($idAsesor);
            $alumnosEntotal = $procesosAsignados->count();     
            $alumnosSinCalificacion = ($procesosAsignados->count())-$alumnosConCalificacion;
        

        return view('vistasAsesoresAcademicos.asesoresAcademicosCalificacionesAlumnos')->with(['procesosAsignados'=>$procesosAsignados])->with(['tituloPagina'=>$tituloPagina])->with(['alumnosAprobados'=>$alumnosAprobados])->with(['alumnosReprobados'=>$alumnosReprobados])->with(['alumnosSinCalificacion'=>$alumnosSinCalificacion])->with(['alumnosEntotal'=>$alumnosEntotal]);
        }
       else
       {
           return view('vistasAsesoresAcademicos.asesorAcademicoNoExistePeriodo');
       }
    }

    public function ingresarCalificacion($idProcesoAlumno, $identificadorProceso){

        list($periodoExistente, $periodoExistenteComprobacion) = verificarPeriodoEscolar();
        if($periodoExistenteComprobacion==true)
        {
            $userCarrera = Auth::user()->IdCarrera;

            //obetener el titulo de la pagina dependiendo la seleccion del usuario

            $tituloPagina = asignarTituloPagina($identificadorProceso);

    
                //se crea las variables que se usaran para las consultas 
                $idPeriodo = $periodoExistente->IdPeriodo;
                $idAseAcademico = Auth::user()->id;
                // $tituloInicio = "Procesos Anteriores";
                //se busca el IdAsesor de la tabla aa que es el perfil del la tabla User que le pertenecen a los usarios con el tipo de usuario 4 o usuario asesorAcademico
                $procesoSeleccionado = Orm_proceso::where('IdProceso', $idProcesoAlumno)->first();
                // dump($procesoSeleccionado);
    
            return view('vistasAsesoresAcademicos.asesoresAcademicosIngresarCalificacionAlumno')->with(['procesoSeleccionado'=>$procesoSeleccionado])->with('calificacion', 'la calificacion se guardo');
    
        }
       else
       {
           return view('vistasAsesoresAcademicos.asesorAcademicoNoExistePeriodo');
       }

    }


    public function anteriorCalificacion($idProcesoAlumno, $identificadorProceso){
        list($periodoExistente, $periodoExistenteComprobacion) = verificarPeriodoEscolar();
        $userCarrera = Auth::user()->IdCarrera;

        //obetener el titulo de la pagina dependiendo la seleccion del usuario
        
        $tituloPagina = asignarTituloPagina($identificadorProceso);

            //se busca el IdAsesor de la tabla aa que es el perfil del la tabla User que le pertenecen a los usarios con el tipo de usuario 4 o usuario asesorAcademico
            $procesoSeleccionado = Orm_proceso::where('IdProceso', $idProcesoAlumno)->first();

        return view('vistasAsesoresAcademicos.asesoresAcademicosCalificacionAnterior')->with(['procesoSeleccionado'=>$procesoSeleccionado]);

    }


    public function actualizarCalificacion($idProcesoAlumno, $identificadorProceso){

        list($periodoExistente, $periodoExistenteComprobacion) = verificarPeriodoEscolar();
        if($periodoExistenteComprobacion==true)
        {
        // list($periodoExistente, $periodoExistenteComprobacion) = verificarPeriodoEscolar();
        $userCarrera = Auth::user()->IdCarrera;
        //obetener el titulo de la pagina dependiendo la seleccion del usuario
        $tituloPagina = asignarTituloPagina($identificadorProceso);

            //se crea las variables que se usaran para las consultas 
            $idPeriodo = $periodoExistente->IdPeriodo;
            $idAseAcademico = Auth::user()->id;
            // $tituloInicio = "Procesos Anteriores";
            //se busca el IdAsesor de la tabla aa que es el perfil del la tabla User que le pertenecen a los usarios con el tipo de usuario 4 o usuario asesorAcademico
            $procesoSeleccionado = Orm_proceso::where('IdProceso', $idProcesoAlumno)->first();

            return view('vistasAsesoresAcademicos.asesoresAcademicosActualizarCalificacion')->with(['procesoSeleccionado'=>$procesoSeleccionado]);
        }
       else
       {
           return view('vistasAsesoresAcademicos.asesorAcademicoNoExistePeriodo');
       }
 
    }


    public function guardarCalificacion(Request $request, $procesoAlumno){

        list($periodoExistente, $periodoExistenteComprobacion) = verificarPeriodoEscolar();
        if($periodoExistenteComprobacion==true)
        {
            $this->validate(request(), [
                'cal1' => 'required|integer|min:50|max:100',
                'cal2' => 'required|integer|min:50|max:100',
                'cal3' => 'required|integer|min:50|max:100',
                'cal4' => 'required|integer|min:50|max:100',
                'cal5' => 'required|integer|min:50|max:100',
                'cal6' => 'required|integer|min:50|max:100',
                'cal7' => 'required|integer|min:50|max:100',
                'cal8' => 'required|integer|min:50|max:100',
                'cal9' => 'required|integer|min:50|max:100',
                'cal10' => 'required|integer|min:50|max:100',
                'cal11' => 'required|integer|min:50|max:100',
                'cal12' => 'required|integer|min:50|max:100',
            ]);
    
      //tipo de comentario, 1 MaestrosAcademicos, 2 Vinculacion
            $procesoRedirect = Orm_Proceso::where('IdProceso', $procesoAlumno)->select('IdTipoProceso')->first();
            $identificadorProceso = $procesoRedirect->IdTipoProceso;
            $idUserAcademico = Auth::user()->id;
            
            $cal_final =( ($request->input('cal1')+$request->input('cal2')+$request->input('cal3')+$request->input('cal4')+$request->input('cal5')+$request->input('cal6')+$request->input('cal7')+$request->input('cal8')+$request->input('cal9')+$request->input('cal10')+$request->input('cal11')+$request->input('cal12')) /12 );
    
    //metodo create or update, el primer array comprueba si existe algun registro en la base de datos con los datos proporcionados, si existe se busca ekl registro con estos datos y se actualiza en el siguiente array de la funcion, donde se pone lo que se va a querer actualizar, si no se busca se crea un nuevo registro con todos los datos de los 2 arrays de la funcion.
            $calificacion = Orm_calificaciones::updateOrCreate([
                'IdUser'=>$idUserAcademico,
                'IdProceso'=>$procesoAlumno,
                'TipoCalificaciones'=>1
            ],[
                'cal1'=>$request->input('cal1'),
                'cal2'=>$request->input('cal12'),
                'cal3'=>$request->input('cal3'),
                'cal4'=>$request->input('cal4'),
                'cal5'=>$request->input('cal5'),
                'cal6'=>$request->input('cal6'),
                'cal7'=>$request->input('cal7'),
                'cal8'=>$request->input('cal8'),
                'cal9'=>$request->input('cal9'),
                'cal10'=>$request->input('cal10'),
                'cal11'=>$request->input('cal11'),
                'cal12'=>$request->input('cal12'),
                'cal_final'=>$cal_final
    
            ]);
    
                    return redirect()->route('calificaciones', ['identificadorProceso'=>$identificadorProceso])->with('calificacion', 'Calificacion se guardo');
    
                    // return redirect()->route('cedulas', ['identificadorProceso'=>$identificadorProceso, 'identificadorDocumento'=>$identificadorDocumento]);
        
        }
       else
       {
           return view('vistasAsesoresAcademicos.asesorAcademicoNoExistePeriodo');
       }
            
    }

    //ruta para pasar al ajax en las plantillas del datatable.
    public function dataTable($procesoElegido){

        $idAseAcademico = Auth::user()->id;
        $idPerfilAcademico = Orm_aa_academico::where('IdUser', $idAseAcademico)->select('IdAsesor')->first();
        $procesosAsignadosAnteriores = Orm_aacademico_proceso::where('IdAsesor', $idPerfilAcademico->IdAsesor)->whereHas('proceso', function($query) use($procesoElegido){
            $query->where('IdTipoProceso', $procesoElegido);
        })->with(['proceso'])->get();
        //se pasa en la ruta el boton desde el servidor y la informacion en formato json, con la ayuda de la dependencia yajra 9.21.2 para datatable .
    return datatables()->of($procesosAsignadosAnteriores)
    ->addColumn('actions', function($procesosAsignadosAnteriores) {
        return '<a style="color:#3B96D1" href="/progresoDocumentacion/'.$procesosAsignadosAnteriores->proceso->IdProceso.'" ><i class="glyphicon glyphicon-edit"></i> '.$procesosAsignadosAnteriores->proceso->user_proceso->alumno_perfil_user->Nombre.' '.$procesosAsignadosAnteriores->proceso->user_proceso->alumno_perfil_user->APP.' '.$procesosAsignadosAnteriores->proceso->user_proceso->alumno_perfil_user->APM.'</a>';
    })->rawColumns(['actions'])->toJson();

    }

    ////termina el controlador 
}
