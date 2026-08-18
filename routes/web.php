<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\BerandaController;
use App\Http\Controllers\Front\BeritaController as FrontBeritaController;
use App\Http\Controllers\Front\DokumenController as FrontDokumenController;
use App\Http\Controllers\Front\HalamanController as FrontHalamanController;
use App\Http\Controllers\Front\KontakController;
use App\Http\Controllers\Front\FaqController as FrontFaqController;
use App\Http\Controllers\Front\SearchController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\BeritaController as AdminBeritaController;
use App\Http\Controllers\Admin\DokumenController as AdminDokumenController;
use App\Http\Controllers\Admin\HalamanController as AdminHalamanController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\PimpinanController as AdminPimpinanController;
use App\Http\Controllers\Admin\VideoController as AdminVideoController;
use App\Http\Controllers\Admin\AnnouncementController as AdminAnnouncementController;
use App\Http\Controllers\Admin\FaqController as AdminFaqController;
use App\Http\Controllers\Admin\PesanController as AdminPesanController;
use App\Http\Controllers\Admin\ProfileController;

// Public routes
Route::get('/', [BerandaController::class, 'index'])->name('beranda');
Route::get('/profil', [FrontHalamanController::class, 'profil'])->name('profil');
Route::get('/profil/pimpinan', [FrontHalamanController::class, 'pimpinan'])->name('profil.pimpinan');
Route::get('/profil/struktur-organisasi', [FrontHalamanController::class, 'strukturOrganisasi'])->name('profil.struktur');
Route::get('/profil/visi-misi', [FrontHalamanController::class, 'visiMisi'])->name('profil.visi-misi');
Route::get('/profil/tupoksi', [FrontHalamanController::class, 'tupoksi'])->name('profil.tupoksi');
Route::get('/publikasi', [FrontBeritaController::class, 'index'])->name('publikasi');
Route::get('/publikasi/{slug}', [FrontBeritaController::class, 'show'])->name('publikasi.show');
Route::get('/dokumen', [FrontDokumenController::class, 'index'])->name('dokumen');
Route::get('/dokumen/unduh/{id}', [FrontDokumenController::class, 'unduh'])->name('dokumen.unduh');
Route::get('/kontak', [KontakController::class, 'index'])->name('kontak');
Route::post('/kontak', [KontakController::class, 'store'])->name('kontak.store');
Route::get('/faq', [FrontFaqController::class, 'index'])->name('faq');
Route::get('/search', [SearchController::class, 'index'])->name('search');

// Admin authentication
Route::get('/admin/login', [AuthController::class, 'loginForm'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

// Admin protected routes
Route::middleware(['isAdmin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Profile Management
    Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');

    // Berita CRUD
    Route::resource('berita', AdminBeritaController::class);

    // Video CRUD
    Route::resource('video', AdminVideoController::class);

    // Dokumen CRUD
    Route::resource('dokumen', AdminDokumenController::class)->parameters([
        'dokumen' => 'dokumen',
    ]);

    // Halaman CRUD
    Route::resource('halaman', AdminHalamanController::class);

    // User management
    Route::resource('users', AdminUserController::class);

    // Pimpinan CRUD
    Route::resource('pimpinan', AdminPimpinanController::class);

    // Announcement CRUD
    Route::resource('announcement', AdminAnnouncementController::class);

    // FAQ CRUD
    Route::resource('faq', AdminFaqController::class);

    // Pesan CRUD
    Route::resource('pesan', AdminPesanController::class)->parameters([
        'pesan' => 'pesan',
    ]);
});

// Helper route to create storage link on hosting
Route::get('/buat-link-storage', function () {
    try {
        \Illuminate\Support\Facades\Artisan::call('storage:link');
        return 'Sukses: ' . nl2br(\Illuminate\Support\Facades\Artisan::output());
    } catch (\Exception $e) {
        $target = storage_path('app/public');
        $shortcut = public_path('storage');
        
        if (file_exists($shortcut)) {
            return 'Folder storage di public sudah ada.';
        }
        
        if (symlink($target, $shortcut)) {
            return 'Sukses membuat link simbolis secara manual.';
        }
        
        return 'Gagal membuat link simbolis: ' . $e->getMessage();
    }
});

?>
