<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class DetailedProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'Durian Musang King Premium',
                'sku' => 'DUR-MSK-001',
                'description' => 'Durian Musang King berkualitas premium dengan daging tebal dan rasa yang creamy.',
                'detailed_description' => "Durian Musang King adalah varietas durian paling terkenal di Asia Tenggara. Buah ini memiliki ciri khas daging berwarna kuning keemasan yang tebal dan tekstur yang sangat creamy. Rasanya manis dengan sedikit pahit yang khas, menciptakan kombinasi rasa yang unik dan menggugah selera.\n\nBuah ini dipanen pada saat yang tepat untuk memastikan kematangan optimal. Setiap buah dipilih secara selektif untuk memastikan kualitas terbaik bagi pelanggan kami.",
                'price' => 150000,
                'discount_price' => 135000,
                'stock_quantity' => 25,
                'weight' => 2500, // 2.5 kg
                'origin' => 'Tegal, Jawa Tengah',
                'care_instructions' => "• Simpan pada suhu ruang (25-30°C)\n• Hindari paparan sinar matahari langsung\n• Konsumsi dalam 2-3 hari setelah matang\n• Jangan simpan di lemari es sebelum matang\n• Buah matang ditandai dengan aroma khas dan sedikit lunak saat ditekan",
                'category' => 'durian',
                'specifications' => [
                    'varietas' => 'Musang King',
                    'grade' => 'Premium A',
                    'ukuran' => 'Sedang - Besar',
                    'tingkat_kematangan' => '80-90%',
                    'jumlah_isi' => '4-6 ruang',
                    'masa_simpan' => '3-5 hari'
                ],
                'is_available' => true,
                'is_featured' => true,
                'harvest_date' => now()->subDays(2),
                'image_path' => null // You can add image later
            ],
            [
                'name' => 'Durian Montong Jumbo',
                'sku' => 'DUR-MTG-002',
                'description' => 'Durian Montong ukuran jumbo dengan rasa manis dan daging yang lembut.',
                'detailed_description' => "Durian Montong adalah varietas durian yang populer karena ukurannya yang besar dan rasanya yang manis. Berbeda dengan Musang King, Montong memiliki rasa yang lebih manis tanpa rasa pahit, membuatnya cocok untuk pemula yang ingin mencoba durian.\n\nBuah ini memiliki daging berwarna kuning pucat hingga kuning muda dengan tekstur yang lembut dan creamy. Aroma khasnya tidak terlalu kuat dibanding varietas lain.",
                'price' => 120000,
                'stock_quantity' => 18,
                'weight' => 3000, // 3 kg
                'origin' => 'Tegal, Jawa Tengah',
                'care_instructions' => "• Simpan pada suhu ruang hingga matang\n• Dapat disimpan di lemari es setelah matang untuk memperlambat proses pembusukan\n• Konsumsi dalam 3-4 hari setelah matang\n• Buah matang ditandai dengan retakan kecil pada kulit",
                'category' => 'durian',
                'specifications' => [
                    'varietas' => 'Montong',
                    'grade' => 'Grade A',
                    'ukuran' => 'Jumbo',
                    'tingkat_kematangan' => '75-85%',
                    'jumlah_isi' => '6-8 ruang',
                    'masa_simpan' => '4-6 hari'
                ],
                'is_available' => true,
                'is_featured' => false,
                'harvest_date' => now()->subDays(1),
                'image_path' => null
            ],
            [
                'name' => 'Bibit Durian Musang King',
                'sku' => 'BBT-MSK-003',
                'description' => 'Bibit durian Musang King unggul, siap tanam dengan tinggi 50-70cm.',
                'detailed_description' => "Bibit durian Musang King berkualitas tinggi yang diperbanyak secara vegetatif (sambung pucuk) untuk memastikan genetik yang sama dengan induknya. Bibit ini sudah berumur 12-18 bulan dan siap untuk ditanam di lahan permanen.\n\nSetiap bibit telah melalui proses seleksi ketat dan perawatan intensif di nursery kami. Bibit dilengkapi dengan media tanam yang sesuai dan petunjuk perawatan lengkap.",
                'price' => 75000,
                'stock_quantity' => 50,
                'weight' => 1500, // 1.5 kg (termasuk pot dan media)
                'origin' => 'Nursery Tegal',
                'care_instructions' => "• Siram secukupnya, jangan sampai tergenang\n• Letakkan di tempat yang terkena sinar matahari pagi\n• Berikan pupuk organik setiap 2 minggu\n• Pindah ke pot yang lebih besar setelah 6 bulan\n• Tanam di lahan permanen setelah tinggi 1 meter",
                'category' => 'bibit',
                'specifications' => [
                    'varietas' => 'Musang King',
                    'umur_bibit' => '12-18 bulan',
                    'tinggi' => '50-70 cm',
                    'diameter_batang' => '1-1.5 cm',
                    'metode_perbanyakan' => 'Sambung pucuk',
                    'ukuran_pot' => '20cm x 25cm',
                    'masa_berbuah' => '3-5 tahun'
                ],
                'is_available' => true,
                'is_featured' => true,
                'harvest_date' => null,
                'image_path' => null
            ],
            [
                'name' => 'Keripik Durian Original',
                'sku' => 'MKN-KRP-004',
                'description' => 'Keripik durian asli Tegal dengan rasa original, renyah dan gurih.',
                'detailed_description' => "Keripik durian yang dibuat dari durian pilihan dengan proses pengolahan higienis. Diproduksi dengan teknologi vacuum frying yang mempertahankan nutrisi dan rasa asli durian sambil menciptakan tekstur yang renyah.\n\nTanpa pengawet buatan dan menggunakan minyak kelapa murni untuk proses penggorengan. Dikemas dalam kemasan kedap udara untuk menjaga kerenyahan.",
                'price' => 25000,
                'stock_quantity' => 100,
                'weight' => 150, // 150 gram
                'origin' => 'Tegal, Jawa Tengah',
                'care_instructions' => "• Simpan dalam kemasan tertutup rapat\n• Hindari paparan sinar matahari langsung\n• Jauhkan dari tempat lembab\n• Konsumsi dalam 3 bulan setelah kemasan dibuka\n• Simpan di tempat sejuk dan kering",
                'category' => 'makanan',
                'specifications' => [
                    'berat_bersih' => '150 gram',
                    'bahan_utama' => 'Durian, Minyak Kelapa',
                    'tanpa_pengawet' => 'Ya',
                    'halal' => 'Bersertifikat',
                    'kemasan' => 'Standing Pouch',
                    'masa_kadaluarsa' => '6 bulan'
                ],
                'is_available' => true,
                'is_featured' => false,
                'harvest_date' => null,
                'image_path' => null
            ],
            [
                'name' => 'Jus Durian Segar',
                'sku' => 'MNM-JUS-005',
                'description' => 'Jus durian segar tanpa pemanis buatan, dibuat dari durian premium.',
                'detailed_description' => "Jus durian segar yang dibuat langsung dari daging durian Musang King premium. Diproses dengan teknologi cold press untuk mempertahankan nutrisi dan rasa asli durian. Tanpa tambahan gula, pengawet, atau pewarna buatan.\n\nSetiap botol mengandung daging durian setara dengan 1-2 ruang durian utuh. Cocok untuk Anda yang ingin menikmati durian dalam bentuk yang praktis dan segar.",
                'price' => 35000,
                'stock_quantity' => 30,
                'weight' => 500, // 500ml
                'origin' => 'Tegal, Jawa Tengah',
                'care_instructions' => "• Simpan dalam lemari es pada suhu 2-8°C\n• Konsumsi maksimal 3 hari setelah kemasan dibuka\n• Kocok sebelum diminum\n• Jangan dibekukan\n• Segera konsumsi setelah dibuka",
                'category' => 'minuman',
                'specifications' => [
                    'volume' => '500ml',
                    'bahan_utama' => 'Durian Musang King 80%, Air mineral 20%',
                    'tanpa_gula_tambahan' => 'Ya',
                    'tanpa_pengawet' => 'Ya',
                    'kemasan' => 'Botol kaca',
                    'masa_simpan' => '5 hari (dalam lemari es)'
                ],
                'is_available' => true,
                'is_featured' => false,
                'harvest_date' => now()->subDays(1),
                'image_path' => null
            ],
            [
                'name' => 'Durian Bawor Super',
                'sku' => 'DUR-BWR-006',
                'description' => 'Durian Bawor asli Banyumas dengan ukuran besar dan rasa khas.',
                'detailed_description' => "Durian Bawor adalah varietas lokal Indonesia yang berasal dari Banyumas, Jawa Tengah. Memiliki ciri khas kulit berduri panjang dan tajam, dengan daging buah berwarna orange kekuningan. Rasanya unik dengan perpaduan manis, sedikit pahit, dan aroma yang sangat khas.\n\nDurian ini dikenal sebagai salah satu varietas terenak di Indonesia dan mulai populer di kalangan pecinta durian. Ukurannya besar dengan isi yang banyak dan daging yang tebal.",
                'price' => 180000,
                'discount_price' => 160000,
                'stock_quantity' => 12,
                'weight' => 3500, // 3.5 kg
                'origin' => 'Banyumas, Jawa Tengah',
                'care_instructions' => "• Simpan pada suhu ruang hingga matang\n• Proses pematangan 2-4 hari setelah dipetik\n• Buah matang ditandai dengan suara bergetar saat dikocok\n• Konsumsi segera setelah matang\n• Aroma khas akan tercium saat buah sudah matang",
                'category' => 'durian',
                'specifications' => [
                    'varietas' => 'Bawor',
                    'grade' => 'Super',
                    'ukuran' => 'Besar',
                    'tingkat_kematangan' => '70-80%',
                    'jumlah_isi' => '5-7 ruang',
                    'masa_simpan' => '3-4 hari'
                ],
                'is_available' => true,
                'is_featured' => true,
                'harvest_date' => now(),
                'image_path' => null
            ]
        ];

        foreach ($products as $productData) {
            Product::create($productData);
        }
    }
}
