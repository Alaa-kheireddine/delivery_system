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

    public function getIndexData(array $validated){
        $users = $this->applyFilters($validated);

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
            // hon b3d fi logic if(hwe client) lezem nsawe new record client bl data li bteje

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

            // eza l role Client
            // if ($user->role?->name === 'client') {
            //     Client::updateOrCreate(
            //         ['user_id' => $user->id],
            //         [
            //             'branch_id' => $user->branch_id,
            //             'name' => $user->name,
            //             'phone' => $user->phone,
            //             'is_active' => $user->is_active,
            //         ]
            //     );
            // } else {
                // Eza ken client abl w hala2 tghayar role, mn3attel client profile
                // $user->client?->update([
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

        // eza howe client w 3ndo shipments b 2idna, eza laa, mn3atil l client profile 
        if ($user->client) {
            $hasActiveClientShipments = Shipment::where('client_id', $user->client->id)
                ->whereNotIn('status', ['delivered', 'cancelled', 'returned'])
                ->exists();

            if ($hasActiveClientShipments) {
                return [
                    'success' => false,
                    'message' => 'This client has active shipments. Reassign them before deactivating.',
                ];
            }
        }

        DB::transaction(function () use ($user) {
            $user->update([
                'is_active' => false,
            ]);

            if ($user->client) {
                $user->client->update([
                    'is_active' => false,
                ]);
            }
        });

        return [
            'success' => true,
            'message' => 'User deactivated successfully.',
        ];
    }

    // Helper Methods

    // apply filters to users

    private function applyFilters(array $validated){
        $query = User::query()
            ->with(['role', 'branch']);

        if (!empty($validated['search'])) {
            $search = $validated['search'];

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%")
                ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        if (!empty($validated['role_name'])) {
            $query->whereHas('role', function ($q) use ($validated) {
                $q->where('name', $validated['role_name']);
            });
        }

        if (!empty($validated['branch_name'])) {
            $query->whereHas('branch', function ($q) use ($validated) {
                $q->where('name', $validated['branch_name']);
            });
        }

        if (!empty($validated['status'])) {
            if ($validated['status'] === 'active') {
                $query->where('is_active', true);
            }

            if ($validated['status'] === 'inactive') {
                $query->where('is_active', false);
            }
        }

        if (!empty($validated['password_status'])) {
            if ($validated['password_status'] === 'must_change') {
                $query->where('must_change_password', true);
            }

            if ($validated['password_status'] === 'changed') {
                $query->whereNotNull('password_changed_at');
            }

            if ($validated['password_status'] === 'not_changed') {
                $query->whereNull('password_changed_at')
                    ->where('must_change_password', false);
            }
        }

        $users = $query
            ->visibleTo(Auth::user())
            ->orderBy('id', 'desc')
            ->paginate(15)
            ->withQueryString();

        return $users;
    }
}
