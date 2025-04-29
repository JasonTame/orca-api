<?php

namespace Database\Seeders;

use App\Models\TechSkill;
use Illuminate\Database\Seeder;
use App\Enums\TechSkillCategory;

class TechSkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Programming Languages
        $languages = [
            'PHP',
            'JavaScript',
            'Python',
            'Java',
            'C#',
            'Ruby',
            'Go',
            'Rust',
            'TypeScript',
            'Swift',
            'Kotlin',
            'Scala',
            'R',
            'C++',
            'C',
        ];

        foreach ($languages as $language) {
            TechSkill::create([
                'name' => $language,
                'category' => TechSkillCategory::LANGUAGE,
                'is_language' => true,
                'is_framework' => false,
                'is_tool' => false,
            ]);
        }

        // Web Frameworks
        $frameworks = [
            'Laravel',
            'React',
            'Vue.js',
            'Angular',
            'Django',
            'Spring Boot',
            'Express.js',
            'Ruby on Rails',
            'ASP.NET',
            'Flask',
        ];

        foreach ($frameworks as $framework) {
            TechSkill::create([
                'name' => $framework,
                'category' => TechSkillCategory::FRAMEWORK,
                'is_language' => false,
                'is_framework' => true,
                'is_tool' => false,
            ]);
        }

        // Databases
        $databases = [
            'MySQL',
            'PostgreSQL',
            'MongoDB',
            'Redis',
            'SQLite',
            'Oracle',
            'Microsoft SQL Server',
            'Cassandra',
            'Elasticsearch',
        ];

        foreach ($databases as $database) {
            TechSkill::create([
                'name' => $database,
                'category' => TechSkillCategory::DATABASE,
                'is_language' => false,
                'is_framework' => false,
                'is_tool' => false,
            ]);
        }

        // Development Tools
        $tools = [
            'Git',
            'Docker',
            'Kubernetes',
            'Jenkins',
            'Terraform',
            'Ansible',
            'Apache',
        ];

        foreach ($tools as $tool) {
            TechSkill::create([
                'name' => $tool,
                'category' => TechSkillCategory::TOOL,
                'is_language' => false,
                'is_framework' => false,
                'is_tool' => true,
            ]);
        }

        // Platforms
        $platforms = [
            'Linux',
            'Windows',
            'macOS',
            'Android',
            'iOS',
            'AWS',
            'Azure',
            'GCP',
            'Heroku',
            'DigitalOcean',
        ];

        foreach ($platforms as $platform) {
            TechSkill::create([
                'name' => $platform,
                'category' => TechSkillCategory::PLATFORM,
                'is_language' => false,
                'is_framework' => false,
                'is_tool' => false,
            ]);
        }
    }
}
