# Website Badan Kesatuan Bangsa dan Politik (Bakesbangpol) Kabupaten Banyuwangi

[![Laravel](https://img.shields.io/badge/Laravel-11.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://php.net)
[![MySQL](https://img.shields.io/badge/MySQL-8.0+-4479A1?style=for-the-badge&logo=mysql&logoColor=white)](https://mysql.com)
[![TailwindCSS](https://img.shields.io/badge/Tailwind_CSS-3.x-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)](https://tailwindcss.com)

Repositori ini merupakan implementasi sistem dari Tugas Akhir:
> **"Pengembangan Website Bakesbangpol Kabupaten Banyuwangi Menggunakan Metode Personal Extreme Programming (PXP)"**  
> **Oleh:** Almahesa Jabbar (NIM: 362055401164)  
> **Program Studi:** Sarjana Terapan Teknologi Rekayasa Perangkat Lunak  
> **Jurusan:** Bisnis dan Informatika, Politeknik Negeri Banyuwangi (2026)

---

## 📌 Tentang Aplikasi

Aplikasi ini adalah **Website Resmi Badan Kesatuan Bangsa dan Politik (Bakesbangpol) Kabupaten Banyuwangi** yang terintegrasi dengan **Content Management System (CMS)** mandiri. 

Sistem ini dikembangkan untuk mengatasi ketergantungan pengelolaan informasi terhadap pihak pengembang eksternal serta mempercepat publikasi informasi publik dan layanan instansi kepada masyarakat secara transparan, akurat, dan berkelanjutan sesuai prinsip *e-government*.

### Modul dan Fitur Utama:
1. **Sisi Pengunjung (Publik):**
   * **Beranda Interaktif:** Hero banner dinamis, bilah pengumuman (*running announcement*), cuplikan berita kegiatan terbaru, galeri video dinas, dan ringkasan FAQ.
   * **Profil Instansi:** Visi & Misi, Tugas Pokok & Fungsi (Tupoksi), Struktur Organisasi, serta profil pimpinan dan pejabat struktural.
   * **Publikasi Berita:** Kumpulan berita dan liputan dinas dengan filter kategori, pagination, serta halaman detail berita.
   * **Dokumen PPID:** Katalog berkas layanan/publikasi (PDF, DOCX, XLSX) dengan pencarian dan unduhan berkas langsung.
   * **Pencarian Global (*Global Search*):** Fitur pencarian terpadu lintas modul (berita, dokumen PPID, video, dan halaman statis).
   * **Kontak & Pesan Masuk:** Formulir aspirasi/pertanyaan publik terkirim langsung ke panel admin.

2. **Sisi Administrator (Panel CMS):**
   * **Autentikasi & Keamanan:** Proteksi rute internal melalui middleware `isAdmin`, proteksi sesi login (*session regeneration*), dan pencegahan akses tak berwenang.
   * **Dashboard Statistik:** Ringkasan statistik jumlah data (berita, dokumen, halaman statis, pimpinan) dan rekap aktivitas terbaru.
   * **Manajemen Berita & Kategori:** Operasi CRUD berita, pengaturan status publikasi (*Draft/Published*), pembuatan slug unik otomatis, serta pemotong gambar (*Cropper.js*).
   * **Manajemen Dokumen PPID:** Unggah berkas dokumen publik dengan validasi format dan batas ukuran file (maks. 5 MB) serta pembersihan berkas fisik saat data dihapus.
   * **Manajemen Galeri Video:** Integrasi penyematan tautan video kegiatan dinas (YouTube).
   * **Manajemen Pengumuman:** Pengaturan teks pengumuman penting yang muncul pada bilah beranda.
   * **Manajemen Halaman Statis:** Pembaruan konten profil instansi secara dinamis menggunakan Rich Text Editor.
   * **Manajemen Pimpinan & FAQ:** Pengelolaan urutan hierarki pejabat dinas dan daftar pertanyaan-jawaban umum.
   * **Manajemen Profil & Keamanan Admin:** Pengelolaan data akun admin dan penggantian kata sandi berenkripsi aman.

---

## 🛠️ Teknologi yang Digunakan

* **Backend Framework:** [Laravel](https://laravel.com) (PHP 8.2+) dengan arsitektur *Model-View-Controller* (MVC).
* **Basis Data:** [MySQL](https://www.mysql.com) / MariaDB.
* **Frontend:** Blade Templating Engine, [Tailwind CSS](https://tailwindcss.com), Vanilla JavaScript, dan [Vite](https://vitejs.dev).
* **Pustaka & Plugin:**
  * [Lucide Icons](https://lucide.dev) (Ikon antarmuka modern)
  * [Cropper.js](https://fengyuanchen.github.io/cropperjs/) (Pemotong dan penyesuai rasio gambar unggulan)
* **Keamanan Sistem:**
  * Pencegahan *Cross-Site Scripting* (XSS) melalui sanitasi HTML kustom (`SecurityHelper`).
  * Pencegahan *SQL Injection* menggunakan *prepared statements* bawaan Eloquent ORM.
  * Validasi ekstensi & integritas MIME file upload (`safe_file` & `safe_image`).
  * Teruji aman dari kerentanan *Injection* dan *Broken Access Control* berdasarkan standar **OWASP Top 10** menggunakan alat audit **OWASP ZAP**.
* **Metode Pengembangan:** *Personal Extreme Programming* (PXP) dengan evaluasi pengujian fungsional *Black Box Testing* (keberhasilan 100%) dan *User Acceptance Testing* (UAT skor 87% internal & 88.93% publik – kategori *Sangat Layak*).

---

## 🚀 Pedoman Pemakaian & Instalasi

Ikuti langkah-langkah berikut untuk menjalankan aplikasi pada lingkungan lokal (*Local Development Environment*):

### 1. Kebutuhan Sistem (Prerequisites)
Pastikan lingkungan komputer Anda telah terpasang:
* PHP >= 8.2 (ekstensi `pdo_mysql`, `mbstring`, `fileinfo`, `gd`, `openssl`, `curl` aktif)
* [Composer](https://getcomposer.org/) (versi 2.x)
* [Node.js & NPM](https://nodejs.org/) (versi LTS)
* Server MySQL / MariaDB (misal: Laragon, XAMPP, atau Native MySQL)

---

### 2. Langkah Instalasi

1. **Clone Repositori:**
   ```bash
   git clone https://github.com/codelabs-poliwangi/TA2026-362055401164-AlmahesaJabbar.git
   cd TA2026-362055401164-AlmahesaJabbar
   ```

2. **Instal Dependensi Proyek:**
   ```bash
   # Dependensi PHP (Composer)
   composer install

   # Dependensi Frontend (NPM)
   npm install
   ```

3. **Konfigurasi Lingkungan (`.env`):**
   Salin file konfigurasi contoh:
   ```bash
   cp .env.example .env
   ```
   Generate application key:
   ```bash
   php artisan key:generate
   ```
   Buka file `.env` dan sesuaikan koneksi basis data Anda:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=bakesbangpol_banyuwangi
   DB_USERNAME=root
   DB_PASSWORD=
   ```
   *(Pastikan basis data `bakesbangpol_banyuwangi` telah dibuat pada MySQL)*

4. **Migrasi Tabel & Seeding Data Awal:**
   Jalankan migrasi database beserta data awal bawaan:
   ```bash
   php artisan migrate --seed
   ```
   *Perintah ini otomatis membangun struktur tabel dan mengisi data profil, struktur pimpinan, kategori, berita kegiatan, FAQ, serta akun administrator awal.*

5. **Tautan Penyimpanan Berkas (Storage Symlink):**
   ```bash
   php artisan storage:link
   ```

6. **Kompilasi Aset Frontend:**
   ```bash
   # Untuk produksi/siap pakai:
   npm run build

   # Atau untuk mode pengembangan aktif:
   npm run dev
   ```

7. **Menjalankan Server Aplikasi:**
   ```bash
   php artisan serve
   ```
   Buka peramban (*browser*) dan akses URL berikut:
   * **Halaman Publik / Pengunjung:** `http://127.0.0.1:8000`
   * **Panel Login Administrator:** `http://127.0.0.1:8000/admin/login`

---

## 🔐 Kredensial Masuk Administrator (Default)

Setelah proses `php artisan migrate --seed` selesai, Anda dapat menggunakan akun administrator bawaan berikut:

| Parameter | Kredensial Default |
| :--- | :--- |
| **URL Login** | `http://127.0.0.1:8000/admin/login` |
| **Email** | `admin@bakesbangpol.go.id` |
| **Password** | `admin123` |
| **Role** | `admin` |

> 🔒 **Keamanan:** Disarankan untuk segera mengganti kata sandi bawaan melalui menu **Profil & Kata Sandi** setelah pertama kali masuk.

---

## 📄 Lisensi & Hak Cipta

Hak Cipta © 2026 **Almahesa Jabbar** - Program Studi Sarjana Terapan Teknologi Rekayasa Perangkat Lunak, Politeknik Negeri Banyuwangi.  
Sistem ini telah diserahterimakan untuk operasional **Badan Kesatuan Bangsa dan Politik (Bakesbangpol) Kabupaten Banyuwangi**.
