<?php
<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    // Menampilkan profile user yang sedang login
    public function show()
    {
        $user = Auth::user();
        return response()->json(['profile' => $user], 200);
    }

    // Update profile user yang sedang login
    public function update(Request $request)
    {
        $user = Auth::user();

        $validatedData = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'email' => [
                'sometimes',
                'required',
                'email',
                Rule::unique('users')->ignore($user->id)
            ],
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        if (isset($validatedData['password'])) {
            $validatedData['password'] = Hash::make($validatedData['password']);
        } else {
            unset($validatedData['password']);
        }

        $user->update($validatedData);

        return response()->json(['profile' => $user, 'message' => 'Profile updated successfully'], 200);
    }

    // Hapus akun user yang sedang login
    public function destroy()
    {
        $user = Auth::user();
        $user->delete();

        return response()->json(['message' => 'Profile deleted successfully'], 200);
    }
}