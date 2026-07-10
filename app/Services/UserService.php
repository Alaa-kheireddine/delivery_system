<?php

namespace App\Services;

use App\Models\Branch;
use App\Models\Client;
use App\Models\Role;
use App\Models\Shipment;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
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

        // la no7faz e5er request 3a index page sar (la n7afiz 3ala filters)
        
        session(['users_index_url' => request()->fullUrl()]);

        $users = $this->applyFilters($validated);

        $branches = Branch::orderBy('id')
                    ->get();
        $roles = Role::orderBy('id')
                    ->whereNot("name", "admin")
                    ->get();

        // njib code e5er client la 7ata n7oto de8re lal admin b create user -> client
        $lastClient = Client::orderByDesc('id')->first();
        if (! $lastClient) {
            $code = 'CL-0001';
        } else {
            $number = (int) str_replace('CL-', '', $lastClient->code);

            $code = 'CL-' . str_pad($number + 1, 4, '0', STR_PAD_LEFT);
        }
        
        return [
            'users' => $users,
            'branches' => $branches,
            'roles' => $roles,
            'last_client_code' => $code,
        ];
    }

    public function getShowData(User $user)
    {
        return [
            "user" => $user->load(['role', 'branch'])
        ];
    }

    public function getEditData(User $user){
        return [
            "user" => $user->load(['branch', 'role']),
            'branches' => Branch::orderBy('id')->get(),
            'roles' => Role::orderBy('id')->where('name', '!=', 'client')->get()
        ];
    }

    public function store(array $validated, Role $role){
        try{
            DB::beginTransaction();

            // Temporary password li byetla3 lal admin marra wa7de bas
            $temporaryPassword = Str::password(12);
            $client = null;

            if($role->name === 'client'){
               $validated['salary'] = null;
               $validated['client_is_active'] = $validated['is_active'] ?? true;

                $client = Client::create([
                    'name' => $validated['client_name'],
                    'code' => $validated['client_code'],
                    'contact_person_name' => $validated['client_contact_person_name'] ?? null,
                    'phone' => $validated['client_phone'] ?? null,
                    'email' => $validated['client_email'] ?? null,
                    'city' => $validated['client_city'] ?? null,
                    'address' => $validated['client_address'] ?? null,
                    'branch_id' => $validated['client_branch_id'] ?? null,
                    'default_delivery_fee' => $validated['client_default_delivery_fee'],
                    'current_balance' => 0,
                    'total_client_earnings' => 0,
                    'total_paid_amount' => 0,
                    'is_active' => $validated['client_is_active'],
                    'notes' => $validated['client_notes'] ?? null,
                ]);
            }

            $client_id = $client->id ?? null;

            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'] ?? null,
                'salary' => $validated['salary'] ?? null,

                'role_id' => $validated['role_id'],
                'branch_id' => $validated['branch_id'] ?? null,
                'client_id' => $client_id,

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
        try {

            $user->loadMissing('role', 'client');

            $user->update([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'] ?? null,
                'salary' => $validated['salary'] ?? null,

                'role_id' => $validated['role_id'],
                'branch_id' => $validated['branch_id'] ?? null,

                'is_active' => $validated['is_active'] ?? true,
            ]);

            return [
                'success' => true,
                'message' => 'User updated successfully.',
            ];

        } catch (Throwable $e) {
            return [
                'success' => false,
                'message' => 'Unable to update user.',
            ];
        }
    }

    public function activate(User $user){

        DB::transaction(function () use ($user) {
            $user->update([
                'is_active' => true,
            ]);

            if ($user->client) {
                $user->client->update([
                    'is_active' => true,
                ]);
            }
        });

        return [
            'success' => true,
            'message' => 'User activated successfully.',
        ];
    }

    public function deactivate(User $user){
        if (! $user->is_active) {
            return [
                'success' => false,
                'message' => 'This user is already inactive.',
            ];
        }

        if (Auth::user()->id === $user->id) {
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
            $hasActiveClientShipments = Shipment::where('created_by', $user->client->id)
                ->whereNotIn('status', ['pending' ,'delivered', 'cancelled', 'returned'])
                ->exists();

            if ($hasActiveClientShipments) {
                return [
                    'success' => false,
                    'message' => 'This client has active shipments. Complete or cancel them before deactivating.',
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

    public function resetPassword(User $user){
        $temporaryPassword = Str::password(12);

        $user->update([
            'password' => Hash::make($temporaryPassword),
            'must_change_password' => true,
            'temporary_password_expires_at' => now()->addDay(),
            'password_changed_at' => null,
        ]);

        return [
            'success' => true,
            'message' => 'Password reset successfully.',
            'temporary_password' => $temporaryPassword
        ];
    }

    // Helper Methods

    // apply filters to users

    private function applyFilters(array $validated){
        $query = User::query()
                ->with(['role:id,name', 
                        'branch:id,name', 
                        'client'
                        ]);


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