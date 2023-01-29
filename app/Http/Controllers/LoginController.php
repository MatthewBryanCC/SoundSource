<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;    
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginController extends Controller
{
    public function index() {
        return view('welcome', [
            'user' => auth()->user()
        ]);
    }

    public function SignupIndex() {
        return view('signup');
    }

    public function Register(Request $request) {
        \Log::info(json_encode($request->all()));
        
        $valids = $request->validate([
            'username' => 'required',
            'password' => 'required',
            'email' => 'required|email'
        ]);

        //Validated properly

        $NewUser = User::create([
            "name" => $request->username,
            "password" => Hash::make($request->password),
            "email" => $request->email
        ]);

        $valid2 = $request->validate([
            'password' => 'required',
            'email' => 'required|email'
        ]);
        if(!Auth::attempt($valid2)) {
            return redirect()->intended('/signup');
        }
        $request->session()->regenerate();
        return redirect()->intended('/dashboard');
       
    }

    public function LoginDo(Request $request) {
        $validation = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if(!Auth::attempt($validation, $request->remember)) {
            return redirect()->back()->withErrors(['email' => 'Invalid credentials!']);
        }
        //Authentication success
        return redirect()->intended('dashboard');
    }
    
    public function Login() {
        if(Auth::check()) {
            return redirect()->intended('dashboard');
        }
        return view('login');
    }

    public function Logout() {
        auth()->logout();
        return redirect()->intended('/');
    }
}
