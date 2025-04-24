<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $fillable = ['name', 'description','type'];

    public function service()
    {
        return $this->hasMany(Service::class);
    }
}