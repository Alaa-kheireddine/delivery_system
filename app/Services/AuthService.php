<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function login(array $data){
        $user = User::where('email', $data['email'])->first();

        if(! $user || ! Hash::check($data['password'], $user->password)){
            return [
                'success' => false,
                'message' => 'Invalid email or password.',
            ];
        }

        if(! $user->is_active){
            return [
                'success' => false,
                'message' => 'Your account is inactive. Please contact the admin.',
            ];
        }

        Auth::login($user);


        return [
                'success' => true,
                'message' => 'Logged in successfully.',
            ];
    }

    public function logout(){

        if (! Auth::check()) {
            return [
                'success' => false,
                'message' => 'No authenticated user.',
            ];
        }

        Auth::logout();

        return [
            'success' => true,
            'message' => 'Logged out successfully.',
        ];
    }

    public function updatePassword(array $data, User $user){
        if(! Hash::check($data['current_password'], $user->password)){
            return [
                'success' => false,
                'message' => 'Current password is incorrect.',
            ];
        }
        $user->update([
            'password' => Hash::make( $data['password'] ) 
        ]); 

        return [
            'success' => true,
            'message' => 'Password updated successfully.',
        ];
    }
}
