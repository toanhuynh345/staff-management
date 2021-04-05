<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RolePermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
         * Create default for super admin
         */
        \DB::transaction(function () {
            $roleName = config('permission.super_admin.role');
            $permissionName = config('permission.super_admin.permission');
            $isEmpty = [];

            $role = new \Spatie\Permission\Models\Role();
            try {
                $role = $role->findByName($roleName);
                $isEmpty[] = false;
            } catch(\Exception $e) {
                $role->name = $roleName;
                $role->save();
                $isEmpty[] = true;
            }

            $permission = new \Spatie\Permission\Models\Permission();
            try {
                $permission->findByName($permissionName);
                $isEmpty[] = false;
            } catch(\Exception $e) {
                $permission->name = $permissionName;
                $permission->save();
                $isEmpty[] = true;
            }

            if (! in_array(false, $isEmpty)) {
                $role->givePermissionTo($permission);
            }
        });
    }
}
