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
        'closed_at',
        'product_id'
    ];


    protected $dates = [
        'created_at',
        'updated_at',
        'sent_at',
        'closed_at'
    ];

    public function users()
    {
        return  $this->belongsTo(User::class);
    }

    public function messages()
    {
        return $this->hasMany(LiveChatMassage::class, 'session_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }
}
