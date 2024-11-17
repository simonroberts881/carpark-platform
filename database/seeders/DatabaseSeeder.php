<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Vehicle;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin User
        User::factory()->admin()->create([
            'name' => 'Simon Roberts',
            'email' => 'simon@bigboffin.com',
        ]);

        // Client User
        User::factory()->has(
            Vehicle::factory()
        )->create([
            'name' => 'John Doe',
            'email' => 'john@example.com'
        ]);
    }
}
