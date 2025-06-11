<div>
    <div class="fixed bottom-0 right-0 mb-4 mr-6">
        <button wire:click="toggleChat"
            class="flex items-center justify-center w-16 h-16 transition-all rounded-full shadow-lg bg-primary hover:bg-blue-700">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-white" viewBox="0 0 24 24" fill="currentColor">
                <path d="M4 4h16v12H5.17L4 17.17V4zm0-2a2 2 0 0 0-2 2v18l4-4h14a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H4z" />
            </svg>
        </button>

        @if ($showChat)
            <div class="flex flex-col w-96 h-[500px] overflow-hidden bg-white rounded-lg shadow-lg">
                <!-- Header -->
                <div class="flex items-center justify-between p-4 text-white bg-primary">
                    <div class="flex items-center gap-3">
                        <select wire:model.live="selectedUserId" wire:change="loadMessages"
                            class="w-48 px-3 py-2 text-gray-800 bg-white border-0 rounded focus:ring-2 focus:ring-blue-300">
                            <option value="">Pilih User</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->user_id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @if ($selectedUserId)
                        @php
                            $selectedUser = $users->firstWhere('user_id', $selectedUserId);
                        @endphp
                        <div class="text-white">
                            <span
                                class="font-medium">{{ \Illuminate\Support\Str::words($selectedUser?->name, 1, '') }}</span>
                        </div>
                    @endif
                </div>

                <!-- Messages Container -->
                <div class="flex-1 overflow-y-auto bg-gray-100 scrollbar-thin scrollbar-thumb-blue-300 scrollbar-track-gray-200"
                    wire:poll.10s="loadMessages" x-data x-ref="messageContainer" x-init="$nextTick(() => { $refs.messageContainer.scrollTop = $refs.messageContainer.scrollHeight })">
                    <div class="p-4 space-y-4">
                        @forelse($messages as $message)
                            <div
                                class="flex {{ $message['from_user_id'] === Auth::id() ? 'justify-end' : 'items-start gap-2' }}">
                                @if ($message['from_user_id'] !== Auth::id())
                                    <div class="flex-shrink-0 w-8 h-8 overflow-hidden bg-gray-300 rounded-full">
                                        <img src="{{ asset('images/default-profile.jpg') }}" alt="Profile"
                                            class="object-cover w-full h-full">
                                    </div>
                                @endif
                                <div
                                    class="{{ $message['from_user_id'] === Auth::id()
                                        ? 'bg-primary text-white'
                                        : 'bg-white border border-gray-300 text-gray-900' }}
                                        px-4 py-2 rounded-lg max-w-[70%] shadow-sm">
                                    <p class="break-words">{{ $message['message'] }}</p>
                                    <div
                                        class="{{ $message['from_user_id'] === Auth::id() ? 'text-blue-100' : 'text-gray-600' }} text-xs mt-1">
                                        {{ \Carbon\Carbon::parse($message['sent_at'])->format('H:i') }}
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="flex items-center justify-center h-full">
                                <div class="text-center text-gray-600">
                                    <p class="mb-2">Belum ada pesan</p>
                                    <p class="text-sm">Pilih user untuk memulai percakapan</p>
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Message Input -->
                <div class="p-4 bg-white border-t border-gray-200">
                    <form wire:submit.prevent="sendMessage" class="flex gap-2">
                        <input type="text" wire:model="messageText" placeholder="Tulis pesan..."
                            class="flex-1 px-4 py-2 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"
                            {{ !$selectedUserId ? 'disabled' : '' }}>
                        <button type="submit"
                            class="px-6 py-2 text-white transition-colors rounded-full bg-primary disabled:opacity-50"
                            {{ !$selectedUserId ? 'disabled' : '' }}>
                            Kirim
                        </button>
                    </form>
                </div>
            </div>
        @endif
    </div>

    <style>
        /* Custom scrollbar styles */
        .scrollbar-thin {
            scrollbar-width: thin;
            scrollbar-color: #93c5fd #e5e7eb;
        }

        .scrollbar-thin::-webkit-scrollbar {
            width: 8px;
        }

        .scrollbar-thin::-webkit-scrollbar-track {
            background: #e5e7eb;
            border-radius: 4px;
        }

        .scrollbar-thin::-webkit-scrollbar-thumb {
            background: #93c5fd;
            border-radius: 4px;
        }

        .scrollbar-thin::-webkit-scrollbar-thumb:hover {
            background: #60a5fa;
        }
    </style>
</div>
