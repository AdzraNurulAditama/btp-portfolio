<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        Project::create([
            'name' => 'Safae - Website Baca & Tulis Cerita',
            'description' => 'Mengembangkan website baca dan tulis cerita dengan fitur autentikasi pengguna, upload cerita, manajemen data, serta antarmuka yang modern dan responsif.',
            'link' => 'https://github.com/AdzraNurulAditama/safae', // Sesuaikan jika ada link asli
            'tech_stack' => 'Laravel, PHP, MySQL, HTML, CSS'
        ]);

        Project::create([
            'name' => 'SIPAR - Sistem Pencarian Air Bersih',
            'description' => 'Mendesain prototype aplikasi pencarian air bersih untuk membantu masyarakat menemukan sumber air terdekat dengan membuat user flow, wireframe, dan high-fidelity design.',
            'link' => null,
            'tech_stack' => 'UI/UX Design, Figma'
        ]);

        Project::create([
            'name' => 'Website Rumah Kost',
            'description' => 'Mengembangkan website rumah kost khusus putri untuk mencari informasi kamar, fasilitas, harga sewa, dan kontak pemilik. Dilengkapi fitur CRUD manajemen data kost dan optimasi Google Search Console.',
            'link' => null,
            'tech_stack' => 'Laravel, MySQL, Google Search Console'
        ]);

        Project::create([
            'name' => 'Website Prediksi Machine Learning',
            'description' => 'Mengembangkan website prediksi berbasis machine learning dengan fitur upload data dan hasil prediksi otomatis melalui dashboard yang informatif.',
            'link' => null,
            'tech_stack' => 'Python, PHP, MySQL'
        ]);
    }
}