<?php

namespace App\Controllers;

use App\Models\UserModel;

class UserController extends BaseController
{
    public function index()
    {
        $model = new UserModel();
        return view('users/index', [
            'pageTitle' => 'Manajemen Pengguna',
            'users'     => $model->orderBy('name', 'ASC')->findAll(),
        ]);
    }

    public function create()
    {
        $model = new UserModel();

        if ($this->request->getMethod() === 'post') {
            $rules = [
                'name'     => 'required|min_length[3]',
                'username' => 'required|min_length[3]|is_unique[users.username]',
                'email'    => 'required|valid_email',
                'role'     => 'required|in_list[admin,pengelola_bmn,kasubag_tu,pegawai]',
                'password' => 'required|min_length[6]'
            ];

            if (! $this->validate($rules)) {
                return view('users/form', [
                    'pageTitle'  => 'Tambah Pengguna',
                    'validation' => $this->validator,
                ]);
            }

            $model->insert([
                'name'          => $this->request->getPost('name'),
                'username'      => $this->request->getPost('username'),
                'email'         => $this->request->getPost('email'),
                'role'          => $this->request->getPost('role'),
                'password_hash' => password_hash((string) $this->request->getPost('password'), PASSWORD_DEFAULT),
            ]);

            return redirect()->to('/users')->with('message', 'Pengguna berhasil dibuat.');
        }

        return view('users/form', [
            'pageTitle' => 'Tambah Pengguna',
        ]);
    }

    public function edit(int $id)
    {
        $model = new UserModel();
        $user  = $model->find($id);

        if (! $user) {
            return redirect()->to('/users')->with('error', 'Pengguna tidak ditemukan.');
        }

        if ($this->request->getMethod() === 'post') {
            $rules = [
                'name'     => 'required|min_length[3]',
                'email'    => 'required|valid_email',
                'role'     => 'required|in_list[admin,pengelola_bmn,kasubag_tu,pegawai]',
            ];

            if ($this->request->getPost('password')) {
                $rules['password'] = 'min_length[6]';
            }

            if (! $this->validate($rules)) {
                return view('users/form', [
                    'pageTitle'  => 'Ubah Pengguna',
                    'validation' => $this->validator,
                    'user'       => $user,
                ]);
            }

            $updateData = [
                'name' => $this->request->getPost('name'),
                'email'=> $this->request->getPost('email'),
                'role' => $this->request->getPost('role'),
            ];

            if ($password = $this->request->getPost('password')) {
                $updateData['password_hash'] = password_hash((string) $password, PASSWORD_DEFAULT);
            }

            $model->update($id, $updateData);

            return redirect()->to('/users')->with('message', 'Pengguna berhasil diperbarui.');
        }

        return view('users/form', [
            'pageTitle' => 'Ubah Pengguna',
            'user'      => $user,
        ]);
    }

    public function delete(int $id)
    {
        $model = new UserModel();
        $model->delete($id);
        return redirect()->to('/users')->with('message', 'Pengguna berhasil dihapus.');
    }
}
