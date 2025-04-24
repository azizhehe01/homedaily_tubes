<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = 'addresses';
    protected $fillable = [
        'user_id',
        'recipient_name',
        'phone_number',
        'full_address',
        'postal_code',
        'city',
        'province',
    ];
    
    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
