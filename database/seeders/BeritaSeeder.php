<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\KategoriBerita;
use App\Models\Berita;
use App\Models\User;
use Illuminate\Support\Str;

class BeritaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::where('role', 'admin')->first() ?: User::first();
        
        $categories = KategoriBerita::all();
        if ($categories->isEmpty()) {
            $kategoriNames = ['Berita Utama', 'Kegiatan', 'Sosialisasi', 'Pelatihan', 'Pengumuman'];
            foreach ($kategoriNames as $name) {
                KategoriBerita::create(['nama_kategori' => $name]);
            }
            $categories = KategoriBerita::all();
        }

        $beritaList = [
            [
                'judul' => 'Sinergi Bakesbangpol Banyuwangi dan Ormas Perkuat Stabilitas Daerah',
                'kategori' => 'Berita Utama',
                'isi' => '<p>Badan Kesatuan Bangsa dan Politik (Bakesbangpol) Kabupaten Banyuwangi terus berkomitmen meningkatkan koordinasi dan pembinaan terhadap Organisasi Kemasyarakatan (Ormas). Upaya ini dilakukan guna memperkokoh nilai-nilai demokrasi Pancasila dan menjaga kerukunan serta kondusivitas wilayah, khususnya menjelang pelaksanaan pesta demokrasi daerah.</p><p>Kepala Bakesbangpol Banyuwangi menyatakan bahwa sinergi aktif antara pemerintah daerah dan Ormas merupakan kunci utama dalam mendeteksi secara dini potensi konflik sosial. Melalui ruang dialog berkelanjutan, diharapkan seluruh elemen Ormas dapat menjadi duta kerukunan yang mengedukasi masyarakat luas.</p>',
            ],
            [
                'judul' => 'Sosialisasi Wawasan Kebangsaan bagi Generasi Muda di Era Digital',
                'kategori' => 'Sosialisasi',
                'isi' => '<p>Bakesbangpol Banyuwangi menyelenggarakan sosialisasi wawasan kebangsaan yang menyasar ratusan pelajar tingkat SMA/SMK sederajat. Kegiatan yang berlangsung di Aula Serbaguna ini mengusung tema penguatan pemahaman Pancasila di era kemajuan teknologi informasi.</p><p>Perkembangan teknologi selain membawa dampak positif, juga menyebarkan berbagai informasi hoaks yang dapat memecah belah persatuan. Melalui kegiatan ini, generasi muda diharapkan mampu menyaring arus informasi dengan bijak dan tetap menanamkan semangat cinta tanah air.</p>',
            ],
            [
                'judul' => 'Pelatihan Deteksi Dini Kerawanan Konflik bagi Komunitas Informasi Masyarakat',
                'kategori' => 'Pelatihan',
                'isi' => '<p>Sebagai langkah preventif menjaga keamanan wilayah, Bakesbangpol Banyuwangi menggelar pelatihan khusus bagi Komunitas Informasi Masyarakat (KIM). Pelatihan difokuskan pada peningkatan kepekaan dan pemahaman mengenai metode deteksi dini potensi kerawanan sosial di tingkat desa.</p><p>Peserta diberikan pembekalan mengenai tata cara pelaporan informasi yang cepat, akurat, dan bertanggung jawab. Hal ini penting guna meminimalisir penyebaran konflik sebelum berkembang menjadi permasalahan yang lebih besar.</p>',
            ],
            [
                'judul' => 'Pendaftaran Rekomendasi Penelitian Kini Bisa Diakses Sepenuhnya Secara Online',
                'kategori' => 'Pengumuman',
                'isi' => '<p>Bakesbangpol Kabupaten Banyuwangi resmi mengumumkan implementasi sistem pendaftaran pelayanan rekomendasi penelitian dan magang secara online. Pelayanan digital ini dirancang untuk memberikan kemudahan bagi akademisi, mahasiswa, maupun peneliti luar daerah.</p><p>Melalui portal resmi website Bakesbangpol, pengguna cukup mengunggah berkas administrasi seperti surat pengantar kampus, proposal penelitian, dan identitas diri. Proses verifikasi dokumen akan diselesaikan dalam kurun waktu singkat tanpa perlu datang langsung ke kantor.</p>',
            ],
            [
                'judul' => 'Bakesbangpol Gelar Rapat Koordinasi Lintas Sektoral Bahas Isu Strategis Daerah',
                'kategori' => 'Kegiatan',
                'isi' => '<p>Rapat koordinasi lintas sektoral yang melibatkan TNI, Polri, Kejaksaan, dan dinas terkait diselenggarakan oleh Bakesbangpol Banyuwangi. Rapat berkala ini membahas pemantauan situasi ketertiban umum serta penyusunan strategi penanganan isu-isu sosial yang berkembang di masyarakat.</p><p>Hasil dari koordinasi ini akan dirumuskan menjadi rekomendasi kebijakan strategis kepada Bupati Banyuwangi guna menjaga kelancaran roda pemerintahan dan pembangunan daerah.</p>',
            ],
            [
                'judul' => 'Pembinaan Pembauran Kebangsaan Ciptakan Keharmonisan Antar Suku',
                'kategori' => 'Sosialisasi',
                'isi' => '<p>Badan Kesatuan Bangsa dan Politik Kabupaten Banyuwangi melaksanakan dialog pembauran kebangsaan yang dihadiri tokoh adat dari berbagai suku di Banyuwangi. Kegiatan ini bertujuan memperkuat rasa persaudaraan dan toleransi di tengah keberagaman budaya yang ada.</p><p>Sikap toleransi harus terus dipupuk demi menghindari disintegrasi bangsa. Keharmonisan sosial yang terjaga di Banyuwangi menjadi modal dasar pembangunan daerah yang berkelanjutan.</p>',
            ],
            [
                'judul' => 'Workshop Peningkatan Peran Perempuan dalam Politik Praktis',
                'kategori' => 'Pelatihan',
                'isi' => '<p>Dalam rangka mendorong keterwakilan perempuan, Bakesbangpol Banyuwangi mengadakan workshop peningkatan peran perempuan dalam politik. Kegiatan ini bertujuan memberikan wawasan politik, kepemimpinan publik, serta pemahaman regulasi pemilu bagi organisasi wanita.</p><p>Keterlibatan aktif perempuan di bidang politik dan pengambilan keputusan strategis diharapkan mampu menyuarakan aspirasi gender secara lebih berbobot di tingkat legislatif maupun eksekutif.</p>',
            ],
            [
                'judul' => 'Pengumuman Seleksi Calon Paskibraka Kabupaten Banyuwangi Tahun 2026',
                'kategori' => 'Pengumuman',
                'isi' => '<p>Bakesbangpol Banyuwangi membuka pendaftaran seleksi calon Pasukan Pengibar Bendera Pusaka (Paskibraka) tingkat Kabupaten Banyuwangi tahun 2026. Seleksi terbuka bagi seluruh siswa-siswi aktif kelas X tingkat SMA/SMK/MA sederajat yang memenuhi persyaratan fisik dan akademis.</p><p>Pendaftaran dilakukan secara online melalui portal administrasi Paskibraka nasional. Proses seleksi dijalankan dengan prinsip transparansi, objektif, dan akuntabel guna menjaring putra-putri terbaik daerah.</p>',
            ],
            [
                'judul' => 'Upacara Peringatan Hari Lahir Pancasila Khidmat di Kantor Bakesbangpol',
                'kategori' => 'Kegiatan',
                'isi' => '<p>Seluruh jajaran pegawai Bakesbangpol Banyuwangi melaksanakan upacara bendera memperingati Hari Lahir Pancasila dengan khidmat. Upacara ini menjadi refleksi bersama untuk terus mengimplementasikan nilai-nilai luhur Pancasila dalam melayani masyarakat sehari-hari.</p><p>Pancasila bukan sekadar hafalan, melainkan pedoman hidup bersosial. Bakesbangpol terus berada di garda terdepan untuk menjaga keutuhan NKRI melalui penguatan ideologi Pancasila.</p>',
            ],
            [
                'judul' => 'Bakesbangpol Raih Penghargaan Pelayanan Publik Kategori Prima',
                'kategori' => 'Berita Utama',
                'isi' => '<p>Kabar gembira datang dari Bakesbangpol Kabupaten Banyuwangi yang berhasil meraih penghargaan kategori pelayanan publik prima tingkat daerah. Penghargaan ini diberikan atas dedikasi instansi dalam menghadirkan kemudahan layanan rekomendasi berbasis online.</p><p>Kepala Badan menyampaikan apresiasi yang mendalam bagi seluruh tim kerja atas kerja keras dan inovasi tanpa henti. Penghargaan ini menjadi motivasi tambahan untuk selalu memberikan pelayanan publik terbaik kepada masyarakat.</p>',
            ],
        ];

        $images = [
            'berita/roadshow-stikom.png',
            'berita/literasi-pemula.png',
            'berita/pembinaan-ormas.png'
        ];

        // Clean up previous run's seeded data to prevent duplicates
        Berita::whereIn('judul', array_column($beritaList, 'judul'))->delete();

        foreach ($beritaList as $index => $b) {
            $categoryModel = $categories->firstWhere('nama_kategori', $b['kategori']);
            $kategori_id = $categoryModel ? $categoryModel->id : $categories->first()->id;

            Berita::create([
                'judul' => $b['judul'],
                'slug' => Str::slug($b['judul']) . '-' . rand(100, 999),
                'isi' => $b['isi'],
                'gambar' => $images[$index % count($images)],
                'kategori_id' => $kategori_id,
                'created_by' => $admin->id,
                'tanggal_publish' => now()->subDays($index)->format('Y-m-d'),
                'status' => 'published',
            ]);
        }
    }
}
