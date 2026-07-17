<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Experience;

class ExperienceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    Experience::create([
        'position' => 'Fullstack Developer Intern',
        'institution' => 'Bandung Techno Park',
        'period' => 'Juli 2026 - April 2027',
        'description' => 'Membangun aplikasi landing page portofolio interaktif menggunakan Laravel dan Livewire.'
    ]);
}
}
