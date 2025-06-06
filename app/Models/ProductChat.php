<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductChat extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'user_id',
        'message',
        'is_admin'
    ];

    // Relasi ke produk
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}