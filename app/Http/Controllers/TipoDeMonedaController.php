<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use App\Models\TipoDeMoneda;

class TipoDeMonedaController extends Controller
{

    public function index(){
      return TipoDeMoneda::all();
    }

    public function create(){

    }

    public function store(Request $request){
        $moneda = new TipoDeMoneda;
        $moneda->fill($request->all());
        $moneda->save();
    }

    public function edit($id){
        return TipoDeMoneda::find($id);
    }

    public function update(Request $request){
        try{
            $moneda = TipoDeMoneda::find($request->idMoneda);
            $moneda->fill($request->all());
            $moneda->save();
        }catch(Exception $ex){

        }
    }

    public function destroy($id){
        TipoDeMoneda::find($id)->delete();
    }
}
