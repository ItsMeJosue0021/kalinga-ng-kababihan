<?php

namespace Database\Seeders;

use App\Models\Tag;
use App\Models\Project;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projects = [
            [
                'title' => 'Gabay at Ginhawa: Women’s Health Fair',
                'date' => '2025-03-08',
                'location' => 'Barangay Malusak, Sta. Rosa, Laguna',
                'description' => 'The Women’s Health Fair aims to provide accessible healthcare services to mothers, grandmothers, and young women in underprivileged communities. The event offers free medical consultations, breast and cervical cancer screenings, mental health checkups, and health education seminars. Local doctors, nurses, and volunteer health workers collaborate to address the unique health needs of women. Informational booths and wellness corners offer guidance on nutrition, reproductive health, and self-care practices. By bringing these services directly to the barangay, the project encourages early diagnosis and proactive care, ultimately improving the overall wellbeing of women who often place their own health last.',
                'tags' => ['health', 'wellness', 'women empowerment'],
                'image' => 'health_fair.jpg',
            ],
            [
                'title' => 'Tahanan para kay Nanay',
                'date' => '2025-02-14',
                'location' => 'Trece Martires, Cavite',
                'description' => 'Tahanan para kay Nanay is a shelter improvement initiative focused on providing safe and decent homes for single mothers, elderly women, and female-headed households living in poor housing conditions. Volunteers and partner organizations assist in repairing leaking roofs, replacing unstable walls, and improving basic sanitation. The program also provides essential furniture, kitchenware, and mattresses to ensure comfort and dignity. This project not only restores physical homes but also uplifts the emotional and mental wellbeing of women who have endured years of hardship. Through this initiative, the community expresses love and care for those who have always cared for others.',
                'tags' => ['housing', 'support', 'community'],
                'image' => 'home_repair.jpg',
            ],
            [
                'title' => 'Likha ni Inay: Livelihood Training for Mothers',
                'date' => '2025-01-20',
                'location' => 'San Pablo City, Laguna',
                'description' => 'Likha ni Inay is a community-based livelihood training project designed to empower mothers and homemakers with practical income-generating skills. The three-week program includes sessions on sewing reusable bags, making natural soaps and candles, and basic online marketing. Participants are given starter kits and mentoring support to jumpstart their own small businesses from home. The training not only helps mothers financially but also builds confidence, self-worth, and resilience. The program encourages creativity and entrepreneurship while fostering solidarity among women striving to improve their family’s quality of life through honest and sustainable means.',
                'tags' => ['livelihood', 'training', 'entrepreneurship'],
                'image' => 'livelihood.jpg',
            ],
            [
                'title' => 'Batang Matibay, Nanay Gabay',
                'date' => '2025-04-01',
                'location' => 'Imus, Cavite',
                'description' => 'Batang Matibay, Nanay Gabay is a health and nutrition program aimed at supporting mothers of undernourished and at-risk children. The project includes nutrition seminars, meal planning workshops, and feeding sessions using locally available and affordable ingredients. Pediatricians and nutritionists provide personalized advice to ensure childrens growth and development. Mothers are taught how to prepare nutritious meals on a tight budget, understand food labels, and spot signs of nutrient deficiency. This initiative strengthens the mother’s role as a health advocate in her home, ensuring that children grow strong, healthy, and well-nurtured.',
                'tags' => ['nutrition', 'motherhood', 'childcare'],
                'image' => 'nutrition_program.jpg',
            ],
            [
                'title' => 'Lakbay Aral para kay Nanay',
                'date' => '2025-05-10',
                'location' => 'Dasmariñas, Cavite',
                'description' => 'Lakbay Aral para kay Nanay is an educational field trip specially organized for mothers from marginalized communities. Participants are taken to visit women-led cooperatives, social enterprises, and successful livelihood projects. The goal is to inspire them with real-life stories of empowerment and perseverance. The tour includes workshops, Q&A sessions, and exposure to sustainable farming, handicrafts, and microenterprises. It provides firsthand learning, networking opportunities, and a chance to dream bigger. This experience allows mothers to envision new possibilities and build aspirations not only for themselves but also for the next generation.',
                'tags' => ['education', 'empowerment', 'fieldtrip'],
                'image' => 'exposure_trip.jpg',
            ],
            [
                'title' => 'Puso’t Pananampalataya: Women’s Retreat',
                'date' => '2025-03-01',
                'location' => 'Tagaytay City',
                'description' => 'Puso’t Pananampalataya is a spiritual retreat crafted for women survivors of abuse and trauma. Over a weekend, participants engage in guided prayer sessions, healing circles, art therapy, and nature reflection. Professional counselors and spiritual leaders accompany them on this journey of inner healing. The peaceful atmosphere and supportive environment allow women to rediscover their strength, worth, and purpose. Activities are designed to help them process their pain and restore hope. The retreat is not just a break from stress—it is a renewal of spirit, reminding women that they are loved, valued, and never alone.',
                'tags' => ['retreat', 'healing', 'faith'],
                'image' => 'womens_retreat.jpg',
            ],
            [
                'title' => 'Tindig Babae: Legal Aid Caravan',
                'date' => '2025-06-05',
                'location' => 'General Trias, Cavite',
                'description' => 'Tindig Babae is a mobile legal aid caravan dedicated to providing free legal consultations and know-your-rights seminars for women. Target beneficiaries include those experiencing domestic violence, workplace discrimination, or child custody issues. Volunteer lawyers and paralegals assist in explaining laws, preparing affidavits, and giving advice on available remedies. Information materials are also distributed in local dialects to ensure accessibility. By bringing legal services directly to barangays, the program aims to empower women with the knowledge and confidence to stand up for their rights and seek justice. It also creates safe spaces where women feel heard and protected.',
                'tags' => ['legal aid', 'rights', 'protection'],
                'image' => 'legal_aid.jpg',
            ],
            [
                'title' => 'Sinag ng Pag-asa: Mental Health Day for Women',
                'date' => '2025-07-12',
                'location' => 'Biñan, Laguna',
                'description' => 'Sinag ng Pag-asa is a mental health awareness event focusing on the emotional and psychological wellbeing of women. It features talks from psychologists, peer-sharing sessions, and mindfulness workshops. Women are encouraged to speak about their experiences with stress, anxiety, burnout, and trauma. The event includes free mental health screenings and one-on-one consultations. Interactive booths offer tips on coping strategies, breathing exercises, journaling, and affirmations. The event fosters a culture where women can openly prioritize their mental health without shame. It aims to replace stigma with support, and fear with healing.',
                'tags' => ['mental health', 'wellbeing', 'awareness'],
                'image' => 'mental_health_day.jpg',
            ],
            [
                'title' => 'Aklat para kay Inay',
                'date' => '2025-08-15',
                'location' => 'Rosario, Cavite',
                'description' => 'Aklat para kay Inay is a literacy enhancement program for mothers who wish to support their children’s education while improving their own reading and writing skills. Held in barangay reading centers, the program includes storytelling sessions, guided reading, basic writing, and comprehension activities. It also trains mothers on how to read with their children at home. Books and learning materials are provided for free. This project recognizes the vital role of mothers as first teachers and seeks to nurture a love for learning within the family. Literacy empowers women to engage confidently in their communities and daily lives.',
                'tags' => ['literacy', 'education', 'parenting'],
                'image' => 'reading_program.jpg',
            ],
            [
                'title' => 'Babaeng Bida sa Barangay',
                'date' => '2025-09-01',
                'location' => 'Carmona, Cavite',
                'description' => 'Babaeng Bida sa Barangay is a leadership development program for women serving as barangay officials, SK leaders, and community volunteers. It consists of training sessions on governance, gender-sensitive policies, disaster response, and budgeting. Women are also taught public speaking, conflict resolution, and decision-making. The program encourages active participation in local development and aims to break gender stereotypes in leadership. By investing in their growth, we empower women to lead with compassion, courage, and integrity. The program recognizes women not just as supporters—but as transformative leaders of their communities.',
                'tags' => ['leadership', 'barangay', 'training'],
                'image' => 'leadership_training.jpg',
            ],
        ];

        foreach ($projects as $data) {
            $project = Project::create([
                'title' => $data['title'],
                'date' => $data['date'],
                'location' => $data['location'],
                'description' => $data['description'],
                'tags' => implode(',', $data['tags']),
                'image' => $data['image'],
            ]);

            foreach ($data['tags'] as $tagText) {
                Tag::create([
                    'text' => $tagText,
                    'project_id' => $project->id,
                ]);
            }
        }
    }
}
