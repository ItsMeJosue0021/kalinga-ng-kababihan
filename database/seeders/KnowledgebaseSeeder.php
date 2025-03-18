<?php

namespace Database\Seeders;

use App\Models\Knowledgebase;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KnowledgebaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Knowledgebase::truncate();
        Knowledgebase::create([
            'title' => 'Organization Information',
            'content' => 'B4 LOT6-6 FANTACY ROAD 3 TERESA PARK SUBD. PILAR LAS PINAS CITY'
        ]);
        Knowledgebase::create([
            'title' => 'What We Are',
            'content' => 'Kalinga ng Kababaihan, A self-sustaining non-governmental organization that aims to promote a sense of community and cooperation among like-minded and self-sufficiency-seeking individuals to contribute to the betterment of society.'
        ]);
        Knowledgebase::create([
            'title' => 'Vision',
            'content' => 'Empowered and united women through volunteerism towards community resiliency and development.'
        ]);
        Knowledgebase::create([
            'title' => 'Mission',
            'content' => 'To promote and strengthen the physical and social well-being of children and senior members of the community, through nutrition programs, responding to emergencies and calamities.'
        ]);
    }
}
