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
        // show pakai id_modul
        $tanamModel = new TanamModel();
        $dataTanam = $tanamModel->where('id_modul', $id)->where('status_panen', 'belum')->findAll();

        $responseTanam = [];
        foreach ($dataTanam as $row) {
            $responseTanam[] = [
                'id' => $row['id'],
                'id_kebun' => $row['id_kebun'],
                'id_modul' => $row['id_modul'],
                'nama_sayur' => $row['nama_sayur'],
                'gambar' => base_url('gambar_kebun/' . $row['gambar']),
                'tanggal_semai' => $row['tanggal_semai'],
                'tanggal_tanam' => $row['tanggal_tanam'],
                'jumlah_semai' => $row['jumlah_semai'],
                'jumlah_bibit' => $row['jumlah_bibit'],
                'masa_tanam' => $row['masa_tanam'],
                'keterangan' => $row['keterangan'],
                'status_panen' => $row['status_panen'],
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
        $tanggal_semai = $tanam_model->getTglSemai($id)[0]->tanggal_semai;
        $tanggal_tanam = $tanam_model->getTglTanam($id)[0]->tanggal_tanam;
        $jumlah_semai = $tanam_model->getJumSemai($id)[0]->jumlah_semai;
        $jumlah_tanam = $tanam_model->getJumTanam($id)[0]->jumlah_bibit;
        $id_modul = $tanam_model->getIdModul($id)[0]->id_modul;
        $nama_sayur = $tanam_model->getSayur($id)[0]->nama_sayur;
        $data = [
            'id' => $id_panen,
            'id_kebun' => $id_kebun,
            'id_modul' => $id_modul,
            'nama_sayur' => $nama_sayur,
            'gambar' => $gambar,
            'tanggal_semai' => $tanggal_semai,
            'tanggal_tanam' => $tanggal_tanam,
            'tanggal_panen' => esc($this->request->getVar('tanggal_panen')),
            'jumlah_semai' => $jumlah_semai,
            'jumlah_tanam' => $jumlah_tanam,
            'jumlah_panen' => esc($this->request->getVar('jumlah_panen')),
            'keterangan' => esc($this->request->getVar('keterangan')),
        ];
        $panen_model->insertData($data);

        // ubah status udah panen di db tanam
        $data2 = [
            'status_panen' => 'sudah'
        ];
        $tanam_model->updateData($id, $data2);

        $response = [
            'status' => 'success',
            'message' => 'Data tanam berhasil dipindah ke status panen.'
        ];

        return $this->response->setJSON($response);
    }

    public function search()
    {
        $keyword = esc($this->request->getVar('keyword'));
        $id_modul = esc($this->request->getVar('id_modul'));

        $tanam_model = new TanamModel();
        $data = $tanam_model->searchData($keyword, $id_modul);
        $response = [];
        foreach ($data as $row) {
            $response[] = array(
                'id' => $row->id,
                'id_kebun' => $row->id_kebun,
                'id_modul' => $row->id_modul,
                'nama_sayur' => $row->nama_sayur,
                'gambar' => base_url('gambar_kebun/' . $row->gambar),
                'tanggal_semai' => $row->tanggal_semai,
                'tanggal_tanam' => $row->tanggal_tanam,
                'jumlah_semai' => $row->jumlah_semai,
                'jumlah_bibit' => $row->jumlah_bibit,
                'masa_tanam' => $row->masa_tanam,
                'keterangan' => $row->keterangan,
                'status_panen' => $row->status_panen,
            );
        }

        $hasil = [
            'hasil_search' => $response
        ];

        return $this->response->setJSON($hasil);
    }

    public function searchTgl()
    {
        $tgl = esc($this->request->getVar('tanggal_tanam'));
        $id_kebun = esc($this->request->getVar('id_kebun'));

        $tanam_model = new TanamModel();
        $data = $tanam_model->searchTgl($tgl, $id_kebun);
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
                'ppm' => $row->ppm,
                'ph' => $row->ph,
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
