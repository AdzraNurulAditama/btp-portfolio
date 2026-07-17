<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Education extends Model
{
        public function up(): void
    {
        Schema::create('educations', function (Blueprint $table) {
            $table->id();
            $table->string('institution');     // Posisi / Jabatan
            $table->string('level_of_education');  // Nama Perusahaan / Organisasi
            $table->string('period');       // Periode (contoh: "2024 - Sekarang")
            $table->text('description');    // Deskripsi tugas/pencapaian
            $table->timestamps();
        });
    }
}
