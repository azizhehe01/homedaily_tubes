<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(10);
        return view('admin.pages.users', compact('users'));
    }

    public function create()
    {
        return view('admin.pages.users.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|in:user,admin',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
        ]);

        return redirect()->route('admin.pages.users')
            ->with('success', 'User created successfully.');
    }

    public function edit($id)
    {
        $user = User::where('user_id', $id)->first();

        if (!$user) {
            return redirect()->route('admin.pages.users')
                ->with('error', 'User not found');
        }

        return view('admin.pages.users', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::where('user_id', $id)->first();

        if (!$user) {
            return redirect()->route('admin.pages.users')
                ->with('error', 'User not found');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($user->user_id, 'user_id')
            ],
            'password' => 'nullable|string|min:8',
            'role' => 'required|in:user,admin',
        ]);

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        return redirect()->route('admin.pages.users')
            ->with('success', 'User updated successfully');
    }

    public function destroy($id)
    {
        $user = User::where('user_id', $id)->first();

        if (!$user) {
            return redirect()->route('admin.pages.users')
                ->with('error', 'User not found');
        }

        $user->delete();

        return redirect()->route('admin.pages.users')
            ->with('success', 'User deleted successfully');
    }
}
