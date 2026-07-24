# BAB IV
# HASIL DAN PEMBAHASAN

## 4.1 Hasil Implementasi Sistem

Sistem Informasi Website Badan Kesatuan Bangsa dan Politik (Bakesbangpol) Kabupaten Banyuwangi telah berhasil dibangun dan diimplementasikan menggunakan *framework* Laravel dan memanfaatkan MySQL sebagai sistem manajemen basis data. Sistem ini dirancang menggunakan arsitektur *Content Management System* (CMS) yang dikembangkan secara komprehensif menggunakan metode *Personal Extreme Programming* (PXP). Secara fungsional, sistem ini mengakomodasi dua jenis pengguna utama, yaitu Administrator yang memiliki hak akses eksklusif untuk mengelola konten melalui *dashboard*, serta Pengunjung (*visitor*) yang bertindak sebagai penerima informasi melalui halaman publik *website*.

Berdasarkan tahap pengembangan yang telah dilakukan, berikut adalah penjabaran hasil implementasi dari fitur-fitur yang terdapat pada sistem:

### 4.1.1 Implementasi Halaman Login

Halaman *login* berfungsi sebagai gerbang utama bagi administrator untuk dapat mengakses *dashboard* pengelolaan sistem. Fitur ini dirancang untuk membatasi akses agar hanya pihak internal Bakesbangpol yang berwenang yang dapat melakukan manipulasi data.

Dalam proses kerjanya, administrator diharuskan memasukkan kredensial berupa alamat *email* dan kata sandi (*password*). Sistem akan memvalidasi kecocokan kredensial tersebut dengan data autentikasi yang tersimpan di dalam basis data. Jika validasi berhasil, sistem akan menginisiasi sesi (*session*) pengguna dan mengarahkan administrator ke halaman *dashboard*. Data yang dilibatkan dalam proses ini mencakup data pengguna (*users*) seperti *email*, *password* terenkripsi, serta peran akses (*role*). 

Fitur ini memberikan manfaat krusial dalam menjaga keamanan sistem Bakesbangpol, memastikan bahwa seluruh operasi pengubahan konten publik hanya dapat dilakukan oleh personel yang memiliki otorisasi sah.

[Gambar 4.1 Halaman Login Admin]

Berdasarkan Gambar 4.1, antarmuka halaman *login* disajikan dengan desain yang lugas dan berpusat pada dua kolom *input* utama, yaitu *email* dan *password*, yang dilengkapi dengan tombol eksekusi untuk proses autentikasi administrator.

### 4.1.2 Implementasi Dashboard

*Dashboard* merupakan halaman pusat kendali (*control panel*) pertama yang ditampilkan setelah administrator berhasil melewati proses *login*. Fitur ini berfungsi memberikan rangkuman informasi dan akses cepat ke berbagai menu pengelolaan CMS.

Implementasi fitur ini bekerja dengan memuat data agregat dari berbagai aktivitas di dalam sistem, sehingga admin bisa memonitor kinerja konten. Meskipun tidak mengubah data secara langsung, *dashboard* memanggil berbagai informasi secara *read-only* dari tabel-tabel utama (seperti jumlah berita, dokumen, maupun pengumuman) untuk disajikan dalam bentuk ringkasan. 

Manfaat utama dari *dashboard* bagi Bakesbangpol adalah memberikan visibilitas yang komprehensif kepada administrator mengenai status terkini dari *website*, sehingga memudahkan pengambilan keputusan terkait pengelolaan konten harian.

[Gambar 4.2 Halaman Dashboard]

Pada Gambar 4.2, terlihat bahwa antarmuka *dashboard* menampilkan statistik ringkas dari data yang ada di sistem, menu navigasi *sidebar* di sebelah kiri untuk berpindah modul, dan identitas administrator yang sedang aktif.

### 4.1.3 Implementasi Kelola Berita

Fitur Kelola Berita merupakan modul utama bagi administrator untuk mempublikasikan artikel, kegiatan, dan liputan khusus terkait urusan Kesatuan Bangsa dan Politik di lingkungan Kabupaten Banyuwangi.

Proses kerja fitur ini mencakup mekanisme *Create, Read, Update, Delete* (CRUD). Administrator dapat menambahkan berita baru dengan mengisi judul, menentukan kategori, mengetik teks isi, hingga mengunggah gambar sampul. Sistem juga menyediakan opsi untuk menyimpan berita sebagai konsep (*draft*) atau langsung memublikasikannya (*published*). Data yang dilibatkan mencakup informasi berita serta relasinya dengan data kategori berita dan identitas admin pembuatnya. 

Kehadiran fitur ini memastikan bahwa Bakesbangpol memiliki sarana publikasi kegiatan yang terstruktur dan mutakhir untuk dibagikan kepada masyarakat secara cepat.

[Gambar 4.3 Halaman Kelola Berita]

Gambar 4.3 menunjukkan daftar artikel berita yang telah diunggah oleh admin, dilengkapi dengan status publikasi, tanggal tayang, serta tombol aksi untuk melihat detail, mengubah, atau menghapus artikel tersebut.

