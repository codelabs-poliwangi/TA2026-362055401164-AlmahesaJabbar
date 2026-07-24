# AI Guideline — Laravel Web Project: Bakesbangpol Banyuwangi
> Dokumen ini adalah panduan teknis lengkap untuk AI/developer dalam membangun proyek website **Bakesbangpol Kabupaten Banyuwangi** menggunakan **Laravel** + **MySQL**.  
> UI/UX mengacu pada wireframe yang sudah ada. Gunakan dokumen `desain.md` sebagai acuan visual.

---

## 1. Stack Teknologi

| Layer | Teknologi |
|---|---|
| Backend Framework | Laravel 11.x |
| Database | MySQL 8.x |
| Template Engine | Blade (Laravel) |
| CSS Framework | Tailwind CSS v3 |
| Font | Public Sans (heading), Inter (body) — via Google Fonts |
| Icon | Lucide Icons / Heroicons |
| Image Storage | Laravel Storage (local / public disk) |
| Auth | Laravel Breeze (session-based, admin only) |
| Environment | PHP 8.2+, Composer, Node.js (untuk Vite/Tailwind) |

---

## 2. Struktur Database MySQL

Nama database: **`bakesbangpol_banyuwangi`**

### 2.1 Tabel `users`
```sql
CREATE TABLE users (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role VARCHAR(50) DEFAULT 'admin',
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);
```

### 2.2 Tabel `kategori_berita`
```sql
CREATE TABLE kategori_berita (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nama_kategori VARCHAR(100) NOT NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);
```

### 2.3 Tabel `berita`
```sql
CREATE TABLE berita (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    judul VARCHAR(100) NOT NULL,
    slug VARCHAR(100) NOT NULL UNIQUE,
    isi TEXT NOT NULL,
    gambar VARCHAR(255) NULL,
    kategori_id BIGINT UNSIGNED NOT NULL,
    created_by BIGINT UNSIGNED NOT NULL,
    tanggal_publish DATE NULL,
    status ENUM('draft', 'published') DEFAULT 'draft',
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    FOREIGN KEY (kategori_id) REFERENCES kategori_berita(id),
    FOREIGN KEY (created_by) REFERENCES users(id)
);
```

### 2.4 Tabel `halaman`
```sql
CREATE TABLE halaman (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    judul_halaman VARCHAR(100) NOT NULL,
    slug VARCHAR(100) NOT NULL UNIQUE,
    isi_konten TEXT NOT NULL,
    created_by BIGINT UNSIGNED NOT NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    FOREIGN KEY (created_by) REFERENCES users(id)
);
```

### 2.5 Tabel `kategori_dokumen`
```sql
CREATE TABLE kategori_dokumen (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nama_kategori VARCHAR(100) NOT NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);
```

### 2.6 Tabel `dokumen`
```sql
CREATE TABLE dokumen (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    judul VARCHAR(100) NOT NULL,
    deskripsi VARCHAR(255) NULL,
    file VARCHAR(255) NOT NULL,
    kategori_id BIGINT UNSIGNED NOT NULL,
    created_by BIGINT UNSIGNED NOT NULL,
    tanggal_upload DATE NULL,
    status ENUM('draft', 'published') DEFAULT 'published',
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    FOREIGN KEY (kategori_id) REFERENCES kategori_dokumen(id),
    FOREIGN KEY (created_by) REFERENCES users(id)
);
```

> **Catatan:** Jalankan semua migrasi via `php artisan migrate`. Gunakan `DatabaseSeeder` untuk data awal (user admin, kategori default).

---

## 3. Struktur Direktori Laravel

```
project-root/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Front/           ← Controller untuk halaman publik
│   │   │   │   ├── BerandaController.php
│   │   │   │   ├── BeritaController.php
│   │   │   │   ├── DokumenController.php
│   │   │   │   ├── HalamanController.php
│   │   │   │   └── KontakController.php
│   │   │   └── Admin/           ← Controller untuk dashboard admin
│   │   │       ├── DashboardController.php
│   │   │       ├── BeritaController.php
│   │   │       ├── DokumenController.php
│   │   │       ├── HalamanController.php
│   │   │       └── UserController.php
│   │   └── Middleware/
│   │       └── IsAdmin.php
│   └── Models/
│       ├── User.php
│       ├── Berita.php
│       ├── KategoriBerita.php
│       ├── Dokumen.php
│       ├── KategoriDokumen.php
│       └── Halaman.php
├── database/
│   ├── migrations/
│   └── seeders/
├── resources/
│   └── views/
│       ├── layouts/
│       │   ├── app.blade.php        ← Layout publik (navbar + footer)
│       │   └── admin.blade.php      ← Layout admin (sidebar + topbar)
│       ├── front/
│       │   ├── beranda.blade.php
│       │   ├── profil/
│       │   │   ├── index.blade.php
│       │   │   └── pimpinan.blade.php
│       │   ├── berita/
│       │   │   ├── index.blade.php
│       │   │   └── show.blade.php
│       │   ├── dokumen/
│       │   │   └── index.blade.php
│       │   └── kontak.blade.php
│       └── admin/
│           ├── dashboard.blade.php
│           ├── berita/
│           │   ├── index.blade.php
│           │   ├── create.blade.php
│           │   └── edit.blade.php
│           ├── dokumen/
│           │   ├── index.blade.php
│           │   ├── create.blade.php
│           │   └── edit.blade.php
│           ├── halaman/
│           │   ├── index.blade.php
│           │   └── edit.blade.php
│           └── auth/
│               └── login.blade.php
└── routes/
    └── web.php
```

