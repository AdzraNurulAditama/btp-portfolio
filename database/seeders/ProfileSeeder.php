<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Profile;

class ProfileSeeder extends Seeder
{
    public function run(): void
    {
        Profile::create([
            'name' => 'Adzra Nurul Aditama',
            'avatar' => null, // Nanti diisi otomatis via upload di frontend
            'headline' => 'Mahasiswa Sistem Informasi | UI/UX Designer & Web Developer',
            'about' => 'Mahasiswa Sistem Informasi di Telkom University dengan ketertarikan di bidang UI/UX Design, Web Development, dan teknologi. Terbiasa bekerja dalam tim, bertanggung jawab, dan mudah beradaptasi.',
            'email' => 'adzraaditama06@gmail.com',
            'phone' => '+6285929939905',
            'linkedin' => 'https://linkedin.com/in/adzranuruladitama', // Sesuaikan jika ada link asli
            'github' => 'https://github.com/AdzraNurulAditama'
        ]);
    }
}