<?php

namespace Database\Seeders;

use App\Models\Enquiry;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EnquirySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Enquiry::truncate();
        Enquiry::create(
            [
                'name' => 'Juan Dela Cruz',
                'email' => 'juan.delacruz@example.com',
                'message' => 'I would like to know more about your services. Please provide more details.'
            ]
        );
        Enquiry::create(
            [
                'name' => 'Maria Santos',
                'email' => 'maria.santos@example.com',
                'message' => 'How can I volunteer for your organization?'
            ]
        );
        Enquiry::create(
            [
                'name' => 'Carlos Reyes',
                'email' => 'carlos.reyes@example.com',
                'message' => 'Do you offer assistance programs for senior citizens?'
            ]
        );
    }
}
