<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            ['name' => 'DEV', 'display_name' => null],
            ['name' => 'ADMIN', 'display_name' => 'Administrador'],
            ['name' => 'USER', 'display_name' => 'Usuario'],
        ];
        
        foreach ($roles as $role) {
            Role::updateOrCreate([
                'name' => $role['name'],
            ], [
                'display_name' => $role['display_name']
            ]);
        }
    }
}
