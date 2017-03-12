<?php

namespace App\Http\Controllers;

use App\Http\Requests\loginRequest;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\MessageBag;

class loginController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
	    return "asd";
    }

    /**
     * @param loginRequest $request
     * @return mixed
     */
    public function store(LoginRequest $request)
    {
        if(Auth::attempt(['correo_usuario' => $request['correo'], 'contra_usuario' => $request['pass']]))
        {
            $rolUsuario = Usuario::find(Auth::user()->idUsuario)->rol()->get();
			return $rolUsuario;
		}
    }

    public function logout()
    {
        Auth::logout();
        return Redirect::to('/login');
    }
}
