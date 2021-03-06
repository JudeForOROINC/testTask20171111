<?php

use Illuminate\Database\Seeder;

class LastNameTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
DB::table('lastname_ref')->delete();
        $faker = \Faker\Factory::create();

        // Let's make sure everyone has the same password and 
        // let's hash it before the loop, or else our seeder 
        // will be too slow.
        $password = Hash::make('toptal');
        for ($i = 0; $i < 10; $i++) {
           DB::table('lastname_ref')->insert(
        [
            'value' => $faker->lastName,
        ]);

        // And now let's generate a few dozen users for our app:
        }
    }
}
