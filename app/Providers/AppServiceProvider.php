<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        \Illuminate\Support\Facades\Validator::extend('safe_file', function ($attribute, $value, $parameters, $validator) {
            if (!$value instanceof \Illuminate\Http\UploadedFile) {
                return false;
            }
            return !\App\Helpers\SecurityHelper::hasDoubleExtension($value) && !\App\Helpers\SecurityHelper::isSpoofedFile($value);
        }, 'Berkas tidak valid, terdeteksi ekstensi ganda atau konten berbahaya.');

        \Illuminate\Support\Facades\Validator::extend('safe_image', function ($attribute, $value, $parameters, $validator) {
            if (!$value instanceof \Illuminate\Http\UploadedFile) {
                return false;
            }
            return !\App\Helpers\SecurityHelper::hasDoubleExtension($value) && !\App\Helpers\SecurityHelper::isSpoofedFile($value);
        }, 'Gambar tidak valid, terdeteksi ekstensi ganda atau konten berbahaya.');

        view()->composer('*', function ($view) {
            try {
                if (\Illuminate\Support\Facades\Schema::hasTable('berita')) {
                    $latestPengumuman = \App\Models\Berita::where('status', 'published')
                        ->whereHas('kategori', fn($q) => $q->where('nama_kategori', 'Pengumuman'))
                        ->orderBy('tanggal_publish', 'desc')
                        ->first();
                    $view->with('globalPengumuman', $latestPengumuman);
                } else {
                    $view->with('globalPengumuman', null);
                }

                if (\Illuminate\Support\Facades\Schema::hasTable('announcements')) {
                    $publishedAnnouncements = \App\Models\Announcement::where('status', 'published')
                        ->latest()
                        ->get();
                    $view->with('globalAnnouncements', $publishedAnnouncements);
                } else {
                    $view->with('globalAnnouncements', null);
                }
            } catch (\Exception $e) {
                $view->with('globalPengumuman', null);
                $view->with('globalAnnouncements', null);
            }
        });
    }
}
