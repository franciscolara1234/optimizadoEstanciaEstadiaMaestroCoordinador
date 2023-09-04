<?php

namespace App\Http\Controllers;

use App\Models\Orm_aa_academico;
use App\Models\Orm_alumnos_perfil;
use App\Models\Orm_coordinador;
use App\Models\Orm_user;
use Illuminate\Http\Request;
use App\Models\User;
use League\Csv\Reader;

class RegisterController extends Controller
{
    public function create() {

        return view('auth.register');
    }

    public function store() {

        $this->validate(request(), [
            'name' => 'required',
            'IdTipoUsu'  => 'required',
            'email' => 'required',
            'password' => 'required',
            'Nombre' => 'required',
            'Matricula' => 'required'
        ]);
        
        $user = User::create(request(['name', 'IdTipoUsu', 'email', 'password','Nombre','Matricula']));

        if (auth()->login($user) == 1 || auth()->login($user) == '1') {
            return view('admin.index');
        } else {
            return redirect()->to('/usuarios');
        }
    }


    public function registrar(Request $request) {


        switch ($request->IdTipoUsu) {
            case 1:
                $this->validate(request(), [
                    'name' => 'required',
                    'IdTipoUsu'  => 'required|numeric',
                    'email' => 'required|unique:users',
                    'password' => 'required',
                    'Nombre' => 'required|alpha',
                    'Matricula' => 'required|unique:users|numeric|digits:5',
                    'IdCarrera' => 'required|numeric'
                ]);
                User::create(request(['name', 'IdTipoUsu', 'email', 'password','Nombre','Matricula', 'IdCarrera']));
        
                return redirect()->to('/datatable_user')->with('success','Usuario agregado');
                break;
            case 2:
                $this->validate(request(), [
                    'name' => 'required|unique:users|numeric|digits:9',
                    'IdTipoUsu'  => 'required|numeric',
                    'email' => 'required|unique:users',
                    'password' => 'required',
                    'Nombre' => 'string|required|regex:/^[a-zA-Z\sÁÉÍÓÚáéíóúÑñ\s]+$/u',
                    'Matricula' => 'required|unique:users|numeric|digits:9',
                    'IdCarrera' => 'required|numeric',
                    'APP' => 'required|alpha',
                    'APM' => 'required|alpha'
                ]);

                User::create(request(['name', 'IdTipoUsu', 'email', 'password','Nombre','Matricula', 'IdCarrera']));
                $IdUser = Orm_user::where('email', $request->input('email'))->first();
                $perfilAlumno = new Orm_alumnos_perfil();
                $perfilAlumno->IdUser = $IdUser->id; 
                $perfilAlumno->Nombre = $request->input('Nombre');
                $perfilAlumno->APP = $request->input('APP');
                $perfilAlumno->APM = $request->input('APM');
                $perfilAlumno->save();
                return redirect()->to('/datatable_user')->with('success','Usuario agregado');                break;
            case 3:
                $this->validate(request(), [
                    'name' => 'required|unique:users|numeric|digits:6',
                    'IdTipoUsu'  => 'required|numeric',
                    'email' => 'required|unique:users',
                    'password' => 'required',
                    'Nombre' => 'string|required|regex:/^[a-zA-Z\sÁÉÍÓÚáéíóúÑñ\s]+$/u',
                    'Matricula' => 'required|unique:users|numeric|digits:5', 
                    'IdCarrera' => 'required|numeric',
                    'APP' => 'required|alpha',
                    'APM' => 'required|alpha',
                    'IdGrado' => 'required|numeric '
                ]);
                User::create(request(['name', 'IdTipoUsu', 'email', 'password','Nombre','Matricula', 'IdCarrera']));
                $IdUser = Orm_user::where('email', $request->input('email'))->first();
                $perfilAcademico = new Orm_coordinador();
                $perfilAcademico->IdUser = $IdUser->id; 
                $perfilAcademico->Nombre = $request->input('Nombre');
                $perfilAcademico->APP = $request->input('APP');
                $perfilAcademico->APM = $request->input('APM');
                $perfilAcademico->IdGrado = $request->input('IdGrado');
                $perfilAcademico->save();

                return redirect()->to('/datatable_user')->with('success','Usuario agregado');                break;
            case 4:
                $this->validate(request(), [
                    'name' => 'required|unique:users|numeric|digits:6',
                    'IdTipoUsu'  => 'required|numeric',
                    'email' => 'required|unique:users',
                    'password' => 'required',
                    'Nombre' => 'string|required|regex:/^[a-zA-Z\sÁÉÍÓÚáéíóúÑñ\s]+$/u',
                    'Matricula' => 'required|unique:users|numeric|digits:5',
                    'IdCarrera' => 'required|numeric',
                    'APP' => 'required|alpha',
                    'APM' => 'required|alpha',
                    'IdGrado' => 'required|numeric'
                ]);
                User::create(request(['name', 'IdTipoUsu', 'email', 'password','Nombre','Matricula', 'IdCarrera']));

                $IdUser = Orm_user::where('email', $request->input('email'))->first();
                // Orm_coordinador::create(request([$IdUser->id, 'Nombre', 'APP', 'APM','IdGrado']));
                
                $coordinador = new Orm_aa_academico();
                $coordinador->IdUser = $IdUser->id; 
                $coordinador->Nombre = $request->input('Nombre');
                $coordinador->APP = $request->input('APP');
                $coordinador->APM = $request->input('APM');
                $coordinador->IdGrado = $request->input('IdGrado');
                $coordinador->save();

                // $tipoProcesoSeleccionado = Orm_tipo_proceso::where('IdTipoProceso', $request->input('select-tipo-proceso'))->get();
                return redirect()->to('/datatable_user')->with('success','Usuario agregado');                break;
                default:
                $this->validate(request(), [
                    'name' => 'required|unique:users',
                    'IdTipoUsu'  => 'required|numeric',
                    'email' => 'required|unique:users',
                    'password' => 'required',
                    'Nombre' => 'required',
                    'Matricula' => 'required|unique:users|numeric',
                    'IdCarrera' => 'required|numeric',
                    'APP' => 'required|alpha',
                    'APM' => 'required|alpha',
                    // 'IdGrado' => 'required|numeric'
                ]);
                return redirect()->to('/agregar_usuario')->with('error','Seleccione un rol de usuario'); ;
        }


    }
    public function registrar_csv(Request $request) {
        if($request->hasFile('alumnoscsv')){
            $csv = Reader::createFromPath($request->file('alumnoscsv')->path());
            $csv->setHeaderOffset(0);
            $batchSize = 1000; // Número de filas a procesar en cada lote
            $records = $csv->getRecords();
            $batch = [];
            $rowCount = 0;
            foreach($records as $record){
                $usuario = User::where('email', $record['email'])->first();
                if(!$usuario){
                    $batch[] = [
                        'name' => $record['matricula'],
                        'email' => $record['email'],
                        'Nombre' => $record['nombre'],
                        'Matricula' => $record['matricula'],
                        'IdTipoUsu' => $record['IdTipoUsu'],
                        'password' => bcrypt($record['matricula'])
                    ];
                }
                $rowCount++;
                if($rowCount == $batchSize){
                    User::insert($batch);
                    $rowCount = 0;
                }
            }
            if ($rowCount > 0) {
                User::insert($batch);
            }
            return redirect()->to('/datatable_user')->with('success','Usuarios agregados');
        }
        return redirect()->to('/datatable_user')->with('error','el archivo no pudo ser procesado o no existe');
    }
}
