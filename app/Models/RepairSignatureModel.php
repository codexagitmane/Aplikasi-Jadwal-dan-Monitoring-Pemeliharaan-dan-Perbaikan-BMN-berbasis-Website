<?php

namespace App\Models;

use CodeIgniter\Model;

class RepairSignatureModel extends Model
{
    protected $table         = 'repair_signatures';
    protected $primaryKey    = 'id';
    protected $returnType    = 'array';
    protected $allowedFields = [
        'repair_request_id',
        'user_id',
        'role',
        'signature',
        'created_at',
        'updated_at',
    ];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function withUser()
    {
        return $this->select('repair_signatures.*, users.name as signer_name')
            ->join('users', 'users.id = repair_signatures.user_id', 'left');
    }
}
