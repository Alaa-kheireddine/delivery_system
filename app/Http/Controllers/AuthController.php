<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AuthService;

class AuthController extends Controller
{
    public function __construct(private AuthService $service){}

    public function showLogin(){
        return view('auth.login');
    }

    public function login(Request $request){
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8'
        ]);

        $result = $this->service->login($validated);

        // $result = ["success" => true/false , "message" => "..."]

        if($result['success'] === false){
            return back()->withErrors(['email' => $result['message']]);
        }

        return redirect()->route('dashboard');
    }

    public function logout(){

        $result = $this->service->logout();
        
        if($result['success'] === false){
            return back()->with('error', $result['message']);
        }

        return redirect()->route('login');
    }
}
