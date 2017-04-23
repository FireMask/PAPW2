<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use App\Models\Rol;

class RolController extends Controller
{

    public function index(){
      return Rol::all();
    }

    public function create(){
        return view('admin.rol.add-rol');
    }

    public function store(Request $request){
        $rol = new Rol;
        $rol->nombre = $request->nombre;
        $rol->save();
    }

    public function edit($id){
        $rol = Rol::find($id);
    }

    public function update(Request $request){
        try{
            $rol = Rol::find($request->idRol);
            $rol->fill($request->all());
            $rol->save();
        }catch(Exception $ex){

        }
    }

    public function destroy($id){
        Rol::find($id)->delete;
    }
}
