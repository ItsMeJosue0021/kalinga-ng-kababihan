<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'first_name' => 'Margie',
                'last_name' => 'Remulta',
                'middle_name' => null,
                'contact_number' => '09123456789',
                'username' => 'adminuser',
                'block' => '1',
                'lot' => '1',
                'steet' => 'Main Street',
                'dubdivision' => 'Central Subdivision',
                'baranggy' => 'Barangay Uno',
                'city' => 'Cityville',
                'province' => 'Province A',
                'email' => 'margeiremulta@gmail.com',
                'password' => Hash::make('password'),
                'role_id' => 1,
            ],
            [
                'first_name' => 'Lyra',
                'last_name' => 'Baculi',
                'middle_name' => null,
                'contact_number' => '09123456789',
                'username' => 'adminuser',
                'block' => '1',
                'lot' => '1',
                'steet' => 'Main Street',
                'dubdivision' => 'Central Subdivision',
                'baranggy' => 'Barangay Uno',
                'city' => 'Cityville',
                'province' => 'Province A',
                'email' => 'lyrabaculi6@gmail.com',
                'password' => Hash::make('password'),
                'role_id' => 1,
            ],
            [
                'first_name' => 'User',
                'last_name' => 'User',
                'middle_name' => null,
                'contact_number' => '09998887777',
                'username' => 'regularuser',
                'block' => '2',
                'lot' => '4',
                'steet' => 'Second Street',
                'dubdivision' => 'West Subdivision',
                'baranggy' => 'Barangay Dos',
                'city' => 'Townsville',
                'province' => 'Province B',
                'email' => 'user@email.com',
                'password' => Hash::make('password'),
                'role_id' => 2,
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
