<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use App\Models\Usuario;
use App\Models\Rol;

class UsuarioController extends Controller
{
      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
      $users = Usuario::with('rol')->get();
      return view('ListaUsuarios', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        //
    }

    public function registrar(){
      $roles = Rol::all();
      return view('registroUsuario', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
      $usuario = new Usuario;
      $usuario->nombres = $request->nombres;
      $usuario->apellido_paterno = $request->apellido_paterno;
      $usuario->apellido_materno = $request->apellido_materno;
      $usuario->correo_usuario = $request->correo;
      $usuario->contra_usuario = sha1($request->contra_usuario);
      $usuario->idRol = $request->rol;
      $usuario->save();
      $roles = Rol::All();
      return view('ListaUsuarios', compact('roles'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
      $usuario = Usuario::find($id);
      $usuario->delete();
      return redirect()->route('users');
    }
}
