<div class="fixed z-50 font-sans bottom-6 right-6">
    <!-- Bubble Button -->
    <button id="chatBubble"
        class="w-16 h-16 bg-[#FF7A00] rounded-full shadow-lg flex items-center justify-center hover:bg-orange-600 transition-all">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-white" viewBox="0 0 24 24" fill="currentColor">
            <path d="M4 4h16v12H5.17L4 17.17V4zm0-2a2 2 0 0 0-2 2v18l4-4h14a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H4z" />
        </svg>
    </button>

    <!-- Chat Box -->
    <div id="chatBox"
        class="hidden w-[360px] max-h-[520px] rounded-xl shadow-2xl bg-white absolute bottom-20 right-0 overflow-hidden border border-gray-200 flex flex-col">

        <div class="bg-[#FF7A00] text-white p-4 flex justify-between items-center">
            <div class="flex items-center gap-3">
                <img id="productImage" src="" alt="Gambar Produk" class="object-cover w-10 h-10 rounded-full">
                <span class="font-semibold">Diskusi Produk <span id="productName"></span></span>
            </div>
            <button id="closeChat" class="hover:text-orange-100">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" stroke="currentColor"
                    fill="none">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Messages -->
        <div id="chatMessages" class="h-[300px] overflow-y-auto p-4 space-y-3 text-sm text-gray-800 flex-1"
            style="background-color: #fff9f5; background-image: url('data:image/svg+xml,%3Csvg width=%27100%27 height=%2720%27 viewBox=%270 0 100 20%27 xmlns=%27http://www.w3.org/2000/svg%27%3E%3Cpath d=%27M21.184 20c.357-.13.72-.264 1.088-.402l1.768-.661C33.64 15.347 39.647 14 50 14c10.271 0 15.362 1.222 24.629 4.928.955.383 1.869.74 2.75 1.072h6.225c-2.51-.73-5.139-1.691-8.233-2.928C65.888 13.278 60.562 12 50 12c-10.626 0-16.855 1.397-26.66 5.063l-1.767.662c-2.475.923-4.66 1.674-6.724 2.275h6.335zm0-20C13.258 2.892 8.077 4 0 4V2c5.744 0 9.951-.574 14.85-2h6.334zM77.38 0C85.239 2.966 90.502 4 100 4V2c-6.842 0-11.386-.542-16.396-2h-6.225zM0 14c8.44 0 13.718-1.21 22.272-4.402l1.768-.661C33.64 5.347 39.647 4 50 4c10.271 0 15.362 1.222 24.629 4.928C84.112 12.722 89.438 14 100 14v-2c-10.271 0-15.362-1.222-24.629-4.928C65.888 3.278 60.562 2 50 2 39.374 2 33.145 3.397 23.34 7.063l-1.767.662C13.223 10.84 8.163 12 0 12v2z%27 fill=%27%23eb5900%27 fill-opacity=%270.32%27 fill-rule=%27evenodd%27/%3E%3C/svg%3E');">

            @foreach ($product->chats as $chat)
                <div class="flex @if ($chat->user_id === auth()->id()) justify-end @else items-start gap-2 @endif">
                    @if ($chat->user_id !== auth()->id())
                        <div class="w-8 h-8 bg-gray-300 rounded-full">
                            <img src="{{ $chat->user->avatar_url ?? asset('images/default-profile.jpg') }}"
                                class="object-cover w-full h-full ">
                        </div>
                    @endif
                    <div
                        class="@if ($chat->user_id === auth()->id()) bg-[#FF7A00] text-white @else bg-gray-200 @endif px-4 py-2 rounded-lg max-w-[70%]">
                        {{ $chat->message }}
                        <div
                            class="text-xs mt-1 @if ($chat->user_id === auth()->id()) text-orange-100 @else text-gray-500 @endif">
                            {{ $chat->created_at->format('H:i') }}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Input -->
        <div class="flex items-center gap-2 p-3 bg-white border-t">
            <input id="chatInput" type="text" placeholder="Tulis pesan..."
                class="flex-1 px-3 py-2 border rounded-full focus:outline-none focus:ring-2 focus:ring-[#FF7A00]"
                data-product-id="{{ $product->product_id }}">
            <button id="sendMessage"
                class="bg-[#FF7A00] text-white px-4 py-2 rounded-full hover:bg-orange-600">Kirim</button>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const chatBubble = document.getElementById('chatBubble');
        const chatBox = document.getElementById('chatBox');
        const closeChat = document.getElementById('closeChat');
        const sendMessageBtn = document.getElementById('sendMessage');
        const chatInput = document.getElementById('chatInput');
        const chatMessages = document.getElementById('chatMessages');
        const productId = chatInput.dataset.productId; // Ambil product_id dari input

        // Toggle chat box + load chat saat dibuka
        chatBubble.addEventListener('click', function() {
            chatBox.classList.toggle('hidden');
            if (!chatBox.classList.contains('hidden')) {
                loadChats(); // Load chat saat chat box dibuka
            }
        });

        closeChat.addEventListener('click', () => chatBox.classList.add('hidden'));

        // Fungsi untuk load chat dari controller
        function loadChats() {
            fetch(`/products/${productId}/chats`) // Endpoint GET chats
                .then(response => response.json())
                .then(data => {
                    const {
                        chats,
                        product
                    } = data;

                    // Setel nama produk dan gambar
                    document.getElementById('productName').textContent = product.name;
                    const productImage = document.getElementById('productImage');
                    if (product.image) {
                        productImage.src = product.image;
                        productImage.alt = `Gambar ${product.name}`;
                    } else {
                        productImage.src = '/images/default-product.jpg'; // Gambar default jika tidak ada
                        productImage.alt = 'Gambar tidak tersedia';
                    }

                    // Render chats
                    chatMessages.innerHTML = '';
                    chats.forEach(chat => {
                        const msgDiv = document.createElement('div');
                        msgDiv.className = chat.is_admin ?
                            'flex justify-start gap-2' // Styling untuk pesan admin
                            :
                            (chat.user_id === {{ auth()->id() }} ? 'flex justify-end' :
                                'flex items-start gap-2');
                        msgDiv.innerHTML = `
                        ${chat.is_admin ? `
                        <div class="w-8 h-8 bg-[#FF7A00] rounded-full flex items-center justify-center text-white font-bold">
                            A
                        </div>` : ''}
                        ${chat.user_id !== {{ auth()->id() }} && !chat.is_admin ? `
                        <div class="w-8 h-8 bg-gray-300 rounded-full">
                            <img src="${chat.user.avatar_url || '/images/default-profile.jpg'}" class="object-cover w-full h-full">
                        </div>` : ''}
                        <div class="${chat.is_admin ? 'bg-[#FFE9D5] text-[#FF7A00]' : (chat.user_id === {{ auth()->id() }} ? 'bg-[#FF7A00] text-white' : 'bg-gray-200')} px-4 py-2 rounded-lg max-w-[70%]">
                            ${chat.message}
                            <div class="text-xs mt-1 ${chat.is_admin ? 'text-[#FF7A00]' : (chat.user_id === {{ auth()->id() }} ? 'text-orange-100' : 'text-gray-500')}">
                                ${new Date(chat.created_at).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })}
                            </div>
                        </div>
                    `;
                        chatMessages.appendChild(msgDiv);
                    });
                    chatMessages.scrollTop = chatMessages.scrollHeight;
                })
                .catch(error => console.error('Error loading chats:', error));
        }


        // Fungsi kirim pesan (tetap pakai AJAX)
        function sendMessage() {
            const message = chatInput.value.trim();
            if (message === '') return;

            fetch(`/products/${productId}/chat`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        message: message
                    })
                })
                .then(response => response.json())
                .then(data => {
                    chatInput.value = '';
                    loadChats(); // Reload chat setelah kirim pesan baru
                })
                .catch(error => console.error('Error:', error));
        }

        sendMessageBtn.addEventListener('click', sendMessage);
        chatInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') sendMessage();
        });
    });
</script>
