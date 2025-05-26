<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 

class UserProfileController extends Controller
{
    public function index()
    {
        return view('user.pages.user-profile'); 
    }

    public function update(Request $request)
    {
         $user = Auth::user();  
        // Validasi
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->user_id . ',user_id',
            'phone_number' => 'nullable|string|max:20'
        ]);
    
        // Update data
        $user->update($request->only(['name', 'email', 'phone_number']));
    
        // Redirect kembali dengan pesan sukses
        return redirect()->route('user.profile')->with('success', 'Profil berhasil diperbarui!');   
    }
}