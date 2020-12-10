<?php namespace App\Models;

use CodeIgniter\Model;

class ModelKegiatan extends Model
{
    protected $table = 'kegiatan';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'judul', 'deskripsi', 'tujuan', 'titik_kumpul',
        'tanggal', 'jam', 'biaya', 'gambar', 'gambar1', 'gambar2',
        'gambar3', 'created_at', 'created_by', 'updated_at'
    ];

}