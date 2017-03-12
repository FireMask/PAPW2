<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use App\Models\Usuario;
use App\Models\Rol;

class UsuarioController extends Controller
{

    public function index(){
      $users = Usuario::with('rol')->get();
      return view('admin.usuario.view-usuario', compact('users'));
    }

    public function create(){
        $roles = Rol::all();
        return view('admin.usuario.add-usuario', compact('roles'));
    }

    public function store(Request $request){
      $usuario = new Usuario;
      $usuario->nombres = $request->nombres;
      $usuario->apellido_paterno = $request->apellido_paterno;
      $usuario->apellido_materno = $request->apellido_materno;
      $usuario->correo_usuario = $request->correo;
      $usuario->contra_usuario = sha1($request->contra_usuario);
      $usuario->idRol = $request->rol;
      $usuario->save();
      return redirect('/usuarios');
    }

    public function edit($id){
        $roles = Rol::all();
        $usuario = Usuario::find($id);
        return view('admin.usuario.edit-usuario', compact('usuario', 'roles'));
    }

    public function update(Request $request, $id){
        try{
            $user = Usuario::find($id);
            $user->fill($request->all());
            $user->save();
            return redirect('/usuarios');
        }catch(Exception $ex){
            return redirect('usuario/'.$id.'/edit');
        }
    }

    public function destroy($id){
      $usuario = Usuario::find($id);
      $usuario->delete();
      return redirect('/usuarios');
    }
}
