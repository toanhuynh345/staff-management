<?php

namespace Database\Seeders;

use App\Models\Position;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
class PositionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $positions = [
            [
               'job_title' => 'ceo',
                'slug' => 'ceo',
            ],
            [
                'job_title' => 'department manager',
                'slug' => 'department_manager',
            ],
            [
                'job_title' => 'team leader',
                'slug' => 'team_leader',
            ],
            [
                'job_title' => 'member staff',
                'slug' => 'member_staff',
            ]
        ];
        Position::insert($positions);
//        DB::table('positions')->insert($positions)
//        for ($i = 0; $i < $limit; $i++) {
//            DB::table('positions')->insert([
//                'name' => $faker->name,
//                'email' => $faker->unique()->email,
//                'birthday' => Date::createFromDate(1990,1, 1),
//                'sex'=> rand(1,2),
//                'phone' => $faker->phoneNumber,
//                'description' => $faker->text,
//                'password' => bcrypt('123456'),
//                'avatar'=> null,
//                'deleted_at' => null,
//            ]);
//        }
    }
}
