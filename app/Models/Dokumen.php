<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Dokumen extends Model
{
    protected $table = 'dokumen';

    protected $fillable = [
        'judul',
        'deskripsi',
        'file',
        'kategori_id',
        'created_by',
        'tanggal_upload',
        'status'
    ];

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(KategoriDokumen::class, 'kategori_id');
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
