<?php

namespace App\Http\Controllers;

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
    public function index(Request $request){

        $this->authorize('viewAny', User::class);

        $rules = [
            'search' => ['nullable', 'string', 'max:100'],
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

    // public function show(Branch $branch){
    //     $this->authorize('view', $branch);

    //     $data = $this->service->getShowData($branch);

    //     return view('branches.show', $data);
    // }

    public function store(Request $request){

        $this->authorize('create', User::class);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'phone' => ['nullable', 'string', 'max:50'],
            'salary' => ['nullable', 'numeric', 'min:0'],

            'role_id' => ['required', 'exists:roles,id'],
            'branch_id' => ['nullable', 'exists:branches,id'],
            'shipper_id' => ['nullable', 'exists:shippers,id'],

            'is_active' => ['nullable', 'boolean'],
        ]);

        $result = $this->service->store($validated);

        return back()
            ->with('success', 'User created successfully.')
            ->with('temporary_password', $result['temporary_password'])
            ->with('temporary_user_email', $result['user']->email);

    }

    public function update(Request $request, User $user){

        $this->authorize('update', $user);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
            'phone' => ['nullable', 'string', 'max:50'],
            'salary' => ['nullable', 'numeric', 'min:0'],

            'role_id' => ['required', 'exists:roles,id'],
            'branch_id' => ['nullable', 'exists:branches,id'],
            'shipper_id' => ['nullable', 'exists:shippers,id'],

        ]);

        $result = $this->service->update($validated, $user);

        return back()
            ->with('success', 'User updated successfully.');

    }

    public function activate(User $user)
    {
        $this->authorize('activate', $user);
        try {
            $this->service->activate($user);

            return back()->with('success', 'User status updated successfully.');
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
            return back()->with('error', 'Something went wrong while updating the branch status.');
        }
    }


}
