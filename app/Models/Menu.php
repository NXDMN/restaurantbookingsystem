<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Booking;

class Menu extends Model
{
    use HasFactory;

    public function getBooking(){
        return $this->belongsToMany(Booking::class);
    }
}
