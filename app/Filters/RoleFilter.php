<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class RoleFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();
        if (! $session->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $allowedRoles = $arguments ?? [];
        $userRole     = $session->get('role');

        if (! in_array($userRole, $allowedRoles, true)) {
            return redirect()->to('/dashboard')->with('error', 'Anda tidak memiliki akses ke fitur ini.');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        //
    }
}
