<?php

namespace App\Controllers;

use App\Models\TransaksiModel;
use App\Models\OrderModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\HTTP\RequestTrait;

class Order extends ResourceController
{
    use RequestTrait;
    public function index()
    {
        $model = new OrderModel();
        $data = $model->showAllData("belum bayar");
        $data2 = $model->showAllData("sudah bayar");
        $response = [];
        $response2 = [];
        foreach ($data as $row) {
            $response[] = array(
                'id_produk' => $row->id_produk,
                'nama' => $row->nama,
                'foto' => base_url('gambar/' . $row->foto),
                'harga' => $row->harga,
                'qty' => $row->qty,
                'id_order' => $row->id_order,
                'total_harga_produk' => $row->total_harga_produk,
                'waktu_kedaluarsa' => $row->waktu_kedaluarsa,
                'status' => $row->status,
                'id_pembeli' => $row->id_pembeli,
                'status_transaksi' => $row->status_transaksi,
                'bukti_pembayaran' => base_url('bukti_pembayaran/' . $row->bukti_pembayaran),
                'id_penjual' => $row->id_penjual,
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
                'waktu_kedaluarsa' => $row->waktu_kedaluarsa,
                'status' => $row->status,
                'id_pembeli' => $row->id_pembeli,
                'status_transaksi' => $row->status_transaksi,
                'bukti_pembayaran' => base_url('bukti_pembayaran/' . $row->bukti_pembayaran),
                'id_penjual' => $row->id_penjual,

            );
        }
        $hasil = [
            'belum_bayar' => $response,
            'sudah_bayar' => $response2,
        ];

        return $this->respond($hasil);
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
        $newDateTime = date('Y-m-d H:i:s', strtotime($currentDateTime) + (2 * 60 * 60));
        $data = [
            'order' => [
                'id' => $id_order,
                'datetime' => $currentDateTime,
                'waktu_kedaluarsa' => $newDateTime,
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
                'waktu_kedaluarsa' => $row->waktu_kedaluarsa,
                'status' => $row->status,
                'id_pembeli' => $row->id_pembeli,
                'status_transaksi' => $row->status_transaksi,
                'bukti_pembayaran' => base_url('bukti_pembayaran/' . $row->bukti_pembayaran),
                'id_penjual' => $row->id_penjual,
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
                'waktu_kedaluarsa' => $row->waktu_kedaluarsa,
                'status' => $row->status,
                'id_pembeli' => $row->id_pembeli,
                'status_transaksi' => $row->status_transaksi,
                'bukti_pembayaran' => base_url('bukti_pembayaran/' . $row->bukti_pembayaran),
                'id_penjual' => $row->id_penjual,

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
                'datetime' => $row->datetime,
                'status' => $row->status,
                'id_pembeli' => $row->id_pembeli,
                'status_transaksi' => $row->status_transaksi,
                'bukti_pembayaran' => base_url('bukti_pembayaran/' . $row->bukti_pembayaran),
                'id_penjual' => $row->id_penjual,
            );
        }
        $hasil = [
            'belum_bayar' => $response,
            'sudah_bayar' => $response2,
            'dibatalkan' => $response3,
        ];

        return $this->respond($hasil);
        // return view('order/order', $hasil);
    }

    public function ubah($id = null)
    {
        // ubah status
        $model = new OrderModel();
        $data = [
            'status' => $this->request->getVar('status'),
        ];

        $result = $model->ubahData($id, $data);
        $response = [
            'status'   => 200,
            'error'    => null,
            'messages' => [
                'success' => 'Data Order berhasil diubah.'
            ]
        ];

        return $this->respondUpdated($response);
    }

    public function kirimGambar($id = null)
    {
        $model = new OrderModel();
        if ($gambar = $this->request->getFile('foto')) {
            $namaGambar = $gambar->getRandomName();
            $gambar->move('bukti_pembayaran', $namaGambar);
            $data = [
                'bukti_pembayaran' => $namaGambar,
            ];
        }
        $model->kirimDataGambar($id, $data);
        $response = [
            'status' => 201,
            'error' => null,
            'messages' => [
                'success' => 'Data order berhasil diubah'
            ]
        ];
        return $this->respondUpdated($response);
    }

    public function delete($id = null)
    {
        $model = new OrderModel();
        $model->deleteData($id);
        $response = [
            'status' => 200,
            'error' => null,
            'messages' => [
                'success' => 'Data produk berhasil dihapus'
            ]
        ];
        return $this->respondDeleted($response);
    }
}
