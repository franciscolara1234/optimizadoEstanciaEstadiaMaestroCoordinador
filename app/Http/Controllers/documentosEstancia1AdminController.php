<?php

namespace App\Http\Controllers;

use App\Models\documentos;
use App\Models\User;
use App\Models\Periodo;
use App\Models\Fase;
use App\Models\usuarios;
use App\Models\Asesor_Aca;
use App\Models\Asesor_Emp;
use App\Models\ae_emp;
use App\Models\Empresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Arr;
use Carbon\Carbon;
use League\Csv\Reader;
use RealRashid\SweetAlert\Facades\Alert;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect as FacadesRedirect;
use Redirect;

class documentosEstancia1AdminController extends Controller
{

    public function periodo()
    {
        $fases = DB::table('fases')
            ->get();
        $periodos = DB::table('periodo')
            ->get();
        return view('admin.crear_periodo', compact('fases', 'periodos'));
    }

    public function cambiarPeriodo($IdPeriodo, $fase)
    {
        $periodo = Periodo::find($IdPeriodo);
        $periodos = DB::table('periodo')
            ->get();
        $fases = DB::table('fases')
            ->get();
        if ($periodo) {
            $valor = $fase;
            $nombre_columna = 'Activo_' . $valor;
            $activo = $periodo->$nombre_columna == 1 ? 0 : 1;
            $periodo->$nombre_columna = $activo;
            $periodo->save();
            $mensaje = $activo == 0 ? 'La fase ha sido desactivada' : 'La fase ha sido activada';
            return redirect()->to('/Periodo')->with('success', $mensaje, compact('fases', 'periodos'));
        } else {
            return redirect()->to('/Periodo')->with('error', 'No se encontró el periodo', compact('fases', 'periodos'));
        }
    }

