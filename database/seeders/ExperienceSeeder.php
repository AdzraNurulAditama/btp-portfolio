<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Experience;

class ExperienceSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Chevalier Lab
        Experience::create([
            'position' => 'Member Study Club',
            'institution' => 'Chevalier Lab',
            'period' => '2025 - Sekarang',
            'description' => 'Aktif mengikuti study club yang berfokus pada pemahaman proses startup seperti validasi masalah, riset pasar, dan pengembangan solusi. Terlibat dalam kerja tim untuk merancang ide solusi dan mengevaluasi potensi value yang dapat diberikan kepada pengguna.'

        ]);

        // 2. GDGOC Telkom University
        Experience::create([
            'position' => 'Member',
            'institution' => 'GDGOC (Google Developer Group On Campus)',
            'period' => '2024 - Sekarang',
            'description' => 'Mengikuti perkembangan teknologi, workshop pengembangan aplikasi, dan berkolaborasi dalam komunitas developer kampus.'
        ]);

        // 3. PORSENI FIT
        Experience::create([
            'position' => 'Staff Sponsor Pekan Olahraga dan Seni',
            'institution' => 'Fakultas Ilmu Terapan Telkom University',
            'period' => '2025',
            'description' => 'Mengelola komunikasi dengan pihak sponsor untuk mendukung pendanaan acara. Bekerja sama dengan tim untuk memastikan terpenuhinya kebutuhan acara.'
        ]);

        // 4. PEACE Roadshow
        Experience::create([
            'position' => 'Staff Logistik',
            'institution' => 'PEACE Roadshow Telkom University',
            'period' => '2025',
            'description' => 'Mengatur pengadaan, distribusi, dan dokumentasi perlengkapan acara. Berkoordinasi dengan tim logistik dan divisi lain untuk memastikan kelancaran operasional.'
        ]);

        // 5. First Meet Maba
        Experience::create([
            'position' => 'Sekretaris First Meet Mahasiswa Baru 2025',
            'institution' => 'Telkom University',
            'period' => '2025',
            'description' => 'Mengurus administrasi, mencatat notulensi, dan mengelola dokumentasi serta surat-menyurat untuk kelancaran penyambutan mahasiswa baru.'
        ]);

        // 6. Taman Lalu Lintas
        Experience::create([
            'position' => 'Volunteer',
            'institution' => 'Taman Lalu Lintas Bandung',
            'period' => '2025',
            'description' => 'Mengikuti kegiatan sukarelawan untuk membantu edukasi keselamatan berlalu lintas dan memfasilitasi aktivitas pengunjung.'
        ]);

        // 7. OASIS KRIDANTA
        Experience::create([
            'position' => 'Liaison Officer',
            'institution' => 'OASIS KRIDANTA',
            'period' => '2025',
            'description' => 'Menjadi penghubung antara mahasiswa baru dan panitia untuk memastikan komunikasi berjalan efektif. Membimbing, mendampingi, memberikan informasi agenda acara, serta membantu kebutuhan peserta agar kegiatan berjalan lancar.'
        ]);

        // 8. The Groovy 5.0
        Experience::create([
            'position' => 'Staff Divisi Acara',
            'institution' => 'The Groovy 5.0 Telkom University',
            'period' => '2025',
            'description' => 'Menyusun rundown acara secara terstruktur agar kegiatan berjalan sesuai alur dan waktu yang ditetapkan. Bertugas sebagai timekeeper dan berkoordinasi dengan divisi lain guna memastikan kebutuhan acara terpenuhi.'
        ]);

        // 9. Sekretaris Seminar UTBK
        Experience::create([
            'position' => 'Sekretaris Seminar "Strategy to Penetrate the National Selection to Enter State Universities"',
            'institution' => 'Kepanitiaan Seminar',
            'period' => '2023',
            'description' => 'Membuat surat perizinan acara untuk dibagikan kepada pihak sekolah dan menghubungi pihak sekolah secara langsung untuk berkoordinasi terkait izin penyelenggaraan acara.'
        ]);

        // 10. Ekskul Biologi
        Experience::create([
            'position' => 'Ketua Ekstrakurikuler Biologi',
            'institution' => 'SMAN 4 Karawang',
            'period' => '2022 - 2023',
            'description' => 'Mengatur berjalannya organisasi ekstrakurikuler, memimpin rapat, dan bertanggung jawab penuh terhadap seluruh program kerja serta anggota.'
        ]);
    }
}