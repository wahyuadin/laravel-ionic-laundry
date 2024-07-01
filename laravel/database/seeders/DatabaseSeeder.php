<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'username'  => 'user',
            'email'     => 'user@user.com',
            'password'  => bcrypt('123'),
            'nama'      => 'user',
        ]);

        User::create([
            'username'  => 'admin',
            'email'     => 'admin@admin.com',
            'password'  => bcrypt('123'),
            'nama'      => 'admin',
            'role'      => '1'
        ]);
    }
}
