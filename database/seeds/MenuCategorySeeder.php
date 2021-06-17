<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuCategorySeeder extends Seeder
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
        DB::table('menu_categories')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $array = [
            [
                'name' => 'Burgers',
                'label' => 'Burger'
            ],
            [
                'name' => 'Beverages',
                'label' => 'Beverage'
            ],
            [
                'name' => 'Combo Meals',
                'label' => 'Combo Meals'
            ],
        ];
        DB::table('menu_categories')->insert($array);
    }
}
