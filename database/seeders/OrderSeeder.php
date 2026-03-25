<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tutor = \App\Models\User::where('role', 'tutor')->first();

        if ($tutor) {
            \App\Models\StoreProduct::create([
                'tutor_id' => $tutor->id,
                'title' => 'Fintech Web Template',
                'description' => 'A fully functional web template for fintech startups.',
                'price' => 15000,
                'file_path' => 'products/sample.zip',
            ]);

            \App\Models\StoreProduct::create([
                'tutor_id' => $tutor->id,
                'title' => 'Laravel Advanced Notes',
                'description' => 'Complete handwritten notes for Laravel 11.',
                'price' => 2500,
                'file_path' => 'products/notes.pdf',
            ]);
        }
    }
}
