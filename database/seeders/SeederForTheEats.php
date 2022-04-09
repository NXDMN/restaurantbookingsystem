<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SeederForTheEats extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now()->toDateTimeString();
        $date_today = Carbon::now()->toDateString(); // format('Y-m-d');

        $users = [
            ['name'=>'David Faroq', 'email'=>'admin@gmail.com', 'role'=>'admin', 'password'=>Hash::make('qwe123')],
            ['name'=>'May Milan', 'email'=>'customer1@gmail.com', 'role'=>'customer', 'password'=>Hash::make('qwe123')],
            ['name'=>'Serrav Lee', 'email'=>'customer2@gmail.com', 'role'=>'customer', 'password'=>Hash::make('qwe123')],
            ['name'=>'Peter Wong', 'email'=>'customer3@gmail.com', 'role'=>'customer', 'password'=>Hash::make('qwe123')],
            ['name'=>'Jenny Teng', 'email'=>'customer4@gmail.com', 'role'=>'customer', 'password'=>Hash::make('qwe123')]
        ];

        $bookings = [
            ['user_id'=>2, 'booking_date'=>new Carbon('2022-05-01'), 'booking_time'=>new Carbon('12:30:00'), 'contact_no'=>'012-1180636', 'no_of_person'=>5,'booking_status'=>'Pending'],
            ['user_id'=>2, 'booking_date'=>new Carbon('2022-05-01'), 'booking_time'=>new Carbon('12:30:00'), 'contact_no'=>'012-1180636', 'no_of_person'=>8,'booking_status'=>'Pending'],
            ['user_id'=>2, 'booking_date'=>new Carbon('2022-04-01'), 'booking_time'=>new Carbon('12:30:00'), 'contact_no'=>'012-1180636', 'no_of_person'=>8,'booking_status'=>'Cancelled'],
            ['user_id'=>2, 'booking_date'=>$date_today, 'booking_time'=>new Carbon('12:30:00'), 'contact_no'=>'012-1180636', 'no_of_person'=>8,'booking_status'=>'Cancelled'],
            ['user_id'=>2, 'booking_date'=>new Carbon('2022-04-01'), 'booking_time'=>new Carbon('13:30:00'), 'contact_no'=>'012-1180636', 'no_of_person'=>8,'booking_status'=>'Confirmed'],
            ['user_id'=>3, 'booking_date'=>new Carbon('2022-05-01'), 'booking_time'=>new Carbon('11:40:00'), 'contact_no'=>'012-1180636', 'no_of_person'=>7,'booking_status'=>'Pending'],
            ['user_id'=>4, 'booking_date'=>new Carbon('2022-05-01'), 'booking_time'=>new Carbon('13:20:00'), 'contact_no'=>'012-1180636', 'no_of_person'=>5,'booking_status'=>'Pending'],
            ['user_id'=>5, 'booking_date'=>new Carbon('2022-05-01'), 'booking_time'=>new Carbon('12:30:00'), 'contact_no'=>'012-1180636', 'no_of_person'=>2,'booking_status'=>'Pending'],
        ];

        $bookingtables = [
            ['table_number'=>"A1", 'seats'=>8],
            ['table_number'=>"A2", 'seats'=>8],
            ['table_number'=>"A3", 'seats'=>8],
            ['table_number'=>"A4", 'seats'=>8],
            ['table_number'=>"A5", 'seats'=>4],
            ['table_number'=>"B1", 'seats'=>4],
            ['table_number'=>"B2", 'seats'=>2],
            ['table_number'=>"B3", 'seats'=>2],
            ['table_number'=>"B4", 'seats'=>2],
            ['table_number'=>"B5", 'seats'=>2],
        ];

        foreach($users as $user) {
            DB::table('users')->insert([
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => $user['password'],
                'role' => $user['role'],
                'created_at' => $now,
                'updated_at' => $now
            ]);
        };

        foreach($bookings as $booking) {
            DB::table('bookings')->insert([
                'user_id' => $booking['user_id'],
                'booking_date' => $booking['booking_date'],
                'booking_time' => $booking['booking_time'],
                'contact_no' => $booking['contact_no'],
                'no_of_person' => $booking['no_of_person'],
                'booking_status' => $booking['booking_status'],
                'created_at' => $now,
                'updated_at' => $now
            ]);
        };

        foreach($bookingtables as $table) {
            DB::table('bookingtables')->insert([
                'table_number' => $table['table_number'],
                'seats' => $table['seats'],
                'created_at' => $now,
                'updated_at' => $now
            ]);
        };
    }
}
