<?php

namespace App\Controllers;

use App\Models\MaintenanceModel;
use App\Models\BMNModel;

class MaintenanceController extends BaseController
{
    public function index()
    {
        $model = new MaintenanceModel();
        return view('maintenance/index', [
            'pageTitle' => 'Jadwal Pemeliharaan',
            'items'     => $model->withBMN()->orderBy('scheduled_date', 'DESC')->findAll(),
        ]);
    }

    public function create()
    {
        $maintenanceModel = new MaintenanceModel();
        $bmnModel         = new BMNModel();

        if ($this->request->getMethod() === 'post') {
            $rules = [
                'bmn_id'        => 'required|integer',
                'title'         => 'required|min_length[3]',
                'scheduled_date'=> 'required|valid_date',
                'type'          => 'required|in_list[maintenance,repair]',
                'status'        => 'required',
                'description'   => 'permit_empty',
            ];

            if (! $this->validate($rules)) {
                return view('maintenance/form', [
                    'pageTitle'  => 'Tambah Jadwal',
                    'validation' => $this->validator,
                    'bmnItems'   => $bmnModel->findAll(),
                ]);
            }

            $maintenanceModel->insert([
                'bmn_id'        => (int) $this->request->getPost('bmn_id'),
                'title'         => $this->request->getPost('title'),
                'description'   => $this->request->getPost('description'),
                'scheduled_date'=> $this->request->getPost('scheduled_date'),
                'status'        => $this->request->getPost('status'),
                'type'          => $this->request->getPost('type'),
            ]);

            return redirect()->to('/maintenance')->with('message', 'Jadwal berhasil ditambahkan.');
        }

        return view('maintenance/form', [
            'pageTitle' => 'Tambah Jadwal',
            'bmnItems'  => $bmnModel->findAll(),
        ]);
    }

    public function edit(int $id)
    {
        $maintenanceModel = new MaintenanceModel();
        $item             = $maintenanceModel->find($id);

        if (! $item) {
            return redirect()->to('/maintenance')->with('error', 'Data tidak ditemukan.');
        }

        $bmnModel = new BMNModel();

        if ($this->request->getMethod() === 'post') {
            $rules = [
                'bmn_id'        => 'required|integer',
                'title'         => 'required|min_length[3]',
                'scheduled_date'=> 'required|valid_date',
                'type'          => 'required|in_list[maintenance,repair]',
                'status'        => 'required',
                'description'   => 'permit_empty',
            ];

            if (! $this->validate($rules)) {
                return view('maintenance/form', [
                    'pageTitle'  => 'Ubah Jadwal',
                    'validation' => $this->validator,
                    'bmnItems'   => $bmnModel->findAll(),
                    'item'       => $item,
                ]);
            }

            $maintenanceModel->update($id, [
                'bmn_id'        => (int) $this->request->getPost('bmn_id'),
                'title'         => $this->request->getPost('title'),
                'description'   => $this->request->getPost('description'),
                'scheduled_date'=> $this->request->getPost('scheduled_date'),
                'status'        => $this->request->getPost('status'),
                'type'          => $this->request->getPost('type'),
            ]);

            return redirect()->to('/maintenance')->with('message', 'Jadwal berhasil diperbarui.');
        }

        return view('maintenance/form', [
            'pageTitle' => 'Ubah Jadwal',
            'item'      => $item,
            'bmnItems'  => $bmnModel->findAll(),
        ]);
    }

    public function delete(int $id)
    {
        $model = new MaintenanceModel();
        $model->delete($id);
        return redirect()->to('/maintenance')->with('message', 'Jadwal berhasil dihapus.');
    }
}
