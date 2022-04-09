<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Booking;
use App\Models\Bookingtable;

class SeederForBookingTablePivot extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bookings = Booking::all()->random(1);
        // $table = Bookingtable::all()->random(1);
        $table = Bookingtable::whereIn('id', [1])->get();

        $bookings->each(function(Booking $booking)use ($table){
            $booking->getBookingtable()->attach($table->pluck('id'));
        });
    }
}
