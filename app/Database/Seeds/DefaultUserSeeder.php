<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DefaultUserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name'          => 'Administrator',
                'username'      => 'admin',
                'email'         => 'admin@example.com',
                'role'          => 'admin',
                'password_hash' => password_hash('admin123', PASSWORD_DEFAULT),
            ],
            [
                'name'          => 'Pengelola BMN',
                'username'      => 'pengelola',
                'email'         => 'pengelola@example.com',
                'role'          => 'pengelola_bmn',
                'password_hash' => password_hash('pengelola123', PASSWORD_DEFAULT),
            ],
            [
                'name'          => 'Kasubag TU',
                'username'      => 'kasubag',
                'email'         => 'kasubag@example.com',
                'role'          => 'kasubag_tu',
                'password_hash' => password_hash('kasubag123', PASSWORD_DEFAULT),
            ],
            [
                'name'          => 'Pegawai',
                'username'      => 'pegawai',
                'email'         => 'pegawai@example.com',
                'role'          => 'pegawai',
                'password_hash' => password_hash('pegawai123', PASSWORD_DEFAULT),
            ],
        ];

        $this->db->table('users')->insertBatch($data);
    }
}
