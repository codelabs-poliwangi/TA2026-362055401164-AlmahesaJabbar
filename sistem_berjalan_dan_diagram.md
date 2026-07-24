# Dokumentasi Diagram Sistem Berjalan dan Perancangan UML
## Website Badan Kesatuan Bangsa dan Politik (Bakesbangpol) Kabupaten Banyuwangi

Dokumen ini berisi analisis aliran sistem dan perancangan UML (*Unified Modeling Language*) yang disesuaikan dengan implementasi aktual pada website Bakesbangpol Kabupaten Banyuwangi. Dokumen ini dirancang agar dapat digunakan secara langsung sebagai lampiran Proposal, Laporan Tugas Akhir, atau Skripsi.

Semua diagram divisualisasikan secara interaktif menggunakan format **Mermaid.js** yang dapat ter-render secara otomatis pada VS Code (dengan ekstensi Markdown Preview), GitHub, GitLab, atau editor Markdown modern lainnya.

---

## 1. Flowchart Sistem Berjalan (Cross Functional Flowchart)

*Cross Functional Flowchart* (atau *Swimlane Flowchart*) ini menggambarkan alur aktivitas sistem berjalan yang dibagi ke dalam 4 (empat) peran/entitas tanggung jawab: **Pengunjung (Publik)**, **Admin (Pengelola)**, **Sistem (Laravel Web App)**, dan **Database/Storage**.

```mermaid
flowchart LR
    %% Pengaturan Gaya & Class
    classDef startEnd fill:#f66,stroke:#333,stroke-width:2px,color:#fff;
    classDef process fill:#9cf,stroke:#333,stroke-width:1px;
    classDef decision fill:#fc9,stroke:#333,stroke-width:1px;
    classDef db fill:#9f9,stroke:#333,stroke-width:1px;
    classDef file fill:#f9f,stroke:#333,stroke-width:1px;

    subgraph Lane_Pengunjung["Pengunjung (Publik)"]
        P_Start([Mulai])
        P_Akses[Akses Website Bakesbangpol]
        P_Navigasi{Pilih Menu Navigasi}
        
        P_Profil[1. Lihat Halaman Profil/Visi-Misi]
        P_Pimpinan[2. Lihat Bagan Pimpinan/Staf]
        P_Berita[3. Baca Detail Berita]
        P_Dokumen[4. Cari & Unduh Dokumen]
        P_FAQ[5. Lihat FAQ & Kontak]

        P_KlikUnduh[Klik Tombol Unduh]
        P_End([Selesai])
    end

    subgraph Lane_Admin["Admin (Pengelola)"]
        A_Start([Mulai Login])
        A_Input[Input Email & Password]
        A_Dashboard{Dashboard Admin}
        
        A_Berita[1. Kelola Berita & Kategori]
        A_Dokumen[2. Kelola Dokumen & Kategori]
        A_Halaman[3. Kelola Halaman Dinamis]
        A_Pimpinan[4. Kelola Bagan Pimpinan]
        A_Logout[5. Klik Logout]
        A_End([Selesai])
    end

    subgraph Lane_Sistem["Sistem (Laravel App)"]
        S_Route[Proses Routing & View]
        S_ValidLogin{Validasi Kredensial}
        S_Session[Buat Sesi & Redirect Dashboard]
        
        S_GetDB[Ambil Data via Eloquent]
        S_Render[Render View HTML]
        S_SimpanCRUD[Proses Simpan / Update Konten]
        S_UploadFile[Upload Gambar/Berkas ke Storage]
        S_Download[Kirim Stream File]
        S_HapusSession[Hapus Sesi & Redirect Login]
    end

    subgraph Lane_DB["Database & Storage (MySQL & Disk)"]
        DB_Read[(Query Select Data)]
        DB_Write[(Query Insert/Update/Delete)]
        ST_File[/Penyimpanan File/Gambar/]
    end

    %% Relasi Aliran - PENGUNJUNG
    P_Start --> P_Akses
    P_Akses --> S_Route
    S_Route --> S_GetDB
    S_GetDB <--> DB_Read
    S_GetDB --> S_Render
    S_Render --> P_Navigasi

    P_Navigasi --> P_Profil & P_Pimpinan & P_Berita & P_FAQ
    P_Navigasi --> P_Dokumen

    P_Profil & P_Pimpinan & P_Berita & P_FAQ --> S_Route

    P_Dokumen --> P_KlikUnduh
    P_KlikUnduh --> S_Download
    S_Download <--> ST_File
    S_Download --> P_End

    %% Relasi Aliran - ADMIN
    A_Start --> A_Input
    A_Input --> S_ValidLogin
    S_ValidLogin <--> DB_Read
    S_ValidLogin -- "Tidak Valid (Gagal)" --> A_Input
    S_ValidLogin -- "Valid (Sukses)" --> S_Session
    S_Session --> A_Dashboard

    A_Dashboard --> A_Berita & A_Dokumen & A_Halaman & A_Pimpinan
    A_Dashboard --> A_Logout

    A_Berita & A_Dokumen & A_Halaman & A_Pimpinan --> S_SimpanCRUD
    S_SimpanCRUD --> S_UploadFile
    S_UploadFile --> ST_File
    S_SimpanCRUD <--> DB_Write
    DB_Write --> A_Dashboard

    A_Logout --> S_HapusSession
    S_HapusSession --> A_End

    %% Apply Classes
    class P_Start,P_End,A_Start,A_End startEnd;
    class P_Akses,P_Profil,P_Pimpinan,P_Berita,P_Dokumen,P_FAQ,P_KlikUnduh,A_Input,A_Berita,A_Dokumen,A_Halaman,A_Pimpinan,S_Route,S_Session,S_GetDB,S_Render,S_SimpanCRUD,S_UploadFile,S_Download,S_HapusSession process;
    class P_Navigasi,A_Dashboard,S_ValidLogin decision;
    class DB_Read,DB_Write db;
    class ST_File file;
```

