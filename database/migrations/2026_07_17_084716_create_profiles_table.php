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
    Schema::create('profiles', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('avatar')->nullable(); // Menyimpan path foto/avatar untuk nilai tambah Laravel Storage
        $table->string('headline');           // Peran (cth: "Mahasiswa Sistem Informasi | Web Developer")
        $table->text('about');                // Deskripsi singkat tentang kamu
        $table->string('email');
        $table->string('phone');
        $table->string('linkedin')->nullable();
        $table->string('github')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
