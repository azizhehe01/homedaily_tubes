<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminLog extends Model
{
    protected $table = 'admin_logs';
    protected $fillable = ['admin_id','activity'];

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
