<?php

namespace Database\Seeders;

use App\Models\Gallery;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $galleries = [
            [
                'judul' => 'Kebun Durian Sentra Tegal',
                'deskripsi' => 'Pemandangan luas kebun durian dengan pohon-pohon durian yang rimbun dan subur',
                'path_gambar' => 'images/durian-farm.jpg',
                'kategori' => 'kebun',
                'urutan' => 1,
                'aktif' => true,
            ],
            [
                'judul' => 'Buah Durian Segar Petik Langsung',
                'deskripsi' => 'Durian segar berkualitas premium yang baru dipetik dari pohon',
                'path_gambar' => 'gallery/durian-segar.jpg',
                'kategori' => 'durian',
                'urutan' => 2,
                'aktif' => true,
            ],
            [
                'judul' => 'Proses Pemetikan Durian',
                'deskripsi' => 'Tim ahli kami sedang melakukan pemetikan durian dengan teknik yang tepat',
                'path_gambar' => 'gallery/proses-petik.jpg',
                'kategori' => 'proses',
                'urutan' => 3,
                'aktif' => true,
            ],
            [
                'judul' => 'Varietas Durian Montong',
                'deskripsi' => 'Durian varietas Montong dengan daging tebal dan rasa manis yang khas',
                'path_gambar' => 'gallery/durian-montong.jpg',
                'kategori' => 'durian',
                'urutan' => 4,
                'aktif' => true,
            ],
            [
                'judul' => 'Fasilitas Penyortiran',
                'deskripsi' => 'Area penyortiran dan pengemasan durian dengan standar kebersihan tinggi',
                'path_gambar' => 'gallery/fasilitas-sortir.jpg',
                'kategori' => 'fasilitas',
                'urutan' => 5,
                'aktif' => true,
            ],
            [
                'judul' => 'Tim Petani Berpengalaman',
                'deskripsi' => 'Tim petani kami yang berpengalaman dalam budidaya durian berkualitas',
                'path_gambar' => 'images/team-pak-budi.jpg',
                'kategori' => 'umum',
                'urutan' => 6,
                'aktif' => true,
            ],
            [
                'judul' => 'Durian Siap Kirim',
                'deskripsi' => 'Durian yang telah dikemas rapi dan siap untuk dikirim ke seluruh Indonesia',
                'path_gambar' => 'gallery/durian-kemasan.jpg',
                'kategori' => 'proses',
                'urutan' => 7,
                'aktif' => true,
            ],
            [
                'judul' => 'Varietas Durian Bawor',
                'deskripsi' => 'Durian Bawor dengan cita rasa legit dan aroma yang sangat harum',
                'path_gambar' => 'gallery/durian-bawor.jpg',
                'kategori' => 'durian',
                'urutan' => 8,
                'aktif' => true,
            ],
            [
                'judul' => 'Area Persemaian',
                'deskripsi' => 'Nursery tempat pembenihan dan perawatan bibit durian unggul',
                'path_gambar' => 'gallery/persemaian.jpg',
                'kategori' => 'fasilitas',
                'urutan' => 9,
                'aktif' => true,
            ],
            [
                'judul' => 'Pemeriksaan Kualitas',
                'deskripsi' => 'Proses quality control untuk memastikan setiap durian memenuhi standar premium',
                'path_gambar' => 'gallery/quality-control.jpg',
                'kategori' => 'proses',
                'urutan' => 10,
                'aktif' => true,
            ],
        ];

        foreach ($galleries as $gallery) {
            Gallery::create($gallery);
        }
    }
}
