<?php

namespace Database\Seeders;

use App\Models\Review;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $reviews = [
            [
                'customer_name' => 'Sari Widayanti',
                'customer_email' => 'sari.widayanti@email.com',
                'rating' => 5,
                'comment' => 'Sentra Durian Tegal benar-benar luar biasa! Duriannya segar langsung dari kebun, rasanya manis dan legit. Tempatnya nyaman untuk bersantai sambil menikmati es durian yang segar. Pelayanannya juga sangat ramah. Pasti akan kembali lagi!',
                'is_approved' => true,
            ],
            [
                'customer_name' => 'Budi Santoso',
                'customer_email' => 'budi.santoso@email.com',
                'rating' => 5,
                'comment' => 'Mantap sekali! Durian di sini kualitasnya premium, daging buahnya tebal dan manis. Saya juga beli bibit durian untuk ditanam di rumah. Pemiliknya sangat berpengalaman dan memberikan tips cara merawat bibit. Recommended banget!',
                'is_approved' => true,
            ],
            [
                'customer_name' => 'Dewi Lestari',
                'customer_email' => 'dewi.lestari@email.com',
                'rating' => 5,
                'comment' => 'Sebagai pecinta durian, saya sangat puas dengan kualitas durian di Sentra Durian Tegal. Es durian mereka segar banget, cocok untuk cuaca panas. Tempatnya bersih dan nyaman. Harga juga terjangkau untuk kualitas sebagus ini!',
                'is_approved' => true,
            ],
            [
                'customer_name' => 'Ahmad Wahyudi',
                'customer_email' => 'ahmad.wahyudi@email.com',
                'rating' => 4,
                'comment' => 'Tempat yang bagus untuk menikmati durian berkualitas. Pilihan duriannya beragam, dari yang lokal sampai varietas unggul. Saya beli untuk kebutuhan usaha, pelayanannya profesional dan bisa melayani pesanan dalam jumlah besar.',
                'is_approved' => true,
            ],
            [
                'customer_name' => 'Rina Puspitasari',
                'customer_email' => 'rina.puspitasari@email.com',
                'rating' => 5,
                'comment' => 'Sentra Durian Tegal memang yang terbaik! Duriannya langsung dari kebun terpilih, jadi freshness-nya terjaga. Es durian mereka juga enak banget, tidak terlalu manis dan porsinya pas. Anak-anak saya juga suka!',
                'is_approved' => true,
            ],
            [
                'customer_name' => 'Hendra Kurniawan',
                'customer_email' => 'hendra.kurniawan@email.com',
                'rating' => 4,
                'comment' => 'Durian berkualitas dengan harga yang wajar. Saya sudah beberapa kali beli di sini untuk acara keluarga. Pemiliknya ramah dan selalu membantu memilihkan durian yang terbaik. Cuma kadang antri agak lama kalau weekend.',
                'is_approved' => true,
            ],
            [
                'customer_name' => 'Maya Sari',
                'customer_email' => 'maya.sari@email.com',
                'rating' => 5,
                'comment' => 'Sangat puas dengan pelayanan dan kualitas produk di Sentra Durian Tegal. Bibit durian yang saya beli tumbuh dengan baik. Mereka juga kasih panduan lengkap cara perawatan. Tempatnya nyaman dan bersih untuk berkunjung bersama keluarga.',
                'is_approved' => true,
            ],
            [
                'customer_name' => 'Rizki Pratama',
                'customer_email' => 'rizki.pratama@email.com',
                'rating' => 5,
                'comment' => 'Sebagai distributor buah, saya sangat terkesan dengan sistem distribusi durian di Sentra Durian Tegal. Mereka menyediakan durian unggulan langsung dari kebun terbaik dengan kualitas konsisten. Partnership yang sangat menguntungkan!',
                'is_approved' => true,
            ],
        ];

        foreach ($reviews as $review) {
            Review::create($review);
        }
    }
}
