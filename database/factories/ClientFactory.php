<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Client::class, function (Faker $faker) {
    static $password;
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
        
        return [
                'firstname_id' => $faker->numberBetween($fn_min,$fn_max),
                'lastname_id' => $faker->numberBetween($ln_min,$ln_max),
                'personal_code' => $faker->sentence,
                'email' => $faker->email,
                'adress' => $faker->streetAddress,
                'city_id' => $faker->numberBetween($c_min,$c_max),
                'country_id' => $faker->numberBetween($co_min,$co_max),

            ];
        }
);
