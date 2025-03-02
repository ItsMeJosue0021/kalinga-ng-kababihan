<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EmergencyContact;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EmergencyContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        EmergencyContact::truncate();

        EmergencyContact::create([
            'member_id' => 1,
            'contact_person' => 'Anna Doe',
            'address' => '123 Main St, Anytown, USA',
            'contact_number' => '123-456-7890',
            'fb_messenger_account' => 'anna.doe',
            'relationship' => 'Sister'
        ]);

        EmergencyContact::create([
            'member_id' => 2,
            'contact_person' => 'Paul Smith',
            'address' => '456 Elm St, Othertown, USA',
            'contact_number' => '234-567-8901',
            'fb_messenger_account' => 'paul.smith',
            'relationship' => 'Husband'
        ]);

        EmergencyContact::create([
            'member_id' => 3,
            'contact_person' => 'Emily Johnson',
            'address' => '789 Oak St, Thistown, USA',
            'contact_number' => '345-678-9012',
            'fb_messenger_account' => 'emily.johnson',
            'relationship' => 'Mother'
        ]);

        EmergencyContact::create([
            'member_id' => 4,
            'contact_person' => 'James Williams',
            'address' => '321 Pine St, Thatown, USA',
            'contact_number' => '456-789-0123',
            'fb_messenger_account' => 'james.williams',
            'relationship' => 'Brother'
        ]);

        EmergencyContact::create([
            'member_id' => 5,
            'contact_person' => 'Lucy Brown',
            'address' => '654 Maple St, Hometown, USA',
            'contact_number' => '567-890-1234',
            'fb_messenger_account' => 'lucy.brown',
            'relationship' => 'Sister'
        ]);
    }
}
