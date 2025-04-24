<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LiveChatMassage extends Model
{
    protected $table = 'live_chat_massages';
    protected $fillable =
    [
        'session_id',
        'sender_id',
        'receiver_id',
        'message_content',
        'message_type',
        'status',
        'sent_at'
    ];

    public function liveChatSessions()
    {
        return $this->belongsTo(LiveChatSession::class);
    }

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
