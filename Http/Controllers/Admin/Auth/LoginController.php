<?php

namespace App\Http\Controllers\admin\Auth;

use App\Http\Controllers\Controller;
use App\Htpp\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\LoginRequest as AuthLoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    public function LoginUser(AuthLoginRequest $request){
        // dd($request->all());
        $credential=['email'=>$request->get('email'),'password'=>$request->get('password')];
        if (Auth::attempt($credential)){
            $request->session()->regenerate();
            if(auth()->user()->usertype == "admin")
                return redirect()->round('dashboard');

        }
        return back()->withErrors([
            'email'=>'The provided credentials do not match our records.',
        ]);
    }
    // protected function redirectTo()
    // {
    //     if(Auth::user()->usertype=='admin')
    //     {
    //        return redirect('layouts1');

    //     }else{
    //        return redirect('Home');
    //     }
    // }
    function logout(){
        if (Auth::check()){
            Auth::logout();
        }
        return redirect()->route('auth.login');
    }
}
