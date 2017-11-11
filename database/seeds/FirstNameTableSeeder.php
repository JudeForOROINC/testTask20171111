<?php

use Illuminate\Database\Seeder;

class FirstNameTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
DB::table('firstname_ref')->delete();
        $faker = \Faker\Factory::create();
        for ($i = 0; $i < 20; $i++) {
            DB::table('firstname_ref')->insert(
[
                'value' => $faker->firstName,
                
            ]);
        }
    }
}
