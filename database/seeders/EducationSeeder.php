<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Education;

class EducationSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Pendidikan Tinggi (Kuliah)
        Education::create([
            'institution' => 'Telkom University',
            'degree' => 'D3 Sistem Informasi',
            'period' => '2024 - Sekarang',
            'description' => 'Mempelajari dasar-dasar pengembangan sistem informasi, UI/UX design, manajemen basis data (MySQL), pemrograman web (PHP/Laravel), serta pengembangan solusi digital tingkat dasar.'
        ]);

        // 2. Pendidikan Menengah Atas (SMA)
        Education::create([
            'institution' => 'SMAN 4 Karawang',
            'degree' => 'Matematika dan Ilmu Pengetahuan Alam',
            'period' => '2021 - 2024',
            'description' => 'Fokus pada peminatan sains dan matematika. Aktif memimpin organisasi kesiswaan ekstrarkurikuler dan kepanitiaan seminar sekolah.'
        ]);
    }
}