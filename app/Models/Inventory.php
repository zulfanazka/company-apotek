<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Inventory extends Model
{
    use HasFactory;

    protected $connection = 'mysql2'; // koneksi database proyek inventaris
    protected $table = 'inventory';
    protected $primaryKey = 'id_barang';

    public $timestamps = false;
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_barang', 'nama_barang', 'kategori', 'satuan', 
        'tanggal_masuk', 'tanggal_keluar', 'harga_beli', 
        'harga_jual', 'stok', 'jumlah_keluar', 'keterangan'
    ];
}