### 4.1.4 Implementasi Kelola Video

Fitur Kelola Video disediakan untuk melengkapi sajian informasi dengan elemen multimedia. Administrator dapat menyematkan dokumentasi audiovisual agar publikasi Bakesbangpol menjadi lebih menarik dan interaktif.

Sistem bekerja dengan cara mengizinkan administrator untuk memasukkan tautan (*link*) video eksternal (misalnya dari YouTube), menentukan judul, dan menetapkan gambar sampul video. Data yang disimpan pada *database* bukanlah *file* videonya secara mentah, melainkan metadata dan tautan referensi, serta status tayangannya. 

Melalui fitur ini, Bakesbangpol dapat mendokumentasikan deklarasi, sosialisasi, atau kegiatan strategis lainnya dalam format video tanpa membebani kapasitas penyimpanan *server* internal.

[Gambar 4.4 Halaman Kelola Video]

Merujuk pada Gambar 4.4, antarmuka Kelola Video menampilkan deretan pustaka tautan video yang terdaftar di dalam sistem. Administrator dapat mengelola daftar putar ini melalui tombol aksi yang tersedia pada setiap baris data.

### 4.1.5 Implementasi Kelola Dokumen

Fitur Kelola Dokumen dirancang khusus untuk mengelola produk hukum, regulasi, maupun formulir pendaftaran yang dapat diunduh (*download*) oleh masyarakat secara bebas.

Proses operasional fitur ini memungkinkan administrator untuk mengunggah *file* berformat dokumen (seperti PDF), menentukan judul dokumen, memberikan deskripsi singkat, dan mengaitkannya dengan kategori dokumen tertentu. Seluruh data mengenai *file* tersebut dicatat beserta informasi admin pengunggahnya. 

Fungsi ini sangat penting bagi Bakesbangpol dalam mewujudkan transparansi tata kelola birokrasi, di mana masyarakat Banyuwangi dapat dengan mudah mengakses Jaringan Dokumentasi dan Informasi Hukum (JDIH) tanpa perlu datang ke kantor secara fisik.

[Gambar 4.5 Halaman Kelola Dokumen]

Gambar 4.5 memperlihatkan halaman manajemen direktori berkas. Admin dapat melihat *file-file* yang berstatus tayang maupun *draft*, serta mengunggah *file* dokumen baru ke dalam sistem untuk keperluan pusat unduhan.

### 4.1.6 Implementasi Kelola Halaman

Kelola Halaman digunakan untuk menangani konten-konten *website* yang sifatnya lebih statis atau permanen, namun sesekali membutuhkan pembaruan tanpa harus campur tangan pihak *programmer*.

Dalam praktiknya, sistem memfasilitasi pembuatan halaman kustom menggunakan URL dinamis (*slug*). Administrator dapat memformat teks panjang, seperti sejarah, struktur organisasi, hingga visi misi instansi. Data yang ditangani berpusat pada elemen tekstual dan judul menu. 

Manfaat fitur ini sangat dirasakan oleh Bakesbangpol ketika terjadi perubahan profil lembaga. Pembaruan identitas instansi dapat langsung dilakukan secara instan dari *dashboard* admin.

[Gambar 4.6 Halaman Kelola Halaman]

Berdasarkan Gambar 4.6, halaman ini menyajikan daftar halaman statis yang menyusun profil *website*. Terdapat antarmuka penyunting teks (*text editor*) untuk memudahkan modifikasi informasi halaman secara langsung.

### 4.1.7 Implementasi Kelola Pengguna

Kelola Pengguna merupakan modul yang memberikan hak kepada super admin (atau administrator berwenang) untuk mendaftarkan dan memanajemen akses operator lain.

Cara kerja fitur ini meliputi proses pendaftaran admin baru dengan menetapkan nama pengguna, *email*, serta kata sandi. Sistem akan melakukan *hashing* (enkripsi searah) terhadap kata sandi sebelum menyimpannya ke *database* untuk menjamin standar keamanan. 

Bagi Bakesbangpol, fitur ini memastikan keberlanjutan pengelolaan *website* ketika terjadi mutasi pegawai atau pendelegasian tugas ke beberapa operator admin yang berbeda.

[Gambar 4.7 Halaman Kelola Pengguna]

Gambar 4.7 menunjukkan manajemen daftar administrator yang terdaftar di dalam *database*. Pada panel ini, admin dapat menambah pengguna baru atau mencabut akses akun yang sudah tidak bertugas.

### 4.1.8 Implementasi Kelola Profil Pimpinan

Fitur Profil Pimpinan dibangun untuk menonjolkan jajaran direksi, pejabat struktural, atau pimpinan yang sedang bertugas di Bakesbangpol.

Secara teknis, administrator dapat memasukkan kelengkapan data pimpinan berupa nama lengkap, jabatan struktural, tugas pokok dan fungsi (tupoksi), serta mengunggah foto resmi. Sistem juga mengakomodasi susunan (*urutan*) hierarki agar posisi pimpinan dapat ditampilkan secara berjenjang di *website*. 

