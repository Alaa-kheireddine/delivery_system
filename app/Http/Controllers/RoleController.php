<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RoleController extends Controller
{
    public function index(){

        $this->authorize('viewAny', Role::class);

        $roles = Role::where('name', '!=', 'admin')
            ->withCount(['users', 'permissions'])
            ->with('permissions:id,name')
            ->orderBy('id')
            ->get();

        $permissions = Permission::orderBy('group')
            ->orderBy('name')
            ->get()
            ->groupBy('group');

        return view('roles.index', compact('roles', 'permissions'));
    }

    public function store(Request $request)
    {

        $this->authorize('create', Role::class);

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:roles,name|regex:/^[a-z0-9_]+$/',
            'permissions' => 'nullable|array',
            'permissions.*' => 'exists:permissions,id',
        ]);

        $role = Role::create([
            'name' => strtolower($validated['name']),
        ]);

        $role->permissions()->sync($validated['permissions'] ?? []);

        return redirect()
            ->route('roles.index')
            ->with('success', 'Role created successfully.');
    }

    public function update(Request $request, Role $role)
    {
        $this->authorize('update', $role);

        $validated = $request->validate([
            'name' => ['required','string','max:255','regex:/^[a-z0-9_]+$/',
                        Rule::unique('roles', 'name')->ignore($role->id)],
            'permissions' => 'nullable|array',
            'permissions.*' => 'exists:permissions,id',
        ]);

        $role->update([
            'name' => strtolower($validated['name']),
        ]);

        $role->permissions()->sync($validated['permissions'] ?? []);

        return redirect()
            ->route('roles.index')
            ->with('success', 'Role updated successfully.');
    }

    public function destroy(Role $role)
    {
        $this->authorize('delete', $role);

        if ($role->users()->exists()) {
            return redirect()
                ->route('roles.index')
                ->with('error', 'Cannot delete this role because it has users assigned.');
        }

        $role->permissions()->detach();

        $role->delete();

        return redirect()
            ->route('roles.index')
            ->with('success', 'Role deleted successfully.');
    }
}
