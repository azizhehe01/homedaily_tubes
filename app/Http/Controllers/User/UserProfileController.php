<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Address;
use Illuminate\Support\Str; 

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

    public function updatePhoto(Request $request)
    {
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Max 2MB
        ]);
    
        $user = Auth::user();
    
        try {
            // Hapus foto lama jika ada
            if ($user->profile_picture) {
                Storage::disk('public')->delete($user->profile_picture);
            }
        
            // Simpan file baru ke folder profiles
            $path = $request->file('avatar')->store('profiles', 'public');
        
            // Update database dengan path file baru
            $user->update([
                'profile_picture' => $path
            ]);
        
            return back()->with('success', 'Foto profil berhasil diperbarui!');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal mengupdate foto profil: ' . $e->getMessage());
        }
    }

    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'current_password' => [
                'required',
                function ($attribute, $value, $fail) use ($user) {
                    if (!Hash::check($value, $user->password)) {
                        $fail('Password saat ini tidak sesuai!');
                    }
                }
            ],
            'new_password' => 'required|string|min:8|different:current_password',
            'confirm_password' => 'required|string|same:new_password'
        ], [
            'current_password.required' => 'Password saat ini wajib diisi',
            'new_password.required' => 'lo niat ubah pw kaga masa  kosong',
            'new_password.min' => 'Password minimal 8 karakter',
            'new_password.different' => 'ya ga boleh sama',
            'confirm_password.required' => 'isi lah kocak konfim pw', 
            'confirm_password.same' => 'passwordnya ga cocok 😭 bagia confirm'
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput()
                ->with('password_error', true); // Flag untuk auto-open modal
        }

        $user->update([
            'password' => Hash::make($request->new_password)
        ]);

        return back()->with('success', 'Password berhasil diperbarui!');
    }

        public function storeAddress(Request $request)
        {
            $validator = Validator::make($request->all(), [
                'recipient_name' => 'required|string|max:255',
                'phone_number' => 'required|string|max:20',
                'full_address' => 'required|string',
                'postal_code' => 'nullable|string|max:10',
                'city' => 'required|string|max:255',
                'province' => 'required|string|max:255',
            ], [
                'recipient_name.required' => 'Nama penerima wajib diisi',
                'phone_number.required' => 'Nomor telepon wajib diisi',
                'full_address.required' => 'Alamat lengkap wajib diisi',
                'city.required' => 'Kota wajib diisi',
                'province.required' => 'Provinsi wajib diisi',
            ]);

            if ($validator->fails()) {
                return back()
                    ->withErrors($validator, 'address')
                    ->withInput()
                    ->with('address_error', true); // Untuk auto-open modal
            }

            try {
                Address::create([
                    'user_id' => Auth::id(),
                    'recipient_name' => $request->recipient_name,
                    'phone_number' => $request->phone_number,
                    'full_address' => $request->full_address,
                    'postal_code' => $request->postal_code,
                    'city' => $request->city,
                    'province' => $request->province,
                ]);

                return redirect()->to(route('user.profile') . '#address-section')->with('address_success', 'Alamat berhasil ditambahkan!');
            } catch (\Exception $e) {
                return back()->with('error', 'Gagal menambahkan alamat: ' . $e->getMessage());
            }
        }

        /**
         * Menghapus alamat
         */
        public function destroyAddress($address_id)
        {
            $address = Address::where('address_id', $address_id)->firstOrFail();
            
            // Pastikan alamat milik user yang login
            if ($address->user_id !== Auth::id()) {
                abort(403, 'Unauthorized action.');
            }
        
            $address->delete();
            
            return back()->with('success', 'Alamat berhasil dihapus!');
        }

}