<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KebunModel;
use App\Models\ReportModel;
use App\Models\SemaiModel;

class Report extends BaseController
{
    public function index()
    {
        //
    }

    public function show($id = null)
    {
        // show pakai id_kebun
        $modelKebun = new KebunModel();
        $report_model = new ReportModel();
        $semaiModel = new SemaiModel();

        $dataReport = $modelKebun->showReport($id);

        $responseReport = [];
        foreach ($dataReport as $row) {
            $responseReport[] = [
                'id' => $row->id,
                'id_kebun' => $row->id_kebun,
                'id_semai' => $row->id_semai,
                'id_tanam' => $row->id_tanam,
                'id_panen' => $row->id_panen,
                'gambar' => base_url('gambar_kebun/' . $semaiModel->getImage($row->id_semai)[0]->gambar),
                'nama_sayur' => $row->nama_sayur,
                'tanggal_semai' => $row->tanggal_semai,
                'tanggal_panen' => $row->tanggal_panen,
                'jumlah_semai' => $row->jumlah_semai,
                'jumlah_tanam' => $row->jumlah_tanam,
                'jumlah_panen' => $row->jumlah_panen,
            ];
        }

        $total_semai = intval($report_model->sumTotalSemai($id)[0]->jumlah_semai);
        $total_tanam = intval($report_model->sumTotalTanam($id)[0]->jumlah_tanam);
        $total_panen = intval($report_model->sumTotalPanen($id)[0]->jumlah_panen);
        $jumlah_sayur = $report_model->sumJumlahSayur($id);

        $data_report = [
            'total sayur disemai' => $total_semai,
            'total sayur ditanam' => $total_tanam,
            'total sayur dipanen' => $total_panen,
            'jumlah sayur' => $jumlah_sayur,
        ];
        $hasil = [
            'report' => $data_report,
            'data_sayur' => $responseReport,
        ];

        return $this->response->setJSON($hasil);
    }
}
