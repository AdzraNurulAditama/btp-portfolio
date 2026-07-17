<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    public function up(): void
{
    Schema::create('experiences', function (Blueprint $table) {
        $table->id();
        $table->string('position');     // Posisi / Jabatan
        $table->string('institution');  // Nama Perusahaan / Organisasi
        $table->string('period');       // Periode (contoh: "2024 - Sekarang")
        $table->text('description');    // Deskripsi tugas/pencapaian
        $table->timestamps();
    });
}
}
