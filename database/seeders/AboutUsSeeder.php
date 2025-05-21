<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Card;

class AboutUsSeeder extends Seeder
{
    public function run()
    {
        Card::updateOrCreate(
            ['id' => 1],
            [
                'title' => 'Berikan yang<br>Terbaik untuk<br>Kesehatan Anda',
                'text' => 'Apotek Kami adalah tujuan utama Anda untuk kesehatan yang lebih baik. Kami menyediakan berbagai macam obat-obatan dan produk kesehatan dengan harga terjangkau dan layanan yang ramah.',
                'layout' => 'text-right',
                'image' => 'img/obat.png',  // pastikan file ini ada di public/img/
            ]
        );
    }
}
