<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SeederForOrder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now()->toDateTimeString();

        $orders = [
            ['booking_id' =>10 ,'user_id' =>6,'dining_package'=>"Classic Pasta A", 'quantity'=>2],
            ['booking_id' =>10 ,'user_id' =>6,'dining_package'=>"Classic Pasta B", 'quantity'=>1],
        ];

        foreach($orders as $order) {
            DB::table('orders')->insert([
                'booking_id' => $order['booking_id'],
                'user_id' => $order['user_id'],
                'dining_package' => $order['dining_package'],
                'quantity' => $order['quantity'],
                'created_at' => $now,
                'updated_at' => $now
            ]);
        };
    }
}
