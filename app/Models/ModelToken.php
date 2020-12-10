<?php namespace App\Models;

use CodeIgniter\Model;

class ModelToken extends Model
{
    protected $table = 'user_token';
    protected $primaryKey = 'id';

    protected $allowedFields = ['email', 'token', 'date_created'];

}