<?php

namespace App\Http\Controllers;

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
use App\Models\Orm_coordinador;
use App\Models\User;

use function App\Helpers\verificarPeriodoEscolar;
use function App\Helpers\asignarTituloPagina;
use function App\Helpers\asignarProcesoPagina;
use function App\Helpers\progresoVinculacion;

class CoordinadorCarreraRutasController extends Controller
{
    //esta parte se tiene que mejorar usando ajax para evitar la carga lenta del datatable y el datable se rellene de parte del servidor
    public function inicioProcesosAnteriores($procesoElegido){

        //se llama a la funcion del helpers para saber la el actual periodo 
        list($periodoExistente, $periodoExistenteComprobacion) = verificarPeriodoEscolar();
        $userCarrera = Auth::user()->IdCarrera;

              //obetener el titulo de la pagina dependiendo la seleccion del usuario

            $tituloPagina = asignarTituloPagina($procesoElegido);//se usa el helper, para no repertir codigo en ambos controladoresm estancia estadia etc
        //se crea las variables que se usaran para las consultas 

        // $idPeriodo = $periodoExistente->IdPeriodo;
        $idCoordinador = Auth::user()->id;
        $tituloInicio = "Procesos Anteriores";
        //se busca el IdAsesor de la tabla aa que es el perfil del la tabla User que le pertenecen a los usarios con el tipo de usuario 4 o usuario asesorAcademico
        $idPerfilCoordinador = Orm_coordinador::where('IdUser', $idCoordinador)->select('IdCordinador')->first();
        

        $userCarrera = Auth::user()->IdCarrera;

        $procesosAsignadosAnteriores = Orm_proceso::where('IdCarrera', $userCarrera)
        ->where('IdTipoProceso', $procesoElegido)->get();

        // $procesosAsignadosAnteriores1 = Orm_aacademico_proceso::whereHas('aa_academico.user_aa_academico', function($query) use($userCarrera){
        //     $query->where($query->where('IdCarrera',  $userCarrera));
                
        //     //     where('IdCarrera',  $userCarrera);
        // })->get();
        
        // whereHas('aa_academico_procesos.aa_academico.user_aa_academico', function($query) use($userCarrera){
        //     $query->where('IdCarrera',  $userCarrera);
        // })
        // $idProceso2 = $procesosAsignadosAnteriores[0]->proceso->IdProceso;
        $idAsesorConteo = $idPerfilCoordinador->IdCordinador;

        //se crea la consulta para saber cuantos registros de la tabla Ae_pp (AsesorEmpresarialProceso) existen con el que esten relacionadas conla tabla periodo que contenga la tabla periodo una relacion con la tabla aa_pp(AsesorAcademicoProceso) donde la tabla aa_pp tenga el identificadopr del Asesor empresarial que este logueado
        $alumnosConEmpresa = Orm_aempresarial_proceso::whereHas('proceso_aempresarial.aa_academico_procesos', function ($query) use($userCarrera, $procesoElegido){
                $query->where('IdCarrera',  $userCarrera)->where('IdTipoProceso', $procesoElegido);
            })->count();

        // $prueba123 = Orm_aacademico_proceso::whereHas('aa_academico.user_aa_academico', function ($query) use($userCarrera){
        //         $query->where('IdCarrera',  1);
        //     })->get();

            // dump($prueba123);

        // $prueba = Orm_aacademico_proceso::whereHas('aa_academico.user_aa_academico', function ($query) use($userCarrera){
        //     $query->where('IdCarrera',  $userCarrera);
        // })->count();
        // dump($prueba);


        $alumnosSinEmpresa = ($procesosAsignadosAnteriores->count())-$alumnosConEmpresa;
            // dump($alumnosConEmpresa);
            // dump($alumnosConEmpresa21);

            $alumnosAprobados = Orm_proceso::where('IdCarrera', $userCarrera)->where('IdTipoProceso', $procesoElegido)->whereHas('calificaciones_proceso', function ($query) {
                $query->where('cal_final', ">=" , 70);
            })->count();
            $alumnosReprobados = Orm_proceso::where('IdCarrera', $userCarrera)->where('IdTipoProceso', $procesoElegido)->whereHas('calificaciones_proceso', function ($query) {
                $query->where('cal_final', "<=" , 69);
            })->count();

            // $alumnosReprobados = ($procesosAsignadosAnteriores->count()) - $alumnosAprobados;

        // $procesosAsignados2 = Orm_aacademico_proceso::with(['proceso' => function ($query) use($idPeriodo){
        //         $query->where('IdPeriodo', $idPeriodo);
        //     }])->with(['aa_academico'  => function ($query) use($idPerfilCoordinador){
        //             $query->where('IdAsesor', $idPerfilCoordinador->IdAsesor);
        //     }])->exists();
                


         if($periodoExistenteComprobacion==true){
            return view('vistasCoordinadoresCarrera.coordinadoresInicioProcesosAnteriores')->with(['procesosAsignados' => $procesosAsignadosAnteriores])->with(['alumnosConEmpresa'=>$alumnosConEmpresa])->with(['alumnosSinEmpresa'=>$alumnosSinEmpresa])->with(['tituloInicio'=>$tituloInicio])->with(['alumnosAprobados'=>$alumnosAprobados])->with(['alumnosReprobados'=>$alumnosReprobados])->with(['tituloPagina'=>$tituloPagina]);   
         }
         else{
            return view('vistasCoordinadoresCarrera.coordinadoresInicioProcesosAnteriores')->with(['procesosAsignados' => $procesosAsignadosAnteriores])->with(['alumnosConEmpresa'=>$alumnosConEmpresa])->with(['alumnosSinEmpresa'=>$alumnosSinEmpresa])->with(['tituloInicio'=>$tituloInicio])->with(['alumnosAprobados'=>$alumnosAprobados])->with(['alumnosReprobados'=>$alumnosReprobados])->with(['tituloPagina'=>$tituloPagina]);   
         }

    }
    //


