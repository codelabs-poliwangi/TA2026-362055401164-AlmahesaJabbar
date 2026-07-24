<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pimpinan extends Model
{
    use HasFactory;

    protected $table = 'pimpinan';

    protected $fillable = [
        'nama',
        'jabatan',
        'tupoksi_singkat',
        'foto',
        'bio',
        'anggota',
        'urutan',
        'created_by'
    ];

    /**
     * Relasi ke pembuat data (User Admin)
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
