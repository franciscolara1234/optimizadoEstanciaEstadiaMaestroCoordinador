<?php

namespace App\Http\Controllers;

use App\Models\proceso;
use App\Models\User;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index() {

        //inicio admin 
        //contador usuarios
        $userC = ['usersCount' => User::count()];
        $adminC = ['adminsCount' => User::where('IdTipoUsu', '1')->count()];
        $estanciaCount = ['estanciaCount' => proceso::where('IdTipoProceso','1')->count()];
        $estancia2Count =['estancia2Count' => proceso::where('IdTipoProceso','2')->count()];
        $estadiaCount =['estadiaCount' => proceso::where('IdTipoProceso','3')->count()];
        $serviciosocialCount =['serviciosocialCount' => proceso::where('IdTipoProceso','4')->count()];
        $estadianacionalesCount = ['estadianacionalesCount' => proceso::where('IdTipoProceso','5')->count()];
        $data = Arr::collapse([$userC,$adminC,$estanciaCount,$estancia2Count,$estadiaCount,$serviciosocialCount,$estadianacionalesCount]);

        return view('admin.index',['datos'=>$data]);
    }
    public function ver(){
       
        return view('admin.editar_admin');
    }
    
    public function editar(Request $request){
        $this->validate(request(), [
            'password' => 'required'
        ]);
        $userID=Auth::user()->id;
        $user=User::find($userID);
        $user->password=request('password');
        $user->save();
        return redirect()->to('/admin')->with('success','Contraseña cambiada');
    }
}
