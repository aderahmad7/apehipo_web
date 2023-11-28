<?php 

namespace App\Controllers;

use App\Models\TransaksiModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\HTTP\RequestTrait;

class Transaksi extends ResourceController {
    use RequestTrait;

    public function create() {
        // insert transaksi
        $model = new TransaksiModel();
        $requestData = $this->request->getJSON();
        $data_produk = $requestData->data_produk;
        // id untuk table user
        $id_sebelumnya = $model->getLastId("A001", "tbl_transaksi", "id");
        $id_transaksi = $model->getNextId($id_sebelumnya, "A");

        // datetime
        $currentDateTime = date('Y-m-d H:i:s');
        $data = [
            'transaksi' => [
                'id' => $id_transaksi,
                'datetime' =>$currentDateTime,
                'total_harga_produk' => $this->request->getJSON()->total_harga_produk,
                'status' => $this->request->getJSON()->status_transaksi,
                'id_order' => $this->request->getJSON()->id_order,
                'id_user' => $this->request->getJSON()->id_user,

            ],
            'detail_transaksi' => $data_produk
            ];   
            $model->insertData($data);
            $response = [
                'status' => 201,
                'error' => 'null',
                'message' => [
                    'success' => 'Data order berhasil ditambahkan'
                ]
            ];

        return $this->respondCreated($response);
    }

    public function show($id = null) {
        $model = new TransaksiModel();
        $data = $model->showData($id, "sudah bayar", "proses", "antar");
        $data2 = $model->showData($id, "selesai");
        $response = [];
        $response2 = [];
        foreach ($data as $row) {
            $response[] = array(
                'id_produk' => $row->id_produk,
                'nama' => $row->nama,
                'foto' => base_url('gambar/'. $row->foto),
                'harga' => $row->harga,
                'amount' => $row->amount,
                'total_harga_produk' => $row->total_harga_produk,
                'status' => $row->status,
                'id_order' => $row->id_order,
                'id_transaksi' => $row->id_transaksi,
                'id_penjual' => $row->id_penjual,
                'id_pembeli' => $row->id_pembeli,
                'alamat' => $row->alamat,
                'no_telpon' => $row->no_telpon
            );
        }

        foreach ($data2 as $row) {
            $response2[] = array(
                'id_produk' => $row->id_produk,
                'nama' => $row->nama,
                'foto' => base_url('gambar/'. $row->foto),
                'harga' => $row->harga,
                'amount' => $row->amount,
                'total_harga_produk' => $row->total_harga_produk,
                'status' => $row->status,
                'id_order' => $row->id_order,
                'id_transaksi' => $row->id_transaksi,
                'id_penjual' => $row->id_penjual,
                'id_pembeli' => $row->id_pembeli,
                'alamat' => $row->alamat,
                'no_telpon' => $row->no_telpon
            );
        }
        $hasil = [
            'proses_bayar' => $response,
            'selesai' => $response2
        ];

        return $this->respond($hasil);
    }

    public function ubah($id_transaksi) {
        $model = new TransaksiModel();
        $data = [
            'status' => $this->request->getVar('status'),
        ];
        $model->ubahData($data, $id_transaksi);
    }

}