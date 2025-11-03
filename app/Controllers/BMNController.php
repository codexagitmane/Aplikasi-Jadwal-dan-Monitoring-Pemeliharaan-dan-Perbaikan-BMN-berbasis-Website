<?php

namespace App\Controllers;

use App\Models\BMNModel;

class BMNController extends BaseController
{
    public function index()
    {
        $model = new BMNModel();
        return view('bmn/index', [
            'pageTitle' => 'Data Barang Milik Negara',
            'items'     => $model->orderBy('created_at', 'DESC')->findAll(),
        ]);
    }

    public function create()
    {
        $model = new BMNModel();
        if ($this->request->getMethod() === 'post') {
            $rules = [
                'name'        => 'required|min_length[3]',
                'code'        => 'required|min_length[3]',
                'category'    => 'required',
                'location'    => 'required',
                'condition'   => 'required',
                'description' => 'permit_empty',
                'image'       => 'uploaded[image]|is_image[image]|max_size[image,2048]'
            ];

            if (! $this->validate($rules)) {
                return view('bmn/form', [
                    'pageTitle' => 'Tambah BMN',
                    'validation' => $this->validator,
                ]);
            }

            $image      = $this->request->getFile('image');
            $imageName  = $image && $image->isValid() ? $image->getRandomName() : null;

            if ($imageName) {
                $this->ensureUploadDirectory();
                $image->move(FCPATH . 'uploads', $imageName);
            }

            $model->insert([
                'name'        => $this->request->getPost('name'),
                'code'        => $this->request->getPost('code'),
                'category'    => $this->request->getPost('category'),
                'location'    => $this->request->getPost('location'),
                'condition'   => $this->request->getPost('condition'),
                'description' => $this->request->getPost('description'),
                'image'       => $imageName,
            ]);

            return redirect()->to('/bmn')->with('message', 'Data BMN berhasil ditambahkan.');
        }

        return view('bmn/form', [
            'pageTitle' => 'Tambah BMN',
        ]);
    }

    public function edit(int $id)
    {
        $model = new BMNModel();
        $item  = $model->find($id);

        if (! $item) {
            return redirect()->to('/bmn')->with('error', 'Data tidak ditemukan.');
        }

        if ($this->request->getMethod() === 'post') {
            $rules = [
                'name'        => 'required|min_length[3]',
                'code'        => 'required|min_length[3]',
                'category'    => 'required',
                'location'    => 'required',
                'condition'   => 'required',
                'description' => 'permit_empty',
                'image'       => 'if_exist|is_image[image]|max_size[image,2048]'
            ];

            if (! $this->validate($rules)) {
                return view('bmn/form', [
                    'pageTitle'  => 'Ubah BMN',
                    'validation' => $this->validator,
                    'item'       => $item,
                ]);
            }

            $image      = $this->request->getFile('image');
            $imageName  = $item['image'];

            if ($image && $image->isValid()) {
                $imageName = $image->getRandomName();
                $this->ensureUploadDirectory();
                $image->move(FCPATH . 'uploads', $imageName, true);
                if (! empty($item['image'])) {
                    $oldPath = FCPATH . 'uploads/' . $item['image'];
                    if (is_file($oldPath)) {
                        @unlink($oldPath);
                    }
                }
            }

            $model->update($id, [
                'name'        => $this->request->getPost('name'),
                'code'        => $this->request->getPost('code'),
                'category'    => $this->request->getPost('category'),
                'location'    => $this->request->getPost('location'),
                'condition'   => $this->request->getPost('condition'),
                'description' => $this->request->getPost('description'),
                'image'       => $imageName,
            ]);

            return redirect()->to('/bmn')->with('message', 'Data BMN berhasil diperbarui.');
        }

        return view('bmn/form', [
            'pageTitle' => 'Ubah BMN',
            'item'      => $item,
        ]);
    }

    public function delete(int $id)
    {
        $model = new BMNModel();
        $item = $model->find($id);
        if ($item && ! empty($item['image'])) {
            $path = FCPATH . 'uploads/' . $item['image'];
            if (is_file($path)) {
                @unlink($path);
            }
        }
        $model->delete($id);
        return redirect()->to('/bmn')->with('message', 'Data BMN berhasil dihapus.');
    }

    public function image(string $filename)
    {
        $path = FCPATH . 'uploads/' . $filename;
        if (! is_file($path)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        return service('response')->download($path, null);
    }

    private function ensureUploadDirectory(): void
    {
        $directory = FCPATH . 'uploads';
        if (! is_dir($directory)) {
            mkdir($directory, 0775, true);
        }
    }
}
