<?php

namespace App\Models;

use App\Models\Order;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    
    protected $fillable = [
        'order_id',
        'first_name',
        'last_name',
        'phone',
        'street_address',
        'city',
        'state',
        'zip_code',
       ]; 

       public function order()
       {
           return $this->belongsto(Order::class);
       }
       
       public function getfullname()
       {
           return "{this->first_name} {$this->last_name}";
       }
       

}