---

## 4. Routing (`routes/web.php`)

```php
<?php

use App\Http\Controllers\Front;
use App\Http\Controllers\Admin;

// ─── FRONT-END (Publik) ───────────────────────────────────────
Route::get('/', [Front\BerandaController::class, 'index'])->name('beranda');
Route::get('/profil', [Front\HalamanController::class, 'profil'])->name('profil');
Route::get('/profil/pimpinan', [Front\HalamanController::class, 'pimpinan'])->name('profil.pimpinan');
Route::get('/dokumen', [Front\DokumenController::class, 'index'])->name('dokumen');
Route::get('/dokumen/{id}/unduh', [Front\DokumenController::class, 'unduh'])->name('dokumen.unduh');
Route::get('/publikasi', [Front\BeritaController::class, 'index'])->name('publikasi');
Route::get('/publikasi/{slug}', [Front\BeritaController::class, 'show'])->name('publikasi.show');
Route::get('/kontak', [Front\KontakController::class, 'index'])->name('kontak');

// ─── AUTH ADMIN ───────────────────────────────────────────────
Route::get('/admin/login', [Admin\AuthController::class, 'loginForm'])->name('admin.login');
Route::post('/admin/login', [Admin\AuthController::class, 'login']);
Route::post('/admin/logout', [Admin\AuthController::class, 'logout'])->name('admin.logout');

// ─── ADMIN (Protected) ────────────────────────────────────────
Route::prefix('admin')->name('admin.')->middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/dashboard', [Admin\DashboardController::class, 'index'])->name('dashboard');

    // Berita CRUD
    Route::resource('berita', Admin\BeritaController::class);

    // Dokumen CRUD
    Route::resource('dokumen', Admin\DokumenController::class);

    // Halaman CRUD
    Route::resource('halaman', Admin\HalamanController::class);

    // User Management
    Route::resource('users', Admin\UserController::class);
});
```

---

## 5. Model & Relasi

### `Berita.php`
```php
class Berita extends Model {
    protected $fillable = ['judul', 'slug', 'isi', 'gambar', 'kategori_id', 'created_by', 'tanggal_publish', 'status'];

    public function kategori() {
        return $this->belongsTo(KategoriBerita::class, 'kategori_id');
    }
    public function author() {
        return $this->belongsTo(User::class, 'created_by');
    }
}
```

### `Dokumen.php`
```php
class Dokumen extends Model {
    protected $fillable = ['judul', 'deskripsi', 'file', 'kategori_id', 'created_by', 'tanggal_upload', 'status'];

    public function kategori() {
        return $this->belongsTo(KategoriDokumen::class, 'kategori_id');
    }
    public function author() {
        return $this->belongsTo(User::class, 'created_by');
    }
}
```

---

## 6. Fitur per Halaman (Front-end)

### 6.1 Beranda (`/`)
**Controller:** `Front\BerandaController@index`  
**Data yang diambil:**
```php
$beritaTerbaru = Berita::with('kategori')->where('status', 'published')
    ->orderBy('tanggal_publish', 'desc')->take(4)->get();

$dokumenTerbaru = Dokumen::with('kategori')->where('status', 'published')
    ->orderBy('created_at', 'desc')->take(3)->get();
```
**Sections yang dirender (ikuti wireframe):**
- Navbar
- Hero Section — tagline + gambar
- Fondasi Strategis — konten statis dari tabel `halaman` (slug: `fondasi-strategis`)
- Kabar Terbaru — grid 4 kartu dari `$beritaTerbaru`
- Video — embed YouTube (URL dari tabel `halaman` slug: `video-embed`)
- FAQ — konten statis dari tabel `halaman` (slug: `faq`)
- Footer