    public function progresoCoordinacion($identificadorProceso){

        //se llama a la funcion del helpers para saber la el actual periodo 
        list($periodoExistente, $periodoExistenteComprobacion) = verificarPeriodoEscolar();
        if($periodoExistenteComprobacion==true){
            $userCarrera = Auth::user()->IdCarrera;
            
              //obetener el titulo de la pagina dependiendo la seleccion del usuario

              $tituloPagina = asignarTituloPagina($identificadorProceso);//se usa el helper, para no repertir codigo en ambos controladoresm estancia estadia etc

    
            //se crea las variables que se usaran para las consultas 
            $idPeriodo = $periodoExistente->IdPeriodo;
            $idAseAcademico = Auth::user()->id;
            $tituloInicio = "Procesos Anteriores";
            //se busca el IdAsesor de la tabla aa que es el perfil del la tabla User que le pertenecen a los usarios con el tipo de usuario 4 o usuario asesorAcademico
            // $idPerfilCoordinacion = Orm_coordinador::where('IdUser', $idAseAcademico)->select('IdCordinador')->first();
            
            //se busca los procesos donde el usuario Asesor academico esta registrado.
            $procesosAsignadosAnteriores = Orm_proceso::where('IdCarrera', $userCarrera)->where('IdPeriodo', $idPeriodo)->where('IdTipoProceso', $identificadorProceso)->get();
    
    
    
            // $idAsesorConteo = $idPerfilCoordinacion->IdAsesor;
    
    
            //se crea la consulta para saber cuantos registros de la tabla Ae_pp (AsesorEmpresarialProceso) existen con el que esten relacionadas conla tabla periodo que contenga la tabla periodo una relacion con la tabla aa_pp(AsesorAcademicoProceso) donde la tabla aa_pp tenga el identificadopr del Asesor empresarial que este logueado
            $alumnosConEmpresa = Orm_aempresarial_proceso::whereHas('proceso_aempresarial.aa_academico_procesos', function ($query)use($userCarrera){
                    $query->where('IdCarrera',  $userCarrera);
                })->whereHas('proceso_aempresarial', function ($query)use($idPeriodo, $identificadorProceso){
                    $query->where('IdPeriodo',  $idPeriodo)->where('IdTipoProceso', $identificadorProceso);
                })->count();
    
            $alumnosSinEmpresa = ($procesosAsignadosAnteriores->count())-$alumnosConEmpresa;
                // dump($alumnosConEmpresa);
    
                // dump($procesosAsignadosAnteriores);
             return view('vistasCoordinadoresCarrera.coordinadoresProgreso')->with(['procesosAsignados' => $procesosAsignadosAnteriores])->with(['alumnosConEmpresa'=>$alumnosConEmpresa])->with(['alumnosSinEmpresa'=>$alumnosSinEmpresa])->with(['tituloInicio'=>$tituloInicio])->with(['tituloPagina'=>$tituloPagina]);
        }
        else
        {
            return view('vistasCoordinadoresCarrera.coordinadoresNOexistePeriodo');
        }
         
       
    }


    public function progresoDocumentacionCoordinacion($identificadorProcesoAlumno){
        
        $informacionProcesoElejido = Orm_proceso::where('IdProceso', $identificadorProcesoAlumno)->get();
        // dump($informacionProcesoElejido[0]);
        
        $idProceso = $informacionProcesoElejido[0]->IdProceso;

        $documentos = progresoVinculacion($informacionProcesoElejido);

        if($informacionProcesoElejido[0]->IdTipoProceso==4){
            return view('vistasCoordinadoresCarrera.coordinadoresServicioSocial')->with(['documentos' => $documentos])->with(['informacionProcesoElejido'=>$informacionProcesoElejido]);
        }
        else{
            return view('vistasCoordinadoresCarrera.coordinadoresInformacionAlumno')->with(['documentos' => $documentos])->with(['informacionProcesoElejido'=>$informacionProcesoElejido]);
        }

    }

    public function calificacionCoordinacion($idProcesoAlumno, $identificadorProceso){

        list($periodoExistente, $periodoExistenteComprobacion) = verificarPeriodoEscolar();
        $userCarrera = Auth::user()->IdCarrera;

        //obetener el titulo de la pagina dependiendo la seleccion del usuario

                //obetener el titulo de la pagina dependiendo la seleccion del usuario

            $tituloPagina = asignarTituloPagina($identificadorProceso);//se usa el helper, para no repertir codigo en ambos controladoresm estancia estadia etc
            //se crea las variables que se usaran para las consultas 
            // $idPeriodo = $periodoExistente->IdPeriodo;
            $idAseAcademico = Auth::user()->id;
            // $tituloInicio = "Procesos Anteriores";
            $procesoSeleccionado = Orm_proceso::where('IdProceso', $idProcesoAlumno)->first();
            // dump($procesoSeleccionado);
        return view('vistasCoordinadoresCarrera.coordinadoresCalificacion')->with(['procesoSeleccionado'=>$procesoSeleccionado]);

    }
        //ver documento
        public function ver_documentoCoordinacion($name, $proces)
        { //*funcion optimizada 
            $nombre = '/documentos/' . $name;
            $nombreD = public_path($nombre);
            $resp = file_exists($nombreD);
            if ($resp == true) {
                return response()->file($nombreD);
            } else return redirect('estancia1_Documentos/' . $proces)->with('error', 'Documento no encontrado, favor de revisar con el usuario');
        }

}
