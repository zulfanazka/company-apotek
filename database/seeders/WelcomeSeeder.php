<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Card;

class WelcomeSeeder extends Seeder
{
    public function run()
    {
        Card::updateOrCreate(
            ['id' => 1],
            [
                'title' => 'Berikan yang<br>Terbaik untuk<br>Kesehatan Anda',
                'text' => 'Apotek Kami adalah tujuan utama Anda untuk kesehatan yang lebih baik. Kami menyediakan berbagai macam obat-obatan dan produk kesehatan dengan harga terjangkau dan layanan yang ramah.',
                'layout' => 'text-right',
                'text_align' => 'left',  // contoh nilai default
                'fit_mode' => 'cover',   // contoh nilai default
                'position' => 0,
                'image' => 'storage/images/obat.png', // harus ada di public/img/obat.png
            ]
        );
    }
}
