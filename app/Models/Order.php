<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $primaryKey = 'order_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'order_id',
        'user_id',
        'product_id',
        'quantity',
        'total_price',
        'midtrans_transaction_id',
        'midtrans_status_code',
        'midtrans_fraud_status',
        'payment_type',
        'va_number',
        'bank',
        'currency',
        'transaction_time',
        'payment_method',
        'order_status',
        'order_date'
    ];

    public function products()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
