<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use App\Models\Producto;
use App\Models\Proveedor;
use App\Models\Fabricante;

class ProductoController extends Controller
{

    public function index(){
        return Producto::with('fabricante', 'proveedor')->get();
    }

    public function create(){
        $proveedores = Proveedor::all();
        $fabricantes = Fabricante::all();
        return compact(['proveedores', 'fabricantes']);
    }

    public function store(Request $request){
        $producto = new Producto;
        $producto->fill($request->all());
        $producto->save();
    }

    public function edit($id){
        $producto = Producto::find($id);
        $proveedores = Proveedor::all();
        $fabricantes = Fabricante::all();
        return compact(['producto', 'proveedores', 'fabricantes']);
    }

    public function update(Request $request){
        try{
            $producto = Producto::find($request->idProducto);
            $producto->fill($request->all());
            $producto->save();
        }catch(Exception $ex){

        }
    }

    public function destroy($id){
        Producto::find($id)->delete();
    }

    function getProductosDeProveedor($id) {
        return Producto::with(['proveedor','fabricante'])->where('idProveedor','=',$id)->get();
    }
}
