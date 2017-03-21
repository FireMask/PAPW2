<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index(){
        if(Auth::check())
            return Redirect::to('index');
        return view('login');
    }

    public function store(Request $request){
        $auth = User::where('correo_usuario', '=', $request->email)
            ->where('contra_usuario', '=', sha1($request->pass))
            ->first();
        if($auth){
            Auth::login($auth);
            return Redirect::to('index');
        }else{
            return Redirect::to('login');
        }
    }

    public function logout(){
        Auth::logout();
        return Redirect::to('/login');
    }
}
