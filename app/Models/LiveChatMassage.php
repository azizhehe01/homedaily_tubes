<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LiveChatMassage extends Model
{
    protected $table = 'live_chat_massages';
    protected $fillable =
    [
        'from_user_id',
        'to_user_id',
        'product_id',
        'message', // Make sure this matches your database column
        'message_type',
        'status',
        'sent_at'
    ];

    protected $casts = [
        'sent_at' => 'datetime'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'sent_at',
        'closed_at'
    ];

    public function sender()
    {
        return $this->belongsTo(User::class, 'from_user_id', 'user_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'to_user_id', 'user_id');
    }
}