---

### 6.2 Profil (`/profil`)
**Data:** `Halaman::where('slug', 'profil')->first()`  
**Sub-menu navigasi:**
- Profil Instansi
- Pimpinan → render dari `halaman` slug: `pimpinan`
- Struktur Organisasi → slug: `struktur-organisasi`
- Visi dan Misi → slug: `visi-misi`
- Tugas Pokok dan Fungsi → slug: `tupoksi`

---

### 6.3 Dokumen PPID (`/dokumen`)
**Controller:** `Front\DokumenController@index`  
**Fitur:**
- Filter per `kategori_id` (query string `?kategori=1`)
- Search judul dokumen (`?search=...`)
- Pagination 10 per halaman
- Tombol unduh → stream file dari storage

```php
$dokumen = Dokumen::with('kategori')
    ->where('status', 'published')
    ->when(request('kategori'), fn($q, $id) => $q->where('kategori_id', $id))
    ->when(request('search'), fn($q, $s) => $q->where('judul', 'like', "%$s%"))
    ->paginate(10);

$kategori = KategoriDokumen::all();
```

---

### 6.4 Publikasi / Berita (`/publikasi`)
**Fitur:**
- Grid kartu berita dengan pagination
- Filter kategori
- Halaman detail berita (`/publikasi/{slug}`)

---

## 7. Fitur Admin (Back-end)

### 7.1 Dashboard
Tampilkan card ringkasan:
```php
$totalBerita = Berita::count();
$totalDokumen = Dokumen::count();
$totalHalaman = Halaman::count();
$aktivitasTerbaru = Berita::latest()->take(5)->get(); // log sederhana
```

### 7.2 CRUD Berita
| Aksi | Method | URL |
|---|---|---|
| List | GET | `/admin/berita` |
| Create Form | GET | `/admin/berita/create` |
| Store | POST | `/admin/berita` |
| Edit Form | GET | `/admin/berita/{id}/edit` |
| Update | PUT | `/admin/berita/{id}` |
| Delete | DELETE | `/admin/berita/{id}` |

**Validasi store/update:**
```php
$request->validate([
    'judul' => 'required|max:100',
    'isi' => 'required',
    'kategori_id' => 'required|exists:kategori_berita,id',
    'gambar' => 'nullable|image|max:2048',
    'tanggal_publish' => 'nullable|date',
    'status' => 'required|in:draft,published',
]);
```

**Upload gambar:**
```php
if ($request->hasFile('gambar')) {
    $path = $request->file('gambar')->store('berita', 'public');
    $data['gambar'] = $path;
}
```

### 7.3 CRUD Dokumen
Sama seperti berita, namun field `file` menerima PDF/Word/Excel.
```php
'file' => 'required|mimes:pdf,doc,docx,xls,xlsx|max:5120'
```
Unduh file menggunakan `Storage::download()`.

### 7.4 Kelola Halaman
Halaman bersifat **konten statis** yang dikelola via slug.  
Admin dapat mengubah `judul_halaman` dan `isi_konten` melalui rich text editor (TinyMCE atau Quill).

---

## 8. Authentication & Middleware

### Middleware `IsAdmin`
```php
// app/Http/Middleware/IsAdmin.php
public function handle($request, Closure $next) {
    if (!Auth::check() || Auth::user()->role !== 'admin') {
        return redirect('/')->with('error', 'Akses ditolak.');
    }
    return $next($request);
}
```

Daftarkan di `bootstrap/app.php` atau `Kernel.php`:
```php
'isAdmin' => \App\Http\Middleware\IsAdmin::class,
```

### Seeder Admin Default
```php
User::create([
    'name' => 'Administrator',
    'email' => 'admin@bakesbangpol.go.id',
    'password' => Hash::make('admin123'),
    'role' => 'admin',
]);
```

---

## 9. UI/UX Implementation Guidelines

> UI mengikuti wireframe yang sudah ada. Warna, font, dan komponen mengikuti `desain.md`.

### 9.1 Color Variables (Tailwind Config)
```js
// tailwind.config.js
theme: {
  extend: {
    colors: {
      primary: '#004795',
      secondary: '#00AEEF',
      tertiary: '#F9B115',
      neutral: '#64748B',
    },
    fontFamily: {
      display: ['"Public Sans"', 'sans-serif'],
      body: ['Inter', 'sans-serif'],
    }
  }
}
```

### 9.2 Layout Blade Publik (`layouts/app.blade.php`)
```html
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Bakesbangpol Banyuwangi')</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@400;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
</head>
<body class="font-body text-neutral bg-white">
  @include('front.partials.navbar')
  <main>@yield('content')</main>
  @include('front.partials.footer')
</body>
</html>
```

