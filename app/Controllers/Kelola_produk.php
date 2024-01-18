<?php

namespace App\Controllers;

use App\Models\DashboardModel;
use App\Models\ProductModel;
use CodeIgniter\RESTful\ResourceController;

class Kelola_Produk extends ResourceController
{
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        $model = new DashboardModel();
        $data = $model->getAllData();

        $response = [];
        foreach ($data as $row) {
            $response[] = array(
                'kode' => $row->kode,
                'produk_nama' => $row->produk_nama,
                'jenis' => $row->jenis,
                'harga' => $row->harga,
                'stok' => $row->stok,
                'deskripsi' => $row->deskripsi,
                'produk_foto' => base_url('gambar/' . $row->foto_produk),
                'status' => $row->status,
                'id_user' => $row->id_user,
                'petani_nama' => $row->petani_nama,
                'alamat' => $row->alamat,
                'petani_foto' => base_url('gambar_account/' . $row->foto_petani),
                'no_telpon' => $row->no_telpon,

            );
        }

        $hasil = [
            "all_product" => $response,
            'title' => "Kelola Produk",
            'validation' => \Config\Services::validation(),
        ];

        return view('pages/Produk', $hasil);
    }

    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update($id = null)
    {
        $model = new ProductModel();

        $gambar = $this->request->getFile('foto');
        if ($gambar->getError() === UPLOAD_ERR_OK && $gambar->getSize() > 0) {
            $namaGambar = $gambar->getRandomName();
            $gambar->move('gambar', $namaGambar);
            unlink('gambar/' . basename($this->request->getVar('gambar_lama')));
            $data = [
                'nama' => $this->request->getVar('nama'),
                'jenis' => $this->request->getVar('jenis'),
                'harga' => $this->request->getVar('harga'),
                'stok' => $this->request->getVar('stok'),
                'status' => $this->request->getVar('status'),
                'deskripsi' => $this->request->getVar('deskripsi'),
                'foto' => $namaGambar,
            ];
        } else {
            $data = [
                'nama' => $this->request->getVar('nama'),
                'jenis' => $this->request->getVar('jenis'),
                'harga' => $this->request->getVar('harga'),
                'stok' => $this->request->getVar('stok'),
                'status' => $this->request->getVar('status'),
                'deskripsi' => $this->request->getVar('deskripsi'),
            ];
        }
        $hasil = $model->update($id, $data);
        $response = [
            'status' => $data,
            'error' => null,
            'messages' => [
                'success' => 'Data produk berhasil diubah'
            ]
        ];
        return redirect()->to('kelola_produk');
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        $model = new ProductModel();
        $model->deleteData($id);
        $response = [
            'status' => 200,
            'error' => null,
            'messages' => [
                'success' => 'Data produk berhasil dihapus'
            ]
        ];
        return redirect()->to('kelola_produk');
    }
}
