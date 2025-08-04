<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;
    //Order And User Relationship
    public function users() {
        return $this->belongsTo(User::class,"user_id");
 }


         protected $fillable = [

                    'user_id',
                    'car_name',
                    'model',
                    'units',
                    'price',
                    'total',
                    'image',
                    'billing_address',
                    'billing_phone',
                    'billing_email',
                    'grand_total',
                    'payment_status'
       ];

}
