<?php

namespace App\Controllers;

use App\Models\RepairRequestModel;
use App\Models\BMNModel;
use App\Models\UserModel;
use App\Models\RepairSignatureModel;

class RepairRequestController extends BaseController
{
    public function index()
    {
        $model = new RepairRequestModel();
        return view('repair_requests/index', [
            'pageTitle' => 'Permohonan Perbaikan BMN',
            'items'     => $model->withRelations()->orderBy('created_at', 'DESC')->findAll(),
        ]);
    }

    public function create()
    {
        $bmnModel  = new BMNModel();
        $userModel = new UserModel();
        $model     = new RepairRequestModel();

        if ($this->request->getMethod() === 'post') {
            $rules = [
                'bmn_id'         => 'required|integer',
                'title'          => 'required|min_length[3]',
                'description'    => 'required',
                'priority'       => 'required|in_list[rendah,sedang,tinggi]',
                'requested_date' => 'required|valid_date',
                'requested_by'   => 'required|integer',
                'status'         => 'required',
            ];

            if (! $this->validate($rules)) {
                return view('repair_requests/form', [
                    'pageTitle'  => 'Permohonan Baru',
                    'validation' => $this->validator,
                    'bmnItems'   => $bmnModel->findAll(),
                    'users'      => $userModel->findAll(),
                ]);
            }

            $model->insert([
                'bmn_id'         => (int) $this->request->getPost('bmn_id'),
                'title'          => $this->request->getPost('title'),
                'description'    => $this->request->getPost('description'),
                'priority'       => $this->request->getPost('priority'),
                'requested_date' => $this->request->getPost('requested_date'),
                'requested_by'   => (int) $this->request->getPost('requested_by'),
                'status'         => $this->request->getPost('status'),
                'notes'          => $this->request->getPost('notes'),
            ]);

            return redirect()->to('/repair-requests')->with('message', 'Permohonan berhasil dibuat.');
        }

        return view('repair_requests/form', [
            'pageTitle' => 'Permohonan Baru',
            'bmnItems'  => $bmnModel->findAll(),
            'users'     => $userModel->findAll(),
        ]);
    }

    public function edit(int $id)
    {
        $model = new RepairRequestModel();
        $item  = $model->find($id);

        if (! $item) {
            return redirect()->to('/repair-requests')->with('error', 'Data tidak ditemukan.');
        }

        $bmnModel  = new BMNModel();
        $userModel = new UserModel();

        if ($this->request->getMethod() === 'post') {
            $rules = [
                'bmn_id'         => 'required|integer',
                'title'          => 'required|min_length[3]',
                'description'    => 'required',
                'priority'       => 'required|in_list[rendah,sedang,tinggi]',
                'requested_date' => 'required|valid_date',
                'requested_by'   => 'required|integer',
                'status'         => 'required',
            ];

            if (! $this->validate($rules)) {
                return view('repair_requests/form', [
                    'pageTitle'  => 'Ubah Permohonan',
                    'validation' => $this->validator,
                    'bmnItems'   => $bmnModel->findAll(),
                    'users'      => $userModel->findAll(),
                    'item'       => $item,
                ]);
            }

            $model->update($id, [
                'bmn_id'         => (int) $this->request->getPost('bmn_id'),
                'title'          => $this->request->getPost('title'),
                'description'    => $this->request->getPost('description'),
                'priority'       => $this->request->getPost('priority'),
                'requested_date' => $this->request->getPost('requested_date'),
                'requested_by'   => (int) $this->request->getPost('requested_by'),
                'status'         => $this->request->getPost('status'),
                'notes'          => $this->request->getPost('notes'),
            ]);

            return redirect()->to('/repair-requests')->with('message', 'Permohonan berhasil diperbarui.');
        }

        return view('repair_requests/form', [
            'pageTitle' => 'Ubah Permohonan',
            'item'      => $item,
            'bmnItems'  => $bmnModel->findAll(),
            'users'     => $userModel->findAll(),
        ]);
    }

    public function delete(int $id)
    {
        $model = new RepairRequestModel();
        $model->delete($id);
        return redirect()->to('/repair-requests')->with('message', 'Permohonan berhasil dihapus.');
    }

    public function show(int $id)
    {
        $model = new RepairRequestModel();
        $item  = $model->withRelations()->find($id);

        if (! $item) {
            return redirect()->to('/repair-requests')->with('error', 'Data tidak ditemukan.');
        }

        $signatureModel = new RepairSignatureModel();

        $currentUser = current_user();
        $hasSigned   = false;

        if ($currentUser) {
            $hasSigned = (new RepairSignatureModel())
                ->where('repair_request_id', $id)
                ->where('user_id', $currentUser['id'])
                ->first() !== null;
        }

        return view('repair_requests/detail', [
            'pageTitle'  => 'Detail Permohonan',
            'item'       => $item,
            'signatures' => $signatureModel->withUser()->where('repair_request_id', $id)->orderBy('created_at', 'ASC')->findAll(),
            'hasSigned'  => $hasSigned,
        ]);
    }

    public function print(int $id)
    {
        $model = new RepairRequestModel();
        $item  = $model->withRelations()->find($id);

        if (! $item) {
            return redirect()->to('/repair-requests')->with('error', 'Data tidak ditemukan.');
        }

        $signatureModel = new RepairSignatureModel();

        return view('repair_requests/print', [
            'pageTitle'  => 'Cetak Permohonan',
            'item'       => $item,
            'signatures' => $signatureModel->withUser()->where('repair_request_id', $id)->orderBy('created_at', 'ASC')->findAll(),
        ]);
    }

    public function sign(int $id)
    {
        $model     = new RepairRequestModel();
        $item      = $model->withRelations()->find($id);
        $user      = current_user();

        if (! $item) {
            return redirect()->to('/repair-requests')->with('error', 'Data tidak ditemukan.');
        }

        if (! $user || $user['role'] === 'admin') {
            return redirect()->to('/repair-requests/detail/' . $id)->with('error', 'Anda tidak dapat menandatangani permohonan ini.');
        }

        $signatureModel = new RepairSignatureModel();

        $existingSignature = $signatureModel
            ->where('repair_request_id', $id)
            ->where('user_id', $user['id'])
            ->first();

        if ($existingSignature) {
            return redirect()->to('/repair-requests/detail/' . $id)->with('error', 'Anda sudah menandatangani permohonan ini.');
        }

        if ($this->request->getMethod() === 'post') {
            $rules = [
                'signature' => 'required|min_length[3]',
            ];

            if (! $this->validate($rules)) {
                return view('repair_requests/sign', [
                    'pageTitle'  => 'Tanda Tangan Permohonan',
                    'validation' => $this->validator,
                    'item'       => $item,
                ]);
            }

            $signatureModel->insert([
                'repair_request_id' => $id,
                'user_id'           => $user['id'],
                'role'              => $user['role'],
                'signature'         => trim((string) $this->request->getPost('signature')),
            ]);

            return redirect()->to('/repair-requests/detail/' . $id)->with('message', 'Permohonan berhasil ditandatangani.');
        }

        return view('repair_requests/sign', [
            'pageTitle' => 'Tanda Tangan Permohonan',
            'item'      => $item,
        ]);
    }
}
