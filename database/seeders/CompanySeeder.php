<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Company;

class CompanySeeder extends Seeder
{
    public function run(): void
    {
        $companies = [
            ['code' => 'COO1', 'name' => 'Caring Hands Community'],
            ['code' => 'COO2', 'name' => 'Green Earth Volunteers'],
            ['code' => 'COO3', 'name' => 'Youth Empowerment Hub'],
            ['code' => 'COO4', 'name' => 'Hope Outreach'],
            ['code' => 'COO5', 'name' => 'BrightFuture Volunteers'],
        ];

        foreach ($companies as $c) {
            // buat 1 company per pasangan (email/password/address/phone dari factory)
            Company::factory()->create([
                'company_code' => $c['code'],
                'name' => $c['name'],
            ]);
        }
    }
}
