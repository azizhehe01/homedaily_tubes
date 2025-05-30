<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = 'addresses';
    protected $primaryKey = 'address_id'; 
    protected $fillable = [
        'address_id',
        'user_id',
        'recipient_name',
        'phone_number',
        'full_address',
        'postal_code',
        'city',
        'province',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id','user_id');
    }
}
