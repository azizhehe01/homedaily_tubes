<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Exception;
use Illuminate\Database\QueryException;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        try {
            return Socialite::driver('google')->redirect();
        } catch (Exception $e) {
            Log::error('Google redirect failed: ' . $e->getMessage());
            return redirect()->route('login')
                ->with('error', 'Could not connect to Google. Please try again.');
        }
    }

    // public function handleGoogleCallback()
    // {
    //     try {
    //         $googleUser = Socialite::driver('google')->user();

    //         if (!$googleUser->getEmail()) {
    //             throw new Exception('Email not provided by Google');
    //         }

    //         try {
    //             $user = User::updateOrCreate(
    //                 ['email' => $googleUser->getEmail()],
    //                 [
    //                     'name' => $googleUser->getName(),
    //                     'google_id' => $googleUser->getId(),
    //                     'password' => bcrypt(Str::random(24))
    //                 ]
    //             );

    //             Auth::login($user);

    //             Log::info('User logged in with Google', ['user_id' => $user->user_id]);

    //             // Add fallback redirect
    //             return redirect()->intended(route('user.index'))
    //                 ->with('success', 'Successfully logged in with Google!');
    //         } catch (QueryException $e) {
    //             Log::error('Database error during Google login: ' . $e->getMessage());
    //             throw $e; // Re-throw to be caught by outer catch
    //         }
    //     } catch (Exception $e) {
    //         Log::error('Google callback failed: ' . $e->getMessage());

    //         // Add more detailed error message in session for debugging
    //         session()->flash('error_details', $e->getMessage());

    //         return redirect()->route('login')
    //             ->with('error', 'Google login failed. Please try again.');
    //     }
    // }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            if (!$googleUser->getEmail()) {
                throw new Exception('Email not provided by Google');
            }

            try {
                $user = User::updateOrCreate(
                    ['email' => $googleUser->getEmail()],
                    [
                        'name' => $googleUser->getName(),
                        'google_id' => $googleUser->getId(),
                        'password' => bcrypt(Str::random(24))
                    ]
                );

                Auth::login($user);

                Log::info('User logged in with Google', ['user_id' => $user->user_id]);

                // Check user role and redirect accordingly
                if ($user->role === 'admin') {
                    return redirect()->route('admin.dashboard')
                        ->with('success', 'Welcome back, Admin!');
                }

                // Default redirect for non-admin users
                return redirect()->intended(route('user.index'))
                    ->with('success', 'Successfully logged in with Google!');
            } catch (QueryException $e) {
                Log::error('Database error during Google login: ' . $e->getMessage());
                throw $e;
            }
        } catch (Exception $e) {
            Log::error('Google callback failed: ' . $e->getMessage());
            session()->flash('error_details', $e->getMessage());
            return redirect()->route('login')
                ->with('error', 'Google login failed. Please try again.');
        }
    }
}
