<div class="fixed z-[9999] font-sans bottom-6 right-6" style="position: fixed !important;">

    <!-- Bubble Button -->
    <button wire:click="toggleChat"
        class="w-16 h-16 bg-[#FF7A00] rounded-full shadow-lg flex items-center justify-center hover:bg-orange-600 transition-all">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-white" viewBox="0 0 24 24" fill="currentColor">
            <path d="M4 4h16v12H5.17L4 17.17V4zm0-2a2 2 0 0 0-2 2v18l4-4h14a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H4z" />
        </svg>
    </button>

    @if ($showChat)
        <div
            class="w-[360px] max-h-[520px] rounded-xl shadow-2xl bg-white absolute bottom-20 right-0 overflow-hidden border border-gray-200 flex flex-col">
            <div class="bg-[#FF7A00] text-white p-4 flex justify-between items-center">
                <div class="flex items-center gap-3">
                    @if ($isAdmin)
                        <select wire:model="selectedUserId" wire:change="loadMessages"
                            class="px-2 py-1 text-gray-800 bg-white rounded">
                            <option value="">Pilih User</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->user_id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    @else
                        <span class="font-semibold">Diskusi Produk {{ $product->name }}</span>
                    @endif
                </div>
                <button wire:click="toggleChat" class="hover:text-orange-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" stroke="currentColor"
                        fill="none">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Messages -->
            <div class="h-[300px] overflow-y-auto p-4 space-y-3 text-sm text-gray-800 flex-1"
                wire:poll.10s="loadMessages" x-ref="messageContainer" x-init="$nextTick(() => { $refs.messageContainer.scrollTop = $refs.messageContainer.scrollHeight })">
                @forelse($messages as $message)
                    <div
                        class="flex {{ $message['from_user_id'] === Auth::id() ? 'justify-end' : 'items-start gap-2' }}">
                        @if ($message['from_user_id'] !== Auth::id())
                            <div class="w-8 h-8 overflow-hidden bg-gray-300 rounded-full">
                                <img src="{{ asset('images/default-profile.jpg') }}"
                                    class="object-cover w-full h-full rounded-full">
                            </div>
                        @endif
                        <div
                            class="{{ $message['from_user_id'] === Auth::id() ? 'bg-[#FF7A00] text-white' : 'bg-gray-100 text-gray-800' }} px-4 py-2 rounded-lg max-w-[70%]">
                            {{ $message['message'] }}
                            <div
                                class="{{ $message['from_user_id'] === Auth::id() ? 'text-orange-100' : 'text-gray-500' }} text-xs mt-1">
                                {{ $message['sent_at'] }}
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="py-8 text-center text-gray-500">
                        Belum ada pesan
                    </div>
                @endforelse
            </div>

            <!-- Input -->
            <div class="p-3 bg-white border-t">
                <form wire:submit="sendMessage" class="flex items-center gap-2">
                    <input wire:model="messageText" type="text" placeholder="Tulis pesan..."
                        class="flex-1 px-3 py-2 border rounded-full focus:outline-none focus:ring-2 focus:ring-[#FF7A00]">
                    <button type="submit"
                        class="bg-[#FF7A00] text-white px-4 py-2 rounded-full hover:bg-orange-600 transition-colors">
                        Kirim
                    </button>
                </form>
            </div>
        </div>
    @endif
</div>
