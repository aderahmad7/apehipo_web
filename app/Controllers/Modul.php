<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModulModel;

class Modul extends BaseController
{
    public function index()
    {
    }

    public function show($id)
    {
        // id = id kebun
        $modulModel = new ModulModel();
        $datamodul = $modulModel->where('id_kebun', $id)->findAll();
        $responmodul = [];
        foreach ($datamodul as $row) {
            $responmodul[] = [
                'id' => $row['id'],
                'id_kebun' => $row['id_kebun'],
                'nama' => $row['nama'],
                'kapasitas' => $row['kapasitas'],
                'keterangan' => $row['keterangan'],
                'gambar' => base_url('gambar_kebun/' . $row['gambar']),
                'terisi' => $row['terisi'],
                'kosong' => $row['kosong'],
            ];
        }
        $hasil = [
            'data_modul' => $responmodul
        ];
        return $this->response->setStatusCode(200)->setJSON($hasil);
    }

    public function addModul($id)
    {
        // id = id kebun
        $modulModel = new ModulModel();

        $validation = \Config\Services::validation();
        $validation->setRules([
            'nama' => 'required',
            'kapasitas' => 'required|numeric',
            'keterangan' => 'required',
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
            return $this->response->setStatusCode(400)->setJSON($response);
        }

        $id_modul_sebelum = $modulModel->getLastId();
        $id_modul = $modulModel->getNextId($id_modul_sebelum);

        $gambar = $this->request->getFile('gambar');
        $nama_gambar = $gambar->getRandomName();
        $gambar->move('gambar_kebun', $nama_gambar);

        $data = [
            'id' => $id_modul,
            'id_kebun' => $id,
            'nama' => esc($this->request->getVar('nama')),
            'kapasitas' => esc($this->request->getVar('kapasitas')),
            'keterangan' => esc($this->request->getVar('keterangan')),
            'gambar' => $nama_gambar,
            'terisi' => 0,
            'kosong' => esc($this->request->getVar('kapasitas')),
        ];
        $modulModel->insert($data);

        $response = [
            'status' => '201',
            'error' => 'null',
            'data' => $data,
            'message' => [
                'success' => 'Data modul berhasil ditambahkan'
            ]
        ];

        return $this->response->setStatusCode(201)->setJSON($response);
    }

    public function edit($id)
    {
        // $id = id modul

        $modulModel = new ModulModel();

        $gambar_baru = $this->request->getFile('gambar_baru');

        // Validasi input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'nama' => 'required',
            'kapasitas' => 'required|numeric',
            'keterangan' => 'required',
        ]);

        if ($gambar_baru != null) {
            $validation->setRules([
                'nama' => 'required',
                'kapasitas' => 'required|numeric',
                'keterangan' => 'required',
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
                'kapasitas' => esc($this->request->getVar('kapasitas')),
                'keterangan' => esc($this->request->getVar('keterangan')),
            ];
        } else {
            $data = [
                'gambar' => esc($this->request->getVar('gambar_lama')),
                'nama' => esc($this->request->getVar('nama')),
                'kapasitas' => esc($this->request->getVar('kapasitas')),
                'keterangan' => esc($this->request->getVar('keterangan')),
            ];
        }

        $modulModel->update($id, $data);

        $response = [
            'data_baru' => $data,
            'status' => 200,
            'error' => null,
            'messages' => [
                'success' => 'Data modul berhasil diubah'
            ]
        ];
        return $this->response->setStatusCode(200)->setJSON($response);
    }

    public function delete($id)
    {
        // $id = id modul
        $modulModel = new ModulModel();

        // hapus gambar
        $path = 'gambar_kebun/' . $modulModel->getImage($id)['gambar'];
        if (file_exists($path)) {
            unlink($path);
        }

        // hapus data modul
        $modulModel->where('id', $id)->delete();

        $response = [
            'status' => 200,
            'error' => null,
            'messages' => [
                'success' => 'Data modul berhasil dihapus'
            ]
        ];
        return $this->response->setStatusCode(200)->setJSON($response);
    }
}
