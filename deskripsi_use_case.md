# Tabel Deskripsi Aktor & Deskripsi Use Case
## Website Badan Kesatuan Bangsa dan Politik (Bakesbangpol) Kabupaten Banyuwangi

Dokumen ini berisi tabel deskripsi aktor dan tabel deskripsi masing-masing *use case* sesuai dengan standar penulisan proposal/laporan Tugas Akhir, mengikuti format pada berkas acuan Anda.

---

### **Tabel 3.8 Deskripsi Aktor**

| No. | Aktor | Deskripsi |
| :---: | :---: | :--- |
| **1.** | **Admin** | Administrator/Pengelola adalah pengguna internal yang memiliki hak akses penuh ke panel admin (*dashboard*) setelah melakukan login. Bertanggung jawab mengelola seluruh konten dan informasi yang ditampilkan pada website. |
| **2.** | **Pengunjung** | Pengunjung adalah masyarakat umum atau pengguna eksternal yang mengakses website secara publik tanpa perlu login. Berperan sebagai konsumen informasi yang disediakan oleh Bakesbangpol. |

---

### **Daftar Tabel Deskripsi Use Case**

#### **Tabel 3.9 Use Case Login ke Dashboard**
| Komponen | : | Keterangan |
| :--- | :---: | :--- |
| **Nama Use Case** | : | Login ke Dashboard |
| **Aktor** | : | Admin |
| **Deskripsi** | : | Use case ini digunakan untuk melakukan proses autentikasi administrator agar dapat masuk ke halaman dashboard pengelola konten. |
| **Ketergantungan** | : | - |
| **Pra-Kondisi** | : | Akun admin sudah terdaftar di database sistem. |
| **Pasca-Kondisi** | : | Sesi admin aktif dan berhasil diarahkan ke halaman dashboard utama admin. |

#### **Tabel 3.10 Use Case Mengelola Berita & Kategori**
| Komponen | : | Keterangan |
| :--- | :---: | :--- |
| **Nama Use Case** | : | Mengelola Berita & Kategori |
| **Aktor** | : | Admin |
| **Deskripsi** | : | Use case ini digunakan untuk melakukan operasi CRUD (Create, Read, Update, Delete) pada data berita, mengelompokkannya dalam kategori berita, serta mengatur status publikasi berita. |
| **Ketergantungan** | : | Login ke Dashboard |
| **Pra-Kondisi** | : | Admin sudah login dan berada di halaman dashboard. |
| **Pasca-Kondisi** | : | Data berita dan kategori berhasil ditambahkan, diubah, atau dihapus dari sistem. |

#### **Tabel 3.11 Use Case Mengelola Galeri Video**
| Komponen | : | Keterangan |
| :--- | :---: | :--- |
| **Nama Use Case** | : | Mengelola Galeri Video |
| **Aktor** | : | Admin |
| **Deskripsi** | : | Use case ini digunakan oleh admin untuk menambahkan link embed video YouTube, menyunting, serta menghapus data publikasi video dinas. |
| **Ketergantungan** | : | Login ke Dashboard |
| **Pra-Kondisi** | : | Admin sudah login dan berada di halaman dashboard. |
| **Pasca-Kondisi** | : | Tautan video berhasil diperbarui, disimpan, atau dihapus dari sistem. |

#### **Tabel 3.12 Use Case Mengelola Dokumen & Kategori**
| Komponen | : | Keterangan |
| :--- | :---: | :--- |
| **Nama Use Case** | : | Mengelola Dokumen & Kategori |
| **Aktor** | : | Admin |
| **Deskripsi** | : | Use case ini digunakan untuk mengunggah berkas/file baru, mengelola dokumen publik (PPID pembantu) serta mengelompokkannya berdasarkan kategori dokumen. |
| **Ketergantungan** | : | Login ke Dashboard |
| **Pra-Kondisi** | : | Admin sudah login dan berada di halaman dashboard. |
| **Pasca-Kondisi** | : | Berkas dokumen dan kategori dokumen berhasil diperbarui di server dan database. |

#### **Tabel 3.13 Use Case Mengelola Halaman Dinamis**
| Komponen | : | Keterangan |
| :--- | :---: | :--- |
| **Nama Use Case** | : | Mengelola Halaman Dinamis |
| **Aktor** | : | Admin |
| **Deskripsi** | : | Use case ini digunakan untuk melakukan penyuntingan isi teks/konten halaman profil dasar seperti Profil, Visi-Misi, Sejarah, dan Tupoksi secara dinamis menggunakan editor teks (WYSIWYG). |
| **Ketergantungan** | : | Login ke Dashboard |
| **Pra-Kondisi** | : | Admin sudah login dan berada di halaman dashboard. |
| **Pasca-Kondisi** | : | Isi halaman profil dinamis berhasil diperbarui di database. |

