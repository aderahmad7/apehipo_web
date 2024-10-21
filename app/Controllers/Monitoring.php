<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MonitoringModel;

class Monitoring extends BaseController
{
    public function index()
    {

    }

    public function show($id, $bulan = null, $tahun = null)
    {
        // $id = id_modul
        $monitoringModel = new MonitoringModel();

        // Memulai query untuk id_modul tertentu
        $monitoringModel->where('id_modul', $id);

        // Jika bulan dan tahun diberikan, tambahkan kondisi filter
        if (!empty($bulan) && !empty($tahun)) {
            // Filter berdasarkan bulan dan tahun
            $monitoringModel->where('MONTH(tanggal)', $bulan);
            $monitoringModel->where('YEAR(tanggal)', $tahun);
        }

        // Urutkan secara descending berdasarkan tanggal
        $dataMonitoring = $monitoringModel->orderBy('tanggal', 'DESC')->findAll();

        // Inisialisasi array untuk response
        $responseMonitoring = [];

        foreach ($dataMonitoring as $row) {
            $responseMonitoring[] = [
                'id' => $row['id'],
                'id_modul' => $row['id_modul'],
                'tanggal' => $row['tanggal'],
                'waktu' => $row['waktu'],
                'ppm_awal' => $row['ppm-awal'],
                'ph_awal' => $row['ph-awal'],
                'ppm_tambah' => $row['ppm-tambah'],
                'ph_tambah' => $row['ph-tambah'],
                'ppm_akhir' => $row['ppm-akhir'],
                'ph_akhir' => $row['ph-akhir'],
            ];
        }

        // Membuat hasil response
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
        // $id = id modul

        $monitoringModel = new MonitoringModel();

        // Validasi input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'tanggal' => 'required|valid_date',
            'waktu' => 'required|valid_date[H:i]',
            'ppm-awal' => 'required|numeric',
            'ph-awal' => 'required|numeric',
            'ppm-tambah' => 'required|numeric',
            'ph-tambah' => 'required|numeric',
            'ppm-akhir' => 'required|numeric',
            'ph-akhir' => 'required|numeric',
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
            'id_modul' => $id,
            'tanggal' => esc($this->request->getVar('tanggal')),
            'waktu' => esc($this->request->getVar('waktu')),
            'ppm-awal' => esc($this->request->getVar('ppm-awal')),
            'ph-awal' => esc($this->request->getVar('ph-awal')),
            'ppm-tambah' => esc($this->request->getVar('ppm-tambah')),
            'ph-tambah' => esc($this->request->getVar('ph-tambah')),
            'ppm-akhir' => esc($this->request->getVar('ppm-akhir')),
            'ph-akhir' => esc($this->request->getVar('ph-akhir')),
        ];

        $monitoringModel->insertData($data);

        $response = [
            'status' => '200',
            'error' => 'null',
            'message' => [
                'success' => 'Data monitoring berhasil ditambahkan'
            ]
        ];

        return $this->response->setJSON($response, 201);
    }
}
