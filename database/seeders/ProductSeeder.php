<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CardProduct;

class ProductSeeder extends Seeder
{
    public function run()
    {
        CardProduct::updateOrCreate(
            ['id' => 1],
            [
                'title' => 'Semua Obat yang Anda Butuhkan, Ada di Sini',
                'text' => 'Jaminan Ketersediaan Obat yang Lengkap Setiap Saat',
                'layout' => 'text-only',
                'text_align' => 'center',
                'image' => null,
                'fit_mode' => 'contain',
                'position' => 1,
            ]
        );
    }
}
