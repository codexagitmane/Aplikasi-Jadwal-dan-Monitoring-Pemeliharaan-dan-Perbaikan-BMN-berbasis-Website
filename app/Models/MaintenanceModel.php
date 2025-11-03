<?php

namespace App\Models;

use CodeIgniter\Model;

class MaintenanceModel extends Model
{
    protected $table          = 'maintenance_schedules';
    protected $primaryKey     = 'id';
    protected $returnType     = 'array';
    protected $allowedFields  = [
        'bmn_id',
        'title',
        'description',
        'scheduled_date',
        'status',
        'type',
        'created_at',
        'updated_at',
    ];
    protected $useTimestamps  = true;
    protected $createdField   = 'created_at';
    protected $updatedField   = 'updated_at';

    public function withBMN()
    {
        return $this->select('maintenance_schedules.*, bmn.name as bmn_name, bmn.code as bmn_code')
            ->join('bmn', 'bmn.id = maintenance_schedules.bmn_id', 'left');
    }
}
