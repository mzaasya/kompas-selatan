<?php namespace App\Models;

use CodeIgniter\Model;

class ModelPesan extends Model
{
    protected $table = 'pesan';
    protected $primaryKey = 'id';

    protected $allowedFields = ['pesan', 'created_for', 'created_by', 'created_at', 'status'];

}