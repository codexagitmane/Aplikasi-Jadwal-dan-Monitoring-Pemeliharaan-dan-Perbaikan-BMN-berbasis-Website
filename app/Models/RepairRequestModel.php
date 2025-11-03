<?php

namespace App\Models;

use CodeIgniter\Model;

class RepairRequestModel extends Model
{
    protected $table         = 'repair_requests';
    protected $primaryKey    = 'id';
    protected $returnType    = 'array';
    protected $allowedFields = [
        'bmn_id',
        'title',
        'description',
        'priority',
        'requested_date',
        'requested_by',
        'status',
        'notes',
        'created_at',
        'updated_at',
    ];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function withRelations()
    {
        return $this->select('repair_requests.*, bmn.name as bmn_name, users.name as requester_name, users.role as requester_role')
            ->join('bmn', 'bmn.id = repair_requests.bmn_id', 'left')
            ->join('users', 'users.id = repair_requests.requested_by', 'left');
    }
}
