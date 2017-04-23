<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use App\Models\Cliente;

class ClienteController extends Controller
{

    public function index(){
        return Cliente::all();
    }

    public function create(){

    }

    public function store(Request $request){
        $cliente = new Cliente();
        $cliente->fill($request->all());
        $cliente->prospecto = ($request->prospecto)?1:0;
        $cliente->save();
    }

    public function edit($id){
        return Cliente::find($id);
    }

    public function update(Request $request){
        try{
            $cliente = Cliente::find($request->idCliente);
            $cliente->fill($request->all());
            $cliente->prospecto = ($request->prospecto)?1:0;
            $cliente->save();
        }catch(Exception $ex){

        }
    }

    public function destroy($id){
        Cliente::find($id)->delete();
    }
}
