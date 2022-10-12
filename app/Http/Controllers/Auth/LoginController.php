<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginUserRequest;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware(['guest']);
    }

    public function index() {
        return view('auth.login');
    }

    public function login(LoginUserRequest $request) {
    
        if (!auth()->attempt($request->only('email', 'password'))) {
            return back()->with('status', 'Données de connexion invalide');
        }

        return redirect()->route('home');
    }
}
