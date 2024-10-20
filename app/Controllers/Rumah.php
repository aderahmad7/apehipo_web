<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MonitoringModel;
use CodeIgniter\RESTful\ResourceController;
use App\Models\RumahModel;

class Rumah extends BaseController
{
    public function index()
    {
        //
    }

    public function show($id)
    {
        // $id = id kebun

        $rumahModel = new rumahModel();
        $dataRumah = $rumahModel->where('id_kebun', $id)->findAll();

        $responseRumah = [];
        foreach ($dataRumah as $row) {
            $responseRumah[] = [
                'id_rumah' => $row['id'],
                'id_kebun' => $row['id_kebun'],
                'nama_rumah' => $row['nama_rumah'],
                'kapasitas' => $row['kapasitas'],
                'gambar' => base_url('gambar_kebun/' . $row['gambar']),
                'deskripsi' => $row['deskripsi'],
            ];
        }

        $hasil = [
            'data_rumah' => $responseRumah,
        ];

        return $this->response->setJSON($hasil, 200);
    }

    public function create()
    {

    }

    public function createRumah($id)
    {
        // $id = id kebun

        $rumahModel = new RumahModel();

        $id_kebun = $id;

        // Validasi input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'nama_rumah' => 'required',
            'kapasitas' => 'required|numeric',
            'gambar' => 'uploaded[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/png]|max_size[gambar,5120]',
            'deskripsi' => 'required',
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

        // upload
        $id_rumah_sebelum = $rumahModel->getLastId();
        $id_rumah = $rumahModel->getNextId($id_rumah_sebelum);

        $gambar = $this->request->getFile('gambar');
        $nama_gambar = $gambar->getRandomName();
        $gambar->move('gambar_kebun', $nama_gambar);

        $data = [
            'id' => $id_rumah,
            'id_kebun' => $id_kebun,
            'nama_rumah' => esc($this->request->getVar('nama_rumah')),
            'kapasitas' => esc($this->request->getVar('kapasitas')),
            'gambar' => $nama_gambar,
            'deskripsi' => esc($this->request->getVar('deskripsi')),
        ];
        $rumahModel->insertData($data);

        $response = [
            'status' => '200',
            'error' => 'null',
            'message' => [
                'success' => 'Data berhasil ditambahkan'
            ]
        ];

        return $this->response->setJSON($response, 201);
    }

    public function edit($id)
    {
        // $id = id_rumah

        $rumahModel = new RumahModel();

        $gambar_baru = $this->request->getFile('gambar_baru');

        // Validasi input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'nama_rumah' => 'required',
            'kapasitas' => 'required|numeric',
            'deskripsi' => 'required',
        ]);

        if ($gambar_baru != null) {
            $validation->setRules([
                'nama_rumah' => 'required',
                'kapasitas' => 'required|numeric',
                'gambar_baru' => 'uploaded[gambar_baru]|mime_in[gambar_baru,image/jpg,image/jpeg,image/png]|max_size[gambar_baru,5120]',
                'deskripsi' => 'required',
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
            return $this->response->setJSON($response, 400);
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
                'nama_rumah' => esc($this->request->getVar('nama_rumah')),
                'kapasitas' => esc($this->request->getVar('kapasitas')),
                'deskripsi' => esc($this->request->getVar('deskripsi')),
            ];
        } else {
            $data = [
                'gambar' => esc($this->request->getVar('gambar_lama')),
                'nama_rumah' => esc($this->request->getVar('nama_rumah')),
                'kapasitas' => esc($this->request->getVar('kapasitas')),
                'deskripsi' => esc($this->request->getVar('deskripsi')),
            ];
        }

        $rumahModel->update($id, $data);

        $response = [
            'data_baru' => $data,
            'status' => 200,
            'error' => null,
            'messages' => [
                'success' => 'Data berhasil diubah'
            ]
        ];
        return $this->response->setJSON($response, 200);
    }

    public function update($id = null)
    {
        //
    }

    public function delete($id)
    {
        // $id = id rumah
        $rumahModel = new RumahModel();
        $monitoringModel = new MonitoringModel();


        // hapus gambar
        $path = 'gambar_kebun/' . $rumahModel->getImage($id)[0]->gambar;
        if (file_exists($path)) {
            unlink($path);
        }

        // hapus data monitoring
        $monitoringModel->where('id_rumah', $id)->delete();

        // hapus data rumah
        $rumahModel->where('id', $id)->delete();

        $response = [
            'status' => 200,
            'error' => null,
            'messages' => [
                'success' => 'Data berhasil dihapus'
            ]
        ];
        return $this->response->setJSON($response);
    }
}
