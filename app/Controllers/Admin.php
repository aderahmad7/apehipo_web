<?php

namespace App\Controllers;

use App\Models\OrderModel;
use App\Models\TransaksiModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;

class Admin extends ResourceController
{
    use ResponseTrait;

    public function index()
    {
        $orderModel = new OrderModel();
        // $transaksiModel = new TransaksiModel();
        // Instance dari HTTP Client
        // $client = \Config\Services::curlrequest();

        // // Lakukan permintaan GET ke API endpoint
        // $response = $client->request('GET', 'https://apehipo.com/api/order');

        // // Mendapatkan respons dari API dalam bentuk JSON
        // $api_data = $response->getBody(); // Mengambil body respons dari API dalam bentuk JSON

        // // Decode JSON ke array asosiatif
        // $dataApi['order'] = json_decode($api_data, true);

        $data = $orderModel->showDataWithUsername("belum bayar");
        $data2 = $orderModel->showDataWithUsername("sudah bayar");
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
                'username' => $row->username,
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
                'username' => $row->username,
            );
        }
        $hasil = [
            'belum_bayar' => $response,
            'sudah_bayar' => $response2,
            'title' => "Dashboard"
        ];
        // Menampilkan data dari API
        return view('pages/admin', $hasil);
    }

    public function ubahStatus($id = null)
    {
        // ubah status order
        $orderModel = new OrderModel();
        $data = [
            'status' => $this->request->getVar('status'),
        ];

        $orderModel->ubahData($id, $data);

        // ubah status transaksi
        $transaksiModel = new TransaksiModel();
        // $requestData = $this->request->getJSON();
        // $data_produk = $requestData->data_produk;

        // id untuk table user (order)
        $id_sebelumnya = $transaksiModel->getLastId("A001", "tbl_transaksi", "id");
        $id_transaksi = $transaksiModel->getNextId($id_sebelumnya, "A");
        var_dump($id_transaksi);

        // id untuk table user (transaksi)
        $id_sebelumnya = $transaksiModel->getLastId("S001", "detail_transaksi", "id");
        $id_detail_transaksi = $transaksiModel->getNextId($id_sebelumnya, "S");

        // datetime
        $currentDateTime = date('Y-m-d H:i:s');
        $data = [
            'transaksi' => [
                'id' => $id_transaksi,
                'datetime' => $currentDateTime,
                'total_harga_produk' => $this->request->getVar('total_harga_produk'),
                'status' => $this->request->getVar('status_transaksi'),
                'id_order' => $this->request->getVar('id_order'),
                'id_user' => $this->request->getVar('id_user'),

            ],
            'detail_transaksi' => [
                'id' => $id_detail_transaksi,
                'id_produk' => $this->request->getVar('id_produk'),
                'harga' => $this->request->getVar('harga'),
                'qty' => $this->request->getVar('qty'),
                'id_transaksi' => $id_transaksi,
            ]
        ];
        $transaksiModel->insertDataViaAdmin($data);
        // Redirect kembali ke halaman admin
        return redirect()->to('pages/admin');
    }
}
