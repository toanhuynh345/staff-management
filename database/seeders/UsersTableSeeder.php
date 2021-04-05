<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        $limit = 1500;

        for ($i = 0; $i < $limit; $i++) {
            DB::table('users')->insert([
                'name' => $faker->name,
                'email' => $faker->unique()->email,
                'birthday' => Date::createFromDate(1990,1, 1),
                'sex'=> rand(1,2),
                'phone' => $faker->phoneNumber,
                'description' => $faker->text,
                'password' => bcrypt('123456'),
                'avatar'=> null,
                'deleted_at' => null,
            ]);
        }
    }
}
