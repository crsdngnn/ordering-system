<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DiscountCouponSeeder extends Seeder
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
        DB::table('discount_coupons')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $array = [
            [
                'name' => 'Burgers',
                'code' => 'ABCDE',
                'discount' => 10
            ],
        ];
        DB::table('discount_coupons')->insert($array);
    }
}
