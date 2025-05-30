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

    // Hapus method create() dan store()

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.pages.edit-user', compact('user'));
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
            'role' => 'required|in:user,admin,admin_jasa',
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