#### **Tabel 3.14 Use Case Mengelola Data Pimpinan & Staff**
| Komponen | : | Keterangan |
| :--- | :---: | :--- |
| **Nama Use Case** | : | Mengelola Data Pimpinan & Staff |
| **Aktor** | : | Admin |
| **Deskripsi** | : | Use case ini digunakan untuk mengelola profil pimpinan instansi, struktur kepengurusan dinas, mengunggah foto profil, serta mengatur urutan hierarki jabatan. |
| **Ketergantungan** | : | Login ke Dashboard |
| **Pra-Kondisi** | : | Admin sudah login dan berada di halaman dashboard. |
| **Pasca-Kondisi** | : | Struktur organisasi dan profil pimpinan berhasil diperbarui. |

#### **Tabel 3.15 Use Case Mengelola Pengumuman**
| Komponen | : | Keterangan |
| :--- | :---: | :--- |
| **Nama Use Case** | : | Mengelola Pengumuman |
| **Aktor** | : | Admin |
| **Deskripsi** | : | Use case ini digunakan untuk mengelola data pengumuman dinas, banner dinamis, serta link promosi penting yang tampil di beranda depan. |
| **Ketergantungan** | : | Login ke Dashboard |
| **Pra-Kondisi** | : | Admin sudah login dan berada di halaman dashboard. |
| **Pasca-Kondisi** | : | Pengumuman berhasil disimpan, diubah, atau dihapus dari sistem. |

#### **Tabel 3.16 Use Case Mengelola FAQ**
| Komponen | : | Keterangan |
| :--- | :---: | :--- |
| **Nama Use Case** | : | Mengelola FAQ |
| **Aktor** | : | Admin |
| **Deskripsi** | : | Use case ini digunakan untuk melakukan CRUD terhadap daftar pertanyaan dan jawaban umum seputar Bakesbangpol Banyuwangi. |
| **Ketergantungan** | : | Login ke Dashboard |
| **Pra-Kondisi** | : | Admin sudah login dan berada di halaman dashboard. |
| **Pasca-Kondisi** | : | Data FAQ berhasil diperbarui di database. |

#### **Tabel 3.17 Use Case Mengelola User Admin**
| Komponen | : | Keterangan |
| :--- | :---: | :--- |
| **Nama Use Case** | : | Mengelola User Admin |
| **Aktor** | : | Admin |
| **Deskripsi** | : | Use case ini digunakan untuk menambah akun admin baru, mengedit profil admin, mengubah kata sandi, serta mencabut hak akses administrator lain. |
| **Ketergantungan** | : | Login ke Dashboard |
| **Pra-Kondisi** | : | Admin sudah login dan berada di halaman dashboard. |
| **Pasca-Kondisi** | : | Akun administrator baru berhasil disimpan atau diperbarui. |

#### **Tabel 3.18 Use Case Logout**
| Komponen | : | Keterangan |
| :--- | :---: | :--- |
| **Nama Use Case** | : | Logout |
| **Aktor** | : | Admin |
| **Deskripsi** | : | Use case ini digunakan untuk mengakhiri sesi login pengelola konten secara aman. |
| **Ketergantungan** | : | Login ke Dashboard |
| **Pra-Kondisi** | : | Admin dalam keadaan login dan berada di dashboard. |
| **Pasca-Kondisi** | : | Sesi admin dihapus dan admin diarahkan kembali ke halaman login. |

---

### **C. Use Case Aktor - Pengunjung (Public)**

#### **Tabel 3.19 Use Case Melihat Beranda**
| Komponen | : | Keterangan |
| :--- | :---: | :--- |
| **Nama Use Case** | : | Melihat Beranda |
| **Aktor** | : | Pengunjung |
| **Deskripsi** | : | Use case ini digunakan untuk menampilkan halaman utama website yang berisi banner dinas, cuplikan berita terbaru, tautan video, pengumuman terbaru, dan FAQ singkat. |
| **Ketergantungan** | : | - |
| **Pra-Kondisi** | : | Pengunjung membuka domain website Bakesbangpol di web browser. |
| **Pasca-Kondisi** | : | Halaman beranda utama berhasil dimuat dan ditampilkan. |

