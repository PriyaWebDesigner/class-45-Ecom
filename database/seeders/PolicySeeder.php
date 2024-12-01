<?php

namespace Database\Seeders;

use App\Models\Policy;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PolicySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $policy = [
            [
                'privacy_policy' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt sint iste voluptas dolores excepturi eaque reprehenderit veritatis iure eveniet voluptatum?',
                'terms_condition' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt sint iste voluptas dolores excepturi eaque reprehenderit veritatis iure eveniet voluptatum?',
                'refund_policy' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt sint iste voluptas dolores excepturi eaque reprehenderit veritatis iure eveniet voluptatum?',
                'payment_policy' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt sint iste voluptas dolores excepturi eaque reprehenderit veritatis iure eveniet voluptatum?',
                'about_us' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt sint iste voluptas dolores excepturi eaque reprehenderit veritatis iure eveniet voluptatum',
            ]
        ];

        Policy::insert($policy);
    }
}
