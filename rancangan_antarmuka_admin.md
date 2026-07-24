# Bab Perancangan Antarmuka Pengguna (UI Design / Mockup) - Panel Admin
## Website Badan Kesatuan Bangsa dan Politik (Bakesbangpol) Kabupaten Banyuwangi

Dokumen ini disusun khusus untuk kebutuhan penulisan **Bab Perancangan Antarmuka (Mockup/UI Design)** pada Laporan atau Proposal Tugas Akhir (TA) Anda. Penjelasan di bawah ini dirancang dengan gaya akademis yang menekankan aspek "rancangan awal" (*design mockup*) sebelum sistem diimplementasikan ke dalam kode program (Laravel).

---

## 1. Konsep Layout Dasar Panel Admin (Master Layout Design)

Secara umum, rancangan antarmuka panel administrator menggunakan pola **Dashboard Layout (Split Screen)** yang dirancang responsif dengan elemen-elemen berikut:
*   **Sidebar (Sisi Kiri):** Berfungsi sebagai panel navigasi utama untuk berpindah antar menu pengelolaan konten (Berita, Dokumen, Halaman, FAQ, dll.). Sidebar ini dirancang memiliki fitur *collapsible* (dapat disembunyikan/diciutkan) pada perangkat mobile.
*   **Header (Sisi Atas):** Berisi remah roti (*breadcrumb*) penunjuk posisi halaman, tombol pintas ke halaman utama publik (*front-end*), indikator profil admin yang sedang aktif, dan tombol penutup sesi (*logout*).
*   **Main Content Area (Sisi Kanan/Tengah):** Area utama yang bersifat dinamis untuk menampilkan data dalam bentuk tabel (*datatable*), visualisasi statistik, maupun formulir masukan data (*form input*).

---

## 2. Detail Rancangan Antarmuka Halaman Admin (Mockup Description)

### 2.1 Rancangan Antarmuka Halaman Login Admin
*   **Deskripsi Fungsi:** Halaman ini dirancang sebagai gerbang masuk aman (*gatekeeper*) bagi pengguna dengan hak akses administrator untuk melakukan autentikasi ke dalam dashboard pengelola.
*   **Komponen Rancangan (UI Elements):**
    *   *Card Container:* Berada tepat di tengah layar (*center aligned*) untuk memusatkan perhatian pengguna.
    *   *Logo Instansi & Judul:* Logo Pemkab Banyuwangi dan teks judul "Bakesbangpol Admin Panel".
    *   *Field Input Username/Email:* Kotak input dengan ikon surat (*mail icon*) dan teks petunjuk (*placeholder*) "Masukkan Email Anda".
    *   *Field Input Password:* Kotak input dengan ikon gembok (*lock icon*), disertai fitur keamanan penyamaran teks karakter.
    *   *Tombol Login:* Tombol aksi utama dengan kontras warna tinggi (contoh: biru solid) yang berubah warna saat kursor diletakkan di atasnya (*hover effect*).
    *   *Notifikasi Kesalahan:* Komponen peringatan dinamis (*alert banner*) berwarna merah yang hanya muncul apabila kredensial yang dimasukkan tidak valid.

---

### 2.2 Rancangan Antarmuka Halaman Dashboard Utama
*   **Deskripsi Fungsi:** Halaman pertama setelah login sukses yang dirancang untuk memberikan gambaran umum mengenai statistik konten dan ringkasan aktivitas website.
*   **Komponen Rancangan (UI Elements):**
    *   *Widget Cards (Info Box):* Empat kotak panel atas yang menampilkan angka statistik jumlah total Berita, jumlah Dokumen PPID, jumlah Video Galeri, dan jumlah Administrator terdaftar.
    *   *Panel Aktivitas Terbaru:* Area tabel yang menyajikan daftar postingan berita terbaru beserta tanggal terbit dan nama admin pembuatnya.
    *   *Sapaan Pengguna (Welcome Banner):* Area atas bermotif grafis yang menampilkan nama admin aktif (contoh: "Selamat Datang Kembali, [Nama Admin]").

