<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Throwable;

class UserController extends Controller
{
    public function __construct(private UserService $service)
    {}
    public function index(Request $request)
    {
        $this->authorize('viewAny', User::class);

        $rules = [
            'search' => ['nullable', 'string', 'max:20'],
            'role_name' => ['nullable', 'string', 'exists:roles,name'],
            'status' => ['nullable', 'in:active,inactive'],
            'password_status' => ['nullable', 'in:must_change,changed,not_changed'],
        ];

        if (Auth::user()->role->name === 'admin') {
            $rules['branch_name'] = ['nullable', 'string', 'exists:branches,name'];
        }

        $validated = $request->validate($rules);
        
        $data = $this->service->getIndexData($validated);
        
        return view('users.index', $data);
    }

    public function show(User $user){
        $this->authorize('view', $user);

        $data = $this->service->getShowData($user);

        return view('users.show', $data);
    }

    public function store(Request $request)
    {

        $this->authorize('create', User::class);

        $rules = [
            // User info
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'phone' => ['nullable', 'string', 'max:50'],
            'salary' => ['nullable', 'numeric', 'min:0'],

            'role_id' => ['required', 'integer','exists:roles,id'],
            'branch_id' => ['nullable', 'integer','exists:branches,id'],
            'client_id' => ['nullable', 'integer', 'exists:clients,id'],

            'is_active' => ['nullable', 'boolean'],
        ];

        $role = Role::findOrFail($request->role_id);

        if($role->name === 'client'){
            $rules += [
                // Client info
                'client_name' => ['required', 'string', 'max:255'],
                'client_code' => ['required', 'string', 'min:7', 'unique:clients,code'],
                'client_contact_person_name' => ['nullable', 'string', 'max:255'],
                'client_phone' => ['nullable', 'string', 'max:50'],
                'client_email' => ['nullable', 'email', 'max:255'],
                'client_city' => ['nullable', 'string', 'max:255'],
                'client_address' => ['nullable', 'string', 'max:255'],

                'client_branch_id' => ['nullable', 'exists:branches,id'],
                'client_default_delivery_fee' => ['required', 'numeric', 'min:0'],

                'client_notes' => ['nullable', 'string'],
            ];
        }

        $validated = $request->validate($rules);

        $result = $this->service->store($validated, $role);

        return back()
            ->with('success', 'User created successfully.')
            ->with('temporary_password', $result['temporary_password'])
            ->with('temporary_user_email', $result['user']->email);
    }

    public function edit(User $user){
        $this->authorize('update', $user);

        $data = $this->service->getEditData($user);

        return view('users.edit', $data);
    }

    public function update(Request $request, User $user){

        $this->authorize('update', $user);

        $role = $user->role;

        if ($request->role_id) {
            $role = Role::findOrFail($request->role_id);

            if ($role->name === 'client') {
                return back()
                    ->withInput()
                    ->with('error', 'Employees cannot be converted into clients.');
            }
        }

        $role_id_is_required = $role->name === 'client' ? 'nullable' : 'required';

        $rules = [
            // User info
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 
                        'email', 
                        'max:255', 
                        Rule::unique('users', 'email')->ignore($user->id),
                    ],
            'phone' => ['nullable', 'string', 'max:50'],
            'salary' => ['nullable', 'numeric', 'min:0'],

            'role_id' => [$role_id_is_required, 'exists:roles,id'],
            'branch_id' => ['nullable', 'exists:branches,id'],
            'client_id' => ['nullable', 'exists:clients,id'],
        ];

        $validated = $request->validate($rules);

        $validated['role_id'] = $role->id;

        $result = $this->service->update($validated, $user);

        if($result['success']){
            return redirect()
                ->route('users.show', $user->id)
                ->with('success', $result['message']);
        }

        return back()->with('error', $result['message']);
    }

    public function activate(User $user)
    {
        $this->authorize('activate', $user);
        try {
            $result = $this->service->activate($user);

            return back()->with('success', $result['message']);
        } catch (Throwable $e) {
            return back()->with('error', 'Something went wrong while updating the user status.');
        }
    }

    public function deactivate(User $user)
    {
        $this->authorize('deactivate', $user);
        try {

            $result = $this->service->deactivate($user);

            if (! $result['success']) {
                return back()->with('error', $result['message']);
            }

            return back()->with('success', $result['message']);
        } catch (Throwable $e) {
            return back()->with('error', 'Something went wrong while updating the user status.');
        }
    }

    public function resetPassword(User $user){
        
        $this->authorize('resetPassword', $user);

        $result = $this->service->resetPassword($user);

        if($result['success']){
            return redirect()->route('users.index')
                    ->with('success', $result['message'])
                    ->with('temporary_password', $result['temporary_password']);
        }
        return back()->with('error', 'Something went wrong while updating the user status.');
    }

}
