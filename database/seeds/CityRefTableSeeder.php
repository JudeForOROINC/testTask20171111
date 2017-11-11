<?php

use Illuminate\Database\Seeder;

class CityRefTableSeeder extends Seeder
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

        // And now, let's create a few articles in our database:
        for ($i = 0; $i < 50; $i++) {
DB::table('city_ref')->insert([

                'value' => $faker->city,

            ]);
        }
    }
}
