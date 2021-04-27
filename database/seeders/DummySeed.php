<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class DummySeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin_permission = Permission::where('slug', 'create-tasks')->first();
        $user_permission = Permission::where('slug', 'edit-users')->first();

        //RoleTableSeeder.php
        $admin_role = new Role();
        $admin_role->slug = 'admin';
        $admin_role->name = 'Administrator';
        $admin_role->save();
        $admin_role->permissions()->attach($admin_permission);

        $manager_role = new Role();
        $manager_role->slug = 'user';
        $manager_role->name = 'User';
        $manager_role->save();
        $manager_role->permissions()->attach($user_permission);

        $admin_role = Role::where('slug', 'admin')->first();
        $user_role = Role::where('slug', 'user')->first();

        $createTasks = new Permission();
        $createTasks->slug = 'create-tasks';
        $createTasks->name = 'Create Tasks';
        $createTasks->save();
        $createTasks->roles()->attach($admin_role);

        $editUsers = new Permission();
        $editUsers->slug = 'edit-users';
        $editUsers->name = 'Edit Users';
        $editUsers->save();
        $editUsers->roles()->attach($user_role);

        $admin_role = Role::where('slug', 'admin')->first();
        $user_role = Role::where('slug', 'user')->first();
        $admin_perm = Permission::where('slug', 'create-tasks')->first();
        $user_perm = Permission::where('slug', 'edit-users')->first();

        $admin = new User();
        $admin->name = 'Administrator';
        $admin->email = 'admin@gmail.com';
        $admin->password = bcrypt('admin');
        $admin->save();
        $admin->roles()->attach($admin_role);
        $admin->permissions()->attach($admin_perm);

        $manager = new User();
        $manager->name = 'User';
        $manager->email = 'user@gmail.com';
        $manager->password = bcrypt('user');
        $manager->save();
        $manager->roles()->attach($user_role);
        $manager->permissions()->attach($user_perm);
    }
}
