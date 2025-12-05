<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Http\Requests\Admin\RoleRequest;

class RoleController extends Controller
{
    public function __construct()
    {

        $this->middleware('can:read roles')->only(['index']);
        $this->middleware('can:create roles')->only(['create', 'store']);
        $this->middleware('can:update roles')->only(['edit', 'update']);
        $this->middleware('can:delete roles')->only(['destroy']);
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::withCount('permissions')->paginate(10);
        return view('admin.role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::all();
        return view('admin.role.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoleRequest $request)
    {
        $data = $request->validated();
        $data['guard_name'] = 'web';
        $role = Role::create($data);
        $role->givePermissionTo($request->permissions);
        return redirect()->route('admin.roles.index')->with("admin_message", __("language.CREATEDSUCCESSFULLY"));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $permissions = Permission::all();
        $role = Role::findOrFail($id);
        $rolePermissions = $role->permissions->pluck('name')->toArray();
        return view('admin.role.edit', compact('permissions', 'role', 'rolePermissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoleRequest $request, string $id)
    {
        $role = Role::findOrFail($id);
        $data = $request->validated();
        $data['guard_name'] = 'web';
        $role->update($data);
        if ($request->permissions) {
            $role->syncPermissions($request->permissions);
        }
        return redirect()->route('admin.roles.index')->with('admin_message', __("language.UPDATEDSUCCESSFULLY"));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role = Role::findOrFail($id);
        $role->delete();
        return redirect()->route('admin.roles.index')->with('admin_message', __("language.DELETEDSUCCESSFULLY"));
    }
}
