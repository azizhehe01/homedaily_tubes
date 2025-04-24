<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeService extends Model
{
    protected $table = 'home_services';
    protected $fillable = 
    [
        'user_id',
        'schedule',
        'address',
        'status'
    ];

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
