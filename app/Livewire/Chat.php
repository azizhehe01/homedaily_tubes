<?php


namespace App\Livewire;

use Livewire\Component;
use App\Models\LiveChatMassage;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class Chat extends Component
{
    public $product;
    public $messages = [];
    public $messageText = '';
    public $showChat = false;
    public $isAdmin;
    public $selectedUserId = null;
    public $users = [];

    protected $listeners = ['echo:chat,MessageSent' => '$refresh'];

    public function mount($product = null)
    {
        $this->isAdmin = Auth::user()->role === 'admin';
        $this->product = $product;

        if ($this->isAdmin) {
            // Fix the whereHas query to use correct column
            $this->users = User::where('role', '!=', 'admin')
                ->whereHas('liveChatMassages', function ($query) {
                    $query->where('from_user_id', '!=', Auth::id());
                })
                ->get();
        } else {
            $admin = User::where('role', 'admin')->first();
            $this->selectedUserId = $admin ? $admin->user_id : null;
        }

        $this->loadMessages();
    }

    public function loadMessages()
    {
        $query = LiveChatMassage::query();

        if ($this->isAdmin) {
            if ($this->selectedUserId) {
                $query->where(function ($q) {
                    $q->where(function ($inner) {
                        $inner->where('from_user_id', Auth::id())
                            ->where('to_user_id', $this->selectedUserId);
                    })->orWhere(function ($inner) {
                        $inner->where('from_user_id', $this->selectedUserId)
                            ->where('to_user_id', Auth::id());
                    });
                });
            }
        } else {
            if (!$this->product) {
                $this->messages = [];
                return;
            }

            $query->where('product_id', $this->product->product_id)
                ->where(function ($q) {
                    $q->where('from_user_id', Auth::id())
                        ->orWhere('to_user_id', Auth::id());
                });
        }

        // Assign messages directly to the component property
        $this->messages = $query->orderBy('sent_at', 'asc')
            ->get()
            ->map(function ($message) {
                return [
                    'id' => $message->message_id,
                    'from_user_id' => $message->from_user_id,
                    'to_user_id' => $message->to_user_id,
                    'message' => $message->message,
                    'sent_at' => $message->sent_at
                ];
            })->toArray();

        // Debug info
        Log::info('Messages loaded', [
            'count' => count($this->messages),
            'is_admin' => $this->isAdmin,
            'selected_user' => $this->selectedUserId
        ]);
    }



    public function selectUser($userId)
    {
        if ($this->isAdmin) {
            $this->selectedUserId = $userId;
            $this->loadMessages();
        }
    }


    public function toggleChat()
    {
        Log::info('Toggle chat called', ['user' => Auth::id(), 'previous_state' => $this->showChat]);
        $this->showChat = !$this->showChat;

        if ($this->showChat) {
            $this->loadMessages();
        }
    }

    public function sendMessage()
    {
        $this->validate([
            'messageText' => 'required|min:1',
            'selectedUserId' => 'required'
        ]);

        try {
            $messageData = [
                'from_user_id' => Auth::id(),
                'to_user_id' => $this->selectedUserId,
                'message' => $this->messageText,
                'message_type' => 'text',
                'status' => 'sent',
                'sent_at' => now()
            ];

            if ($this->isAdmin) {
                // Get product_id from the user's last message
                $lastMessage = LiveChatMassage::where('from_user_id', $this->selectedUserId)
                    ->whereNotNull('product_id')
                    ->latest()
                    ->first();

                if ($lastMessage) {
                    $messageData['product_id'] = $lastMessage->product_id;
                }
            } else {
                // Only set product_id if product exists
                if ($this->product) {
                    $messageData['product_id'] = $this->product->product_id;
                }
            }

            $message = LiveChatMassage::create($messageData);

            $this->messages[] = [
                'id' => $message->message_id,
                'from_user_id' => $message->from_user_id,
                'to_user_id' => $message->to_user_id,
                'message' => $message->message,
                'sent_at' => $message->sent_at
            ];

            $this->messageText = '';
            $this->dispatch('messageSent');
        } catch (\Exception $e) {
            Log::error('Chat error: ' . $e->getMessage(), [
                'user_id' => Auth::id(),
                'selected_user' => $this->selectedUserId,
                'is_admin' => $this->isAdmin
            ]);
            session()->flash('error', 'Failed to send message');
        }
    }

    public function render()
    {
        $viewData = [
            'users' => $this->users,
            'messages' => $this->messages,
            'selectedUserId' => $this->selectedUserId,
            'showChat' => $this->showChat,
            'product' => $this->product,
            'isAdmin' => $this->isAdmin
        ];

        if ($this->isAdmin) {
            return view('livewire.admin-chat', $viewData);
        }

        return view('livewire.chat', $viewData);
    }
}
