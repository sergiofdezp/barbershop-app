<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;

    protected $fillable = ['order_id', 'message', 'user_id'];

    public function orders(){
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function users(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
