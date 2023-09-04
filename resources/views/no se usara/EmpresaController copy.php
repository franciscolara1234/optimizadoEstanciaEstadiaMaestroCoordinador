<?php

namespace App\Http\Controllers;

use App\Models\documentos;
use App\Models\Empresa;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmpresaController extends Controller
{
    //
    public function vertest()
    {
        $empresa = DB::table('empresa')
            ->get();

        return view('admin.vistaadminempresa', compact('empresa', 'tipoemp'));
    }

    public function verempresasadmin()
    {
        $empresa = Empresa::select(
            'emp.IdEmp',
            'emp.Nombre',
            'emp.Direccion',
            'emp.Correo',
            'emp.Telefono',
            'emp.RFC',
            'emp.Giro',
            'emp.URLemp',
            'tipE.Tipo_Empresa',
            'taE.Tipo_Tamaño'
        )
            ->from('empresa as emp')
            ->join('tipoemp as tipE', 'emp.fk_TipoEmp', '=', 'tipE.id_Tipo_Emp')
            ->join('tamañoemp as taE', 'emp.fk_TamañoEmp', '=', 'taE.id_Tamaño_Emp')
            ->get();
        // dd($empresa);
        return view('admin.DatosEmpresaNuevo', compact('empresa'));
    }

    public function verempresausuario()
    {
        $empresa = Empresa::select(
            'emp.IdEmp',
            'emp.Nombre',
            'emp.Direccion',
            'emp.Correo',
            'emp.Telefono',
            'emp.RFC',
            'emp.Giro',
            'emp.URLemp',
            'tipE.Tipo_Empresa',
            'taE.Tipo_Tamaño'
        )
            ->from('empresa as emp')
            ->join('tipoemp as tipE', 'emp.fk_TipoEmp', '=', 'tipE.id_Tipo_Emp')
            ->join('tamañoemp as taE', 'emp.fk_TamañoEmp', '=', 'taE.id_Tamaño_Emp')
            ->get();
        // dd($empresa);
        return view('usuario.vistaEmpresa', compact('empresa'));
    }

public function ver_datos_empresa($IdEmp)
{
    $datos = DB::table('empresa')
    ->join('tamañoemp','empresa.fk_TamañoEmp','=','tamañoemp.id_Tamaño_Emp')
    ->join('tipoemp','empresa.fk_TipoEmp','=','tipoemp.id_Tipo_Emp')
    ->where('IdEmp', $IdEmp)->get();
    $Tipoemp = DB::table('tipoemp')->get();
    $Tamañoemp = DB::table('tamañoemp')->get();

    return view('admin.editarEmpresa', ['data' => $datos, 'Tipoemp' => $Tipoemp , 'Tamañoemp' => $Tamañoemp]);
}

    public function editarEmpresa(Request $request, $IdEmp)
    {
        $empresa = Empresa::Find($IdEmp);
        // $empresa = new Empresa($IdEmp);

        // $empresa->Nombre =Request('nombre');
        if ($empresa !== null) {
            $empresa->Nombre = Request('nombre');
        }
        // $empresa->Direccion =Request('direccion');
        if ($empresa !== null) {
            $empresa->Direccion = Request('direccion');
        }
        // $empresa->Correo =Request('correo');
        if ($empresa !== null) {
            $empresa->Correo = Request('correo');
        }
        // $empresa->Telefono =Request('telefono');
        if ($empresa !== null) {
            $empresa->Telefono = Request('telefono');
        }

        // $empresa->RFC =Request('rfc');
        if ($empresa !== null) {
            $empresa->RFC = Request('rfc');
        }
        // $empresa->Giro =Request('giro');
        if ($empresa !== null) {
            $empresa->Giro = Request('giro');
        }
        // $empresa->URLemp =Request('urlemp');
        if ($empresa !== null) {
            $empresa->URLemp = Request('urlemp');
        }

        // $empresa->Tipo_Empresa =Request('tipo_empresa');
        if ($empresa !== null) {
            $empresa->fk_TipoEmp = Request('Tipo_Empresa');
        }
        // $empresa->Tipo_Tamaño =Request('tipo_tamaño ');
        if ($empresa !== null) {
            $empresa->fk_TamañoEmp = Request('Tamaño_Empresa');
        }

        $empresa->save();
        return redirect()->to('/vistaEmpresaAdmin')->with('success', 'sus datos han sido modificados exitosamente');
    }

    public function eliminarEmpresa($IdEmp)
    {
        DB::table('empresa')
            ->where('IdEmp', $IdEmp)
            ->delete();
        return redirect()->to('/vistaEmpresaAdmin')->with('mensaje', 'El registro se eliminó correctamente');
    }

    //Agregar empresa
    public function registroEmpresa()
    {
        // dd($Result);
        $insercionEmpresas = DB::table('empresa AS emp')
        ->select(
                 'emp.Nombre',
                 'emp.Direccion',
                 'emp.Correo',
                 'emp.Telefono',
                 'emp.RFC', 'emp.Giro',
                 'emp.URLemp',
                 'tipE.id_Tipo_Emp',
                 'taE.id_Tamaño_Emp')
        ->join('tipoemp AS tipE', 'emp.fk_TipoEmp', '=', 'tipE.id_Tipo_Emp')
        ->join('tamañoemp AS taE', 'emp.fk_TamañoEmp', '=', 'taE.id_Tamaño_Emp')

        ->get();

        return view('admin.empresa_registro', ['empresa' => $insercionEmpresas]);
    }

    public function agregar(Request $request) {

        $request->validate([
            'Nombre' => 'required',
            'Direccion' => 'required',
            'Correo' => 'required|email',
            'Telefono' => 'required',
            'RFC' => 'required',
            'Giro' => 'required',
            'URLemp' => 'required|url',
            'fk_TipoEmp' => 'required',
            'fk_TamañoEmp' => 'required',
        ]);

        $empresa = new Empresa([
            // 'IdEmp' => $request->input('IdEmp'),
            'Nombre' =>  $request->input('Nombre'),
            'Direccion' => $request->input('Direccion'),
            'Correo' => $request->input('Correo'),
            'Telefono' => $request->input('Telefono'),
            'RFC' => $request->input('RFC'),
            'Giro' => $request->input('Giro'),
            'URLemp' => $request->input('URLemp'),
            'fk_TipoEmp' => $request->input('fk_TipoEmp'),
            'fk_TamañoEmp' => $request->input('fk_TamañoEmp'),

        ]);
        $empresa->save();

        return view('admin.empresa_registro');

    }


}


