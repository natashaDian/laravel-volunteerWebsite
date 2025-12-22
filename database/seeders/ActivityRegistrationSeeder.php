<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Activity;
use App\Models\ActivityRegistration;
use Illuminate\Support\Str;

class ActivityRegistrationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::pluck('id');
        $activities = Activity::pluck('id');

        if ($users->isEmpty() || $activities->isEmpty()) {
            $this->command->warn('Users atau Activities kosong!'); #catch error
            return;
        }

        foreach ($users as $userId) {
            // tiap user daftar 1–3 activity
            $randomActivities = $activities->random(rand(1, 3));

            foreach ($randomActivities as $activityId) {
                ActivityRegistration::create([
                    'user_id' => $userId,
                    'activity_id' => $activityId,
                    'motivation' => 'Saya ingin berkontribusi dalam kegiatan ini.',
                    'status' => 'pending',
                    'confirmation_code' => strtoupper(Str::random(8)),
                ]);
            }
        }   
    }
}