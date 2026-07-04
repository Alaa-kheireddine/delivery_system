<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AuthService;
use Illuminate\Support\Facades\Auth;

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

        if ($result['force_change_password']) {
            return redirect()->route('password.force-change');
        }

        $request->session()->regenerate();

        return redirect()->route('dashboard.index');
    }

    public function logout(Request $request){

        $result = $this->service->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    public function showForcePasswordChangeForm(){
        return view('auth.force-change-password');
    }

    public function forcePasswordChange(Request $request){
        $validated = $request->validate([
            'password' => ['required', 'confirmed', 'min:8']
        ]);

        $result = $this->service->forcePasswordChange($validated, Auth::user());

        if($result['sucess']){
            return redirect()->route('dashboard.index')
                    ->with('success', $result['message']);
        }
        return back()->with('error', 'Failed to change password.');
    }
}
