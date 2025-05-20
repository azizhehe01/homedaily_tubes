<div class="fixed bottom-6 right-6 z-50 font-sans">
    <!-- Bubble Button -->
    <button id="chatBubble" class="w-16 h-16 bg-[#FF7A00] rounded-full shadow-lg flex items-center justify-center hover:bg-orange-600 transition-all">
        <!-- Bigger Chat Icon -->
        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-white" viewBox="0 0 24 24" fill="currentColor">
            <path d="M4 4h16v12H5.17L4 17.17V4zm0-2a2 2 0 0 0-2 2v18l4-4h14a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H4z"/>
        </svg>
    </button>

    <!-- Chat Box -->
    <div id="chatBox" class="hidden w-[360px] max-h-[500px] rounded-xl shadow-2xl bg-white absolute bottom-20 right-0 overflow-hidden border border-gray-200">
        <!-- Header -->
        <div class="bg-[#FF7A00] text-white p-4 flex justify-between items-center">
            <span class="font-semibold">Diskusi Produk</span>
            <button id="closeChat" class="hover:text-orange-100">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" stroke="currentColor" fill="none">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Chat Messages -->
        <div id="chatMessages" class="h-[300px] overflow-y-auto p-4 space-y-3 bg-[#FFF9F5] text-sm text-gray-800">
            <div class="text-center text-gray-500">Belum ada percakapan. Mulai bertanya tentang produk ini.</div>

            <!-- Contoh pesan admin -->
            <div class="flex items-start gap-2">
                <div class="w-8 h-8 bg-gray-300 rounded-full"></div>
                <div class="bg-gray-200 px-4 py-2 rounded-lg max-w-[70%]">
                    Hai Kak, produk ini ready ya!
                </div>
            </div>

            <!-- Contoh pesan user -->
            <div class="flex justify-end">
                <div class="bg-[#FF7A00] text-white px-4 py-2 rounded-lg max-w-[70%]">
                    Oke kak, saya mau order 😊
                </div>
            </div>
        </div>

        <!-- Chat Input -->
        <div class="border-t p-3 bg-white flex gap-2">
            <input 
                id="chatInput" 
                type="text" 
                placeholder="Tulis pesan..." 
                class="flex-1 px-3 py-2 border rounded-full focus:outline-none focus:ring-2 focus:ring-[#FF7A00]"
            >
            <button id="sendMessage" class="bg-[#FF7A00] text-white px-4 py-2 rounded-full hover:bg-orange-600">
                Kirim
            </button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const chatBubble = document.getElementById('chatBubble');
    const chatBox = document.getElementById('chatBox');
    const closeChat = document.getElementById('closeChat');

    chatBubble.addEventListener('click', () => {
        chatBox.classList.toggle('hidden');
    });

    closeChat.addEventListener('click', () => {
        chatBox.classList.add('hidden');
    });
});
</script>
