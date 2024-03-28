<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['order_date', 'user_id', 'name', 'is_hair', 'is_beard', 'is_online', 'order_status', 'total_price', 'pay_status'];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
