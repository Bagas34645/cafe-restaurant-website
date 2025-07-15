<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Content;

class ContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $contents = [
            // Hero Section - Home
            [
                'key' => 'home_hero_title',
                'title' => 'Judul Hero Home',
                'content' => 'Selamat Datang',
                'type' => 'text',
                'section' => 'home',
                'order' => 1,
                'is_active' => true
            ],
            [
                'key' => 'home_hero_subtitle',
                'title' => 'Subtitle Hero Home',
                'content' => 'Sentra Durian Tegal adalah pusat informasi dan distribusi durian unggulan langsung dari kebun terbaik di Tegal. Kami berkomitmen menyediakan durian berkualitas tinggi untuk konsumsi pribadi maupun kebutuhan bisnis Anda.',
                'type' => 'text',
                'section' => 'home',
                'order' => 2,
                'is_active' => true
            ],

            // Featured Products Section - Home
            [
                'key' => 'home_featured_title',
                'title' => 'Judul Produk Unggulan',
                'content' => 'Produk Durian Unggulan',
                'type' => 'text',
                'section' => 'home',
                'order' => 3,
                'is_active' => true
            ],
            [
                'key' => 'home_featured_subtitle',
                'title' => 'Subtitle Produk Unggulan',
                'content' => 'Temukan durian berkualitas terbaik dari kebun pilihan kami',
                'type' => 'text',
                'section' => 'home',
                'order' => 4,
                'is_active' => true
            ],

            // About Hero Section
            [
                'key' => 'about_hero_title',
                'title' => 'Judul Hero About',
                'content' => 'Tentang Kami',
                'type' => 'text',
                'section' => 'about',
                'order' => 1,
                'is_active' => true
            ],
            [
                'key' => 'about_hero_subtitle',
                'title' => 'Subtitle Hero About',
                'content' => 'Pelajari kisah kami sebagai pusat durian berkualitas terbaik di Tegal',
                'type' => 'text',
                'section' => 'about',
                'order' => 2,
                'is_active' => true
            ],

            // Our Story Section
            [
                'key' => 'about_story_title',
                'title' => 'Judul Kisah Kami',
                'content' => 'Kisah Kami',
                'type' => 'text',
                'section' => 'about',
                'order' => 3,
                'is_active' => true
            ],
            [
                'key' => 'about_story_content',
                'title' => 'Konten Kisah Kami',
                'content' => 'Didirikan dengan visi menjadi pusat distribusi durian terbaik di Tegal, Sentra Durian Tegal telah melayani masyarakat dengan komitmen kualitas dan kepuasan pelanggan selama bertahun-tahun. Dimulai dari kebun keluarga kecil, kami telah berkembang menjadi destinasi utama bagi pecinta durian yang mencari kualitas terbaik.',
                'type' => 'text',
                'section' => 'about',
                'order' => 4,
                'is_active' => true
            ],
            [
                'key' => 'about_story_image',
                'title' => 'Gambar Kisah Kami',
                'content' => 'images/durian-farm.jpg',
                'type' => 'image',
                'section' => 'about',
                'order' => 5,
                'is_active' => true
            ],

            // Mission Section
            [
                'key' => 'about_mission_title',
                'title' => 'Judul Misi Kami',
                'content' => 'Misi Kami',
                'type' => 'text',
                'section' => 'about',
                'order' => 6,
                'is_active' => true
            ],

            // Mission Cards
            [
                'key' => 'about_mission_quality_title',
                'title' => 'Judul Kualitas',
                'content' => 'Kualitas',
                'type' => 'feature',
                'section' => 'about',
                'order' => 7,
                'meta_data' => ['icon' => 'fas fa-seedling'],
                'is_active' => true
            ],
            [
                'key' => 'about_mission_quality_content',
                'title' => 'Konten Kualitas',
                'content' => 'Kami hanya menyediakan durian pilihan dari kebun terbaik dengan standar kualitas tinggi dan proses seleksi yang ketat.',
                'type' => 'feature',
                'section' => 'about',
                'order' => 8,
                'is_active' => true
            ],
            [
                'key' => 'about_mission_service_title',
                'title' => 'Judul Pelayanan',
                'content' => 'Pelayanan',
                'type' => 'feature',
                'section' => 'about',
                'order' => 9,
                'meta_data' => ['icon' => 'fas fa-handshake'],
                'is_active' => true
            ],
            [
                'key' => 'about_mission_service_content',
                'title' => 'Konten Pelayanan',
                'content' => 'Tim berpengalaman kami siap memberikan pelayanan terbaik dan konsultasi profesional untuk kebutuhan durian Anda.',
                'type' => 'feature',
                'section' => 'about',
                'order' => 10,
                'is_active' => true
            ],
            [
                'key' => 'about_mission_innovation_title',
                'title' => 'Judul Inovasi',
                'content' => 'Inovasi',
                'type' => 'feature',
                'section' => 'about',
                'order' => 11,
                'meta_data' => ['icon' => 'fas fa-lightbulb'],
                'is_active' => true
            ],
            [
                'key' => 'about_mission_innovation_content',
                'title' => 'Konten Inovasi',
                'content' => 'Kami terus berinovasi dalam teknik budidaya dan distribusi untuk memberikan pengalaman terbaik bagi pelanggan.',
                'type' => 'feature',
                'section' => 'about',
                'order' => 12,
                'is_active' => true
            ],

            // Contact Info
            [
                'key' => 'contact_hero_title',
                'title' => 'Judul Hero Kontak',
                'content' => 'Hubungi Kami',
                'type' => 'text',
                'section' => 'contact',
                'order' => 1,
                'is_active' => true
            ],
            [
                'key' => 'contact_hero_subtitle',
                'title' => 'Subtitle Hero Kontak',
                'content' => 'Kami siap membantu Anda dengan durian berkualitas terbaik. Hubungi kami untuk informasi lebih lanjut atau pemesanan.',
                'type' => 'text',
                'section' => 'contact',
                'order' => 2,
                'is_active' => true
            ],
            [
                'key' => 'contact_form_title',
                'title' => 'Judul Form Kontak',
                'content' => 'Kirim Pesan',
                'type' => 'text',
                'section' => 'contact',
                'order' => 3,
                'is_active' => true
            ],
            [
                'key' => 'contact_form_description',
                'title' => 'Deskripsi Form Kontak',
                'content' => 'Silakan isi form di bawah ini untuk menghubungi kami. Kami akan merespon dalam 24 jam.',
                'type' => 'text',
                'section' => 'contact',
                'order' => 4,
                'is_active' => true
            ],
            [
                'key' => 'contact_info_title',
                'title' => 'Judul Info Kontak',
                'content' => 'Informasi Kontak',
                'type' => 'text',
                'section' => 'contact',
                'order' => 5,
                'is_active' => true
            ],
            [
                'key' => 'contact_address',
                'title' => 'Alamat',
                'content' => 'Jl. Durian Raya No. 123, Tegal, Jawa Tengah 52124',
                'type' => 'text',
                'section' => 'contact',
                'order' => 6,
                'is_active' => true
            ],
            [
                'key' => 'contact_phone',
                'title' => 'Nomor Telepon',
                'content' => '+62 812-3456-7890',
                'type' => 'text',
                'section' => 'contact',
                'order' => 7,
                'is_active' => true
            ],
            [
                'key' => 'contact_email',
                'title' => 'Email',
                'content' => 'info@sentradurian-tegal.com',
                'type' => 'text',
                'section' => 'contact',
                'order' => 8,
                'is_active' => true
            ],
            [
                'key' => 'contact_hours',
                'title' => 'Jam Operasional',
                'content' => 'Senin - Sabtu: 08:00 - 17:00 WIB\nMinggu: 09:00 - 15:00 WIB',
                'type' => 'text',
                'section' => 'contact',
                'order' => 9,
                'is_active' => true
            ],

            // Footer
            [
                'key' => 'footer_description',
                'title' => 'Deskripsi Footer',
                'content' => 'Sentra Durian Tegal - Pusat durian berkualitas terbaik di Tegal. Melayani kebutuhan durian untuk konsumsi pribadi maupun bisnis.',
                'type' => 'text',
                'section' => 'footer',
                'order' => 1,
                'is_active' => true
            ]
        ];

        foreach ($contents as $content) {
            Content::create($content);
        }
    }
}
