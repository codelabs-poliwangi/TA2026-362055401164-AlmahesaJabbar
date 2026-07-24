<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KategoriDokumen extends Model
{
    protected $table = 'kategori_dokumen';

    protected $fillable = [
        'nama_kategori'
    ];

    public function dokumen(): HasMany
    {
        return $this->hasMany(Dokumen::class, 'kategori_id');
    }
}
