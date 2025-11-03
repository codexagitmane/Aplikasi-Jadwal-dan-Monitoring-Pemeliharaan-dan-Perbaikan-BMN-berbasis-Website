# Sistem Jadwal & Monitoring Pemeliharaan dan Perbaikan BMN

Aplikasi web modern berbasis CodeIgniter 4 untuk mengelola aset Barang Milik Negara (BMN), menjadwalkan pemeliharaan, memantau permohonan perbaikan, serta menangani alur persetujuan dengan tanda tangan digital sederhana.

## Fitur Utama

- **Dashboard interaktif** dengan ringkasan statistik dan kalender kegiatan (FullCalendar).
- **Manajemen BMN** lengkap dengan unggah foto dan detail aset (CRUD).
- **Jadwal Pemeliharaan & Perbaikan** dengan visual kalender dan riwayat (CRUD).
- **Permohonan Perbaikan BMN** termasuk pencetakan formulir dan tanda tangan digital multi-role (CRUD + Print + Sign).
- **Manajemen Pengguna** untuk peran Admin, Pengelola BMN, Kasubag TU, dan Pegawai.
- **Autentikasi login** dengan pembatasan akses berbasis peran.

## Teknologi

- [CodeIgniter 4](https://codeigniter4.github.io/CodeIgniter4/) (PHP 8.1+)
- MySQL / MariaDB
- Bootstrap 5.3, Bootstrap Icons, FullCalendar 6

## Instalasi

1. **Clone repositori & instal dependensi**

   ```bash
   git clone <repo-url>
   cd Aplikasi-Jadwal-dan-Monitoring-Pemeliharaan-dan-Perbaikan-Barang-Milik-Negara-BMN-berbasis-Website
   composer install
   cp env.example .env
   ```

2. **Konfigurasi environment**

   - Buka file `.env` dan sesuaikan pengaturan database `database.default.*` dengan kredensial MySQL Anda.
   - Pastikan `CI_ENVIRONMENT = development` saat pengembangan.

3. **Migrasi database & seeder**

   ```bash
   php spark migrate
   php spark db:seed DefaultUserSeeder
   ```

4. **Jalankan aplikasi**

   ```bash
   php spark serve
   ```

   Aplikasi akan tersedia di `http://localhost:8080`.

## Struktur Direktori Utama

- `app/Controllers` – Controller aplikasi dan logika fitur.
- `app/Models` – Model database untuk BMN, jadwal, permohonan, pengguna, dan tanda tangan.
- `app/Views` – Blade-like view dengan layout Bootstrap modern.
- `app/Database/Migrations` – Struktur tabel database.
- `public/` – Front controller dan aset (CSS/JS, upload).

## Akun Default

Setelah menjalankan seeder, tersedia akun berikut:

| Peran            | Username   | Password       |
|------------------|------------|----------------|
| Admin            | `admin`    | `admin123`     |
| Pengelola BMN    | `pengelola`| `pengelola123` |
| Kasubag TU       | `kasubag`  | `kasubag123`   |
| Pegawai          | `pegawai`  | `pegawai123`   |

## Lisensi

Dirilis di bawah lisensi MIT. Silakan gunakan dan kembangkan sesuai kebutuhan.
