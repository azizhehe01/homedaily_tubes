<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LiveChatSession extends Model
{
    protected $table =  'live_chat_sessions';
    protected $fillable = 
    [
        'user_id',
        'admin_id',
        'status',
        'created_at',
        'closed_at'
    ];

    public function users()
    {
        return  $this->belongsTo(User::class);
    }

    public function liveChatMassages()
    {
        return  $this->hasMany(LiveChatMassage::class);
    }
}
