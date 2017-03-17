<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;

class apiController extends Controller
{
	public function getUsers(){
		$usuarios = Usuario::with('rol')->get();
		return response()->json(['usuarios' => $usuarios]);
	}
}