Keberadaan fitur ini memberikan nilai tambah berupa pengenalan figur kelembagaan Bakesbangpol yang kredibel kepada publik, sekaligus mencerminkan transparansi struktur organisasi.

[Gambar 4.8 Halaman Kelola Profil Pimpinan]

Gambar 4.8 menampilkan pengelolaan profil pejabat Bakesbangpol. Admin disediakan formulir *input* untuk menyesuaikan foto pejabat, mengedit tugas pokok, dan mengatur urutan tampilan struktur kepegawaian.

### 4.1.9 Implementasi Kelola Pengumuman

Fitur Kelola Pengumuman ditujukan untuk menyiarkan informasi yang sifatnya insidental, krusial, dan membutuhkan atensi segera dari pengunjung, seperti spanduk informasi peringatan kewaspadaan dini atau berita mendesak.

Administrator mengoperasikan fitur ini dengan memasukkan teks judul pengumuman dan mengaitkannya dengan sebuah tautan rujukan (*link*). Pengumuman ini akan diproses sistem dan ditampilkan di area yang mudah dilihat (misalnya sebagai *running text* di beranda). Data yang digunakan cukup ringkas, yakni berisi teks instruksi dan status penayangan. 

Fitur ini membantu fungsi kehumasan Bakesbangpol Banyuwangi untuk menyampaikan pemberitahuan cepat (misalnya instruksi pemilu atau kewaspadaan menjelang hari raya) secara *real-time*.

[Gambar 4.9 Halaman Kelola Pengumuman]

Pada Gambar 4.9, antarmuka ini menyediakan tabel pengumuman aktif dan tidak aktif. Administrator bisa mengatur pengumuman mana yang sedang ditayangkan (*published*) di beranda muka *website*.

### 4.1.10 Implementasi Kelola FAQ

Fitur *Frequently Asked Questions* (FAQ) berfungsi untuk mengumpulkan dan menjawab pertanyaan-pertanyaan yang sering dilontarkan oleh masyarakat seputar layanan Bakesbangpol.

Alur kerjanya memungkinkan admin untuk membuat pasangan data berupa satu kalimat pertanyaan dan teks deskripsi jawabannya. Jawaban-jawaban ini diatur secara berurutan (*urutan*) untuk memudahkan pengunjung melakukan navigasi informasi. 

Manfaat utama dari pengelolaan FAQ adalah meringankan beban admin dari pertanyaan repetitif, serta memberikan kepuasan layanan publik yang mandiri dan responsif (*self-service*) bagi masyarakat Kabupaten Banyuwangi.

[Gambar 4.10 Halaman Kelola FAQ]

Gambar 4.10 mengilustrasikan daftar pertanyaan dan jawaban yang siap ditampilkan. Admin memiliki fleksibilitas untuk merevisi jawaban mengikuti dinamika prosedur di internal Bakesbangpol.

### 4.1.11 Implementasi Website Pengunjung

*Website* Pengunjung (*front-end*) adalah antarmuka utama yang berinteraksi langsung dengan masyarakat luas. Bagian ini merupakan etalase dari seluruh data yang telah dikelola oleh administrator melalui sistem CMS.

Sistem bekerja dengan memanggil (*querying*) dan mengkompilasi data secara dinamis dari basis data untuk merender halaman secara visual. Fitur-fitur yang tercakup pada bagian ini meliputi:
- **Beranda**, menyuguhkan pengumuman (*running text*), ringkasan berita terbaru, dan tautan akses cepat.
- **Profil Instansi**, memaparkan visi misi, sejarah, struktur organisasi, dan profil pimpinan Bakesbangpol Banyuwangi secara statis maupun dinamis.
- **Publikasi Berita**, menyediakan daftar panjang artikel kegiatan yang dapat diakses secara spesifik pada halaman detail berita.
- **Pusat Unduhan**, memfasilitasi pengunjung untuk mengunduh regulasi dan *file* dokumen publik melalui kategori-kategori yang tertata.
- **Layanan Interaktif**, menyajikan halaman FAQ untuk informasi instan serta rincian Kontak institusi untuk pelayanan lebih lanjut.

Seluruh data yang tertampil (seperti artikel berita, dokumen JDIH, galeri video, hingga pertanyaan FAQ) ditarik dari hasil olahan data di tabel relasional. Kehadiran antarmuka pengunjung ini sangat strategis karena berfungsi sebagai representasi digital dari instansi Bakesbangpol Kabupaten Banyuwangi. Sistem ini membuktikan bahwa pelayanan publik, penyebaran informasi terkait kesatuan bangsa, dan dokumentasi politik kini dapat dijangkau oleh masyarakat kapan saja tanpa batas ruang dan waktu.

[Gambar 4.11 Halaman Beranda Pengunjung]

Berdasarkan Gambar 4.11, halaman pengunjung didesain secara estetis dan responsif. Pengunjung disambut dengan menu navigasi yang komprehensif di bagian atas, spanduk pengumuman aktif, serta cuplikan kegiatan terbaru dari instansi Bakesbangpol.
