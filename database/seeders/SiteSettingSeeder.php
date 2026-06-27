<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\SiteSetting;

class SiteSettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            ['key' => 'site_title', 'value' => 'Jass | Portfolio'],
            ['key' => 'site_description', 'value' => 'Portfolio website of Jass, an AI & Web Developer.'],
            ['key' => 'hero_title', 'value' => 'Hello, I am Jass.'],
            ['key' => 'hero_subtitle', 'value' => 'AI & Web Developer'],
            ['key' => 'about_text', 'value' => 'I am a passionate AI enthusiast, Web Developer, and Software Engineer focused on building robust, scalable applications and exploring machine learning.'],
            ['key' => 'email', 'value' => 'admin@jass.com'],
            ['key' => 'phone', 'value' => '+62 812 3456 7890'],
            ['key' => 'location', 'value' => 'Indonesia'],
        ];

        foreach ($settings as $setting) {
            SiteSetting::updateOrCreate(['key' => $setting['key']], $setting);
        }
    }
}
