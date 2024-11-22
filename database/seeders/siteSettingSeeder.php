<?php

namespace Database\Seeders;

use App\Models\siteSetting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class siteSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $setting = [
            [
                'phone' => '893627293',
                'email' => 'example@gmail.com',
                'address' => 'amar street kolkata-00012',
                'facebook' => 'https://www.facebook.com/',
                'twitter' => 'https://x.com/',
                'instagram' => 'https://www.instagram.com/',
                'youtube' => 'https://www.youtube.com/',
                'logo' => 'logo.png',
                'banner' => 'banner.png',
            ]
        ]; 
        
        siteSetting::insert($setting);
    }
}
