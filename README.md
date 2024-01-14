# Penjuang Event (evenin)
![Alt text](public/images/images.png)
## Tentang Pejuang Event
Pejuang Event adalah sebuah platform yang dapat digunakan untuk manajemen dan mempromosikan event. tersedia berbagai tawaran menarik paket promosi event, dan gratis untuk kamu yang seorang pelajar atau mahasiswa.

Pejuang Event dibangun dengan
- Laravel 9
- Tailwind CSS 3
- MySQL
- Windmill Dashboard Admin
  
## Fitur Pejuang Event

- Membuat event dan tiket
- Manajemen konten event yang terbit
- Pembayaran tiket melalui e-wallet dan bank (sudah terintegrasi payment gateway)
- Admin dashboard untuk kurasi event yang akan tayang

---
# Cara Menjalankan Pejuang Event
## Hal - hal  yang dibutuhkan
- PHP 8.2.4
- MySQL
- NPM 9.8.1
- Git
- Composer 2.5.7

## Cara Install
- Clone atau download repository ini
- Jalankan `composer install`
- copy file .env.example, paste, lalu rubah namanya menjadi .env
- siapkan database dan rubah nama database di file .env DB_DATABASE
- jalankan `php artisan key:generate`
- jalankan `npm install && npm run dev`
- jalankan `php artisan migrate`
- jalankan `php artisan db:seed`
- jalankan `php artisan serve` di terminal baru
