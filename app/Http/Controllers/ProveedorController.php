<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use App\Models\Proveedor;

class ProveedorController extends Controller
{

    public function index(){
        return Proveedor::all();
    }

    public function create(){

    }

    public function store(Request $request){
        $proveedor = new Proveedor;
        $proveedor->nombre = $request->nombre;
        $proveedor->save();
    }

    public function edit($id){
        return Proveedor::find($id);
    }

    public function update(Request $request){
        try{
            $proveedor = Proveedor::find($request->idProveedor);
            $proveedor->fill($request->all());
            $proveedor->save();
        }catch(Exception $ex){

        }
    }

    public function destroy($id){
        Proveedor::find($id)->delete();
    }
}
