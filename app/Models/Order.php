<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'grand_total',
        'payment_method',
        'payment_status',
        'status',
        'currency',
        'shipping_amount',
        'shipping_method',
        'notes'
       ]; 

       public function user()
       {
           return $this->belongsto(User::class);
       }
       

       public function items()
       {
           return $this->belongsto(OrderItems::class);
       }

       public function address()
       {
           return $this->belongsto(Address::class);
       }
       
       
}
