<?php

namespace App\Http\Controllers;

use App\Models\proceso;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{

    public function create() {
        
        return view('auth.login');
    }

    public function store() {
        if(auth()->attempt(request(['name', 'password'])) == false) {
            return back()->withErrors([
                'message' => 'El correo electrónico o la contraseña son incorrectos, intente nuevamente'
            ]);
        } 
        else 
        {
            if(auth()->user()->deleted_at){
                auth()->logout();

                return redirect()->to('/login');
            }
            else
            {
                // if (auth()->user()->IdTipoUsu == '1' || auth()->user()->IdTipoUsu == 1) {
                //     return redirect()->route('admin.index');
                // } 
                // else 
                // {

                //     if(auth()->user()->IdTipoUsu == '3' || auth()->user()->IdTipoUsu == 3)
                //     {
                //         return redirect()->route('homeAseAca');
                //     }
                //     else
                //     {
                //         return redirect()->to('/inicio');
                //     }

                // }
                switch (auth()->user()->IdTipoUsu) {
                    case 1:
                        return redirect()->route('admin.index');
                        break;
                    case 2:
                        return redirect()->to('/inicio');
                        break;
                    case 3:
                        return redirect()->route('inicioProcesosAnteriores',3);
                        break;
                    case 4:
                        return redirect()->route('homeAcademico',3);
                        break;
                }
            }
            
        }
    }

    public function destroy() {

        auth()->logout();

        return redirect()->to('/login');
    }

    public function ver(){
        $userID=Auth::user()->id; 
        $cedula_doc=DB::table('users')
        ->where('users.id',$userID)
        ->get();
        $carreras = DB::table('carrera')
        ->get();
        return view('cambiar_contra',['datos'=>$cedula_doc,'carreras'=>$carreras]);
    }
    
    public function editar(Request $request){
        $this->validate(request(), [
            'password' => 'required',
        ]);
        $userID=Auth::user()->id;
        $proceso = proceso::where('IdUsuario',$userID)->get();
        foreach($proceso as $pro){
            $pro->IdCarrera = request('carrera');
            $pro->save();
        }
        $user=User::find($userID);
        $user->password=request('password');
        $user->save();
        return redirect()->to('/alumno_ver_editar')->with('success','Datos cambiados');
    }
}