---

## 2. Activity Diagram

*Activity Diagram* berfokus pada aliran kontrol dari satu aktivitas ke aktivitas lainnya dalam suatu sistem. Di bawah ini disajikan 3 (tiga) *Activity Diagram* untuk alur-alur proses krusial pada website Bakesbangpol.

### A. Activity Diagram: Akses dan Unduh Dokumen (Pengunjung)
Menggambarkan aktivitas pengunjung mencari berkas (seperti dokumen regulasi, laporan keuangan PPID) dan mengunduhnya.

```mermaid
stateDiagram-v2
    [*] --> BukaMenuDokumen : Pengunjung memilih menu Dokumen
    
    state BukaMenuDokumen {
        [*] --> KirimRequest : GET /dokumen
        KirimRequest --> AmbilDataDB : Controller meminta data dokumen & kategori
        AmbilDataDB --> RenderHalaman : Kirim data ke view
        RenderHalaman --> [*] : Tampilkan daftar dokumen
    }

    BukaMenuDokumen --> CariDokumen : Pengunjung memasukkan kata kunci / filter kategori
    CariDokumen --> SaringData : Sistem menyaring data dokumen
    SaringData --> TampilkanHasil : Tampilkan dokumen yang sesuai

    TampilkanHasil --> KlikUnduh : Pengunjung klik tombol "Unduh"
    KlikUnduh --> CekFileServer : Sistem mengecek fisik berkas di storage
    
    state CekFileServer <<choice>>
    CekFileServer --> MulaiUnduh : Jika file ditemukan
    CekFileServer --> TampilkanError : Jika file tidak ditemukan / rusak

    MulaiUnduh --> FileTersimpan : File ter-download ke perangkat lokal
    TampilkanError --> [*] : Tampilkan pesan error "File tidak ditemukan"
    FileTersimpan --> [*]
```

### B. Activity Diagram: Autentikasi Admin (Login & Logout)
Menggambarkan alur keamanan saat administrator melakukan login ke *dashboard* dan keluar (*logout*) dari sistem.

```mermaid
stateDiagram-v2
    [*] --> AksesHalamanLogin : Akses URL /admin/login
    AksesHalamanLogin --> TampilkanForm : Sistem menampilkan Form Login
    TampilkanForm --> InputKredensial : Admin menginput Email & Password
    InputKredensial --> ValidasiForm : Klik tombol "Login" (Kirim POST)

    state CekValidasiForm <<choice>>
    ValidasiForm --> CekValidasiForm
    CekValidasiForm --> TampilkanErrorInput : Data tidak lengkap / format salah
    TampilkanErrorInput --> TampilkanForm

    CekValidasiForm --> CekDatabase : Format Valid -> Cocokkan dengan DB
    
    state CekMatchDB <<choice>>
    CekDatabase --> CekMatchDB
    CekMatchDB --> TampilkanErrorKredensial : Password salah / Akun tidak terdaftar
    TampilkanErrorKredensial --> TampilkanForm
    
    CekMatchDB --> BuatSession : Email & Password Cocok
    BuatSession --> RedirectDashboard : Sistem membuat session login
    RedirectDashboard --> MasukDashboard : Masuk ke Dashboard Utama Admin
    
    MasukDashboard --> KlikLogout : Admin klik tombol "Logout"
    KlikLogout --> HapusSession : Kirim POST /admin/logout
    HapusSession --> RedirectLogin : Sesi dihapus, arahkan ke Login
    RedirectLogin --> [*]
```

