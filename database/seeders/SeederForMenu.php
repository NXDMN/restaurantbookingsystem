<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SeederForMenu extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now()->toDateTimeString();

        $menus = [
            ['dining_package'=>"Classic Pasta A", 'items'=>"Angel Hair Pasta tossed with Soya Braised Chicken, French Onion Soup, Green Tea Ice Cream, Lychee in Mint Lemonande Syrup ", "description"=>"This package is serve for 1 person and MYR 99 Nett Per Person."],
            ['dining_package'=>"Classic Pasta B", 'items'=>"Angel Hair Pasta tossed with Aubergine and topped with Dried Shimp, Cream of Tomato Soup, Toffee Chocolate Cake, Jackfruit in Mint Lemonande Syrup ", "description"=>"This package is serve for 1 person and MYR 129 Nett Per Person."],
            ['dining_package'=>"Smoked Duck ", 'items'=>"Earl Grey Tea Smoked Duck with Mascarpone Mousseline Potatoes and Red Wine Cherry Sauce, Frech Onion Soup, Orange and Lemon Passet", "description"=>"This package is serve for 1 person and MYR 219 Nett Per Person."],
        ];

        foreach($menus as $menu) {
            DB::table('menus')->insert([
                'dining_package' => $menu['dining_package'],
                'items' => $menu['items'],
                'description' => $menu['description'],
                'created_at' => $now,
                'updated_at' => $now
            ]);
        };
    }
}
