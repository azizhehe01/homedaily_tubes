@extends('admin.layouts.app')

@section('title', 'Users')

@section('content')
    <div class="py-4 table-orders">
        <div class="overflow-x-auto">
            <div class="inline-block min-w-full align-middle">
                <div class="pb-3 text-end">

                    {{-- {{ route('admin.users.create') }} --}}
                    <button class="text-white bg-warning btn text-end hover:bg-orange-300" data-hs-overlay="#modal-input">
                        Add
                    </button>

                    {{-- modal --}}
                    <div id="modal-input"
                        class="fixed top-0 left-0 hidden w-full h-full overflow-y-auto transition-all duration-500 pointer-events-none hs-overlay z-70">
                        <div
                            class="flex flex-col my-8 transition-all duration-500 ease-in-out -translate-y-5 bg-white rounded shadow-sm opacity-0 hs-overlay-open:translate-y-0 hs-overlay-open:opacity-100 sm:max-w-2xl sm:w-full sm:mx-auto">
                            <div class="flex flex-col border rounded-lg shadow-sm pointer-events-auto border-default-200">
                                <div class="flex items-center justify-between px-4 py-3 border-b border-default-200">
                                    <h3 class="text-lg font-medium text-default-900">
                                        Add User
                                    </h3>
                                </div>
                                <form action="{{ route('admin.users.store') }}" method="POST" class="p-4">
                                    @csrf
                                    <div class="space-y-4">
                                        <div>
                                            <label for="name" class="block text-sm font-medium text-gray-700">Nama
                                                Lengkap</label>
                                            <input type="text" name="name" id="name"
                                                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-primary focus:ring-primary sm:text-sm"
                                                required>
                                        </div>

                                        <div>
                                            <label for="email"
                                                class="block text-sm font-medium text-gray-700">Email</label>
                                            <input type="email" name="email" id="email"
                                                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-primary focus:ring-primary sm:text-sm"
                                                required>
                                        </div>

                                        <div>
                                            <label for="password"
                                                class="block text-sm font-medium text-gray-700">Password</label>
                                            <input type="password" name="password" id="password"
                                                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-primary focus:ring-primary sm:text-sm"
                                                required>
                                        </div>

                                        <div>
                                            <label for="role"
                                                class="block text-sm font-medium text-gray-700">Role</label>
                                            <select name="role" id="role"
                                                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-primary focus:ring-primary sm:text-sm">
                                                <option value="user">User</option>
                                                <option value="admin">Admin</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div
                                        class="flex items-center justify-end px-4 py-3 border-t gap-x-2 border-default-200">
                                        <button type="button"
                                            class="inline-flex items-center justify-center px-5 py-2 text-sm font-medium tracking-wide text-center align-middle duration-500 border rounded-md bg-primary/5 hover:bg-primary border-primary/10 hover:border-primary text-primary hover:text-white"
                                            data-hs-overlay="#modal-four">
                                            <i class="i-tabler-x me-1"></i>
                                            Close
                                        </button>
                                        <a class="inline-flex items-center justify-center px-5 py-2 text-sm font-medium tracking-wide text-center text-white align-middle duration-500 border rounded-md bg-primary hover:bg-primary-700 border-primary hover:border-primary-700"
                                            href="#">
                                            Save changes
                                        </a>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="overflow-hidden border rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-sm text-start text-default-500">ID</th>
                                <th scope="col" class="px-6 py-3 text-sm text-start text-default-500">Name</th>
                                <th scope="col" class="px-6 py-3 text-sm text-start text-default-500">Title</th>
                                <th scope="col" class="px-6 py-3 text-sm text-start text-default-500">Email</th>
                                <th scope="col" class="px-6 py-3 text-sm text-end text-default-500">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach ($users ?? [] as $user)
                                <tr>
                                    <td class="px-6 py-4 text-sm font-medium whitespace-nowrap text-default-800">
                                        {{ $user->id }}
                                    </td>
                                    <td class="px-6 py-4 text-sm font-medium whitespace-nowrap text-default-800">
                                        {{ $user->name }}
                                    </td>
                                    <td class="px-6 py-4 text-sm whitespace-nowrap text-default-800">
                                        {{ $user->title }}
                                    </td>
                                    <td class="px-6 py-4 text-sm whitespace-nowrap text-default-800">
                                        {{ $user->email }}
                                    </td>
                                    <td class="px-6 py-4 text-sm font-medium whitespace-nowrap text-end">
                                        <a href="{{ route('admin.users.edit', $user->id) }}"
                                            class="text-primary hover:text-sky-700">
                                            <iconify-icon icon="uil:edit" width="20"></iconify-icon>
                                        </a>
                                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
                                            class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-primary hover:text-sky-700">
                                                <iconify-icon icon="mdi:delete-outline" width="20"></iconify-icon>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach

                            @if (($users ?? collect())->isEmpty())
                                <tr>
                                    <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                        No users found.
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


@endsection

{{-- @include('admin.dashboard.partials.user-modal'); --}}

@push('scripts')
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
@endpush
