<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ReportModel;
use App\Models\KebunModel;
use App\Models\PanenModel;
use App\Models\TanamModel;

class Tanam extends BaseController
{
    public function index()
    {
        //
    }

    public function show($id = null)
    {
        // show pakai id_kebun
        $modelKebun = new KebunModel();
        $dataTanam = $modelKebun->showTanam($id);

        $responseTanam = [];
        foreach ($dataTanam as $row) {
            $responseTanam[] = [
                'id' => $row->id,
                'id_kebun' => $row->id_kebun,
                'nama_sayur' => $row->nama_sayur,
                'gambar' => base_url('gambar_kebun/' . $row->gambar),
                'tanggal_tanam' => $row->tanggal_tanam,
                'jumlah_bibit' => $row->jumlah_bibit,
                'masa_tanam' => $row->masa_tanam,
                'jam_siram' => $row->jam_siram,
                'keterangan' => $row->keterangan,
                'status_panen' => $row->status_panen,
            ];
        }

        $hasil = [
            'data_tanam' => $responseTanam,
        ];

        return $this->response->setJSON($hasil);

    }

    public function toPanen($id = null)
    {
        // toPanen pakai id_tanam
        $tanam_model = new TanamModel();
        $panen_model = new PanenModel();
        $report_model = new ReportModel();

        $id_panen_sebelum = $panen_model->getLastId();
        $id_panen = $panen_model->getNextId($id_panen_sebelum);

        // Validasi input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'tanggal_panen' => 'required|valid_date',
            'jumlah_panen' => 'required|numeric',
            'keterangan' => 'required',
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
        $gambar = $tanam_model->getImage($id)[0]->gambar;
        $id_kebun = $tanam_model->getIdKebun($id)[0]->id_kebun;
        $nama_sayur = $tanam_model->getSayur($id)[0]->nama_sayur;
        $data = [
            'id' => $id_panen,
            'id_kebun' => $id_kebun,
            'nama_sayur' => $nama_sayur,
            'gambar' => $gambar,
            'tanggal_panen' => esc($this->request->getVar('tanggal_panen')),
            'jumlah_panen' => esc($this->request->getVar('jumlah_panen')),
            'keterangan' => esc($this->request->getVar('keterangan')),
        ];
        $panen_model->insertData($data);

        // ubah status udah panen di db tanam
        $data2 = [
            'status_panen' => 'sudah'
        ];
        $tanam_model->updateData($id, $data2);

        // update data report
        $report_data = [
            'id_panen' => $id_panen,
            'tanggal_panen' => esc($this->request->getVar('tanggal_panen')),
            'jumlah_panen' => esc($this->request->getVar('jumlah_panen')),
        ];
        $report_model->updateData('id_tanam', $id, $report_data);

        $response = [
            'status' => 'success',
            'message' => 'Data berhasil dipindah ke status panen.'
        ];

        return $this->response->setJSON($response);
    }

    public function manage($id)
    {
        $tanam_model = new TanamModel();

        // Validasi input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'tanggal_manage' => 'required|valid_date',
            'ppm' => 'required|numeric',
            'ph' => 'required|numeric',
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
        $id_sebelumnya = $tanam_model->getLastIdManage();
        $id_selanjutnya = $tanam_model->getNextIdManage($id_sebelumnya);
        $data = [
            'id' => $id_selanjutnya,
            'id_tanaman' => $id,
            'tanggal_manage' => esc($this->request->getVar('tanggal_manage')),
            'ppm' => esc($this->request->getVar('ppm')),
            'ph' => esc($this->request->getVar('ph')),
        ];

        $tanam_model->insertManage($data);

        $response = [
            'status' => 'success',
            'data' => $data,
            'message' => 'Monitoring tanaman berhasil.'
        ];

        return $this->response->setJSON($response);
    }

    public function search()
    {
        $keyword = $this->request->getVar('keyword');
        $id_kebun = $this->request->getVar('id_kebun');

        $tanam_model = new TanamModel();
        $data = $tanam_model->searchData($keyword, $id_kebun);
        $response = [];
        foreach ($data as $row) {
            $response[] = array(
                'id' => $row->id,
                'id_kebun' => $row->id_kebun,
                'nama_sayur' => $row->nama_sayur,
                'gambar' => base_url('gambar_kebun/' . $row->gambar),
                'tanggal_tanam' => $row->tanggal_tanam,
                'jumlah_bibit' => $row->jumlah_bibit,
                'masa_tanam' => $row->masa_tanam,
                'jam_siram' => $row->jam_siram,
                'keterangan' => $row->keterangan,
                'status_panen' => $row->status_panen,
            );
        }

        $hasil = [
            'hasil_search' => $response
        ];

        return $this->response->setJSON($hasil);
    }
}
