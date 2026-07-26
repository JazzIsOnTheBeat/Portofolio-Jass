<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Skill;
use App\Models\Experience;
use App\Models\Education;
use App\Models\Project;
use Illuminate\Support\Str;

class DemoDataSeeder extends Seeder
{
    public function run(): void
    {
        // Categories
        $backend = Category::updateOrCreate(['slug' => 'backend'], ['name' => 'Backend', 'sort_order' => 1]);
        $frontend = Category::updateOrCreate(['slug' => 'frontend'], ['name' => 'Frontend', 'sort_order' => 2]);
        $aiml = Category::updateOrCreate(['slug' => 'ai-ml'], ['name' => 'AI/ML', 'sort_order' => 3]);

        // Skills
        $skills = [
            ['name' => 'Laravel', 'category_id' => $backend->id, 'proficiency' => 90],
            ['name' => 'Python', 'category_id' => $aiml->id, 'proficiency' => 85],
            ['name' => 'TailwindCSS', 'category_id' => $frontend->id, 'proficiency' => 95],
            ['name' => 'Vue.js', 'category_id' => $frontend->id, 'proficiency' => 80],
            ['name' => 'PyTorch', 'category_id' => $aiml->id, 'proficiency' => 70],
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
