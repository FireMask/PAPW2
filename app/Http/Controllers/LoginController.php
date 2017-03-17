<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\MessageBag;

class LoginController extends Controller
{
    public function index(){
        if(Auth::check()) return Redirect::to('perfil');
        return view('login');
    }

    public function store(Request $request){
        return Redirect::to('index');
    }

    public function logout(){
        Auth::logout();
        return Redirect::to('/login');
    }
}
