<?php

namespace App\Controllers;

use App\Models\OrderModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\HTTP\RequestTrait;

class Order extends ResourceController
{
    use RequestTrait;
    public function index()
    {
    }

    public function create()
    {
        $model = new OrderModel();
        $requestData = $this->request->getJSON();
        $data_produk = $requestData->data_produk;
        // id untuk table user
        $id_sebelumnya = $model->getLastId("O001", "tbl_order", "id");
        $id_order = $model->getNextId($id_sebelumnya, "O");
        // datetime
        $currentDateTime = date('Y-m-d H:i:s');
        $data = [
            'order' => [
                'id' => $id_order,
                'datetime' => $currentDateTime,
                'total_harga_produk' => $this->request->getJSON()->total_harga_produk,
                'status' => $this->request->getJSON()->status,
                'id_user' => $this->request->getJSON()->id_user
            ],
            'detail_order' => $data_produk

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

    public function show($id = null)
    {
        $model = new OrderModel();
        $data = $model->showData("belum bayar", $id);
        $data2 = $model->showData("sudah bayar", $id);
        $data3 = $model->showData("dibatalkan", $id);
        $response = [];
        $response2 = [];
        $response3 = [];
        foreach ($data as $row) {
            $response[] = array(
                'id_produk' => $row->id_produk,
                'nama' => $row->nama,
                'foto' => base_url('gambar/' . $row->foto),
                'harga' => $row->harga,
                'qty' => $row->qty,
                'id_order' => $row->id_order,
                'total_harga_produk' => $row->total_harga_produk,
                'status' => $row->status,
                'id_user' => $row->id_user
            );
        }
        foreach ($data2 as $row) {
            $response2[] = array(
                'id_produk' => $row->id_produk,
                'nama' => $row->nama,
                'foto' => base_url('gambar/' . $row->foto),
                'harga' => $row->harga,
                'qty' => $row->qty,
                'id_order' => $row->id_order,
                'total_harga_produk' => $row->total_harga_produk,
                'status' => $row->status,
                'id_user' => $row->id_user
            );
        }
        foreach ($data3 as $row) {
            $response3[] = array(
                'id_produk' => $row->id_produk,
                'nama' => $row->nama,
                'foto' => base_url('gambar/' . $row->foto),
                'harga' => $row->harga,
                'qty' => $row->qty,
                'id_order' => $row->id_order,
                'total_harga_produk' => $row->total_harga_produk,
                'status' => $row->status,
                'id_user' => $row->id_user
            );
        }
        $hasil = [
            'belum_bayar' => $response,
            'sudah_bayar' => $response2,
            'dibatalkan' => $response3,
        ];

        return $this->respond($hasil);
    }

    public function ubah($id = null) {
        $model = new OrderModel();
        $data = [
            'status' => $this->request->getVar('status')
        ];
        $model->update($id, $data);
        $response= [
            'status'   => 200,
            'error'    => null,
            'messages' => [
                'success' => 'Data produk berhasil diubah.'
            ]
        ];

        return $this->respondUpdated($response);
    }

    // public function delete($id = null)
    // {
    //     $model = new OrderModel();
    //     $model->deleteData($id);
    //     $response = [
    //         'status' => 200,
    //         'error' => null,
    //         'messages' => [
    //             'success' => 'Data produk berhasil dihapus'
    //         ]
    //     ];
    //     return $this->respondDeleted($response);
    // }
}
