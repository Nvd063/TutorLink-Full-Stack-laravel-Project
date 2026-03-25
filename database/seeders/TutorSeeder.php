<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\TutorProfile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class TutorSeeder extends Seeder
{
    public function run(): void
    {
        $subjects = ['Mathematics', 'Physics', 'Chemistry', 'Computer Science', 'Laravel', 'React', 'Node.js', 
                     'English', 'Biology', 'C++', 'Java', 'Python', 'PHP', 'Data Science', 'Accounting'];

        $cities = ['Lahore', 'Karachi', 'Islamabad', 'Faisalabad', 'Multan', 'Rawalpindi', 'Peshawar', 'Quetta'];

        $titles = [
            'Senior Lecturer', 'PhD Scholar', 'Professional Tutor', 'Subject Specialist',
            'Software Engineer & Mentor', 'Mathematics Expert', 'Physics Professor',
            'Full Stack Developer', 'IELTS Trainer', 'O-Level / A-Level Tutor'
        ];

        for ($i = 1; $i <= 20; $i++) {
            
            // 1. Create Tutor User
            $tutor = User::create([
                'name'      => fake()->name() . " Sir",
                'email'     => "tutor{$i}@example.com",
                'password'  => Hash::make('password'),
                'role'      => 'tutor',
                'is_verified' => true,           // Seeders mein mostly verified rakhna acha hota hai
            ]);

            // Random expertise (2 to 5 subjects)
            $expertiseCount = rand(2, 5);
            $expertiseList = collect($subjects)->random($expertiseCount)->implode(', ');

            // Random realistic bio
            $bio = "Hello! I am a passionate educator with over " . rand(3, 12) . " years of experience in teaching " . 
                   $expertiseList . ". My teaching style focuses on conceptual clarity and practical understanding.";

            // 2. Create Tutor Profile
            TutorProfile::create([
                'user_id'            => $tutor->id,
                'title'              => $titles[array_rand($titles)],
                'bio'                => $bio,
                'expertise'          => $expertiseList,
                'location'           => $cities[array_rand($cities)],
                'experience'         => rand(1, 10),
                'hourly_rate'        => rand(10, 50),           // Pakistani Rupees mein realistic rate
                'profile_image'      => 'tutor-profiles/tutor-' . $i . '.jpg',   // fake image path
                'degree_certificate' => 'certificates/degree-' . $i . '.pdf',
                'cv_resume'          => 'resumes/cv-' . $i . '.pdf',
            ]);

            // Optional: Agar real dummy images daalna chahte ho toh yeh uncomment kar sakte ho
            // Storage::disk('public')->put('tutor-profiles/tutor-' . $i . '.jpg', file_get_contents(public_path('dummy/tutor.jpg')));
        }

        $this->command->info('✅ 20 Tutors seeded successfully with complete profiles!');
        $this->command->info('   → Verified tutors with realistic data, expertise, location, documents etc.');
    }
}