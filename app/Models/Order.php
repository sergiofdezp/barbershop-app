<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['order_ref', 'order_date', 'order_hour', 'user_id', 'name', 'phone', 'service_id', 'is_online', 'order_status', 'total_price', 'pay_status', 'coupon_id'];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function service(){
        return $this->belongsTo(Service::class, 'service_id');
    }

    public function coupon(){
        return $this->belongsTo(Coupon::class, 'coupon_id');
    }
}
