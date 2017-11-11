<?php

use Illuminate\Database\Seeder;
use App\Client;

class ClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Client::truncate();

        $faker = \Faker\Factory::create();

        $fn_min = DB::table('firstname_ref')->min('id');
        $ln_min = DB::table('lastname_ref')->min('id');
        $fn_max = DB::table('firstname_ref')->max('id');
        $ln_max = DB::table('lastname_ref')->max('id');
        $c_min = DB::table('city_ref')->min('id');
        $c_max = DB::table('city_ref')->max('id');
        $co_min = DB::table('country_ref')->min('id');
        $co_max = DB::table('country_ref')->max('id');

        // And now, let's create a few articles in our database:
        for ($i = 0; $i < 50; $i++) {
            Client::create([
                'firstname_id' => $faker->numberBetween($fn_min,$fn_max),
                'lastname_id' => $faker->numberBetween($ln_min,$ln_max),
                'personal_code' => $faker->sentence,
                'email' => $faker->email,
                'adress' => $faker->streetAddress,
                'city_id' => $faker->numberBetween($c_min,$c_max),
                'country_id' => $faker->numberBetween($co_min,$co_max),

            ]);
        }
    }
}
