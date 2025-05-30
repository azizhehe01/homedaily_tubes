<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Image extends Model
{
    use HasFactory;

    protected $primaryKey = 'image_id';
    protected $fillable = [
        'path',
        'product_id',
        'is_primary'
    ];

    protected $casts = [
        'is_primary' => 'boolean' // [!] Tambahkan casting untuk boolean
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }
}
