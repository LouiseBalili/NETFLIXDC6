<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

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

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@test.com',
            'password' => bcrypt('password123'),

        ]);

        User::factory()->create([
            'name' => 'User',
            'email' => 'user@test.com',
            'password' => bcrypt('password123'),

        ]);


        $this->call([
            RoleandPermissionSeeder::class,
        ]);
    }
}
