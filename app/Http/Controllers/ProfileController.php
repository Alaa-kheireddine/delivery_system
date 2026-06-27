<?php

namespace App\Http\Controllers;

use App\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function __construct(private AuthService $service)
    {
        
    }
    public function showProfile(){
        $user = Auth::user();
        return view('auth.profile', compact('user'));
    }

    public function updatePassword(Request $request){
        $validated = $request->validate([
            'current_password' => 'required|string',
            'password' =>         'required|string|min:8|confirmed'
        ]);

        $result = $this->service->updatePassword($validated, auth()->user());

        if($result['success'] == false){
            return back()->with('error', $result['message']);
        }

        return back()->with('success', $result['message']);
    }
}
