@extends('admin.layouts.app')

@section('title', 'Transactions')

@section('content')
    <div class="py-4 table-orders">
        <div class="overflow-x-auto">
            <div class="inline-block min-w-full align-middle">
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
                            @foreach ($transactions ?? [] as $transaction)
                                <tr>
                                    <td class="px-6 py-4 text-sm font-medium whitespace-nowrap text-default-800">
                                        {{ $transaction->id }}
                                    </td>
                                    <td class="px-6 py-4 text-sm font-medium whitespace-nowrap text-default-800">
                                        {{ $transaction->name }}
                                    </td>
                                    <td class="px-6 py-4 text-sm whitespace-nowrap text-default-800">
                                        {{ $transaction->title }}
                                    </td>
                                    <td class="px-6 py-4 text-sm whitespace-nowrap text-default-800">
                                        {{ $transaction->email }}
                                    </td>
                                    <td class="px-6 py-4 text-sm font-medium whitespace-nowrap text-end">
                                        <a href="{{ route('admin.transactions.edit', $transaction->id) }}"
                                            class="text-primary hover:text-sky-700">
                                            <iconify-icon icon="uil:edit" width="20"></iconify-icon>
                                        </a>
                                        <form action="{{ route('admin.transactions.destroy', $transaction->id) }}"
                                            method="POST" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-primary hover:text-sky-700">
                                                <iconify-icon icon="mdi:delete-outline" width="20"></iconify-icon>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach

                            @if (($transactions ?? collect())->isEmpty())
                                <tr>
                                    <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                        No transactions found.
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
