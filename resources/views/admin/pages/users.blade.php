@extends('admin.layouts.app')

@section('title', 'Users')

@section('content')
    <div class="py-4 table-orders">
        <div class="overflow-x-auto">
            <div class="inline-block min-w-full align-middle">
                <div class="pb-3 text-end">
                    {{-- ini isi href user --}}
                    {{-- {{ route('admin.users.create') }} --}}
                    <a href="" class="text-white bg-warning btn text-end hover:bg-orange-300">
                        Add
                    </a>
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

@push('scripts')
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
@endpush
