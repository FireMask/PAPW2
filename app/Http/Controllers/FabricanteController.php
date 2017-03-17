<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use App\Models\Fabricante;

class FabricanteController extends Controller
{

    public function index(){
      $fabricantes = Fabricante::all();
      return view('admin.fabricante.view-fabricante', compact('fabricantes'));
    }

    public function create(){
        return view('admin.fabricante.add-fabricante');
    }

    public function store(Request $request){
        $fabricante = new Fabricante;
        $fabricante->nombre = $request->nombre;
        $fabricante->save();
        return redirect('/fabricante');
    }

    public function edit($id){
        $fabricante = Fabricante::find($id);
        return view('admin.fabricante.edit-fabricante', compact('fabricante'));
    }

    public function update(Request $request){
        try{
            $fabricante = Fabricante::find($request->idFabricante);
            $fabricante->fill($request->all());
            $fabricante->save();
            return redirect('/fabricante');
        }catch(Exception $ex){
            return redirect('fabricante/'.$request->idFabricante.'/edit');
        }
    }

    public function destroy($id){
        $fabricante = Fabricante::find($id);
        $fabricante->delete();
        return redirect('/fabricante');
    }
}
