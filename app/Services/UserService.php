<?php

namespace App\Services;

use App\Models\Branch;
use App\Models\Role;
use App\Models\Shipment;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Throwable;

class UserService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function getIndexData(){
        $users = User::with(['role', 'branch'])
                    ->whereHas('role', function ($query) {
                        $query->where('name', '!=', 'admin');
                    })
                    ->visibleTo(Auth::user())
                    ->orderBy('id')
                    ->paginate(15);
        $branches = Branch::orderBy('id')
                    ->get();
        $roles = Role::orderBy('id')
                    ->whereNot("name", "admin")
                    ->get();
        
        return [
            'users' => $users,
            'branches' => $branches,
            'roles' => $roles
        ];
    }

    public function store(array $validated){
        try{
            DB::beginTransaction();

            // Temporary password li byetla3 lal admin marra wa7de bas
            $temporaryPassword = Str::password(12);

            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'] ?? null,
                'salary' => $validated['salary'] ?? null,

                'role_id' => $validated['role_id'],
                'branch_id' => $validated['branch_id'] ?? null,

                'is_active' => $validated['is_active'] ?? true,

                // Mnkhazen l password hashed, la ysir fi ysawe login
                'password' => Hash::make($temporaryPassword),

                // Awal login lezem yghayer l password
                'must_change_password' => true,

                // Temporary password valid 24 hours
                'temporary_password_expires_at' => now()->addDay(),

                // Ba3do ma ghayar password
                'password_changed_at' => null,
            ]);
            // hon b3d fi logic if(hwe shipper) lezem nsawe new record Shipper bl data li bteje

            DB::commit();
        } catch(Throwable $e){
            DB::rollBack();
            throw $e;
        }

        return [
            'user' => $user,
            'temporary_password' => $temporaryPassword,
        ];
    }

    public function update(array $validated, User $user)
    {
        DB::beginTransaction();

        try {
            $user->update([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'] ?? null,
                'salary' => $validated['salary'] ?? null,

                'role_id' => $validated['role_id'],
                'branch_id' => $validated['branch_id'] ?? null,
            ]);

            // eza l role shipper
            // if ($user->role?->name === 'shipper') {
            //     Shipper::updateOrCreate(
            //         ['user_id' => $user->id],
            //         [
            //             'branch_id' => $user->branch_id,
            //             'name' => $user->name,
            //             'phone' => $user->phone,
            //             'is_active' => $user->is_active,
            //         ]
            //     );
            // } else {
                // Eza ken shipper abl w hala2 tghayar role, mn3attel shipper profile
                // $user->shipper?->update([
                //     'is_active' => false,
                // ]);
            // }

            DB::commit();

            return $user;

        } catch (Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function activate(User $user){
        return $user->update([
            'is_active' => true,
        ]);
    }

    public function deactivate(User $user){
        if (! $user->is_active) {
            return [
                'success' => false,
                'message' => 'This user is already inactive.',
            ];
        }

        if (auth()->id() === $user->id) {
            return [
                'success' => false,
                'message' => 'You cannot deactivate your own account.',
            ];
        }

        // eza hwe mwazaf, w fi shipments men3atyin elo 
        $hasActiveAgentShipments = Shipment::where('delivery_agent_id', $user->id)
            ->whereNotIn('status', ['delivered', 'cancelled', 'returned'])
            ->exists();

        if ($hasActiveAgentShipments) {
            return [
                'success' => false,
                'message' => 'This employee has active shipments. Reassign them before deactivating.',
            ];
        }

        // eza howe shipper w 3ndo shipments b 2idna, eza laa, mn3atil l shipper profile 
        if ($user->shipper) {
            $hasActiveShipperShipments = Shipment::where('shipper_id', $user->shipper->id)
                ->whereNotIn('status', ['delivered', 'cancelled', 'returned'])
                ->exists();

            if ($hasActiveShipperShipments) {
                return [
                    'success' => false,
                    'message' => 'This shipper has active shipments. Reassign them before deactivating.',
                ];
            }
        }

        DB::transaction(function () use ($user) {
            $user->update([
                'is_active' => false,
            ]);

            if ($user->shipper) {
                $user->shipper->update([
                    'is_active' => false,
                ]);
            }
        });

        return [
            'success' => true,
            'message' => 'User deactivated successfully.',
        ];
    }
}
