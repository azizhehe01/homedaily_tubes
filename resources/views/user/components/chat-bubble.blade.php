<!-- Bubble Chat Component -->
<div class="fixed bottom-5 right-5 z-[9999]">
    <!-- Floating Bubble Button -->
    <button id="chatBubble" class="w-14 h-14 bg-blue-500 rounded-full flex items-center justify-center shadow-lg hover:bg-blue-600 transition-all">
        <!-- Chat Icon -->
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
        </svg>
    </button>

    <!-- Chat Box -->
    <div id="chatBox" class="hidden w-80 rounded-lg shadow-lg bg-white absolute bottom-16 right-0 z-50">
        <!-- Chat Header -->
        <div class="bg-blue-500 text-white p-4 rounded-t-lg flex justify-between items-center">
            <span class="font-semibold">Chat Support</span>
            <button id="closeChat" class="text-white hover:text-blue-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Chat Messages -->
        <div id="chatMessages" class="h-[300px] p-4 overflow-y-auto flex flex-col space-y-3 bg-gray-50">
            <div class="text-center text-gray-500 py-4">
                Start a conversation
            </div>
        </div>

        <!-- Chat Input -->
        <div class="p-4 border-t border-gray-200 flex space-x-2">
            <input id="chatInput" type="text" placeholder="Type a message..."
                   class="flex-1 px-4 py-2 border border-gray-300 rounded-full focus:outline-none focus:border-blue-500">
            <button id="sendMessage" class="bg-blue-500 text-white px-4 py-2 rounded-full hover:bg-blue-600 transition-colors">
                Send
            </button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
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
