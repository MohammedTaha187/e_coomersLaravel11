<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin User
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'utype' => 'ADM',
        ]);

        // Customer User
        User::factory()->create([
            'name' => 'Customer User',
            'email' => 'customer@example.com',
            'password' => Hash::make('password'),
            'utype' => 'USR',
        ]);

        // Random Users
        User::factory(1)->create();
    }
}
