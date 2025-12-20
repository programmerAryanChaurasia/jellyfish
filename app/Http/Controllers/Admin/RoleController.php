<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class RoleController extends Controller
{
    public function index()
    {
        // Display users with roles
        $users = User::whereIn('role', ['admin', 'editor', 'user'])->get();
        return view('admin.roles.index', compact('users'));
    }

    public function create()
    {
        return view('admin.roles.create');
    }

    public function store(Request $request)
    {
        // Create new user with role
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:admin,editor,user',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('admin.roles.index')
            ->with('success', 'User role created successfully.');
    }

    public function edit(User $user)
    {
        return view('admin.roles.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|in:admin,editor,user',
        ]);

        $user->update([
            'role' => $request->role,
        ]);

        return redirect()->route('admin.roles.index')
            ->with('success', 'User role updated successfully.');
    }
}