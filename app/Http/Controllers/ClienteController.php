<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use App\Models\Cliente;

class ClienteController extends Controller
{

    public function index(){
        $clientes = Cliente::all();
        return view('admin.cliente.view-cliente', compact('clientes'));
    }

    public function create(){
        return view('admin.cliente.add-cliente');
    }

    public function store(Request $request){
        $cliente = new Cliente();
        $cliente->fill($request->all());
        $cliente->prospecto = ($request->prospecto)?1:0;
        $cliente->save();
        return redirect('/cliente');
    }

    public function edit($id){
        $cliente = Cliente::find($id);
        return view('admin.cliente.edit-cliente', compact('cliente'));
    }

    public function update(Request $request){
        try{
            $cliente = Cliente::find($request->idCliente);
            $cliente->fill($request->all());
            $cliente->prospecto = ($request->prospecto)?1:0;
            $cliente->save();
            return redirect('/cliente');
        }catch(Exception $ex){
            return redirect('cliente/'.$request->idCliente.'/edit');
        }
    }

    public function destroy($id){
        $cliente = Cliente::find($id);
        $cliente->delete();
        return redirect('/cliente');
    }
}
