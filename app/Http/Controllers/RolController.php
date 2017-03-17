<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use App\Models\Rol;

class RolController extends Controller
{

    public function index(){
      $roles = Rol::all();
      return view('admin.rol.view-rol', compact('roles'));
    }

    public function create(){
        return view('admin.rol.add-rol');
    }

    public function store(Request $request){
        $rol = new Rol;
        $rol->nombre = $request->nombre;
        $rol->save();
        return redirect('/rol');
    }

    public function edit($id){
        $rol = Rol::find($id);
        return view('admin.rol.edit-rol', compact('rol'));
    }

    public function update(Request $request){
        try{
            $rol = Rol::find($request->idRol);
            $rol->fill($request->all());
            $rol->save();
            return redirect('/rol');
        }catch(Exception $ex){
            return redirect('rol/'.$request->idRol.'/edit');
        }
    }

    public function destroy($id){
        $rol = Rol::find($id);
        $rol->delete();
        return redirect('/rol');
    }
}
