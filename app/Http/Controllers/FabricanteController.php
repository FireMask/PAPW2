<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use App\Models\Fabricante;
use App\Models\Producto;
use App\Models\Proveedor;

class FabricanteController extends Controller
{

    public function index(){
      return Fabricante::all();
    }

    public function create(){

    }

    public function store(Request $request){
        $fabricante = new Fabricante;
        $fabricante->nombre = $request->nombre;
        $fabricante->save();
    }

    public function edit($id){
        return Fabricante::find($id);
    }

    public function update(Request $request){
        try{
            $fabricante = Fabricante::find($request->idFabricante);
            $fabricante->fill($request->all());
            $fabricante->save();
        }catch(Exception $ex){

        }
    }

    public function destroy($id){
        return Fabricante::find($id)->delete();
    }

    public function getProductosDeFabricante($id) {
        return Producto::with(['proveedor','fabricante'])->where('idFabricante','=',$id)->get();
    }

    public function getFabProd(){
        $fabricantes = Fabricante::all();
        $proveedores = Proveedor::all();
        return compact(['fabricantes', 'proveedores']);
    }
}
