<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Doctor;
use App\Models\Department;
use App\Models\Message;
use App\Models\User;
use App\Models\Client;
use Spatie\Permission\Models\Role;

class HomeController extends Controller
{

    public function index()
    {
        $doctors_count = Doctor::count();
        $departments_count = Department::count();
        $messages_count = Message::count();
        $users_count = User::count();
        $clients_count = Client::count();
        $roles_count = Role::count();

        return view('admin.dashboard', compact('doctors_count', 'departments_count', 'messages_count', 'users_count', 'clients_count', 'roles_count'));
    }
}
