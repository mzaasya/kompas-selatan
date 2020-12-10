<?php namespace App\Models;

use CodeIgniter\Model;

class ModelUser extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'name', 'email', 'password', 'image', 'birth', 'address', 
        'phone', 'is_active', 'created_at', 'updated_at'
    ];

    protected $useTimeStamps = 'true';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
}