#### **Tabel 3.20 Use Case Melihat Profil, Visi-Misi & Tupoksi**
| Komponen | : | Keterangan |
| :--- | :---: | :--- |
| **Nama Use Case** | : | Melihat Profil, Visi-Misi & Tupoksi |
| **Aktor** | : | Pengunjung |
| **Deskripsi** | : | Use case ini digunakan pengunjung untuk membaca sejarah, struktur visi dan misi, tugas pokok dan fungsi instansi Bakesbangpol. |
| **Ketergantungan** | : | - |
| **Pra-Kondisi** | : | Pengunjung menavigasikan peramban ke menu Profil instansi. |
| **Pasca-Kondisi** | : | Halaman informasi profil, visi-misi, atau tupoksi instansi berhasil ditampilkan. |

#### **Tabel 3.21 Use Case Melihat Bagan & Profil Pimpinan**
| Komponen | : | Keterangan |
| :--- | :---: | :--- |
| **Nama Use Case** | : | Melihat Bagan & Profil Pimpinan |
| **Aktor** | : | Pengunjung |
| **Deskripsi** | : | Use case ini digunakan untuk melihat bagan struktur organisasi kepengurusan instansi beserta daftar profil pejabat structural dan staff Bakesbangpol Banyuwangi. |
| **Ketergantungan** | : | - |
| **Pra-Kondisi** | : | Pengunjung memilih menu Profil Pimpinan atau Struktur Organisasi. |
| **Pasca-Kondisi** | : | Bagan visual struktur dan foto pimpinan beserta jabatannya sukses ditampilkan. |

#### **Tabel 3.22 Use Case Membaca Berita / Publikasi**
| Komponen | : | Keterangan |
| :--- | :---: | :--- |
| **Nama Use Case** | : | Membaca Berita / Publikasi |
| **Aktor** | : | Pengunjung |
| **Deskripsi** | : | Use case ini digunakan pengunjung untuk melihat kumpulan berita instansi, melakukan filter berdasarkan kategori, serta membaca artikel berita secara detail. |
| **Ketergantungan** | : | - |
| **Pra-Kondisi** | : | Pengunjung menavigasikan peramban ke menu Publikasi/Berita. |
| **Pasca-Kondisi** | : | Daftar berita dan halaman detail berita berhasil ditampilkan. |

#### **Tabel 3.23 Use Case Mencari & Mengunduh Dokumen PPID**
| Komponen | : | Keterangan |
| :--- | :---: | :--- |
| **Nama Use Case** | : | Mencari & Mengunduh Dokumen PPID |
| **Aktor** | : | Pengunjung |
| **Deskripsi** | : | Use case ini digunakan pengunjung untuk mencari dokumen/berkas layanan (seperti laporan keuangan, regulasi) berdasarkan nama/kategori, dan mengunduh berkas tersebut. |
| **Ketergantungan** | : | - |
| **Pra-Kondisi** | : | Pengunjung berada di menu Dokumen. |
| **Pasca-Kondisi** | : | Berkas berhasil diunduh ke perangkat penyimpanan lokal pengunjung. |

#### **Tabel 3.24 Use Case Melihat FAQ**
| Komponen | : | Keterangan |
| :--- | :---: | :--- |
| **Nama Use Case** | : | Melihat FAQ |
| **Aktor** | : | Pengunjung |
| **Deskripsi** | : | Use case ini digunakan pengunjung untuk membaca kumpulan tanya jawab yang sering diajukan terkait layanan Bakesbangpol Banyuwangi. |
| **Ketergantungan** | : | - |
| **Pra-Kondisi** | : | Pengunjung memilih menu FAQ. |
| **Pasca-Kondisi** | : | Halaman berisi daftar tanya jawab berhasil ditampilkan. |

#### **Tabel 3.25 Use Case Mengakses Kontak**
| Komponen | : | Keterangan |
| :--- | :---: | :--- |
| **Nama Use Case** | : | Mengakses Kontak |
| **Aktor** | : | Pengunjung |
| **Deskripsi** | : | Use case ini digunakan pengunjung untuk memperoleh informasi alamat instansi, link peta kantor, email, telepon, serta link sosial media resmi. |
| **Ketergantungan** | : | - |
| **Pra-Kondisi** | : | Pengunjung menavigasi ke halaman Kontak. |
| **Pasca-Kondisi** | : | Detail kontak instansi sukses ditampilkan. |
