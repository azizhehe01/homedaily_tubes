<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class User extends Model
{
    protected $table = 'users';
    protected $fillable = ['name', 'email', 'password', 'google_id', 'phone_number', 'address', 'profile_picture', 'role'];

    public function adminLogs()
    {
        return $this->hasMany(AdminLog::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

    public function homeServices()
    {
        return $this->hasMany(HomeService::class);
    }

    public function liveChatSessions()
    {
        return $this->hasMany(LiveChatSession::class);
    }

    public function liveChatMassages()
    {
        return $this->hasMany(LiveChatMassage::class);
    }
}
