<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Skill;
use App\Models\Experience;
use App\Models\Education;
use App\Models\Project;
use Illuminate\Support\Str;

class DemoDataSeeder extends Seeder
{
    public function run(): void
    {
        // Skills
        $skills = [
            ['name' => 'Laravel', 'category' => 'Backend', 'proficiency' => 90],
            ['name' => 'Python', 'category' => 'AI/ML', 'proficiency' => 85],
            ['name' => 'TailwindCSS', 'category' => 'Frontend', 'proficiency' => 95],
            ['name' => 'Vue.js', 'category' => 'Frontend', 'proficiency' => 80],
            ['name' => 'PyTorch', 'category' => 'AI/ML', 'proficiency' => 70],
        ];
        foreach ($skills as $skill) { Skill::updateOrCreate(['name' => $skill['name']], $skill); }

        // Education
        Education::updateOrCreate(
            ['degree' => 'Bachelor of Computer Science'],
            [
                'institution' => 'University of Tech',
                'field_of_study' => 'Artificial Intelligence',
                'start_year' => 2023,
                'end_year' => 2027,
                'description' => 'Focusing on Machine Learning and Web Technologies.',
                'sort_order' => 1
            ]
        );

        // Experience
        Experience::updateOrCreate(
            ['title' => 'Web Developer Intern'],
            [
                'company' => 'Tech Startup',
                'description' => 'Developed scalable backend solutions using Laravel.',
                'start_date' => '2024-06-01',
                'end_date' => '2024-09-01',
                'is_current' => false,
                'sort_order' => 1
            ]
        );

        // Project
        Project::updateOrCreate(
            ['title' => 'AI Chatbot'],
            [
                'slug' => Str::slug('AI Chatbot'),
                'description' => 'A smart chatbot built with Python and NLP.',
                'category' => 'AI/ML',
                'is_featured' => true,
                'status' => 'published'
            ]
        );
    }
}