### 9.3 Layout Blade Admin (`layouts/admin.blade.php`)
```html
<body class="bg-slate-100 font-body">
  <div class="flex min-h-screen">
    @include('admin.partials.sidebar')
    <div class="flex-1 flex flex-col">
      @include('admin.partials.topbar')
      <main class="p-6">@yield('content')</main>
    </div>
  </div>
</body>
```

### 9.4 Komponen Penting yang Harus Dibuat

| Komponen | Path | Keterangan |
|---|---|---|
| Navbar | `front/partials/navbar.blade.php` | Sticky, active state per route |
| Footer | `front/partials/footer.blade.php` | 4 kolom, dark bg |
| Sidebar Admin | `admin/partials/sidebar.blade.php` | Active state, icon per menu |
| Topbar Admin | `admin/partials/topbar.blade.php` | Nama user + logout |
| Card Berita | `front/partials/card-berita.blade.php` | Reusable component |
| Alert/Flash | `partials/alert.blade.php` | Success/error messages |
| Pagination | Override default Tailwind pagination | |

---

## 10. Slug Auto-generate

Gunakan Spatie Sluggable atau helper manual:
```php
// Dalam BeritaController@store
use Illuminate\Support\Str;
$data['slug'] = Str::slug($request->judul);

// Pastikan slug unik
$count = Berita::where('slug', $data['slug'])->count();
if ($count > 0) $data['slug'] .= '-' . ($count + 1);
```

---

## 11. File Upload & Storage

```bash
# Buat symlink storage
php artisan storage:link
```

```php
// Akses file di view
<img src="{{ asset('storage/' . $berita->gambar) }}" alt="...">

// Unduh dokumen
return Storage::download('public/' . $dokumen->file, $dokumen->judul . '.pdf');
```

---

## 12. Environment `.env`

```env
APP_NAME="Bakesbangpol Banyuwangi"
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=bakesbangpol_banyuwangi
DB_USERNAME=root
DB_PASSWORD=

FILESYSTEM_DISK=public
```

---

## 13. Perintah Setup Awal

```bash
# 1. Install dependencies
composer install
npm install

# 2. Setup env
cp .env.example .env
php artisan key:generate

# 3. Migrasi + seeder
php artisan migrate --seed

# 4. Storage link
php artisan storage:link

# 5. Build assets
npm run dev      # development
npm run build    # production

# 6. Jalankan server
php artisan serve
```

---

## 14. Konvensi Penamaan

| Konteks | Konvensi |
|---|---|
| Controller | `PascalCase`, suffix `Controller` |
| Model | `PascalCase` singular |
| Migration | `snake_case`: `create_berita_table` |
| Route name | `kebab-case`: `admin.berita.index` |
| Blade view | `kebab-case`: `card-berita.blade.php` |
| Variable | `camelCase` di PHP, `snake_case` di Blade |
| CSS class | Gunakan Tailwind utility, hindari custom class kecuali perlu |

---

## 15. Checklist Pengembangan

### Setup
- [ ] Laravel project dibuat & `.env` dikonfigurasi
- [ ] Database `bakesbangpol_banyuwangi` dibuat di MySQL
- [ ] Semua migrasi dijalankan
- [ ] Seeder admin default dijalankan
- [ ] Storage link dibuat

### Front-end (Publik)
- [ ] Layout `app.blade.php` + Navbar + Footer
- [ ] Halaman Beranda (semua sections)
- [ ] Halaman Profil + sub-halaman
- [ ] Halaman Dokumen PPID (filter + search + unduh)
- [ ] Halaman Publikasi / Berita
- [ ] Halaman Detail Berita
- [ ] Halaman Kontak
- [ ] Responsif mobile

### Back-end (Admin)
- [ ] Login Admin
- [ ] Dashboard (statistik ringkas)
- [ ] CRUD Berita (+ upload gambar)
- [ ] CRUD Dokumen (+ upload file)
- [ ] CRUD Halaman (rich text)
- [ ] Manajemen User/Admin
- [ ] Logout

### QA
- [ ] Validasi semua form
- [ ] Flash message sukses/error
- [ ] Route protection (middleware isAdmin)
- [ ] File unduh berfungsi
- [ ] Pagination berfungsi
- [ ] Slug unik tidak duplikat

---

*Dokumen ini digunakan sebagai panduan untuk AI/developer dalam membangun sistem dari awal hingga selesai. Selalu rujuk `desain.md` untuk keputusan visual dan wireframe untuk struktur halaman.*
