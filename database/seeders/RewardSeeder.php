<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Reward;

class RewardSeeder extends Seeder
{
    public function run()
    {
        $rewards = [
            [
                'name' => 'Kopi Kenangan – Digital Voucher',
                'description' => 'Digital voucher redeemable at Kopi Kenangan outlets.',
                'required_points' => 10,
                'image_url' => 'img/rewards/kopi-kenangan.png',
            ],
            [
                'name' => 'Fore Coffee – E-Voucher',
                'description' => 'Electronic voucher usable via Fore Coffee app.',
                'required_points' => 60,
                'image_url' => 'img/rewards/fore-coffee.jpg',
            ],
            [
                'name' => 'GoFood Discount Voucher',
                'description' => 'Discount voucher for GoFood orders.',
                'required_points' => 70,
                'image_url' => 'img/rewards/gofood.jpg',
            ],
            [
                'name' => 'Tokopedia Shopping Voucher',
                'description' => 'Shopping voucher redeemable on Tokopedia.',
                'required_points' => 80,
                'image_url' => 'img/rewards/tokopedia.jpg',
            ],
            [
                'name' => 'Canva Pro (1 Month)',
                'description' => 'One-month premium access to Canva Pro.',
                'required_points' => 100,
                'image_url' => 'img/rewards/canva.png',
            ],
            [
                'name' => 'Notion Plus (1 Month)',
                'description' => 'One-month access to Notion Plus features.',
                'required_points' => 110,
                'image_url' => 'img/rewards/notion.png',
            ],
            [
                'name' => 'MySkill Online Workshop Pass',
                'description' => 'Access to selected online workshop by MySkill.',
                'required_points' => 120,
                'image_url' => 'img/rewards/myskill.png',
            ],
            [
                'name' => 'Binar Academy Webinar Access',
                'description' => 'Invitation to career & tech webinar by Binar Academy.',
                'required_points' => 130,
                'image_url' => 'img/rewards/binar.png',
            ],
        ];

        foreach ($rewards as $reward) {
            Reward::create($reward);
        }
    }
}
