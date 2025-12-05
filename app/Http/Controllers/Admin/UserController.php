<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;
use App\Http\Requests\PasswordRequest;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:read users')->only(['index']);
        $this->middleware('can:create users')->only(['create', 'store']);
        $this->middleware('can:update users')->only(['edit', 'update']);
        $this->middleware('can:delete users')->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $users = User::with('roles')->when(
            $request->filled('name'),
            fn($query) =>
            $query->where('name', 'like', "%{$request->name}%")
        )
            ->paginate(10)
            ->appends($request->query());
        $totalUsers = $users->total();
        return view('admin.user.index', compact('users', 'totalUsers'));
    }


    public function create()
    {
        $roles = Role::all();
        return view('admin.user.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $validated = $request->validated();
        $validated['password'] = Hash::make($validated['password']);
        $user = User::create($validated);
        $user->assignRole($request->role_name);
        return redirect()->route('admin.users.index')->with("admin_message", __("language.CREATEDSUCCESSFULLY"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $roles = Role::all();
        $user = User::findOrFail($id);
        return view('admin.user.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, string $id)
    {
        $user = User::findOrFail($id);
        $validated = $request->validated();
        $user->update($validated);
        if ($request->has('role_name')) {
            $user->syncRoles($request->role_name);
        }
        return redirect()->route('admin.users.index')->with("admin_message",  __("language.UPDATEDSUCCESSFULLY"));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('admin.users.index')->with("admin_message",  __("language.DELETEDSUCCESSFULLY"));
    }

    //  change password for User
    public function password()
    {
        return view("admin.user.password");
    }

    //  change password for User
    public function pass(PasswordRequest $request, string $id)
    {
        $user = User::findOrFail($id);
        $user->update([
            'password' => Hash::make($request->password)
        ]);
        return redirect()->route("admin.dashboard")->with("admin_message", "Your Password changed successfully");
    }
}
