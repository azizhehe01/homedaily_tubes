<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $primaryKey = 'product_id';
    protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
        'category_id'
    ];

    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'category_id', 'category_id');
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

    public function images()
    {
        return $this->hasMany(Image::class, 'product_id', 'product_id');
    }

    public function chats()
    {
         return $this->hasMany(ProductChat::class, 'product_id', 'product_id')->with('user');
    }
}