    public function crearPeriodo(Request $request)
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
        $periodoExistente = Periodo::where('Periodo', $numero)->first();
        if ($periodoExistente) {
            return redirect()->to('/Periodo')->with('error', 'Periodo: ' . $numero . ' ya existe, si quiere activar las etapas, favor de hacerlo en la parte de abajo');
        }
        $periodo = new Periodo;
        $periodo->Periodo = $numero;
        $periodo->Idfase_1 = 1;
        $periodo->Activo_1 = 1;
        $periodo->Idfase_2 = 2;
        $periodo->Activo_2 = 1;
        $periodo->Idfase_3 = 3;
        $periodo->Activo_3 = 1;
        $periodo->save();
        return redirect()->to('/Periodo')->with('success', 'periodo: ' . $numero . ' creado con exito');
    }

    public function ver($proces)
    {
        $name = ['Estancia I', 'Estancia II', 'Estadia', 'Estadias Nacionales', 'Servicio Social'];
        //!cambiar este numero si se quiere agregar un nuevo proceso y tambien agregar el nombre en $name
        if ($proces > 0 && $proces <= 5) { //comprueba si el numero es de algun proceso del 1...5
            //$NmProces=$name[$proces-1];
            $var = [$proces, $name[$proces - 1]]; //guarda el numero y nombre del proceso
        } else return redirect('admin');
        $periodos = DB::table('periodo')->get();
        return view('admin.documentosEstancia1', ['proceso' => $var, 'periodos' => $periodos]);
    }

    public function ver_cd_estancia_f03($id, $name)
    { //#

    }
    //ver documento
    public function ver_documento($name, $proces)
    { //*funcion optimizada 
        $nombre = '/documentos/' . $name;
        $nombreD = public_path($nombre);
        $resp = file_exists($nombreD);
        if ($resp == true) {
            return response()->file($nombreD);
        } else return redirect('estancia1_Documentos/' . $proces)->with('error', 'Documento no encontrado, favor de revisar con el usuario');
    }
    //aceptar documentos->envia correo
    public function aceptar_documento(request $request, $idU, $id, $proces, $doc)
    { //*funcion optimizada
        $texto   = trim($request->get('texto1'));
        $estatus = trim($request->get('estatus'));
        $año     = trim($request->get('año'));
        $name = [
            'Carga Horaria', 'Constancia de Derecho',
            'Carta Responsiva', 'Carta de Presentación',
            'Carta de Aceptacion', 'Cedula de Registro',
            'Definicion de Proyecto', 'Carta de Liberacion', 'Carta Compromiso', 'Reporte Mensual', 'Reporte Mensual',
            'Reporte Mensual', 'Reporte Mensual', 'Reporte Mensual', 'Reporte Mensual', 'Reporte Mensual',
            'Reporte Mensual', 'Reporte Mensual', 'Reporte Mensual', 'Reporte Mensual', 'Reporte Mensual'
        ];
        switch ($doc) {
            case 1:
                $carta = documentos::find($id);
                $carta->estado_c_h = 2;
                break;
            case 2:
                $carta = documentos::find($id);
                $carta->estado_c_d = 2;
                break;
            case 3:
                $carta = documentos::find($id);
                $carta->estado_c_r = 2;
                break;
            case 4:
                $carta = documentos::find($id);
                $carta->estado_c_p = 2;
                break;
            case 5:
                $carta = documentos::find($id);
                $carta->estado = 2;
                break;
            case 6:
                $carta = documentos::find($id);
                $carta->estado_c_r = 2;
                break;
            case 7:
                $carta = documentos::find($id);
                $carta->estado_d_p = 2;
                break;
            case 8:
                $carta = documentos::find($id);
                $carta->estado_c_l = 2;
                break;
            case 9:
                $carta = documentos::find($id);
                $carta->estado_c_c = 2;
                break;
            case 10:
                $carta = documentos::find($id);
                $carta->estado_r_m = 2;
                break;
            case 11:
                $carta = documentos::find($id);
                $carta->estado_r_m = 2;
                break;
            case 12:
                $carta = documentos::find($id);
                $carta->estado_r_m = 2;
                break;
            case 13:
                $carta = documentos::find($id);
                $carta->estado_r_m = 2;
                break;
            case 14:
                $carta = documentos::find($id);
                $carta->estado_r_m = 2;
                break;
            case 15:
                $carta = documentos::find($id);
                $carta->estado_r_m = 2;
                break;
            case 16:
                $carta = documentos::find($id);
                $carta->estado_r_m = 2;
                break;
            case 17:
                $carta = documentos::find($id);
                $carta->estado_r_m = 2;
                break;
            case 18:
                $carta = documentos::find($id);
                $carta->estado_r_m = 2;
                break;
            case 19:
                $carta = documentos::find($id);
                $carta->estado_r_m = 2;
                break;
            case 20:
                $carta = documentos::find($id);
                $carta->estado_r_m = 2;
                break;
            case 21:
                $carta = documentos::find($id);
                $carta->estado_r_m = 2;
                break;
            default:
                # code...
                break;
        }
        $carta->save();
        $resp = $name[$doc - 1] . ' Aceptada y ' . CorreoController::store($idU, $name[$doc - 1], 1);
        return back()->withInput()->with('aceptado', $resp);
    }
    //documento pendiente->no manda correo
    public function pendiente_documento(request $request, $idU, $id, $proces, $doc)
    { //*funcion optimizada
        $texto   = trim($request->get('texto1'));
        $estatus = trim($request->get('estatus'));
        $año     = trim($request->get('año'));
        $name = [
            'Carga Horaria', 'Constancia de Derecho',
            'Carta Responsiva', 'Carta de Presentación',
            'Carta de Aceptacion', 'Cedula de Registro',
            'Definicion de Proyecto', 'Carta de Liberacion', 'Carta Compromiso', 'Reporte Mensual', 'Reporte Mensual',
            'Reporte Mensual', 'Reporte Mensual', 'Reporte Mensual', 'Reporte Mensual', 'Reporte Mensual',
            'Reporte Mensual', 'Reporte Mensual', 'Reporte Mensual', 'Reporte Mensual', 'Reporte Mensual'
        ];
        switch ($doc) {
            case 1:
                $carta = documentos::find($id);
                $carta->estado_c_h = 1;
                break;
            default:
                # code...
                break;
        }
        $carta->save();
        return back()->withInput()->with('pendiente', $name[$doc - 1] . ' Pendiente');
    }
    //vista observaciones carga horaria
    public function observaciones_documento(Request $request, $idU, $proces, $doc)
    { //*funcion optimizada
        $texto   = trim($request->get('texto1'));
        $estatus = trim($request->get('estatus'));
        $año     = trim($request->get('año'));
        $id_c   = ['id_c' => $request->input('id_c'), 'idU' => $idU, '#proces' => $proces, '#doc' => $doc, '#texto' => $texto]; //manda datos a la vista para despues pasarlo a correo
        $datos = Arr::collapse([$id_c]);
        return view('admin.observaciones_estancia_carga_horaria', ['datos' => $datos]);
    }
    //vista observaciones con observaciones carga horaria
    public function conObservaciones_documento_admin(Request $request, $proces, $doc)
    { //*funcion optimizada
        $id_c   = [$request->input('id_c')];
        $id_c_r   = ['id_c' => $request->input('id_c'), '#proces' => $proces, '#doc' => $doc];
        $datos = Arr::collapse([$id_c_r]);
        switch ($doc) {
            case 1:
                $carta = documentos::find($id_c);
                break;
            default:
                # code...
                break;
        }
        return view('admin.conObservaciones_estancia_carga_horaria', ['datos' => $carta, 'id' => $datos]);
    }
    //guardar carga horaria->manda correo
    public function  guardarObservaciones_documento_admin(Request $request, $id, $idU, $proces, $doc)
    { //*funcion optimizada
        $observacion = $request->input('observaciones');
        $name = [
            'Carga Horaria', 'Constancia de Derecho',
            'Carta Responsiva', 'Carta de Presentación',
            'Carta de Aceptacion', 'Cedula de Registro',
            'Definicion de Proyecto', 'Carta de Liberacion', 'Carta Compromiso', 'Reporte Mensual', 'Reporte Mensual',
            'Reporte Mensual', 'Reporte Mensual', 'Reporte Mensual', 'Reporte Mensual', 'Reporte Mensual',
            'Reporte Mensual', 'Reporte Mensual', 'Reporte Mensual', 'Reporte Mensual', 'Reporte Mensual'
        ];
        switch ($doc) {
            case 1:
                $carta = documentos::find($id);
                $carta->estado_c_h = 0;
                $carta->observaciones_c_h = $observacion;
                break;
            default:
                # code...
                break;
        }
        $carta->save();
        $resp = $name[$doc - 1] . ' con Observación y ' . CorreoController::storeob($idU, $name[$doc - 1], 2, $observacion);
        if (Session("url_return")) {
            return redirect(Session("url_return"))->with('Con Observacion', $resp);
            $request->session()->put('url_return', null);
        }
    }
    //buscar datos de usuario
    public function buscador_estancia1(Request $request, $proces, $name)
    { //*optimizado
        $texto   = trim($request->get('texto'));
        $estatus = ($request->get('estatus'));
        $año     = trim($request->get('año'));
        $name = ['Estancia I', 'Estancia II', 'Estadia', 'Estadias Nacionales', 'Servicio Social'];
        if ($proces > 0 && $proces <= 5) { //comprueba si el numero es de algun proceso del 1...5
            //$NmProces=$name[$proces-1];
            $var = [$proces, $name[$proces - 1]]; //guarda el numero y nombre del proceso
        } else return redirect('admin');
        $tiposdocumentos = DB::table('tipodoc')->get();
        $documentos = DB::table('documentos')
            ->join('detalledoc', 'documentos.IdDoc', "=", 'detalledoc.IdDoc')
            ->join('proceso', 'proceso.IdProceso', "=", 'detalledoc.IdProceso')
            ->join('users', 'users.id', "=", 'proceso.IdUsuario')
            ->where('IdTipoProceso', $proces)
            ->where('name', 'LIKE', '%' . $texto . '%')
            ->where('IdPeriodo', '=', $estatus)
            ->orWhere('Nombre', 'LIKE', '%' . $texto . '%')
            ->get();
        // dump($documentos);
            // dump($texto, $estatus, $var, $name, );
        return view('nombres.Buscar_estancia1', ['proceso' => $var, 'documentos' => $tiposdocumentos, 'documentacion' => $documentos]);
    }

    public function Cambiar_Estado_Doc(Request $request, $idDoc, $idSeleccionado)
    {
        $estadoDeseado = $request->input('estadoDeseado');
        $idProcesoSeleccionado = (int)$idSeleccionado;
        $carta = documentos::find($idDoc);
        switch ($estadoDeseado) {
            case 1:
                $carta->IdEstado = 1;
                $estado = 'Aceptado';
                break;
            case 2:
                $carta->IdEstado = 2;
                $estado = 'Pendiente';
                break;
            case 3:
                return redirect()->route('observacion_documento_ver.index', ['idDoc' => $idDoc, 'idProcesoSeleccionado'=>$idProcesoSeleccionado]);
                break;
            default:

                break;
        }
        $carta->save();
        return back()->withInput()->with('success', 'se ha cambiado el estado del documento a:' . $estado);
    }

    public function observacion_documento(Request $request, $idDoc, $idProcesoSeleccionado)
    {
        $observacion = $request->get('observaciones');
        $documento = documentos::find($idDoc);
        $documento->comentario = $observacion;
        $documento->IdEstado = 3;
        $documento->save();
        return redirect()->route('observacion_documento_ver.index', ['idDoc' => $idDoc, 'idProcesoSeleccionado'=>$idProcesoSeleccionado])->with('success', 'comentario guardado correctamente');
    }

    public function observacion_documento_Ver($idDoc, $idProceso)
    {
        $documento = documentos::find($idDoc);
        $procesoTipoSeleccionado = (int)$idProceso;
        return view('admin.observaciones_estancia_carga_horaria', ['documento' => $documento, 'procesoTipoSeleccionado'=>$procesoTipoSeleccionado]);
    }
    public function ver_csv_academico()
    {
        return view('admin.asesores_agregar');
    }
    public function subir_csv_academico(Request $request)
    {
        if ($request->hasFile('csv_aa')) {
            $csv = Reader::createFromPath($request->file('csv_aa')->path());
            $csv->setHeaderOffset(0);
            $batchSize = 1000; // Número de filas a procesar en cada lote
            $records = $csv->getRecords();

            $batch = [];
            $rowCount = 0;

            foreach ($records as $record) {
                $asesor = Asesor_Aca::where('Nombre', $record['Nombre'])->first();
                if (!$asesor) {
                    $batch[] = [
                        'Nombre' => $record['Nombre'],
                        'APP' => $record['APP'],
                        'APM' => $record['APM'],
                        'IdGrado' => $record['IdGrado']
                    ];
                }
                $rowCount++;
                if ($rowCount == $batchSize) {
                    Asesor_Aca::insert($batch);
                    $batch = [];
                    $rowCount = 0;
                }
            }

            // Procesa el último lote (si existe)
            if ($rowCount > 0) {
                Asesor_Aca::insert($batch);
            }

            return redirect()->to('/Asesores')->with('success', 'asesores agregados');
        }
        return view('admin.asesores_agregar')->with('error', 'tuvo errores');
    }

    public function subir_csv_empresarial(Request $request)
    {
        if ($request->hasFile('csv_ae')) {
            $csv = Reader::createFromPath($request->file('csv_ae')->path());
            $csv->setHeaderOffset(0);
            $batchSize = 1000; // Número de filas a procesar en cada lote
            $records = $csv->getRecords();

            $batchEmpresa = [];
            $batchAE_Empresa = [];
            $rowCount = 0;

            foreach ($records as $record) {
                // Verificar si la empresa ya existe en la tabla Empresa
                $empresa = Empresa::where('Nombre', $record['Nombre_Emp'])->first();
                if (!$empresa) {
                    $batchEmpresa[] = [
                        'Nombre' => $record['Nombre_Emp'],
                        'Direccion' => $record['Direccion'],
                        'Correo' => $record['Correo_emp'],
                        'Telefono' => $record['Telefono']
                    ];
                }

                // Obtener el ID del asesor y el ID de la empresa (o crearlos si no existen)
                $rowCount++;
                if ($rowCount == $batchSize) {
                    ae_emp::insert($batchAE_Empresa);
                    $batchAE_Empresa = [];
                    $rowCount = 0;
                }
            }
            return redirect()->to('/Asesores')->with('success', 'Asesores agregados');
        }

        return view('admin.asesores_agregar')->with('error', 'El archivo CSV no se pudo procesar');
    }
}
