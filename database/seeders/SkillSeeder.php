<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SkillSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Masukkan Data Keahlian Teknis (Skill) dari CV
        $skills = [
            ['name' => 'PHP / Laravel', 'level' => 'Intermediate', 'type' => 'skill'],
            ['name' => 'MySQL', 'level' => 'Intermediate', 'type' => 'skill'],
            ['name' => 'HTML & CSS', 'level' => 'Advanced', 'type' => 'skill'],
            ['name' => 'Figma (UI/UX Design)', 'level' => 'Advanced', 'type' => 'skill'],
            ['name' => 'Java', 'level' => 'Basic', 'type' => 'skill'],
        ];

        foreach ($skills as $skill) {
            DB::table('skills')->insert($skill);
        }

        // 2. Masukkan Data Sertifikasi Kompetensi
        DB::table('skills')->insert([
            'name' => 'Sertifikasi Kompetensi Software Engineer',
            'level' => 'RevoU', // Sesuaikan dengan instansi penerbit sertifikasimu
            'type' => 'certification'
        ]);
    }
}