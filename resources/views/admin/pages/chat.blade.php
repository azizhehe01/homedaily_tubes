@extends('admin.layouts.app')

@section('title', 'Chat Management')

@section('content')
<div id="admin-chat-container">
    <!-- List chats -->
    <div id="chat-list" class="chat-list">
        <h3>Daftar Chat</h3>
        <ul id="chat-groups"></ul>
    </div>

    <!-- Chat messages -->
    <div id="chat-messages" class="chat-messages">
        <h3>Pesan Chat</h3>
        <div id="messages"></div>
        <textarea id="admin-message" placeholder="Ketik balasan di sini..."></textarea>
        <button id="send-reply">Kirim</button>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener("DOMContentLoaded", function() {
    const chatGroupsEl = document.getElementById('chat-groups');
    const messagesEl = document.getElementById('messages');
    const sendReplyBtn = document.getElementById('send-reply');
    const adminMessageInput = document.getElementById('admin-message');

    // Fetch chat groups
    fetch("{{ route('admin.pages.get-chats') }}")
        .then(response => response.json())
        .then(data => {
            chatGroupsEl.innerHTML = '';
            data.forEach(group => {
                const li = document.createElement('li');
                li.textContent = `${group.user.name} - ${group.product.name}`;
                li.dataset.userId = group.user.id;
                li.dataset.productId = group.product.id;
                chatGroupsEl.appendChild(li);
            
                li.addEventListener('click', () => {
                    displayMessages(group.chats);
                });
            });
        });

    function displayMessages(chats) {
        messagesEl.innerHTML = '';
        chats.forEach(chat => {
            const div = document.createElement('div');
            div.textContent = chat.message;
            div.className = chat.is_admin ? 'admin-message' : 'user-message';
            messagesEl.appendChild(div);
        });
    }

    sendReplyBtn.addEventListener('click', () => {
        const message = adminMessageInput.value;
        if (!message.trim()) return;

        // Send message to the server (update route to your API)
        fetch(`/api/admin/reply`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            body: JSON.stringify({
                message: message,
                product_id: messagesEl.dataset.productId,
                user_id: messagesEl.dataset.userId,
            })
        }).then(response => response.json())
          .then(data => {
              displayMessages(data.chats);
              adminMessageInput.value = '';
          });
    });
});
</script>
@endpush
