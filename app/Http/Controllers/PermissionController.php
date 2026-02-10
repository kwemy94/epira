<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::orderBy('group')
            ->orderBy('name')
            ->get()
            ->groupBy('group');

        $roles = Role::with('permissions')->get();
        $superAdmin = checkCompany();

        return view('dashboard.permissions.index', compact('permissions', 'roles', 'superAdmin'));
    }

    public function editUserPermissions(User $user)
    {
        $permissions = Permission::orderBy('group')
            ->orderBy('name')
            ->get()
            ->groupBy('group');

        $userPermissions = $user->permissions->pluck('id')->toArray();
        $superAdmin = checkCompany();

        return view(
            'dashboard.permissions.user',
            compact('user', 'permissions', 'userPermissions', 'superAdmin')
        );
    }

    public function updateUserPermissions(Request $request, User $user)
    {
        $permissionIds = $request->input('permissions', []);

        $user->permissions()->sync($permissionIds);

        return redirect()
            ->back()
            ->with('success', 'Permissions mises à jour avec succès.');
    }
}