---

### 2.3 Rancangan Antarmuka Halaman Pengelolaan Berita & Kategori
Halaman ini dibagi menjadi dua rancangan tampilan:

#### A. Rancangan Halaman Daftar Berita (Index Table)
*   **Deskripsi Fungsi:** Menampilkan seluruh artikel berita yang telah diposting dalam bentuk tabel dinamis untuk mempermudah pencarian dan aksi manipulasi data.
*   **Komponen Rancangan (UI Elements):**
    *   *Tombol Aksi Tambah:* Tombol "+ Tambah Berita Baru" di bagian atas tabel.
    *   *Filter & Pencarian:* Kotak masukan teks pencarian kata kunci judul dan pemilih menu turun (*dropdown*) kategori berita.
    *   *Tabel Data (Datatable):* Kolom tabel terdiri dari No, Gambar Cover (thumbnail), Judul Berita, Kategori, Tanggal Publikasi, Status (`Draft` / `Published`), dan Kolom Aksi.
    *   *Kolom Aksi (Action Buttons):* Tombol edit (ikon pensil kuning) dan tombol hapus (ikon tempat sampah merah).
    *   *Navigasi Halaman (Pagination):* Angka navigasi di bawah tabel untuk membagi tampilan data per 10 baris.

#### B. Rancangan Form Input Tambah/Edit Berita
*   **Deskripsi Fungsi:** Formulir entri data yang dirancang terstruktur dari atas ke bawah (*single column layout*) untuk menginputkan berita baru atau mengedit berita lama.
*   **Komponen Rancangan (UI Elements):**
    *   *Input Text Judul:* Kotak teks berukuran panjang untuk mengetikkan judul berita.
    *   *Dropdown Kategori:* Pilihan kategori berita yang terhubung langsung dengan database tabel `kategori_berita`.
    *   *WYSIWYG Text Editor:* Komponen editor teks kaya (*Rich Text Editor*) untuk memformat artikel (tebal, miring, poin-poin, link) secara visual tanpa menulis tag HTML.
    *   *Upload File Gambar:* Area unggah berkas gambar cover dengan fitur pratinjau gambar (*preview thumbnail*) sebelum disimpan.
    *   *Input Date Tanggal Publish:* Kalender pemilih tanggal publikasi.
    *   *Dropdown/Radio Status:* Pemilih status berita (`Draft` untuk disimpan sementara, `Published` untuk langsung ditampilkan ke publik).
    *   *Tombol Aksi Bawah:* Tombol "Simpan" (warna hijau) dan tombol "Batal" (warna abu-abu).

---

### 2.4 Rancangan Antarmuka Halaman Pengelolaan Dokumen PPID & Kategori
Sama halnya dengan berita, rancangan halaman dokumen dibagi menjadi:

#### A. Rancangan Halaman Daftar Dokumen (Index Table)
*   **Deskripsi Fungsi:** Menampilkan berkas-berkas PPID Pembantu yang telah diunggah ke server.
*   **Komponen Rancangan (UI Elements):**
    *   Tabel data dengan kolom: No, Judul Dokumen, Deskripsi Singkat, Kategori Dokumen (contoh: Laporan Keuangan, Regulasi), Tanggal Unggah, Nama File, Status, dan Tombol Aksi (Edit/Hapus).

#### B. Rancangan Form Input Upload Dokumen
*   **Deskripsi Fungsi:** Formulir untuk mengunggah berkas baru ke direktori server publik.
*   **Komponen Rancangan (UI Elements):**
    *   *Input Text Judul Dokumen & Deskripsi:* Bidang isian informasi dokumen.
    *   *Dropdown Kategori Dokumen:* Pilihan jenis kategori berkas.
    *   *File Uploader Field:* Area seret-dan-lepas (*drag and drop*) berkas dengan batasan ekstensi dokumen (.pdf, .docx, .xlsx, .zip) yang dirancang memberikan validasi pesan kesalahan jika berkas terlalu besar (>10MB).

