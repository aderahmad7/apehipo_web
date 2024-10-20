<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MonitoringModel;

class Monitoring extends BaseController
{
    public function index()
    {

    }

    public function show($id, $tanggal)
    {
        // $id = id Rumah
        $monitoringModel = new MonitoringModel();

        $dataMonitoring = $monitoringModel->where('id_rumah', $id)->where('tanggal', $tanggal)->findAll();

        $responseMonitoring = [];
        if (empty($dataMonitoring)) {
            $responseMonitoring[] = [
                'id_monitoring' => '-',
                'id_rumah' => $id,
                'tanggal' => $tanggal,
                'ppm' => '-',
                'ph' => '-',
            ];
        } else {
            $responseMonitoring[] = [
                'id_monitoring' => $dataMonitoring['id'],
                'id_rumah' => $dataMonitoring['id_rumah'],
                'tanggal' => $dataMonitoring['tanggal'],
                'ppm' => $dataMonitoring['ppm'],
                'ph' => $dataMonitoring['ph'],
            ];
        }


        $hasil = [
            'data_monitoring' => $responseMonitoring,
            'status' => 200
        ];

        return $this->response->setJSON($hasil, 200);
    }

    public function create()
    {

    }

    public function createMonitoring($id)
    {
        // $id = id rumah

        $monitoringModel = new MonitoringModel();

        $id_rumah = $id;

        // Validasi input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'ppm' => 'required|numeric',
            'tanggal' => 'required|valid_date',
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
        $id_monitoring_sebelum = $monitoringModel->getLastId();
        $id_monitoring = $monitoringModel->getNextId($id_monitoring_sebelum);

        $data = [
            'id' => $id_monitoring,
            'id_rumah' => $id_rumah,
            'tanggal' => esc($this->request->getVar('tanggal')),
            'ppm' => esc($this->request->getVar('ppm')),
            'ph' => esc($this->request->getVar('ph')),
        ];

        $monitoringModel->insertData($data);

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
        //$id = id monitoring

        $monitoringModel = new MonitoringModel();

        // Validasi input
        $validation = \Config\Services::validation();
        $validation->setRules([
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

        $data = [
            'ppm' => esc($this->request->getVar('ppm')),
            'ph' => esc($this->request->getVar('ph')),
        ];

        $monitoringModel->update($id, $data);

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



}
