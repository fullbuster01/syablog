<?php

use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name' => 'Admin',
            'username' => 'Admin',
            'email' => 'admin@role.co',
            'password' => bcrypt('password')
        ]);
        $admin->assignRole('administrator');

        $user = User::create([
            'name' => 'User',
            'username' => 'user',
            'email' => 'user@role.co',
            'password' => bcrypt('password')
        ]);
        $user->assignRole('author');

        $ara = User::create([
            'name' => 'Ara Ara',
            'username' => 'ara',
            'email' => 'ara@role.co',
            'password' => bcrypt('password')
        ]);
        $ara->assignRole('author');
    }
}
