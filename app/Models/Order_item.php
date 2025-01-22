<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order_item extends Model
{
    
    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'unit_amount',
        'total_amount'
       ]; 

       public function order()
       {
           return $this->belongsto(Order::class);
       }
       
       public function product()
       {
           return $this->belongsto(Product::class);
       }
       

}
