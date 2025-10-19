<?php

namespace App\Models;

use CodeIgniter\Model;

class BarangModel extends Model
{
    protected $table            = 'barang';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $protectFields    = true;
    protected $allowedFields    = ['id_kategori' , 'id_lokasi' , 'nama_barang' , 'kode_barang' , 'merk' , 'tahun_perolehan' , 'kondisi' , 'gambar' , 'dokumen_bast' , 'qr_code' , 'keterangan' , 'created_at', 'updated_at'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';


}
