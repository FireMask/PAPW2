<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use App\Models\Empresa;
use App\Models\TipoDeMoneda;

class EmpresaController extends Controller
{

    public function index(){
      Empresa::with('moneda')->get()->first();
    }

    public function edit($id){
        $empresa = Empresa::with('moneda')->get()->first();
        $monedas = TipoDeMoneda::all();
        return compact(['empresa', 'monedas']);
    }

    public function update(Request $request){
        try{
            $empresa = Empresa::find($request->idEmpresa);
            $empresa->fill($request->all());
            $empresa->save();
        }catch(Exception $ex){

        }
    }
}
