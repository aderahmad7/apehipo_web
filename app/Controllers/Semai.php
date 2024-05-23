<?php

namespace App\Controllers;

use App\Models\ReportModel;
use App\Models\TanamModel;
use CodeIgniter\RESTful\ResourceController;
use App\Models\KebunModel;
use App\Models\SemaiModel;

class Semai extends ResourceController
{
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {

    }

    public function show($id = null)
    {
        $modelKebun = new KebunModel();
        $dataSemai = $modelKebun->showSemai($id);

        $responseSemai = [];
        foreach ($dataSemai as $row) {
            $responseSemai[] = [
                'id' => $row->id,
                'id_kebun' => $row->id_kebun,
                'gambar' => base_url('gambar_kebun/' . $row->gambar),
                'jenis_sayur' => $row->jenis_sayur,
                'tanggal' => $row->tanggal,
                'jumlah' => $row->jumlah,
                'waktu' => $row->waktu,
                'status_tanam' => $row->status_tanam,
            ];
        }

        $hasil = [
            'data_semai' => $responseSemai,
        ];

        return $this->respond($hasil);
    }


    public function create()
    {

    }

    public function createSemai($id = null)
    {
        // create pakai id_kebun
        $semai_model = new SemaiModel();
        $report_model = new ReportModel();

        $id_kebun = $id;

        // Validasi input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'gambar' => 'uploaded[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/png]|max_size[gambar,5120]',
            'jenis_sayur' => 'required',
            'tanggal' => 'required|valid_date',
            'jumlah' => 'required|numeric',
            'waktu' => 'required|numeric',
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
            return $this->respond($response, 400);
        }


        // upload
        $id_semai_sebelum = $semai_model->getLastId();
        $id_semai = $semai_model->getNextId($id_semai_sebelum);

        $gambar = $this->request->getFile('gambar');
        $nama_gambar = $gambar->getRandomName();
        $gambar->move('gambar_kebun', $nama_gambar);
        $data = [
            'id' => $id_semai,
            'id_kebun' => $id_kebun,
            'gambar' => $nama_gambar,
            'jenis_sayur' => esc($this->request->getVar('jenis_sayur')),
            'tanggal' => esc($this->request->getVar('tanggal')),
            'jumlah' => esc($this->request->getVar('jumlah')),
            'waktu' => esc($this->request->getVar('waktu')),
            'status_tanam' => 'belum',
        ];
        $semai_model->insertData($data);

        //menambah data report
        $id_report_sebelum = $report_model->getLastId();
        $id_report = $report_model->getNextId($id_report_sebelum);
        $report_data = [
            'id' => $id_report,
            'id_kebun' => $id_kebun,
            'id_semai' => $id_semai,
            'id_tanam' => '-',
            'id_panen' => '-',
            'nama_sayur' => esc($this->request->getVar('jenis_sayur')),
            'tanggal_semai' => esc($this->request->getVar('tanggal')),
            'tanggal_panen' => '0000-00-00',
            'jumlah_semai' => esc($this->request->getVar('jumlah')),
            'jumlah_tanam' => 0,
            'jumlah_panen' => 0,
        ];
        $report_model->insertData($report_data);

