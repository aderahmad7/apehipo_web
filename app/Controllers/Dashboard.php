<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\DashboardModel;
use CodeIgniter\HTTP\RequestTrait;

class Dashboard extends ResourceController
{
    use RequestTrait;

    // all users
    public function index()
    {
        $model = new DashboardModel();
        $data = $model->getAllData();
        $data2 = $model->getKlasifikasi("penjualan eksklusif");
        $data3 = $model->getKlasifikasi("penjualan terbaik");
        $data4 = $model->getKlasifikasi("sedang laris");
        $response = [];
        $response2 = [];
        $response3 = [];
        $response4 = [];
        foreach($data as $row) {
            $response[] = array(
                'kode' => $row->kode,
                'produk_nama' => $row->produk_nama,
                'jenis' => $row->jenis,
                'harga' => $row->harga,
                'stok' => $row->stok,
                'deskripsi' => $row->deskripsi,
                'produk_foto' => base_url('gambar/'.$row->foto_produk),
                'klasifikasi' => $row->klasifikasi,
                'status' => $row->status,
                'id_user' => $row->id_user,
                'petani_nama' => $row->petani_nama,
                'alamat' => $row->alamat,
                'petani_foto' =>base_url('gambar_account/'.$row->foto_petani),
            );
        }
        foreach($data2 as $row) {
            $response2[] = array(
                'kode' => $row->kode,
                'produk_nama' => $row->produk_nama,
                'jenis' => $row->jenis,
                'harga' => $row->harga,
                'stok' => $row->stok,
                'deskripsi' => $row->deskripsi,
                'produk_foto' => base_url('gambar/'.$row->foto_produk),
                'klasifikasi' => $row->klasifikasi,
                'status' => $row->status,
                'id_user' => $row->id_user,
                'petani_nama' => $row->petani_nama,
                'alamat' => $row->alamat,
                'petani_foto' =>base_url('gambar_account/'.$row->foto_petani),
                // 'no_rekening' =>$row->no_rekening,
            );
        }
        foreach($data3 as $row) {
            $response3[] = array(
                'kode' => $row->kode,
                'produk_nama' => $row->produk_nama,
                'jenis' => $row->jenis,
                'harga' => $row->harga,
                'stok' => $row->stok,
                'deskripsi' => $row->deskripsi,
                'produk_foto' => base_url('gambar/'.$row->foto_produk),
                'klasifikasi' => $row->klasifikasi,
                'status' => $row->status,
                'id_user' => $row->id_user,
                'petani_nama' => $row->petani_nama,
                'alamat' => $row->alamat,
                'petani_foto' =>base_url('gambar_account/'.$row->foto_petani),
                // 'no_rekening' =>$row->no_rekening,

            );
        }
        foreach($data4 as $row) {
            $response4[] = array(
                'kode' => $row->kode,
                'produk_nama' => $row->produk_nama,
                'jenis' => $row->jenis,
                'harga' => $row->harga,
                'stok' => $row->stok,
                'deskripsi' => $row->deskripsi,
                'produk_foto' => base_url('gambar/'.$row->foto_produk),
                'klasifikasi' => $row->klasifikasi,
                'status' => $row->status,
                'id_user' => $row->id_user,
                'petani_nama' => $row->petani_nama,
                'alamat' => $row->alamat,
                'petani_foto' =>base_url('gambar_account/'.$row->foto_petani),
                // 'no_rekening' =>$row->no_rekening,

            );
        }
        $x = [
            'semua_produk' => $response,
            'penjualan_eksklusif' => $response2,
            'penjualan_terbaik' => $response3,
            'sedang_laris' => $response4,
        ];
        return $this->respond($x);
    }

    public function show($id = null)
    {
        $model = new DashboardModel();
        $data = $model->showData($id);
        return $this->respond($data);
    }

    public function update($id = null)
    {
        $model = new DashboardModel();
        $data = [
            'nama_produk' => $this->request->getRawInput('nama'),
        ];
        $model->updateData($id, $data);
        $response = [
            'status' => $data,
            'error' => null,
            'messages' => [
                'success' => 'Data produk berhasil diubah'
            ]
        ];
        return $this->respondUpdated($response);
    }

    public function delete($id = null)
    {
        $model = new DashboardModel();
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
