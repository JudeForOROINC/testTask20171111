<?php

use Illuminate\Database\Seeder;

class CountryRefTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $faker = \Faker\Factory::create();
        for ($i = 0; $i < 15; $i++) {
        DB::table('country_ref')->insert(
[
                'value' => $faker->country,
                
            ]);
        }
    }
}
