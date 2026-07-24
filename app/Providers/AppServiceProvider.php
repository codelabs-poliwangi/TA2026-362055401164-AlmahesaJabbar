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
