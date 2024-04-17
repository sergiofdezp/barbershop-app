<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = ['type', 'price', 'image'];

    public function orders(){
        return $this->hasMany(Order::class, 'id');
    }
}
