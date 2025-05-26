<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    // Menentukan kolom-kolom mana yang boleh diisi melalui mass assignment
    protected $fillable = [
        'name',       // Kolom nama lokasi
        'latitude',   // Kolom latitude
        'longitude',
        'alamat',  // Kolom longitude
    ];

    // Jika kamu ingin menambahkan validasi timestamp atau pengaturan lainnya, bisa diatur di sini
    // public $timestamps = false; // jika tidak menggunakan timestamp
}
