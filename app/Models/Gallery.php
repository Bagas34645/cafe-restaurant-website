<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $fillable = [
        'judul',
        'deskripsi',
        'path_gambar',
        'kategori',
        'urutan',
        'aktif'
    ];

    protected $casts = [
        'aktif' => 'boolean',
        'urutan' => 'integer',
    ];

    // Scope untuk mengambil gallery yang aktif
    public function scopeAktif($query)
    {
        return $query->where('aktif', true);
    }

    // Scope untuk mengambil berdasarkan kategori
    public function scopeKategori($query, $kategori)
    {
        return $query->where('kategori', $kategori);
    }

    // Scope untuk mengurutkan berdasarkan urutan
    public function scopeUrutkan($query)
    {
        return $query->orderBy('urutan', 'asc');
    }

    // Method untuk mendapatkan URL gambar lengkap
    public function getUrlGambar()
    {
        return asset('storage/' . $this->path_gambar);
    }

    // Method untuk mendapatkan daftar kategori yang tersedia
    public static function getKategoriTersedia()
    {
        return [
            'umum' => 'Umum',
            'durian' => 'Durian',
            'kebun' => 'Kebun',
            'proses' => 'Proses',
            'fasilitas' => 'Fasilitas'
        ];
    }
}
