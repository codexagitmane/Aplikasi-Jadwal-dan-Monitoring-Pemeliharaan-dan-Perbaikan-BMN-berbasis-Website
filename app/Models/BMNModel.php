<?php

namespace App\Models;

use CodeIgniter\Model;

class BMNModel extends Model
{
    protected $table            = 'bmn';
    protected $primaryKey       = 'id';
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $allowedFields    = [
        'name',
        'code',
        'category',
        'location',
        'condition',
        'description',
        'image',
        'created_at',
        'updated_at',
    ];
    protected $useTimestamps    = true;
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';
}
