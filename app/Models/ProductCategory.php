<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    protected $table =  'product_categories';
    protected $primaryKey = 'category_id'; 
    protected $fillable =  [
        'category_name',
        'description'
    ];

    public function products()
    {
        return $this->hasMany(Product::class,'category_id', 'category_id') ;
    }
}
