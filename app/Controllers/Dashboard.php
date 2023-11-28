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
        $data2 = $model->getKlasifikasi("Buah");
        $data3 = $model->getKlasifikasi("Sayuran");
        $response = [];
        $response2 = [];
        $response3 = [];
        foreach($data as $row) {
            $response[] = array(
                'kode' => $row->kode,
                'produk_nama' => $row->produk_nama,
                'jenis' => $row->jenis,
                'harga' => $row->harga,
                'stok' => $row->stok,
                'deskripsi' => $row->deskripsi,
                'produk_foto' => base_url('gambar/'.$row->foto_produk),
                'status' => $row->status,
                'id_user' => $row->id_user,
                'petani_nama' => $row->petani_nama,
                'alamat' => $row->alamat,
                'petani_foto' =>base_url('gambar_account/'.$row->foto_petani),
                'no_telpon' =>$row->no_telpon,

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
                'status' => $row->status,
                'id_user' => $row->id_user,
                'petani_nama' => $row->petani_nama,
                'alamat' => $row->alamat,
                'petani_foto' =>base_url('gambar_account/'.$row->foto_petani),
                'no_telpon' => $row->no_telpon,
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
                'status' => $row->status,
                'id_user' => $row->id_user,
                'petani_nama' => $row->petani_nama,
                'alamat' => $row->alamat,
                'petani_foto' =>base_url('gambar_account/'.$row->foto_petani),
                'no_telpon' =>$row->no_telpon,
                // 'no_rekening' =>$row->no_rekening,

            );
        }
        $x = [
            'semua_produk' => $response,
            'buah' => $response2,
            'sayuran' => $response3,
        ];
        return $this->respond($x);
    }

    public function cari($keyword = null) {
        $model = new DashboardModel();
        $data = $model->searchData($keyword);
        $response5 = [];
        foreach($data as $row) {
            $response5[] = array(
                'kode' => $row->kode,
                'produk_nama' => $row->produk_nama,
                'jenis' => $row->jenis,
                'harga' => $row->harga,
                'stok' => $row->stok,
                'deskripsi' => $row->deskripsi,
                'produk_foto' => base_url('gambar/'.$row->foto_produk),
                'status' => $row->status,
                'id_user' => $row->id_user,
                'petani_nama' => $row->petani_nama,
                'alamat' => $row->alamat,
                'petani_foto' =>base_url('gambar_account/'.$row->foto_petani),
                'no_telpon' =>$row->no_telpon,
            );
        }
        $x = [
            'produk_search' => $response5,
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
