<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use App\Models\Cliente;
use App\Models\UsuarioCliente;
use App\Models\TipoDeMoneda;
use App\Models\Producto;

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
        $cliente->save();

        $relacion = new UsuarioCliente();
        $relacion->idUsuario = $request->idUsuario;
        $relacion->idCliente = $cliente->idCliente;
        $relacion->save();
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

    public function clientes_monedas($id){
        $monedas = TipoDeMoneda::all();
        $clientes = Cliente::join('usuario_cliente','usuario_cliente.idCliente','=','cliente.idCliente')
            ->where('idUsuario', '=', $id)
            ->select('cliente.*')
            ->get();
        $productos = Producto::all();
        return compact(['monedas', 'clientes', 'productos']);
    }

    public function destroy($id){
        Cliente::find($id)->delete();
    }
}
