<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use App\Models\Proveedor;

class ProveedorController extends Controller
{

    public function index(){
      $proveedores = Proveedor::all();
      return view('admin.proveedor.view-proveedor', compact('proveedores'));
    }

    public function create(){
        return view('admin.proveedor.add-proveedor');
    }

    public function store(Request $request){
        $proveedor = new Proveedor;
        $proveedor->nombre = $request->nombre;
        $proveedor->save();
        return redirect('/proveedor');
    }

    public function edit($id){
        $proveedor = Proveedor::find($id);
        return view('admin.proveedor.edit-proveedor', compact('proveedor'));
    }

    public function update(Request $request){
        try{
            $proveedor = Proveedor::find($request->idProveedor);
            $proveedor->fill($request->all());
            $proveedor->save();
            return redirect('/proveedor');
        }catch(Exception $ex){
            return redirect('proveedor/'.$request->idProveedor.'/edit');
        }
    }

    public function destroy($id){
        $proveedor = Proveedor::find($id);
        $proveedor->delete();
        return redirect('/proveedor');
    }
}