### C. Activity Diagram: Pengelolaan Konten (Tambah Berita Baru oleh Admin)
Menggambarkan alur aktivitas administrator saat menginputkan berita publikasi baru ke sistem.

```mermaid
stateDiagram-v2
    [*] --> MasukMenuBerita : Admin klik menu "Berita" di Dashboard
    MasukMenuBerita --> KlikTambahBerita : Klik tombol "Tambah Berita"
    KlikTambahBerita --> TampilkanFormBerita : Sistem memuat Form input berita
    
    TampilkanFormBerita --> IsiFormBerita : Admin mengisi judul, isi, kategori, status & upload gambar
    IsiFormBerita --> KlikSimpan : Klik tombol "Simpan" (Kirim POST)
    KlikSimpan --> ValidasiForm : Sistem memproses validasi input

    state CekValidasi <<choice>>
    ValidasiForm --> CekValidasi
    CekValidasi --> TampilkanErrorValidasi : Ada kolom wajib kosong / ukuran gambar > 2MB
    TampilkanErrorValidasi --> TampilkanFormBerita : Tampilkan form beserta pesan error

    CekValidasi --> BuatSlugUnik : Validasi Berhasil
    BuatSlugUnik --> CekUploadGambar : Generate slug unik berdasarkan Judul
    
    state CekGambar <<choice>>
    CekUploadGambar --> CekGambar
    CekGambar --> SimpanGambar : Jika ada file gambar diunggah
    SimpanGambar --> SimpanKeDatabase : Simpan gambar ke storage 'public/berita'
    CekGambar --> SimpanKeDatabase : Jika tidak mengunggah gambar (default null)

    SimpanKeDatabase --> RedirectIndex : Simpan data ke tabel 'berita'
    RedirectIndex --> TampilkanNotifikasiSukses : Tampilkan daftar berita dengan alert "Berita berhasil ditambahkan"
    TampilkanNotifikasiSukses --> [*]
```

---

## 3. Sequence Diagram

*Sequence Diagram* menunjukkan interaksi antar objek/komponen di dalam sistem yang disusun berdasarkan urutan waktu. Bagian ini menjelaskan interaksi arsitektur MVC (*Model-View-Controller*) Laravel pada website Bakesbangpol.

### A. Sequence Diagram: Membaca Detail Berita (Pengunjung)
Menjelaskan aliran data ketika pengunjung memilih dan membaca sebuah berita di halaman depan website.

```mermaid
sequenceDiagram
    autonumber
    actor Pengunjung
    participant Browser as Client Browser
    participant Route as routes/web.php
    participant Controller as Front\BeritaController
    participant Model as Berita (Model)
    participant Database as MySQL Database
    participant View as front.berita.show (Blade)

    Pengunjung->>Browser: Klik judul/gambar berita
    Browser->>Route: HTTP GET /publikasi/{slug}
    Route->>Controller: show($slug)
    
    critical Query Berita Utama
        Controller->>Model: with('kategori', 'author')->where('slug', $slug)->firstOrFail()
        Model->>Database: SELECT * FROM berita WHERE slug = $slug AND status = 'published'
        Database-->>Model: Kembalikan data berita utama
        Model-->>Controller: Objek Berita
    end

    opt Query Berita Lainnya (Rekomendasi)
        Controller->>Model: orderBy('tanggal_publish', 'desc')->take(3)
        Model->>Database: SELECT * FROM berita WHERE status = 'published' LIMIT 3
        Database-->>Model: Kembalikan data berita lainnya
        Model-->>Controller: Koleksi Berita
    end

    Controller->>View: view('front.berita.show', compact('berita', 'beritaLainnya'))
    View-->>Browser: Render konten ke HTML
    Browser-->>Pengunjung: Tampilkan detail berita & berita rekomendasi
```

### B. Sequence Diagram: Login Admin
Menjelaskan proses autentikasi administrator secara detail dari pengisian form hingga pembuatan sesi.

