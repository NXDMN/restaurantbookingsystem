<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Booking;

class Order extends Model
{
    use HasFactory;

    public function getBookings(){
        return $this->belongsTo(Booking::class);
    }

}
