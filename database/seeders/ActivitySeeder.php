<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Activity;

class ActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Menambahkan data aktivitas
        Activity::create([
            'title' => 'OKL Street Library Cornerstone Adventure',
            'description' => 'Special edition: Christmas Jingle Bell with Coastal Kids. Join us for a fun reading adventure and interactive activities with coastal children.',
            'image_url' => 'path-to-image.jpg',
            'start_date' => '2025-12-23',
            'end_date' => '2025-12-27',
            'category' => 'Seni dan Budaya',
        ]);

        Activity::create([
            'title' => 'Needed! Volunteers for 10Billion.org Event',
            'description' => 'Volunteer to help with a social event focusing on development and youth empowerment. Support the 10Billion.org initiative.',
            'image_url' => 'path-to-image2.jpg',
            'start_date' => '2025-12-14',
            'end_date' => '2025-12-14',
            'category' => 'Pengembangan Anak Muda',
        ]);

        Activity::create([
            'title' => 'Open Recruitment Volunteer IAR Mengajar Batch 6',
            'description' => 'We are looking for volunteers to teach in underserved areas. Help us empower the next generation through education.',
            'image_url' => 'path-to-image3.jpg',
            'start_date' => '2026-01-01',
            'end_date' => '2026-06-30',
            'category' => 'Pendidikan',
        ]);

        Activity::create([
            'title' => 'Festival Seni dan Budaya untuk Anak-Anak',
            'description' => 'A festival celebrating local arts and culture with fun activities for children, from traditional dance performances to craft-making workshops.',
            'image_url' => 'path-to-image4.jpg',
            'start_date' => '2025-07-10',
            'end_date' => '2025-07-15',
            'category' => 'Seni dan Budaya',
        ]);

        Activity::create([
            'title' => 'Pembersihan Sungai dan Penghijauan',
            'description' => 'Join us in a river cleanup and tree planting event to help improve the local environment and raise awareness on sustainable living.',
            'image_url' => 'path-to-image5.jpg',
            'start_date' => '2026-02-20',
            'end_date' => '2026-02-25',
            'category' => 'Lingkungan',
        ]);
    }
}
