<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);


        // create admin user
        User::factory()->create([
            'name' => 'Admin User',
            'email' => env('ADMIN_USER_EMAIL', 'admin@example.com'),
            'password' => bcrypt(env('ADMIN_USER_PASSWORD', 'password')),
            'role' => 'admin',
        ]);

        // add 10 random users with role = client
        User::factory(10)->create([
            'role' => 'client',
        ]);

        //add, 20 invoices for random users
        \App\Models\Invoice::factory(20)->create();
       
    }
}
