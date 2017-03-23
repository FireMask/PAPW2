<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\Rol;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

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
        $usuario->fill($request->all());
        $usuario->contra_usuario = sha1($request->contra_usuario);
        if($request->hasFile('imagen_perfil')){
            $file = $request->file('imagen_perfil');
            $extension = $file->getClientOriginalExtension();
            $newname = sha1(Carbon::now().$file->getFilename()).'.'.$extension;
            $usuario->imagen_perfil = $newname;
            Storage::disk('public')->put($newname,  File::get($file));
        }
        $usuario->save();
        return redirect('/usuario');
    }

    public function edit($id){
        $roles = Rol::all();
        $usuario = Usuario::find($id);
        return view('admin.usuario.edit-usuario', compact('usuario', 'roles'));
    }

    public function update(Request $request){
        try{
            $usuario = Usuario::find($request->idUsuario);
            $usuario->fill($request->all());
            $usuario->contra_usuario = sha1($request->contra_usuario);
            if($request->hasFile('imagen_perfil')){
                $file = $request->file('imagen_perfil');
                $extension = $file->getClientOriginalExtension();
                $newname = sha1(Carbon::now().$file->getFilename()).'.'.$extension;
                $usuario->imagen_perfil = $newname;
                Storage::disk('public')->put($newname,  File::get($file));
            }
            $usuario->save();
            return redirect('/usuario');
        }catch(Exception $ex){
            return redirect('usuario/'.$request->idUsuario.'/edit');
        }
    }

    public function destroy($id){
        $usuario = Usuario::find($id);
        $usuario->delete();
        return redirect('/usuario');
    }
}
