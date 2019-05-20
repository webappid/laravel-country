<?php
/**
 * Created by PhpStorm.
 * User: dyangalih
 * Date: 2019-02-13
 * Time: 19:15
 */

namespace WebAppId\Country\Seeds;


use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(CurrencyTableSeeder::class);
        $this->call(CountryTableSeeder::class);
    }
}