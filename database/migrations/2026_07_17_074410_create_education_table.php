<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('educations', function (Blueprint $table) {
        $table->id();
        $table->string('institution'); // Nama Kampus / Sekolah
        $table->string('degree');      // Jenjang (misal: S1, SMK)
        $table->string('period');      // Periode (misal: "2023 - 2027")
        $table->text('description');   // Deskripsi / Pencapaian akademis
        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('education');
    }
};
