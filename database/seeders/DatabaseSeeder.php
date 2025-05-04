<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::create([
            'name' => 'ICTS ADMIN',
            'email' => 'icts.admin@email.com',
            'password' => Hash::make('icts_password'),
            'role' => 'admin'
        ]);

        for ($i=1; $i <= 20; $i++) {
            User::create([
                'name' => 'treasurer_'.$i,
                'email' => 'treasurer_'.$i.'@email.com',
                'password' => Hash::make('treasurer_password'),
            ]);
        }
    }
}
