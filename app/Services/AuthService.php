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

            Auth::logout();

            return [
                'success' => false,
                'message' => 'Your account is inactive. Please contact the admin.',
            ];
        }

        Auth::login($user);

        if ($user->must_change_password) {
            return [
                'success' => true,
                'force_change_password' => true,
                'message' => 'You must change your password.',
            ];
        }
        
        return [
                'success' => true,
                'force_change_password' => false,
                'message' => 'Logged in successfully.',
            ];
    }

    public function logout(){

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

    public function forcePasswordChange(array $validated, User $user){
        $user->update([
            'password' => Hash::make($validated['password']),
            'must_change_password' => false,
            'temporary_password_expires_at' => null,
            'password_changed_at' => now(),
        ]);
        
        return [
            'sucess' => true,
            'message' => 'Password changed succefully.'
        ];
    }
}
