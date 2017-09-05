<?php

use Illuminate\Database\Seeder;
use Minion\Entities\Role;
use Minion\Entities\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRole = Role::create(['name' => 'admin']);
        Role::create(['name' => 'owner']);
        Role::create(['name' => 'moderator']);
        Role::create(['name' => 'user']);
        Role::create(['name' => 'bot']);

        $admin = User::create([
            'name' => 'Administrator',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin123'),
            'is_admin' => 1,
            'status' => 1,
        ]);

        $admin->assignRole($adminRole->id);
    }
}
