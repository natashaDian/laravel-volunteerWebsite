<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Activity;

class ActivitySeeder extends Seeder
{
    public function run(): void
    {
        $companyCodes = ['COO1', 'COO2', 'COO3', 'COO4', 'COO5'];

        $activities = [
            [
                'title' => 'Community Beach Cleanup Drive',
                'description' => 'Join volunteers to clean the shoreline, sort waste for recycling, and run awareness activities about marine conservation.',
                'start_date' => '2025-07-05',
                'end_date' => '2025-07-05',
                'category' => 'Lingkungan',
                'location' => 'Pantai Indah',
            ],
            [
                'title' => 'After-School Tutoring for Underprivileged Kids',
                'description' => 'Volunteer tutors needed to help children with basic literacy, numeracy, and study skills in after-school sessions.',
                'start_date' => '2025-08-01',
                'end_date' => '2025-08-30',
                'category' => 'Pendidikan',
                'location' => 'Pusat Komunitas Utama',
            ],
            [
                'title' => 'Senior Care Visit & Conversation',
                'description' => 'Spend time with seniors in the community home: conversation, light activities, and companionship for elderly residents.',
                'start_date' => '2025-09-10',
                'end_date' => '2025-09-10',
                'category' => 'Kesejahteraan Sosial',
                'location' => 'Panti Wredha Harapan',
            ],
            [
                'title' => 'Urban Tree Planting Weekend',
                'description' => 'Help plant native trees in urban parks, assist with tree guards, and learn about urban reforestation benefits.',
                'start_date' => '2025-10-18',
                'end_date' => '2025-10-19',
                'category' => 'Lingkungan',
                'location' => 'Taman Kota',
            ],
            [
                'title' => 'Mobile Health Clinic Support',
                'description' => 'Assist medical teams by helping with patient registration, crowd guidance, and basic logistics at the mobile clinic.',
                'start_date' => '2025-11-02',
                'end_date' => '2025-11-02',
                'category' => 'Kesehatan',
                'location' => 'Lapangan Serbaguna',
            ],
            [
                'title' => 'Literacy Campaign: Book Donation & Reading',
                'description' => 'Collect and distribute books to community libraries; volunteers will also read aloud in children sessions.',
                'start_date' => '2025-12-01',
                'end_date' => '2025-12-03',
                'category' => 'Pendidikan',
                'location' => 'Perpustakaan Sekitar',
            ],
            [
                'title' => 'Youth Leadership Workshop Facilitation',
                'description' => 'Facilitators needed to run soft-skill workshops for youth: public speaking, teamwork, and project planning.',
                'start_date' => '2025-12-10',
                'end_date' => '2025-12-11',
                'category' => 'Pengembangan Anak Muda',
                'location' => 'Aula Serbaguna',
            ],
            [
                'title' => 'Food Drive & Distribution for Families in Need',
                'description' => 'Organize, pack, and distribute food parcels to vulnerable families in the neighborhood.',
                'start_date' => '2025-12-20',
                'end_date' => '2025-12-20',
                'category' => 'Kesejahteraan Sosial',
                'location' => 'Gereja & Pusat Komunitas',
            ],
            [
                'title' => 'Disaster Preparedness Community Training',
                'description' => 'Volunteer trainers to teach disaster preparedness, basic first aid, and evacuation planning to local communities.',
                'start_date' => '2026-01-15',
                'end_date' => '2026-01-16',
                'category' => 'Kesiapsiagaan',
                'location' => 'Balai Desa',
            ],
            [
                'title' => 'Recycling Workshop for Schools',
                'description' => 'Hands-on workshop teaching students how to recycle and upcycle waste into useful items.',
                'start_date' => '2026-02-05',
                'end_date' => '2026-02-05',
                'category' => 'Lingkungan',
                'location' => 'Sekolah Dasar Negeri 3',
            ],
            [
                'title' => 'Community Mural Painting Project',
                'description' => 'Artists and helpers collaborate with youth to paint murals that reflect community identity and hope.',
                'start_date' => '2026-03-10',
                'end_date' => '2026-03-12',
                'category' => 'Seni dan Budaya',
                'location' => 'Gang Seni',
            ],
            [
                'title' => 'Skills Bootcamp: Basic Computer for Jobseekers',
                'description' => 'Teach essential computer and internet skills to jobseekers to improve employment opportunities.',
                'start_date' => '2026-03-25',
                'end_date' => '2026-03-27',
                'category' => 'Pengembangan Anak Muda',
                'location' => 'Kantor Komunitas',
            ],
            [
                'title' => 'Community Health Awareness Campaign',
                'description' => 'Volunteers help run booths, distribute flyers, and educate about hygiene, nutrition, and prevention.',
                'start_date' => '2026-04-07',
                'end_date' => '2026-04-07',
                'category' => 'Kesehatan',
                'location' => 'Alun-alun Kota',
            ],
            [
                'title' => 'Accessible Playground Build',
                'description' => 'Join a team to build inclusive playground features for children with disabilities.',
                'start_date' => '2026-04-20',
                'end_date' => '2026-04-22',
                'category' => 'Kesejahteraan Sosial',
                'location' => 'Taman Anak',
            ],
            [
                'title' => 'Coastal Wildlife Monitoring Patrol',
                'description' => 'Assist environmentalists in simple monitoring tasks to track coastal wildlife and plastic hotspots.',
                'start_date' => '2026-05-05',
                'end_date' => '2026-05-06',
                'category' => 'Lingkungan',
                'location' => 'Pesisir Selatan',
            ],
            [
                'title' => 'Career Mentoring for High School Seniors',
                'description' => 'Mentors provide guidance on higher education, vocational routes, and job application tips.',
                'start_date' => '2026-05-20',
                'end_date' => '2026-05-20',
                'category' => 'Pendidikan',
                'location' => 'SMAN 1',
            ],
            [
                'title' => 'Community Sports Day & Volunteer Marshals',
                'description' => 'Organize community sports activities; volunteers act as marshals, referees, and coordinators.',
                'start_date' => '2026-06-08',
                'end_date' => '2026-06-08',
                'category' => 'Kegiatan Komunitas',
                'location' => 'Lapangan Bola',
            ],
            [
                'title' => 'Neighborhood Home Repairs for Elderly',
                'description' => 'Volunteer builders help with small home repairs and safety improvements for elderly residents.',
                'start_date' => '2026-06-18',
                'end_date' => '2026-06-19',
                'category' => 'Kesejahteraan Sosial',
                'location' => 'Komunitas RW 07',
            ],
            [
                'title' => 'Youth Environmental Film Screening',
                'description' => 'Screen films about environment and sustainability followed by discussion sessions led by volunteers.',
                'start_date' => '2026-07-02',
                'end_date' => '2026-07-02',
                'category' => 'Seni dan Budaya',
                'location' => 'Gedung Serba Guna',
            ],
            [
                'title' => 'Skills Exchange: Sewing & Crafting for Income',
                'description' => 'Train community members in sewing and crafting to help generate small-scale income opportunities.',
                'start_date' => '2026-07-15',
                'end_date' => '2026-07-17',
                'category' => 'Pengembangan Komunitas',
                'location' => 'Ruang Kegiatan Lokal',
            ],
        ];

        foreach ($activities as $act) {
            // ambil kata pertama dari title
            $firstWord = explode(' ', trim($act['title']))[0] ?? 'default';

            // sanitize: hanya huruf/angka/dash, lowercase
            $cleanFirst = preg_replace('/[^a-z0-9\-]/', '', strtolower($firstWord));

            // bentuk image_url
            $imageUrl = 'img/' . ($cleanFirst ?: 'default') . '.jpg';

            Activity::create([
                'title' => $act['title'],
                'description' => $act['description'],
                'image_url' => $imageUrl,
                'start_date' => $act['start_date'],
                'end_date' => $act['end_date'],
                'category' => $act['category'],
                'location' => $act['location'] ?? null,
                // company_code random dari COO1..COO5
                'company_code' => $companyCodes[array_rand($companyCodes)],
            ]);
        }
    }
}
