<?php

namespace App\Controllers;

use App\Models\AccountModel;
use App\Models\KebunModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

class Kelola_kebun extends ResourceController
{
    public function index()
    {
        $model = new AccountModel();
        $modelKebun = new KebunModel();
        $dataKebun = $model->showKebun();
        $dataPetani = $model->showPetani();

        $responseKebun = [];
        foreach ($dataKebun as $row) {
            $namaPetani = $modelKebun->getNamaPetani($row->id_petani);
            $responseKebun[] = [
                'id' => $row->id,
                'id_petani' => $row->id_petani,
                'nama_petani' => $namaPetani ? $namaPetani['nama'] : null,
            ];
        }

        $hasil = [
            'data_kebun' => $responseKebun
        ];

        return $this->respond($hasil);
    }

}