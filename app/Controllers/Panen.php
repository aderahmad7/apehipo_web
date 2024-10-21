<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PanenModel;

class Panen extends BaseController
{
    public function index()
    {
        //
    }

    public function show($id)
    {
        // id = id modul
        $panenModel = new PanenModel();
        $dataPanen = $panenModel->where('id_modul', $id)->findAll();

        // Inisialisasi variabel untuk perhitungan
        $totalSemai = 0;
        $totalTanam = 0;
        $totalPanen = 0;
        $jumlahPanen = count($dataPanen);
        $jenisSayur = [];

        // Array untuk respons data panen
        $responsePanen = [];

        foreach ($dataPanen as $row) {
            // Menjumlahkan total sayur disemai, ditanam, dan dipanen
            $totalSemai += intval($row['jumlah_semai']);
            $totalTanam += intval($row['jumlah_tanam']);
            $totalPanen += intval($row['jumlah_panen']);

            // Cek jenis sayur, hanya dihitung sekali
            if (!in_array($row['nama_sayur'], $jenisSayur)) {
                $jenisSayur[] = $row['nama_sayur'];
            }

            // Membuat array untuk respons panen
            $responsePanen[] = [
                'id' => $row['id'],
                'id_kebun' => $row['id_kebun'],
                'id_modul' => $row['id_modul'],
                'nama_sayur' => $row['nama_sayur'],
                'gambar' => base_url('gambar_kebun/' . $row['gambar']),
                'tanggal_semai' => $row['tanggal_semai'],
                'tanggal_tanam' => $row['tanggal_tanam'],
                'tanggal_panen' => $row['tanggal_panen'],
                'jumlah_semai' => $row['jumlah_semai'],
                'jumlah_tanam' => $row['jumlah_tanam'],
                'jumlah_panen' => $row['jumlah_panen'],
                'keterangan' => $row['keterangan'],
            ];
        }

        // Buat respons akhir yang menggabungkan informasi yang diinginkan
        $response = [
            'dataPanen' => $responsePanen,
            'totalSemai' => $totalSemai,        // Total sayur yang disemai
            'totalTanam' => $totalTanam,        // Total sayur yang ditanam
            'totalPanen' => $totalPanen,        // Total sayur yang dipanen
            'jumlahPanen' => $jumlahPanen,      // Total jumlah row panen
            'jumlahJenisSayur' => count($jenisSayur) // Total jumlah jenis sayur (tanpa duplikasi)
        ];

        // Kembalikan dalam format JSON (atau bisa disesuaikan dengan output yang diinginkan)
        return $this->response->setJSON($response);
    }

    public function search()
    {
        $keyword = esc($this->request->getVar('keyword'));
        $id_modul = esc($this->request->getVar('id_modul'));

        $panen_model = new PanenModel();
        $data = $panen_model->searchData($keyword, $id_modul);
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
                'tanggal_panen' => $row->tanggal_panen,
                'jumlah_semai' => $row->jumlah_semai,
                'jumlah_tanam' => $row->jumlah_tanam,
                'jumlah_panen' => $row->jumlah_panen,
                'keterangan' => $row->keterangan,
            );
        }

        $hasil = [
            'hasil_search' => $response
        ];

        return $this->response->setJSON($hasil);
    }

}
