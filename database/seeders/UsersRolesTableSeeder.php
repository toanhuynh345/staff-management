<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UsersRolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::transaction(function () {
            $user = new User();
            $roleName = config('permission.super_admin.role');
            $userName = 'Super Admin';
            $userEmail = config('permission.super_admin.email');
            $userPass = '123456';

            if (empty($user->where('name', $userName)->first())) {
                $user = \App\Models\User::create([
                    'name' => $userName,
                    'email' => $userEmail,
                    'password' => Hash::make($userPass),
                ]);

                try {
                    $role = Role::where('name', $roleName)->firstOrFail();
                    $user->assignRole($role);
                } catch(\Exception $e) {
                    return;
                }
            }
        });
    }
}
