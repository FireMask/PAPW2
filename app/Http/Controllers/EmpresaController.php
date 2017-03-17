<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use App\Models\Empresa;
use App\Models\TipoDeMoneda;

class EmpresaController extends Controller
{

    public function index(){
      $emp = Empresa::with('moneda')->get()->first();
      return view('admin.empresa.view-empresa', compact('emp'));
    }

    public function edit($id){
        $empresa = Empresa::with('moneda')->get()->first();
        $monedas = TipoDeMoneda::all();
        return view('admin.empresa.edit-empresa', compact('empresa', 'monedas'));
        //return $empresa;
    }

    public function update(Request $request){
        try{
            $empresa = Empresa::find($request->idEmpresa);
            $empresa->fill($request->all());
            $empresa->save();
            return redirect('/empresa');
        }catch(Exception $ex){
            return redirect('empresa/'.$id.'/edit');
        }
    }
}
