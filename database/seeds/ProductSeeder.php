<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('products')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $array = [
            [
                'name' => 'Hotdog',
                'price' => 20,
                'quantity' => 100,
                'menu_category_id' => 1,
            ],
            [
                'name' => 'Cheese Burger',
                'price' => 50,
                'quantity' => 100,
                'menu_category_id' => 1,
            ],
            [
                'name' => 'Fries',
                'price' => 25,
                'quantity' => 100,
                'menu_category_id' => 1,
            ],
            [
                'name' => 'Coke',
                'price' => 15,
                'quantity' => 100,
                'menu_category_id' => 2,
            ],
            [
                'name' => 'Sprite',
                'price' => 15,
                'quantity' => 100,
                'menu_category_id' => 2,
            ],
            [
                'name' => 'Tea',
                'price' => 30,
                'quantity' => 100,
                'menu_category_id' => 2,
            ],
            [
                'name' => 'Chicken Combo Meal',
                'price' => 109,
                'quantity' => 50,
                'menu_category_id' => 3,
            ],
            [
                'name' => 'Pork Combo',
                'price' => 159,
                'quantity' => 50,
                'menu_category_id' => 3,
            ],
            [
                'name' => 'Fish Combo',
                'price' => 79,
                'quantity' => 50,
                'menu_category_id' => 3,
            ],
        ];
        DB::table('products')->insert($array);
    }
}
