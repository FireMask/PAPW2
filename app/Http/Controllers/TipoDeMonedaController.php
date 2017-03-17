<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use App\Models\TipoDeMoneda;

class TipoDeMonedaController extends Controller
{

    public function index(){
      $monedas = TipoDeMoneda::all();
      return view('admin.moneda.view-moneda', compact('monedas'));
    }

    public function create(){
        return view('admin.moneda.add-moneda');
    }

    public function store(Request $request){
        $moneda = new TipoDeMoneda;
        $moneda->nombre = $request->nombre;
        $moneda->simbolo = $request->simbolo;
        $moneda->presicion = $request->presicion;
        $moneda->separador_millares = $request->separador_millares;
        $moneda->separador_decimales = $request->separador_decimales;
        $moneda->codigo = $request->codigo;
        $moneda->save();
        return redirect('/moneda');
    }

    public function edit($id){
        $moneda = TipoDeMoneda::find($id);
        return view('admin.moneda.edit-moneda', compact('moneda'));
    }

    public function update(Request $request){
        try{
            $moneda = TipoDeMoneda::find($request->idMoneda);
            $moneda->fill($request->all());
            $moneda->save();
            return redirect('/moneda');
        }catch(Exception $ex){
            return redirect('moneda/'.$request->idMoneda.'/edit');
        }
    }

    public function destroy($id){
        $moneda = TipoDeMoneda::find($id);
        $moneda->delete();
        return redirect('/moneda');
    }
}
