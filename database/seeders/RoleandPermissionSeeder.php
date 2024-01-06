<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleandPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role_admin = Role::create(['name' => 'admin']);
        $role_user = Role::create(['name' => 'user']);

        $view_tvshow = Permission::create (['name'=> 'view_tvshow']);
        $view_movie = Permission::create (['name'=> 'view_movie']);
        $manage_all = Permission::create (['name'=> 'manage_all']);
        $read_requests = Permission::create (['name' => 'read_requests']);

        $permission_admin = [ $view_tvshow, $view_movie, $manage_all, $read_requests];
        $permission_user = [ $view_tvshow, $view_movie];


        $role_admin->syncPermissions($permission_admin);
        $role_user->syncPermissions($permission_user);


        User::find(1)->assignRole($role_admin);
        User::find(2)->assignRole($role_user);

    }
}
