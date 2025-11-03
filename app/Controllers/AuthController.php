<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class AuthController extends BaseController
{
    public function login()
    {
        $session = session();

        if ($this->request->getMethod() === 'post') {
            $validationRules = [
                'username' => 'required',
                'password' => 'required'
            ];

            if (! $this->validate($validationRules)) {
                return view('auth/login', [
                    'validation' => $this->validator,
                ]);
            }

            $userModel = new UserModel();
            $user      = $userModel->where('username', $this->request->getPost('username'))->first();

            if (! $user || ! password_verify((string) $this->request->getPost('password'), $user['password_hash'])) {
                return redirect()->back()->with('error', 'Username atau password salah.');
            }

            unset($user['password_hash']);

            $session->set([
                'isLoggedIn' => true,
                'user_id'    => $user['id'],
                'role'       => $user['role'],
                'user'       => $user,
            ]);

            return redirect()->to('/dashboard');
        }

        return view('auth/login', ['pageTitle' => 'Masuk']);
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login')->with('message', 'Anda telah keluar.');
    }
}
