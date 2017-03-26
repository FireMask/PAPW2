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
        $productos = Producto::with('fabricante', 'proveedor')->get();
        return view('admin.producto.view-producto', compact('productos'));
//        return $productos;
    }

    public function create(){
        $proveedores = Proveedor::all();
        $fabricantes = Fabricante::all();
        return view('admin.producto.add-producto', compact('proveedores', 'fabricantes'));
    }

    public function store(Request $request){
        $producto = new Producto;
        $producto->fill($request->all());
        $producto->save();
        return redirect('/producto');
    }

    public function edit($id){
        $producto = Producto::find($id);
        $proveedores = Proveedor::all();
        $fabricantes = Fabricante::all();
        return view('admin.producto.edit-producto', compact('producto', 'proveedores', 'fabricantes'));
    }

    public function update(Request $request){
        try{
            $producto = Producto::find($request->idProducto);
            $producto->fill($request->all());
            $producto->save();
            return redirect('/producto');
        }catch(Exception $ex){
            return redirect('producto/'.$request->idProducto.'/edit');
        }
    }

    public function destroy($id){
        $producto = Producto::find($id);
        $producto->delete();
        return redirect('/producto');
    }
}
