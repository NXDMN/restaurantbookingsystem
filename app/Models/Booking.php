<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Bookingtable;

class Booking extends Model
{
    use HasFactory;

    public function getUser(){
        return $this->belongsTo(User::class);
    }

    public function getBookingtable(){
        return $this->hasOne(Bookingtable::class);
    }
}
