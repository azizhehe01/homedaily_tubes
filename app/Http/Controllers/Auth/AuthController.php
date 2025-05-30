<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'name.required' => 'gimana si lo masa nama nya kosong🤷‍♂️',
            'email.required' => 'yakali email kosong🤷‍♂️',
            'email.email' => 'ga valid email lo🤬',
            'email.unique' => 'udah ada yang pake email ini😭',
            'password.required' => 'yakin lo ga isi password🤣',
            'password.min' => 'minimal password 8 karakter bro💜',
            'password.confirmed' => 'passwordnya ga cocok😭',
        ]);

        if ($validator->fails()) {
            if ($request->wantsJson()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validation Error',
                    'errors' => $validator->errors()
                ], 422);
            }

            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'email_verified_at' => now(),
            'google_id' => null
        ]);

        if ($request->wantsJson()) {
            $token = $user->createToken('auth_token')->plainTextToken;
            return response()->json([
                'status' => true,
                'message' => 'Registration successful',
                'user' => $user,
                'token' => $token
            ], 201);
        }

        return redirect()->route('login')->with('success', 'Registration successful!');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation Error',
                'errors' => $validator->errors()
            ], 422);
        }

        $user = User::where('email', $request->email)->first();

        // Cek apakah user ada dan bukan Google user
        if (!$user || $user->google_id) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid credentials or Google account',
            ], 401);
        }

        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid credentials',
            ], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        // Jika request API (JSON)
        if ($request->wantsJson()) {
            return response()->json([
                'status' => true,
                'message' => 'Login successful',
                'user' => $user,
                'token' => $token,
                'redirect' => $this->getRedirectRoute($user->role)
            ], 200);
        }

        // Jika request web (browser)
        return redirect()->route($this->getRedirectRoute($user->role));
    }

    // Method baru untuk menentukan redirect route
    protected function getRedirectRoute(string $role): string
    {
        return match ($role) {
            'admin' => 'admin.dashboard',
            'admin_jasa' => 'admin_jasa.dashboard',
            default => 'user.index'
        };
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }
    // ... existing logout and user methods ...

}
