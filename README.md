# Livewire Dynamic Portfolio Manager — Ujian BTP

Aplikasi Portofolio Interaktif Berbasis Single Page Application (SPA) yang dibangun menggunakan Laravel 11, Livewire v3, dan Tailwind CSS. Sistem ini mengimplementasikan manajemen data penuh (CRUD mandiri) untuk komponen portofolio yang terintegrated secara dinamis antara Landing Page Publik (*View Mode*) dan Dashboard Admin (*Edit Mode*).

---

## Panduan Instalasi & Setup Lokal

Ikuti langkah-langkah di bawah ini untuk memasang dan menjalankan proyek ini di lingkungan lokal Anda:

### 1. Kloning Repositori Git
Buka terminal dan jalankan perintah berikut untuk mengunduh proyek:
```bash
git clone [https://github.com/adzranuruladitama/btp_portfolio.git](https://github.com/adzranuruladitama/btp_portfolio.git)
cd btp_portfolio
2. Install Dependensi PHP
Unduh seluruh package vendor yang dibutuhkan oleh framework Laravel:
3. Konfigurasi Berkas Environment (.env)
Salin berkas template bawaan menjadi file .env aktif yang akan digunakan oleh aplikasi:
**cp .env.example .env
**4. Generate Application Security Key
Buat kunci enkripsi keamanan aplikasi Laravel yang baru:
**php artisan key:generate**
5. Setup Folder Tautan Simbolis (Storage Link)
Buat tautan symlink agar file foto profil atau avatar yang diunggah ke folder private dapat diakses secara publik oleh browser:
**php artisan storage:link**
6. Migrasi Database & Seeding Data Awal
Jalankan migrasi untuk menyusun skema tabel database terbaru sekaligus memasukkan data profil tiruan awal (dummy data):
**php artisan migrate:fresh --seed**
7. Jalankan Server Lokal
Nyalakan server lokal Laravel untuk menjalankan dan menguji aplikasi:
**php artisan serve**
Kemudian website siap diakses melalui browser di alamat http://127.0.0.1:8000.
8. Kompilasi Aset Frontend (Tailwind & Vite)
Karena proyek ini menggunakan Tailwind CSS via Vite, kita wajib mengompilasi aset frontend agar tampilan halaman portofolio tidak memicu error manifest not found dan terformat dengan rapi. Buka jendela terminal baru, lalu jalankan perintah berikut:
# Mengunduh dependensi Node.js (jalankan sekali di awal)
npm install
# Menjalankan server pengembangan Vite secara real-time
npm run dev
