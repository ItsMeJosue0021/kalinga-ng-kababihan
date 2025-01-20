<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'John Doe',
                'email' => 'john@doe.com',
                'password' => Hash::make('password'),
                'role_id' => 1,
            ],
            [
                'name' => 'Jane Doe',
                'email' => 'jane@doe.com',
                'password' => Hash::make('password'),
                'role_id' => 2,
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
