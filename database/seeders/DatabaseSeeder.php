<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Employee;
use App\Models\Position;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $managerPosition = Position::factory()->create([
            'name' => 'Manager',
            'rate' => 450.00,
        ]);

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@test.com',
            'password' => bcrypt('password123'),

        ]);

        $manager = User::factory()->create([
            'name' => 'User',
            'email' => 'user@test.com',
            'password' => bcrypt('password123'),

        ]);

        Employee::factory()->create([
            'pos_id' => $managerPosition->id,
            'user_id' => $manager->id,
        ]);


        $this->call([
            RoleandPermissionSeeder::class,
            // UserSeeder::class
        ]);
    }
}
