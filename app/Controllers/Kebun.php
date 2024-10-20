<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KebunModel;

class Kebun extends BaseController
{
    public function index()
    {
    }

    public function show($id)
    {
        // id = id petani

        //id untuk table kebun
        $kebunModel = new KebunModel();
        $dataKebun = $kebunModel->where('id_petani', $id)->findAll();
        $responKebun = [];
        foreach ($dataKebun as $row) {
            $responKebun[] = [
                'id' => $row['id'],
                'id_petani' => $row['id_petani'],
                'nama' => $row['nama'],
                'alamat' => $row['alamat'],
                'gambar' => base_url('gambar_kebun/' . $row['gambar']),
            ];
        }
        $hasil = [
            'data_kebun' => $responKebun
        ];
        return $this->response->setJSON($hasil);
    }

    public function addKebun($id)
    {
        // id = id petani
        $kebunModel = new KebunModel();

        $validation = \Config\Services::validation();
        $validation->setRules([
            'nama' => 'required',
            'alamat' => 'required',
            'gambar' => 'uploaded[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/png]|max_size[gambar,5120]',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            // Jika validasi gagal, kembalikan pesan kesalahan
            $response = [
                'status' => '400',
                'error' => $validation->getErrors(),
                'message' => [
                    'failed' => 'Data tidak valid'
                ]
            ];
            return $this->response->setJSON($response, 400);
        }

        $id_kebun_sebelum = $kebunModel->getLastId();
        $id_kebun = $kebunModel->getNextId($id_kebun_sebelum);

        $gambar = $this->request->getFile('gambar');
        $nama_gambar = $gambar->getRandomName();
        $gambar->move('gambar_kebun', $nama_gambar);

        $data = [
            'id' => $id_kebun,
            'id_petani' => $id,
            'nama' => esc($this->request->getVar('nama')),
            'alamat' => esc($this->request->getVar('alamat')),
            'gambar' => $nama_gambar,
        ];
        $kebunModel->insert($data);

        $response = [
            'status' => '201',
            'error' => 'null',
            'data' => $data,
            'message' => [
                'success' => 'Data kebun berhasil ditambahkan'
            ]
        ];

        return $this->response->setStatusCode(201)->setJSON($response);
    }

    public function edit($id)
    {
        // $id = id kebun

        $kebunModel = new KebunModel();

        $gambar_baru = $this->request->getFile('gambar_baru');

        // Validasi input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'nama' => 'required',
            'alamat' => 'required',
        ]);

        if ($gambar_baru != null) {
            $validation->setRules([
                'nama' => 'required',
                'alamat' => 'required',
                'gambar_baru' => 'uploaded[gambar_baru]|mime_in[gambar_baru,image/jpg,image/jpeg,image/png]|max_size[gambar_baru,5120]',
            ]);
        }

        if (!$validation->withRequest($this->request)->run()) {
            // Jika validasi gagal, kembalikan pesan kesalahan
            $response = [
                'status' => '400',
                'error' => $validation->getErrors(),
                'message' => [
                    'failed' => 'Data tidak valid'
                ]
            ];
            return $this->response->setStatusCode(400)->setJSON($response, 400);
        }

        // update

        if ($gambar_baru) {
            $nama_gambar_baru = $gambar_baru->getRandomName();
            $gambar_baru->move('gambar_kebun', $nama_gambar_baru);

            // Hapus foto lama
            if (!empty(esc($this->request->getVar('gambar_lama')))) {
                $path_gambar_lama = 'gambar_kebun/' . esc($this->request->getVar('gambar_lama'));
                if (file_exists($path_gambar_lama)) {
                    unlink($path_gambar_lama);
                }
            }
            $data = [
                'gambar' => $nama_gambar_baru,
                'nama' => esc($this->request->getVar('nama')),
                'alamat' => esc($this->request->getVar('alamat')),
            ];
        } else {
            $data = [
                'gambar' => esc($this->request->getVar('gambar_lama')),
                'nama' => esc($this->request->getVar('nama')),
                'alamat' => esc($this->request->getVar('alamat')),
            ];
        }

        $kebunModel->update($id, $data);

        $response = [
            'data_baru' => $data,
            'status' => 200,
            'error' => null,
            'messages' => [
                'success' => 'Data kebun berhasil diubah'
            ]
        ];
        return $this->response->setStatusCode(200)->setJSON($response);
    }

    public function delete($id)
    {
        // $id = id kebun
        $kebunModel = new KebunModel();

        // hapus gambar
        $path = 'gambar_kebun/' . $kebunModel->getImage($id)['gambar'];
        if (file_exists($path)) {
            unlink($path);
        }

        // hapus data kebun
        $kebunModel->where('id', $id)->delete();

        $response = [
            'status' => 200,
            'error' => null,
            'messages' => [
                'success' => 'Data kebun berhasil dihapus'
            ]
        ];
        return $this->response->setStatusCode(200)->setJSON($response);
    }
}
