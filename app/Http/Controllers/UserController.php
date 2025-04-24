<?php

namespace App\Http\Controllers;

use App\Models\user;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = user::all();
        return view('admin.user.index', compact('users'));
    }

    public function create()
    {
        return view('admin.user.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
        ]);

        user::create($request->all());

        return redirect()->route('user.index')->with('success', 'user created successfully.');
    }

    public function edit(user $user)
    {
        return view('admin.user.edit', compact('user'));
    }

    public function update(Request $request, user $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
        ]);

        $user->update($request->all());

        return redirect()->route('user.index')->with('success', 'user updated successfully.');
    }

    public function destroy(user $user)
    {
        $user->delete();
        return redirect()->route('user.index')->with('success', 'user deleted successfully.');
    }
}