```mermaid
sequenceDiagram
    autonumber
    actor Admin
    participant Browser as Client Browser
    participant Route as routes/web.php
    participant Controller as Admin\AuthController
    participant Request as Illuminate\Http\Request
    participant Auth as Illuminate\Support\Facades\Auth
    participant Database as MySQL Database

    Admin->>Browser: Buka halaman login (/admin/login)
    Browser->>Route: GET /admin/login
    Route->>Controller: loginForm()
    Controller-->>Browser: Tampilkan View login form
    
    Admin->>Browser: Input Email, Password, klik Login
    Browser->>Route: POST /admin/login
    Route->>Controller: login(Request $request)
    
    Controller->>Request: validate([email, password])
    alt Form Input Tidak Valid
        Request-->>Controller: Validasi Gagal (Kirim Exception)
        Controller-->>Browser: Redirect back dengan error validasi
        Browser-->>Admin: Tampilkan pesan error input
    else Form Input Valid
        Controller->>Auth: attempt(credentials)
        Auth->>Database: SELECT * FROM users WHERE email = $email LIMIT 1
        Database-->>Auth: Data User (Password Hash)
        
        alt Kredensial Tidak Cocok
            Auth-->>Controller: return false
            Controller-->>Browser: Redirect back dengan error "Email/password salah"
            Browser-->>Admin: Tampilkan pesan error kredensial
        else Kredensial Cocok (Sukses)
            Auth-->>Controller: return true & simpan user session
            Controller-->>Browser: Redirect to Route('admin.dashboard')
            
            Browser->>Route: GET /admin
            Note over Route, Controller: Melewati Middleware 'isAdmin' (Mengecek Sesi Aktif)
            Route->>Controller: DashboardController@index
            Controller-->>Browser: Render View Dashboard Admin
            Browser-->>Admin: Tampilkan halaman dashboard pengelola
        end
    end
```

### C. Sequence Diagram: Menambah Berita Baru (Admin)
Menjelaskan interaksi objek saat admin membuat berita baru, termasuk proses unggah gambar cover dan penulisan ke database.

```mermaid
sequenceDiagram
    autonumber
    actor Admin
    participant Browser as Client Browser
    participant Route as routes/web.php
    participant Controller as Admin\BeritaController
    participant Request as Request Input
    participant Storage as File Storage (Public Disk)
    participant Model as Berita (Model)
    participant Database as MySQL Database

    Admin->>Browser: Isi Form Berita & Klik "Simpan"
    Browser->>Route: HTTP POST /admin/berita
    Route->>Controller: store(Request $request)

    Controller->>Request: validate()
    alt Validasi Gagal
        Request-->>Controller: Kembalikan Error (status, gambar, dll)
        Controller-->>Browser: Redirect back dengan pesan error
        Browser-->>Admin: Tampilkan tanda error pada form
    else Validasi Berhasil
        Controller->>Controller: uniqueSlug($request->judul)
        Note over Controller: Menghasilkan slug unik (contoh: "kegiatan-bakesbangpol-1")
        
        opt Ada Upload File Gambar
            Controller->>Request: file('gambar')->store('berita', 'public')
            Request->>Storage: Simpan berkas ke direktori public/berita
            Storage-->>Request: Kembalikan Path File (e.g., "berita/namafile.jpg")
            Request-->>Controller: Path Gambar
        end
        
        Controller->>Model: create($data)
        Model->>Database: INSERT INTO berita (judul, slug, isi, gambar, kategori_id, created_by, status, tanggal_publish) VALUES (...)
        Database-->>Model: Berhasil menyimpan data berita
        Model-->>Controller: Instance Berita Berhasil Dibuat
        
        Controller-->>Browser: Redirect to Route('admin.berita.index') dengan session flash 'success'
        Browser->>Route: GET /admin/berita
        Route->>Controller: index()
        Controller-->>Browser: Tampilkan daftar berita + Notifikasi Sukses
        Browser-->>Admin: Berita baru muncul di baris teratas tabel berita
    end
```

---

## 4. Cara Menyalin / Menggunakan Diagram ini di Proposal / Laporan

Jika Anda ingin memasukkan diagram ini ke dokumen Microsoft Word, Google Docs, atau presentasi PowerPoint, Anda dapat mengekspornya menjadi format gambar (PNG/SVG) dengan langkah-langkah berikut:

1. **Menggunakan VS Code (Rekomendasi):**
   * Pasang ekstensi **Markdown Preview Mermaid Support** dan **Markdown PDF** / **Markdown Preview Enhanced**.
   * Buka berkas ini di VS Code, klik kanan pada preview diagram, lalu pilih **Save Image as PNG**.
2. **Menggunakan Mermaid Live Editor (Online):**
   * Buka situs web [mermaid.live](https://mermaid.live/).
   * Salin kode diagram (blok berkode di dalam tanda ` ```mermaid ` dan ` ``` `) dari dokumen ini.
   * Tempelkan kode ke dalam kolom *Code* di Mermaid Live Editor.
   * Unduh gambar secara instan dengan mengklik tombol **PNG** atau **SVG** pada bagian bawah preview.