---

### 2.5 Rancangan Antarmuka Halaman Pengelolaan Halaman Dinamis
*   **Deskripsi Fungsi:** Halaman khusus untuk mengedit isi konten statis website seperti Sejarah, Visi & Misi, serta Tugas Pokok dan Fungsi (Tupoksi) instansi Bakesbangpol.
*   **Komponen Rancangan (UI Elements):**
    *   *Tabel Halaman:* Menampilkan daftar halaman dinamis yang telah terdaftar di database.
    *   *Form Edit Konten:* Menggunakan editor WYSIWYG berskala penuh agar administrator dapat menyusun dokumen panjang secara rapi, lengkap dengan penataan paragraf dan sub-judul.

---

### 2.6 Rancangan Antarmuka Halaman Pengelolaan Pimpinan & Staff
*   **Deskripsi Fungsi:** Halaman rancangan untuk mengelola struktur pejabat dinas Bakesbangpol Banyuwangi secara hierarki.
*   **Komponen Rancangan (UI Elements):**
    *   *Input Text Nama & Jabatan:* Form isian nama lengkap beserta gelar dan jabatannya.
    *   *File Uploader Foto:* Form unggah foto profil pimpinan/staf dengan pembatasan rasio aspek foto.
    *   *WYSIWYG Bio & Tupoksi:* Deskripsi singkat mengenai latar belakang atau tugas harian staf.
    *   *Input Number Urutan (Ordering):* Bidang angka untuk mengatur prioritas tampilan pada bagan organisasi depan (urutan 1 paling atas, dst.).

---

### 2.7 Rancangan Antarmuka Halaman Pengelolaan Galeri Video
*   **Deskripsi Fungsi:** Halaman untuk menambahkan tautan galeri video sosialisasi Bakesbangpol yang berasal dari platform YouTube.
*   **Komponen Rancangan (UI Elements):**
    *   *Input Text Judul Video:* Isian judul video.
    *   *Input Text Tautan Embed Video:* Form untuk memasukkan URL YouTube (sistem dirancang mengekstrak ID video secara otomatis untuk kebutuhan pemutar video di halaman publik).
    *   *Dropdown Status:* Pilihan publikasi video (`Draft` / `Published`).

---

### 2.8 Rancangan Antarmuka Halaman Pengelolaan Pengumuman & Banner
*   **Deskripsi Fungsi:** Halaman untuk mengatur banner promosi/informasi kedinasan mendesak yang muncul sebagai *pop-up* atau slider di beranda depan.
*   **Komponen Rancangan (UI Elements):**
    *   *Input Text Judul Pengumuman:* Judul pengumuman/banner.
    *   *Input Link/Tautan:* URL tujuan jika gambar banner diklik oleh pengunjung.
    *   *Dropdown Status:* Menyetel aktif tidaknya banner informasi tersebut di beranda depan.

---

### 2.9 Rancangan Antarmuka Halaman Pengelolaan FAQ (Frequently Asked Questions)
*   **Deskripsi Fungsi:** Halaman untuk merancang daftar pertanyaan yang sering diajukan masyarakat beserta jawaban resminya.
*   **Komponen Rancangan (UI Elements):**
    *   *Input Text Pertanyaan:* Isian kalimat tanya dari publik.
    *   *Textarea Jawaban:* Isian jawaban resmi dari admin Bakesbangpol.

---

### 2.10 Rancangan Antarmuka Halaman Pengelolaan User Admin (Manajemen Akun)
*   **Deskripsi Fungsi:** Halaman terbatas untuk Super Admin dalam mengelola akun pengguna pengelola situs (tambah admin baru, ubah kata sandi, hapus akun).
*   **Komponen Rancangan (UI Elements):**
    *   Tabel data pengguna berisi Nama, Email, Role (Admin/Superadmin), dan Aksi.
    *   Form isian nama, email, kata sandi baru, konfirmasi kata sandi, serta pilihan otorisasi tingkatan akses pengguna (*role level*).
