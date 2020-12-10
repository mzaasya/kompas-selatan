<?php namespace App\Models;

use CodeIgniter\Model;

class ModelPengumuman extends Model
{
    protected $table = 'pengumuman';
    protected $primaryKey = 'id';

    protected $allowedFields = ['pesan', 'created_at'];

}