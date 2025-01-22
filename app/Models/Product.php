<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class Product extends Model
{
    protected $fillable = [
     'category_id',
     'brand_id',
     'name',
     'slug',
     'images',
     'description',
     'price',
     'is_active',
     'is_feature',
     'in_stock',
     'on_sale',
    ];

    protected $casts = [
        'images'=>'array'
    ]; 
    
    public function category()
{
    return $this->belongsto(Category::class);
}

    public function brand()
{
    return $this->belongsto(Brand::class);
}

    public function orderItems()
{
    return $this->hasmany(OrderItems::class);
}

}