        // response
        $response = [
            'status' => '201',
            'error' => 'null',
            'message' => [
                'success' => 'Data berhasil ditambahkan'
            ]
        ];
        return $this->respondCreated($response);
    }

    public function edit($id = null)
    {
        // edit pakai id_semai
        $semai_model = new SemaiModel();
        $report_model = new ReportModel();

        // Validasi input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'gambar_baru' => 'uploaded[gambar_baru]|mime_in[gambar_baru,image/jpg,image/jpeg,image/png]|max_size[gambar_baru,5120]',
            'gambar_lama' => 'required',
            'jenis_sayur' => 'required',
            'tanggal' => 'required|valid_date',
            'jumlah' => 'required|numeric',
            'waktu' => 'required|numeric',
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
            return $this->respond($response, 400);
        }

        // update
        $gambar_baru = $this->request->getFile('gambar_baru');
        if ($gambar_baru) {
            $nama_gambar_baru = $gambar_baru->getRandomName();
            $gambar_baru->move('gambar_kebun', $nama_gambar_baru);

            // Hapus foto lama
            if (!empty($this->request->getVar('gambar_lama'))) {
                $path_gambar_lama = 'gambar_kebun/' . $this->request->getVar('gambar_lama');
                if (file_exists($path_gambar_lama)) {
                    unlink($path_gambar_lama);
                }
            }
            $data = [
                'gambar' => $nama_gambar_baru,
                'jenis_sayur' => esc($this->request->getVar('jenis_sayur')),
                'tanggal' => esc($this->request->getVar('tanggal')),
                'jumlah' => esc($this->request->getVar('jumlah')),
                'waktu' => esc($this->request->getVar('waktu')),
            ];
        } else {
            $data = [
                'jenis_sayur' => esc($this->request->getVar('jenis_sayur')),
                'tanggal' => esc($this->request->getVar('tanggal')),
                'jumlah' => esc($this->request->getVar('jumlah')),
                'waktu' => esc($this->request->getVar('waktu')),
            ];
        }

        $semai_model->updateData($id, $data);

        // edit data report
        $report_data = [
            'nama_sayur' => esc($this->request->getVar('jenis_sayur')),
            'tanggal_semai' => esc($this->request->getVar('tanggal')),
            'jumlah_semai' => esc($this->request->getVar('jumlah')),
        ];
        $report_model->updateData('id_semai', $id, $report_data);


        $response = [
            'status' => $data,
            'error' => null,
            'messages' => [
                'success' => 'Data berhasil diubah'
            ]
        ];
        return $this->respondUpdated($response);
    }

    public function toTanam($id = null)
    {
        // toTanam pakai id_semai
        $semai_model = new SemaiModel();
        $tanam_model = new TanamModel();
        $report_model = new ReportModel();

        // Validasi input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'tanggal_tanam' => 'required|valid_date',
            'jumlah_bibit' => 'required|numeric',
            'masa_tanam' => 'required|numeric',
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
            return $this->respond($response, 400);
        }

        // upload
        $id_tanam_sebelum = $tanam_model->getLastId();
        $id_tanam = $tanam_model->getNextId($id_tanam_sebelum);

        $gambar = $semai_model->getImage($id)[0]->gambar;
        $id_kebun = $semai_model->getIdKebun($id)[0]->id_kebun;
        $nama_sayur = $semai_model->getSayur($id)[0]->jenis_sayur;
        $jam_siram = $this->request->getVar('jam_siram');
        if ($jam_siram !== null) {
            $jam_siram = esc($jam_siram);
        } else {
            $jam_siram = null;
        }
        $data = [
            'id' => $id_tanam,
            'id_kebun' => $id_kebun,
            'nama_sayur' => $nama_sayur,
            'gambar' => $gambar,
            'tanggal_tanam' => esc($this->request->getVar('tanggal_tanam')),
            'jumlah_bibit' => esc($this->request->getVar('jumlah_bibit')),
            'masa_tanam' => esc($this->request->getVar('masa_tanam')),
            'jam_siram' => $jam_siram,
            'keterangan' => esc($this->request->getVar('keterangan')),
            'status_panen' => 'belum',
        ];
        $tanam_model->insertData($data);

        // ubah status udah tanam di db semai
        $data2 = [
            'status_tanam' => 'sudah'
        ];
        $semai_model->updateData($id, $data2);

        // edit report
        $report_data = [
            'id_tanam' => $id_tanam,
            'jumlah_tanam' => esc($this->request->getVar('jumlah_bibit')),
        ];
        $report_model->updateData('id_semai', $id, $report_data);


        $response = [
            'status' => 'success',
            'message' => 'Data berhasil dipindah ke status tanam.'
        ];

        return $this->response->setJSON($response);
    }

    public function update($id = null)
    {
        //
    }

    public function delete($id = null)
    {
        // delete pakai id_semai
        $semai_model = new SemaiModel();
        $report_model = new ReportModel();

        // hapus gambar
        $path = 'gambar_kebun/' . $semai_model->getImage($id)[0]->gambar;
        if (file_exists($path)) {
            unlink($path);
        }

        $semai_model->deleteData($id);

        // delete report
        $report_model->deleteData('id_semai', $id);

        $response = [
            'status' => 200,
            'error' => null,
            'messages' => [
                'success' => 'Data berhasil dihapus'
            ]
        ];
        return $this->respondDeleted($response);
    }

    public function search()
    {
        $keyword = esc($this->request->getVar('keyword'));
        $id_kebun = esc($this->request->getVar('id_kebun'));

        $semai_model = new SemaiModel();
        $data = $semai_model->searchData($keyword, $id_kebun);
        $response = [];
        foreach ($data as $row) {
            $response[] = array(
                'id' => $row->id,
                'id_kebun' => $row->id_kebun,
                'gambar' => base_url('gambar_kebun/' . $row->gambar),
                'jenis_sayur' => $row->jenis_sayur,
                'tanggal' => $row->tanggal,
                'jumlah' => $row->jumlah,
                'waktu' => $row->waktu,
                'status_tanam' => $row->status_tanam,
            );
        }

        $hasil = [
            'hasil_search' => $response
        ];

        return $this->response->setJSON($hasil);
    }
}
