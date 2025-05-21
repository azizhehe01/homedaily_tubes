@extends('admin.layouts.app')

@section('title', 'Edit User')

@section('content')
    <div class="py-4">
        <div class="max-w-2xl mx-auto">
            <div class="overflow-hidden border rounded-lg">
                <div class="p-6 bg-white">
                    <h2 class="mb-4 text-xl font-semibold">Edit User</h2>
                    
                    <form action="{{ route('admin.pages.users.update', $user->user_id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-4">
                            <label for="name" class="block mb-2 text-sm font-medium">Name</label>
                            <input type="text" name="name" id="name" 
                                   value="{{ old('name', $user->name) }}"
                                   class="w-full p-2 border rounded">
                        </div>
                        
                        <div class="mb-4">
                            <label for="email" class="block mb-2 text-sm font-medium">Email</label>
                            <input type="email" name="email" id="email" 
                                   value="{{ old('email', $user->email) }}"
                                   class="w-full p-2 border rounded">
                        </div>
                        
                        <div class="mb-4">
                            <label for="password" class="block mb-2 text-sm font-medium">Password (Kosongkan jika tidak diubah)</label>
                            <input type="password" name="password" id="password"
                                   class="w-full p-2 border rounded">
                        </div>
                        
                        <div class="mb-4">
                            <label for="role" class="block mb-2 text-sm font-medium">Role</label>
                            <select name="role" id="role" class="w-full p-2 border rounded">
                                <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="admin_jasa" {{ $user->role == 'admin_jasa' ? 'selected' : '' }}>Admin jasa</option>
                            </select>
                        </div>
                        
                        <div class="flex justify-end gap-3">
                            <a href="{{ route('admin.pages.users') }}" 
                               class="px-4 py-2 text-gray-700 bg-gray-200 rounded hover:bg-gray-300">
                                Cancel
                            </a>
                            <button type="submit" 
                                    class="px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700">
                                Update User
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection