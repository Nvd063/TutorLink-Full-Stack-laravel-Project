<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $list = [

            // Core Academic
            'Mathematics',
            'Physics',
            'Chemistry',
            'Biology',
            'English',
            'Urdu',
            'Islamiat',
            'Pakistan Studies',
            'Statistics',
            'Economics',

            // Computer Science Basics
            'Computer Science',
            'Programming Fundamentals',
            'Object Oriented Programming',
            'Data Structures',
            'Algorithms',
            'Database Systems',
            'Operating Systems',
            'Software Engineering',
            'Computer Architecture',
            'Theory of Automata',

            // Web Development
            'HTML',
            'CSS',
            'JavaScript',
            'PHP',
            'Laravel',
            'Node.js',
            'Express.js',
            'React',
            'Next.js',
            'Vue.js',
            'Bootstrap',
            'Tailwind CSS',
            'REST API Development',
            'GraphQL',
            'Web Security',

            // Mobile Development
            'Android Development',
            'Java (Android)',
            'Kotlin',
            'Flutter',
            'React Native',
            'iOS Development',
            'Swift',

            // Backend / Advanced
            'Microservices Architecture',
            'System Design',
            'API Development',
            'Authentication & Authorization',
            'JWT',
            'OAuth',

            // Databases
            'MySQL',
            'PostgreSQL',
            'MongoDB',
            'Firebase',
            'Redis',
            'Database Design',
            'SQL Advanced',

            // DevOps / Tools
            'Git & GitHub',
            'Docker',
            'Kubernetes',
            'CI/CD',
            'Linux',
            'Shell Scripting',
            'Nginx',
            'Apache',

            // Networking
            'Computer Networks',
            'Network Security',
            'CCNA',
            'CCNP',
            'Routing & Switching',
            'Wireless Networking',
            'Cyber Security',
            'Ethical Hacking',
            'Firewalls',
            'VPN',
            'Cloud Networking',

            // Cloud
            'AWS',
            'Microsoft Azure',
            'Google Cloud Platform',
            'Cloud Computing',
            'Serverless Architecture',

            // AI / Data Science
            'Artificial Intelligence',
            'Machine Learning',
            'Deep Learning',
            'Data Science',
            'Data Analysis',
            'Python for Data Science',
            'TensorFlow',
            'PyTorch',
            'Natural Language Processing',
            'Computer Vision',

            // Programming Languages
            'C',
            'C++',
            'Java',
            'Python',
            'C#',
            '.NET',
            'Go',
            'Rust',
            'TypeScript',
            'Dart',

            // Software Tools
            'Visual Studio Code',
            'Android Studio',
            'IntelliJ IDEA',
            'Postman',
            'Figma',
            'Adobe XD',

            // Graphic / Design
            'Graphic Design',
            'UI/UX Design',
            'Adobe Photoshop',
            'Adobe Illustrator',
            'Canva',
            'Branding',
            'Logo Design',

            // Business / Freelancing
            'Digital Marketing',
            'SEO',
            'Content Writing',
            'Freelancing',
            'E-commerce',
            'Shopify',
            'WordPress',

            // Game Development
            'Unity',
            'Unreal Engine',
            'Game Design',
            '2D Game Development',
            '3D Game Development',

            // Misc / Emerging
            'Blockchain',
            'Web3',
            'Cryptocurrency',
            'AR/VR Development',
            'Internet of Things (IoT)',
            'Embedded Systems'

        ];

        foreach ($list as $name) {
            \App\Models\Subject::create(['name' => $name]);
        }
    }
}
