<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Booking;
use App\Models\Menu;

class SeederForBookingMenu extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $booking = Booking::findOrFail(3);
        $menu = Menu::findOrFail(3);

        $booking->getMenu()->attach($menu->pluck('id'));

    }
}
