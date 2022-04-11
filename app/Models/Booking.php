<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Bookingtable;
use App\Models\Order;

class Booking extends Model
{
    use HasFactory;

    public function getUser(){
        return $this->belongsTo(User::class,'user_id')->select(['name']);
    }

    public function getBookingtable(){
        return $this->belongsToMany(Bookingtable::class);
    }

    public function getOrder(){
        return $this->hasMany(Order::class);
    }
}
