<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dev_role = Role::where('name', 'DEV')->first();
        $admin_role = Role::where('name', 'ADMIN')->first();

        $users = [
            [
                'role_id' => $dev_role->id,
                'name' => 'SUPERUSER',
                'email' => 'super-user@dev.com',
                'password' => '25950164'
            ],
            [
                'role_id' => $admin_role->id,
                'name' => 'Eddy Meléndez',
                'email' => 'eemelendez@gmail.com',
                'password' => 'e7801954'
            ],
        ];
        
        foreach ($users as $user) {
            User::firstOrCreate([
                'role_id' => $user['role_id'],
                'name' => $user['name'],
                'email' => $user['email'],
            ], [
                'password' => $user['password']
            ]);
        }
    }
}
