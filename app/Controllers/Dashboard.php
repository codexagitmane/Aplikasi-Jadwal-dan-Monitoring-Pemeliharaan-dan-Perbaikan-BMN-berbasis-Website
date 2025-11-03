<?php

namespace App\Controllers;

use App\Models\BMNModel;
use App\Models\MaintenanceModel;
use App\Models\RepairRequestModel;
use App\Models\UserModel;

class Dashboard extends BaseController
{
    public function index()
    {
        $bmnModel          = new BMNModel();
        $maintenanceModel  = new MaintenanceModel();
        $repairRequestModel = new RepairRequestModel();
        $userModel         = new UserModel();

        $maintenanceEvents = $maintenanceModel->findAll();
        $repairRequests    = $repairRequestModel->findAll();

        $events = array_map(static function ($item) {
            return [
                'title' => $item['title'] ?? $item['description'] ?? 'Kegiatan',
                'start' => $item['scheduled_date'],
                'className' => 'event-maintenance',
            ];
        }, $maintenanceEvents);

        foreach ($repairRequests as $request) {
            $events[] = [
                'title' => 'Perbaikan: ' . $request['title'],
                'start' => $request['requested_date'],
                'className' => 'event-repair',
            ];
        }

        $data = [
            'pageTitle'        => 'Dashboard',
            'bmnCount'         => $bmnModel->countAll(),
            'maintenanceCount' => $maintenanceModel->countAll(),
            'repairCount'      => $repairRequestModel->countAll(),
            'userCount'        => $userModel->countAll(),
            'events'           => $events,
            'latestRepairRequests' => $repairRequestModel->orderBy('created_at', 'DESC')->findAll(5),
            'upcomingMaintenances' => $maintenanceModel->orderBy('scheduled_date', 'ASC')->findAll(5),
        ];

        return view('dashboard/index', $data);
    }
}
