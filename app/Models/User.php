<?php

namespace App\Models;

use Spatie\Permission\Traits\HasRoles;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    protected $primaryKey = 'user_id';

    protected $fillable = [
        'name',
        'email',
        'password',
        'google_id',
        'role',
        'phone_number',
        'profile_picture',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

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
        return $this->hasMany(Address::class, 'user_id', 'user_id');
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
        return $this->hasMany(LiveChatMassage::class, 'from_user_id', 'user_id');
    }

    public function receivedMessages()
    {
        return $this->hasMany(LiveChatMassage::class, 'to_user_id', 'user_id');
    }

    public function productChats()
    {
        return $this->hasMany(ProductChat::class);
    }
}
