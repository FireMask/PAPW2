<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\TipoDeMoneda;
use App\Models\Usuario;
use Illuminate\Http\Request;
use App\Models\Cotizacion;

class CotizacionController extends Controller
{

    public function index(){
        $cotizaciones = Cotizacion::with('moneda', 'cliente', 'usuario')->get();
        return view('admin.cotizacion.view-cotizacion', compact('cotizaciones'));
    }

    public function create(){
        $monedas = TipoDeMoneda::all();
        $clientes = Cliente::all();
        $usuarios = Usuario::all();
        return view('admin.cotizacion.add-cotizacion', compact('monedas', 'clientes', 'usuarios'));
    }

    public function store(Request $request){

    }

    public function edit($id){

    }

    public function update(Request $request){
        try{
            $cotizacion = Cotizacion::find($request->idCotizacion);
            $cotizacion->aprobada = $request->aprobada ? 1 : 0;
            $cotizacion->save();
            return redirect('/cotizacion');
        }catch(Exception $ex){}
    }

    public function destroy($id){

    }
}
