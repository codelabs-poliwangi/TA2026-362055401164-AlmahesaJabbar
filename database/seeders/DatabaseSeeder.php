<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\KategoriBerita;
use App\Models\KategoriDokumen;
use App\Models\Halaman;
use App\Models\Berita;
use App\Models\Dokumen;
use App\Models\Pimpinan;
use App\Models\Faq;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Matikan pemeriksaan foreign key agar aman saat membersihkan data dummy
        Schema::disableForeignKeyConstraints();
        
        User::truncate();
        KategoriBerita::truncate();
        KategoriDokumen::truncate();
        Halaman::truncate();
        Berita::truncate();
        Dokumen::truncate();
        Pimpinan::truncate();
        Faq::truncate();
        
        Schema::enableForeignKeyConstraints();

        // 1. Default Admin (Kredensial Utama)
        $admin = User::create([
            'name' => 'Administrator',
            'email' => 'admin@bakesbangpol.go.id',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        // 2. Kategori Berita Real
        $kategoriBerita = [
            'Berita Utama', 
            'Kegiatan', 
            'Sosialisasi', 
            'Pelatihan', 
            'Pengumuman'
        ];
        $kategoriBeritaModels = [];
        foreach ($kategoriBerita as $k) {
            $kategoriBeritaModels[$k] = KategoriBerita::create(['nama_kategori' => $k]);
        }

        // 3. Kategori Dokumen Real
        $kategoriDokumen = [
            'Profil dan Kebijakan', 
            'Laporan dan Kinerja', 
            'Peraturan dan Regulasi', 
            'Informasi Publik'
        ];
        $kategoriDokumenModels = [];
        foreach ($kategoriDokumen as $k) {
            $kategoriDokumenModels[$k] = KategoriDokumen::create(['nama_kategori' => $k]);
        }

        // 4. Halaman Statis dengan Data Real Bakesbangpol Banyuwangi
        $halaman = [
            [
                'judul_halaman' => 'Profil Instansi Bakesbangpol',
                'slug' => 'profil',
                'isi_konten' => '<p>Badan Kesatuan Bangsa dan Politik (Bakesbangpol) Kabupaten Banyuwangi merupakan unsur pelaksana urusan pemerintahan di bidang kesatuan bangsa dan politik. Berkedudukan di bawah dan bertanggung jawab kepada Bupati Banyuwangi melalui Sekretaris Daerah.</p><p>Kantor kami berlokasi di Jl. KH. Agus Salim No. 109, Mojopanggung, Kec. Banyuwangi, Kabupaten Banyuwangi, Jawa Timur 68425. Kami berkomitmen menyelenggarakan pelayanan publik terbaik, pembinaan wawasan kebangsaan, serta menjaga kondusivitas daerah demi tercapainya pembangunan daerah yang harmonis.</p>',
                'created_by' => $admin->id
            ],
            [
                'judul_halaman' => 'Pimpinan Bakesbangpol',
                'slug' => 'pimpinan',
                'isi_konten' => '<p>Badan Kesatuan Bangsa dan Politik Kabupaten Banyuwangi saat ini dipimpin oleh <strong>Drs. R. Agus Mulyono, M.Si.</strong> selaku Kepala Badan.</p><p>Di bawah kepemimpinan beliau, Bakesbangpol Banyuwangi terus berinovasi dalam menguatkan nilai-nilai kebangsaan, memfasilitasi organisasi kemasyarakatan, serta menjalankan digitalisasi layanan rekomendasi penelitian dan magang secara online guna memberikan kemudahan bagi masyarakat luas.</p>',
                'created_by' => $admin->id
            ],
            [
                'judul_halaman' => 'Struktur Organisasi',
                'slug' => 'struktur-organisasi',
                'isi_konten' => '<p>Struktur organisasi Bakesbangpol Kabupaten Banyuwangi terdiri dari:</p><ul><li><strong>Kepala Badan</strong> (Drs. R. Agus Mulyono, M.Si.)</li><li><strong>Sekretariat</strong> (Mengelola administrasi umum, keuangan, kepegawaian, dan perlengkapan)</li><li><strong>Bidang Ideologi, Wawasan Kebangsaan, dan Karakter Bangsa</strong></li><li><strong>Bidang Kewaspadaan Nasional dan Penanganan Konflik</strong></li><li><strong>Bidang Ketahanan Ekonomi, Sosial, Budaya, dan Organisasi Kemasyarakatan</strong></li></ul>',
                'created_by' => $admin->id
            ],
            [
                'judul_halaman' => 'Visi dan Misi',
                'slug' => 'visi-misi',
                'isi_konten' => '<p>Visi Bakesbangpol Kabupaten Banyuwangi selaras dengan visi pemerintah daerah Kabupaten Banyuwangi, yaitu:</p><h4 style="text-align: center; color: #004795; margin: 15px 0;"><strong>&ldquo;Mewujudkan Banyuwangi yang MAJU, SEJAHTERA dan BERKAH untuk SEMUA&rdquo;</strong></h4><p>Untuk mewujudkan visi tersebut, Bakesbangpol Banyuwangi memiliki Misi utama sebagai berikut:</p><ol><li><strong>Pembinaan Ideologi dan Wawasan Kebangsaan:</strong> Menanamkan nilai-nilai Pancasila, wawasan kebangsaan, karakter bangsa, serta pembauran kebangsaan bagi seluruh lapisan masyarakat.</li><li><strong>Kewaspadaan Nasional dan Deteksi Dini:</strong> Mengoordinasikan intelijen keamanan, kewaspadaan dini daerah, serta pencegahan dan penanganan konflik sosial.</li><li><strong>Fasilitasi Demokrasi dan Ormas:</strong> Memberikan pembinaan politik dalam negeri, pendidikan pemilih pemula, serta pendaftaran dan pembinaan organisasi kemasyarakatan (Ormas).</li></ol>',
                'created_by' => $admin->id
            ],
            [
                'judul_halaman' => 'Tugas Pokok dan Fungsi',
                'slug' => 'tupoksi',
                'isi_konten' => '<p>Merujuk pada Peraturan Bupati Banyuwangi Nomor 76 Tahun 2021, tugas pokok dan fungsi Bakesbangpol Banyuwangi adalah:</p><p><strong>Tugas Pokok:</strong><br />Membantu Bupati dalam melaksanakan urusan pemerintahan di bidang kesatuan bangsa dan politik dalam negeri.</p><p><strong>Fungsi Utama:</strong></p><ul><li>Perumusan kebijakan teknis di bidang ideologi Pancasila, wawasan kebangsaan, karakter bangsa, kewaspadaan nasional, ketahanan ekonomi, sosial budaya, organisasi kemasyarakatan, dan penanganan konflik.</li><li>Pelaksanaan kebijakan daerah terkait koordinasi intelijen keamanan daerah dan forum kemitraan masyarakat.</li><li>Pembinaan, pengawasan, evaluasi, dan pelaporan pelaksanaan urusan kesatuan bangsa dan politik di wilayah Kabupaten Banyuwangi.</li></ul>',
                'created_by' => $admin->id
            ],
            [
                'judul_halaman' => 'Fondasi Strategis',
                'slug' => 'fondasi-strategis',
                'isi_konten' => 'Membangun ekosistem politik yang kondusif, meningkatkan literasi sosial kemasyarakatan, serta kolaborasi aktif melalui semangat "Tandang Bareng" bersama organisasi kemasyarakatan (Ormas), tokoh lintas agama, akademisi, dan media guna menjaga kondusivitas Banyuwangi.',
                'created_by' => $admin->id
            ],
            [
                'judul_halaman' => 'Video Embed',
                'slug' => 'video-embed',
                'isi_konten' => 'https://www.youtube.com/embed/P3U60x9pYd8',
                'created_by' => $admin->id
            ],
        ];

        foreach ($halaman as $h) {
            Halaman::create($h);
        }

        // 5. Input Data Berita Real & Aktual Bakesbangpol Banyuwangi
        $berita = [
            [
                'judul' => 'Roadshow Wawasan Kebangsaan Bakesbangpol Menyasar Mahasiswa Stikom Banyuwangi',
                'slug' => 'roadshow-wawasan-kebangsaan-stikom-banyuwangi',
                'isi' => '<p>Banyuwangi - Badan Kesatuan Bangsa dan Politik (Bakesbangpol) Kabupaten Banyuwangi menyelenggarakan roadshow pendidikan wawasan kebangsaan di Aula Stikom Banyuwangi dengan tema "Rekonstruksi Karakter Kebangsaan di Tengah Cengkraman Politik Algoritma".</p><p>Kepala Bakesbangpol Banyuwangi, Drs. R. Agus Mulyono, M.Si., menyampaikan bahwa di era digital ini, mahasiswa dituntut untuk kritis dan tidak mudah terprovokasi oleh penyebaran informasi palsu (hoaks) yang dapat memecah belah persatuan bangsa.</p><p>Acara ini dihadiri oleh ratusan mahasiswa dan akademisi yang antusias mendiskusikan pentingnya memelihara nilai-nilai luhur Pancasila dalam interaksi di dunia maya maupun nyata.</p>',
                'gambar' => 'berita/roadshow-stikom.png',
                'kategori_id' => $kategoriBeritaModels['Kegiatan']->id,
                'created_by' => $admin->id,
                'tanggal_publish' => '2026-05-21',
                'status' => 'published'
            ],
            [
                'judul' => 'Bakesbangpol Banyuwangi Berikan Literasi Politik bagi Pelajar Gen Z di SMKN 1 Glagah',
                'slug' => 'bakesbangpol-berikan-literasi-politik-gen-z-smkn-1-glagah',
                'isi' => '<p>Banyuwangi - Guna memberikan pemahaman dasar tentang demokrasi, Bakesbangpol Kabupaten Banyuwangi melaksanakan penyuluhan pendidikan politik bagi pelajar tingkat menengah atas di SMKN 1 Glagah, Banyuwangi.</p><p>Penyuluhan yang bertajuk "Pemahaman Dasar Tentang Demokrasi Bagi Pemilih Pemula" ini berfokus pada pentingnya hak suara generasi muda dalam menentukan arah kepemimpinan bangsa, serta etika berdemokrasi yang sehat.</p><p>Bakesbangpol berharap kegiatan ini mampu melahirkan pemilih pemula yang cerdas, rasional, mandiri, dan bertanggung jawab pada pemilu mendatang.</p>',
                'gambar' => 'berita/literasi-pemula.png',
                'kategori_id' => $kategoriBeritaModels['Sosialisasi']->id,
                'created_by' => $admin->id,
                'tanggal_publish' => '2026-05-18',
                'status' => 'published'
            ],
            [
                'judul' => 'Perkuat Sinergi Pembangunan, Bakesbangpol Gelar Pembinaan Ormas dan Media Massa',
                'slug' => 'bakesbangpol-gelar-pembinaan-ormas-dan-media-massa',
                'isi' => '<p>Banyuwangi - Dalam rangka memperkuat kolaborasi pembangunan daerah yang kondusif, Bakesbangpol Banyuwangi menggelar kegiatan pembinaan bagi Organisasi Kemasyarakatan (Ormas) dan wartawan media massa.</p><p>Kegiatan ini menjadi wadah konsolidasi untuk merumuskan sinergi aktif di mana Ormas dan media dapat mengambil peran sebagai mitra strategis pemerintah daerah dalam mengawal stabilitas keamanan dan mensosialisasikan program-program pembangunan secara transparan.</p><p>Bakesbangpol berkomitmen untuk terus memfasilitasi kemitraan ini demi kemajuan masyarakat Kabupaten Banyuwangi.</p>',
                'gambar' => 'berita/pembinaan-ormas.png',
                'kategori_id' => $kategoriBeritaModels['Sosialisasi']->id,
                'created_by' => $admin->id,
                'tanggal_publish' => '2026-04-09',
                'status' => 'published'
            ]
        ];

        foreach ($berita as $b) {
            Berita::create($b);
        }

        // 6. Input Data Dokumen Real Bakesbangpol
        $dokumen = [
            [
                'judul' => 'Laporan Akuntabilitas Kinerja Instansi Pemerintah (LAKIP) Bakesbangpol 2025',
                'deskripsi' => 'Laporan kinerja resmi Badan Kesatuan Bangsa dan Politik Kabupaten Banyuwangi tahun anggaran 2025.',
                'file' => 'dokumen/laporan_kinerja_2025.pdf',
                'kategori_id' => $kategoriDokumenModels['Laporan dan Kinerja']->id,
                'created_by' => $admin->id,
                'tanggal_upload' => '2026-01-15',
                'status' => 'published'
            ],
            [
                'judul' => 'Rencana Strategis (Renstra) Bakesbangpol Kabupaten Banyuwangi',
                'deskripsi' => 'Rencana strategis jangka menengah Bakesbangpol Banyuwangi untuk arah kebijakan daerah.',
                'file' => 'dokumen/renstra_bakesbangpol.pdf',
                'kategori_id' => $kategoriDokumenModels['Profil dan Kebijakan']->id,
                'created_by' => $admin->id,
                'tanggal_upload' => '2026-02-10',
                'status' => 'published'
            ]
        ];

        foreach ($dokumen as $d) {
            Dokumen::create($d);
        }

        // 7. Input Data Pimpinan Real & Aktual Bakesbangpol (Termasuk Bendahara!)
        // 7. Input Data Pimpinan & Staf Real & Aktual Bakesbangpol Banyuwangi sesuai Bagan Resmi
        $pimpinan = [
            [
                'nama' => 'Drs. R. Agus Mulyono, M.Si.',
                'jabatan' => 'Kepala Badan Kesatuan Bangsa dan Politik',
                'tupoksi_singkat' => 'Memimpin penyusunan rencana program, perumusan kebijakan teknis, dan pelaksanaan pembinaan di bidang kesatuan bangsa, politik dalam negeri, serta ketahanan nasional.',
                'foto' => 'pimpinan/agus_mulyono.png',
                'bio' => '<p>Drs. R. Agus Mulyono, M.Si. menjabat sebagai Kepala Badan Kesatuan Bangsa dan Politik Kabupaten Banyuwangi.</p><p>Beliau memimpin penyusunan rencana strategis dan pelaksanaan urusan pemerintahan terkait ideologi Pancasila, wawasan kebangsaan, kewaspadaan nasional, ketahanan ekonomi dan sosial budaya, pendaftaran organisasi kemasyarakatan, serta koordinasi erat pencegahan dan penanganan konflik sosial di seluruh wilayah Banyuwangi.</p>',
                'anggota' => null,
                'urutan' => 1,
                'created_by' => $admin->id
            ],
            [
                'nama' => 'H. Moh. Sulaeman, M.Si.',
                'jabatan' => 'Sekretaris',
                'tupoksi_singkat' => 'Mengoordinasikan perencanaan program kerja, pengelolaan tata usaha kepegawaian, penatausahaan keuangan, perlengkapan logistik, serta penyusunan pelaporan kinerja badan.',
                'foto' => 'pimpinan/moh_sulaeman.png',
                'bio' => '<p>H. Moh. Sulaeman, M.Si. menjabat sebagai Sekretaris Bakesbangpol Kabupaten Banyuwangi.</p><p>Beliau mengomandoi kelancaran pelayanan administrasi internal dinas, pengelolaan anggaran belanja operasional, ketatausahaan kepegawaian, surat-menyurat, serta koordinasi penyiapan laporan akuntabilitas kinerja badan secara profesional.</p>',
                'anggota' => null,
                'urutan' => 2,
                'created_by' => $admin->id
            ],
            [
                'nama' => 'Irma Kurniawati, S.Sos.',
                'jabatan' => 'Kasub Bagian Umum dan Keuangan',
                'tupoksi_singkat' => 'Mengelola administrasi perkantoran, tata usaha kepegawaian, urusan rumah tangga dinas, surat-menyurat, serta penatausahaan administrasi keuangan internal.',
                'foto' => 'pimpinan/irma_kurniawati.png',
                'bio' => '<p>Irma Kurniawati, S.Sos. menjabat sebagai Kepala Sub Bagian Umum dan Keuangan di Bakesbangpol Kabupaten Banyuwangi.</p><p>Beliau mengelola administrasi perkantoran, ketatausahaan, pengelolaan data kepegawaian, logistik rumah tangga dinas, pengelolaan arsip surat-menyurat, serta penyusunan pelaporan keuangan belanja rutin badan secara transparan.</p>',
                'anggota' => null,
                'urutan' => 3,
                'created_by' => $admin->id
            ],
            [
                'nama' => 'Daru Surya Putra, S.E.',
                'jabatan' => 'Kelompok Jabatan Fungsional (Sekretariat)',
                'tupoksi_singkat' => 'Melaksanakan pendampingan fungsional perencanaan, evaluasi program kerja, penyiapan anggaran, serta penyusunan laporan akuntabilitas kinerja sekretariat.',
                'foto' => 'pimpinan/daru_surya_putra.png',
                'bio' => '<p>Daru Surya Putra, S.E. bertugas dalam Kelompok Jabatan Fungsional pada Sekretariat Bakesbangpol Kabupaten Banyuwangi.</p><p>Beliau fokus dalam pendampingan analisis penyusunan perencanaan kerja, pemantauan realisasi program, serta penyiapan data evaluasi pelaporan kinerja tahunan kesekretariatan.</p>',
                'anggota' => null,
                'urutan' => 4,
                'created_by' => $admin->id
            ],
            [
                'nama' => 'Nasrodin, S.Pd.',
                'jabatan' => 'Kelompok Jabatan Fungsional (Bina Ideologi & Wawasan Kebangsaan)',
                'tupoksi_singkat' => 'Melaksanakan tugas fungsional pembinaan wawasan kebangsaan, bela negara, penguatan kapasitas ideologi Pancasila, serta pembauran kebangsaan.',
                'foto' => 'pimpinan/nasrodin.png',
                'bio' => '<p>Nasrodin, S.Pd. bertugas dalam Kelompok Jabatan Fungsional pada Bidang Bina Ideologi, Pembauran dan Wawasan Kebangsaan Bakesbangpol Banyuwangi.</p><p>Beliau aktif merancang program pengenalan wawasan kebangsaan ke sekolah-sekolah, pembinaan karakter bangsa, penguatan ketahanan ideologi Pancasila bagi pemuda, serta menyelenggarakan forum pembauran kebangsaan lintas suku dan budaya.</p>',
                'anggota' => null,
                'urutan' => 5,
                'created_by' => $admin->id
            ],
            [
                'nama' => 'Yudhi Erwanto, S.H.',
                'jabatan' => 'Kelompok Jabatan Fungsional (Kewaspadaan & Penanganan Konflik)',
                'tupoksi_singkat' => 'Mengoordinasikan pelaksanaan deteksi dini konflik sosial, pengawasan orang asing/kewarganegaraan, serta pembinaan forum kewaspadaan dini masyarakat.',
                'foto' => 'pimpinan/yudhi_erwanto.png',
                'bio' => '<p>Yudhi Erwanto, S.H. bertugas dalam Kelompok Jabatan Fungsional pada Bidang Kewaspadaan Nasional dan Penanganan Konflik Bakesbangpol Banyuwangi.</p><p>Tugas beliau sangat vital dalam mendeteksi potensi kerawanan sosial di wilayah Banyuwangi, membina Forum Kewaspadaan Dini Masyarakat (FKDM), melakukan pengawasan administrasi orang asing, serta berkoordinasi erat dengan aparat hukum dalam penanganan konflik sosial di daerah.</p>',
                'anggota' => "SITI MARYAM, S.E.\nNOVI KRISTINA SARI, S.E.\nDIANA HOLIFA, S.A.P.\nRACHMAD ISKANDAR ZULKARNAIN\nCAROLINA ANUGRAH DGS\nSARI NUR 'AINI, S.A.P\nANA SUSILOWATI, S.A.P.\nBUDI WINARTO\nLENI TIARA SANDY, S.I.P.\nNASWAN\nLITA SUPRIYATNA\nKARTONO\nLILIK PUJIYATI, S.E.\nHUSNUL HOTIMAH, S.A.P.\nMUHAMAD AZWAR ANAS, S.H.\nABDUL YUSUF\nPUTRI SUCI LESTARI\nFITRIYANI\nWAHYU DIAN PUTRA\nMAURIZA QUAMILA NAZIRIL",
                'urutan' => 6,
                'created_by' => $admin->id
            ],
            [
                'nama' => 'Febi Nugroho Wibisono, S.Sos.',
                'jabatan' => 'Kelompok Jabatan Fungsional (Budaya Politik & HAM)',
                'tupoksi_singkat' => 'Melaksanakan fasilitasi etika budaya politik daerah, pembinaan pendidikan politik bagi pelajar/pemilih pemula, serta pengawalan koordinasi perlindungan Hak Asasi Manusia.',
                'foto' => 'pimpinan/febi_nugroho.png',
                'bio' => '<p>Febi Nugroho Wibisono, S.Sos. bertugas dalam Kelompok Jabatan Fungsional pada Bidang Budaya Politik dan HAM Bakesbangpol Banyuwangi.</p><p>Beliau memfokuskan kinerjanya pada peningkatan indeks etika demokrasi daerah, penyelenggaraan sekolah politik pemilih pemula bagi Gen Z, serta fasilitasi program Rencana Aksi Nasional Hak Asasi Manusia (RANHAM) secara berkelanjutan.</p>',
                'anggota' => null,
                'urutan' => 7,
                'created_by' => $admin->id
            ]
        ];

        foreach ($pimpinan as $p) {
            Pimpinan::create($p);
        }

        // 8. Input Data FAQ Awal
        $faqs = [
            [
                'pertanyaan' => 'Bagaimana cara mengajukan Izin Penelitian atau Magang/KKN?',
                'jawaban' => 'Pengajuan izin penelitian, KKN, PKL, atau magang di Kabupaten Banyuwangi kini dapat diajukan secara online dengan melampirkan surat pengantar dari kampus/sekolah serta proposal melalui website pelayanan resmi kami.',
                'urutan' => 1,
                'status' => 'published',
                'created_by' => $admin->id
            ],
            [
                'pertanyaan' => 'Apa persyaratan pendaftaran Ormas baru?',
                'jawaban' => 'Persyaratan meliputi Akta Notaris, AD/ART, Surat Kepengurusan, Surat Keterangan Domisili Kantor, NPWP Organisasi, serta program kerja. Berkas dibawa langsung ke Seksi Fasilitasi Ormas di kantor Bakesbangpol Banyuwangi.',
                'urutan' => 2,
                'status' => 'published',
                'created_by' => $admin->id
            ]
        ];

        foreach ($faqs as $f) {
            Faq::create($f);
        }
    }
}
