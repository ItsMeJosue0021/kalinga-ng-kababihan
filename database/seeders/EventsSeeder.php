<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EventsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('events')->insert([
            [
                'title' => 'Women\'s Health and Wellness Seminar',
                'description' => 'A day-long seminar focused on educating women about reproductive health, mental wellness, and proper nutrition.',
                'location' => 'Barangay Hall, San Isidro',
                'date' => '2025-06-10',
                'image' => 'health_wellness.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Livelihood Skills Training: Soap and Candle Making',
                'description' => 'Hands-on training session aimed at teaching women to create homemade soaps and candles as a potential source of income.',
                'location' => 'Mambog Multipurpose Center',
                'date' => '2025-07-05',
                'image' => 'skills_training.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Legal Rights and Women’s Empowerment Forum',
                'description' => 'A forum with lawyers and advocates discussing women’s legal rights, domestic abuse, and community resources.',
                'location' => 'Municipal Covered Court',
                'date' => '2025-08-15',
                'image' => 'legal_forum.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Free Medical Check-up for Women',
                'description' => 'Free general medical consultation, breast exam, and pap smear for women in the community.',
                'location' => 'Barangay Health Center',
                'date' => '2025-09-01',
                'image' => 'medical_checkup.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Women’s Day Celebration and Recognition',
                'description' => 'A community celebration honoring women who have made a positive impact in their families and communities.',
                'location' => 'Town Plaza',
                'date' => '2025-03-08',
                'image' => 'womens_day.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
