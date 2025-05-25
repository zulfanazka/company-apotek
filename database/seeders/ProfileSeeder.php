<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CardProfile;

class ProfileSeeder extends Seeder
{
    public function run()
    {
        CardProfile::updateOrCreate(
            ['id' => 1],
            [
                'title' => 'APOTEK RAJAWALI',
                'text' => 'Apotek Sehat Sentosa berdiri sejak tahun 2005 dan telah melayani kebutuhan kesehatan masyarakat dengan komitmen dan dedikasi tinggi. Kami menyediakan berbagai macam obat-obatan resep, obat bebas, suplemen, serta produk kesehatan lainnya. Dengan lokasi yang strategis dan jam operasional yang panjang, kami hadir untuk memudahkan akses masyarakat terhadap kebutuhan kesehatan. Apotek Sehat Sentosa berdiri sejak tahun 2005 dan telah melayani kebutuhan kesehatan masyarakat dengan komitmen dan dedikasi tinggi. Kami menyediakan berbagai macam obat-obatan resep, obat bebas, suplemen, serta produk kesehatan lainnya. Dengan lokasi yang strategis dan jam operasional yang panjang, kami hadir untuk memudahkan akses masyarakat terhadap kebutuhan kesehatan.',
                'layout' => 'text-only',
                'text_align' => 'center',
                'image' => null,
                'fit_mode' => 'contain',
                'position' => 1,
            ]
        );
    }
}
