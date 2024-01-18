<?php

namespace App\Controllers;

use App\Models\AccountModel;
use CodeIgniter\RESTful\ResourceController;

class Kelola_User extends ResourceController
{
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        $model = new AccountModel();
        $data = $model->showPetani();
        $data2 = $model->showKonsumen();

        $response = [];
        foreach ($data as $row) {
            $response[] = array(
                'id' => $row->id,
                'nama' => $row->nama,
                'no_telpon' => $row->no_telpon,
                'no_rekening' => $row->no_rekening,
                'alamat' => $row->alamat,
                'foto' => base_url('gambar_account/' . $row->foto),

            );
        }

        $response2 = [];
        foreach ($data2 as $row) {
            $response2[] = array(
                'id' => $row->id,
                'nama' => $row->nama,
                'no_telpon' => $row->no_telpon,
                'alamat' => $row->alamat,
                'foto' => base_url('gambar_account/' . $row->foto),

            );
        }



        $hasil = [
            'data_petani' => $response,
            'data_konsumen' => $response2,
            'title' => "Kelola User"
        ];


        return view('pages/user', $hasil);
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        //
    }

    /**
     * Return a new resource object, with default properties
     *
     * @return mixed
     */
    public function new()
    {
        //
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {
        //
    }

    /**
     * Return the editable properties of a resource object
     *
     * @return mixed
     */
    public function edit($id = null)
    {
    }

    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update($id = null)
    {
        $model = new AccountModel();
        $gambar = $this->request->getFile('foto');
        $no_rekening = $this->request->getVar('no_rekening');
        // ada gambar
        if ($gambar->getError() === UPLOAD_ERR_OK && $gambar->getSize() > 0) {
            $namaGambar = $gambar->getRandomName();
            $gambar->move('gambar_account', $namaGambar);
            unlink('gambar_account/' . basename($this->request->getVar('gambar_lama')));
            // ada rekening
            if ($no_rekening) {
                $data = [
                    'nama' => $this->request->getVar('nama'),
                    'no_telpon' => $this->request->getVar('no_telpon'),
                    'no_rekening' => $this->request->getVar('no_rekening'),
                    'alamat' => $this->request->getVar('alamat'),
                    'foto' => $namaGambar,
                ];
            } else {
                // tidak ada rekening
                $data = [
                    'nama' => $this->request->getVar('nama'),
                    'no_telpon' => $this->request->getVar('no_telpon'),
                    'alamat' => $this->request->getVar('alamat'),
                    'foto' => $namaGambar,
                ];
            }
        } else {
            // tidak ada gambar
            //  ada rekening
            if ($no_rekening) {
                $data = [
                    'nama' => $this->request->getVar('nama'),
                    'no_telpon' => $this->request->getVar('no_telpon'),
                    'no_rekening' => $this->request->getVar('no_rekening'),
                    'alamat' => $this->request->getVar('alamat'),
                ];
            } else {
                // tidak ada rekening
                $data = [
                    'nama' => $this->request->getVar('nama'),
                    'no_telpon' => $this->request->getVar('no_telpon'),
                    'alamat' => $this->request->getVar('alamat'),
                ];
            }
        }

        $hasil = $model->updateRoleData($id, $data);
        $response = [
            'status' => 200,
            'error' => null,
            'messages' => [
                'success' => 'Data produk berhasil diubah'
            ]
        ];
        if ($hasil) {
            return redirect()->to('kelola_user')->with('success', "User berhasil diubah");
        } else {
            return redirect()->to('kelola_user')->with('error', "User gagal diubah");
        }
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        $model = new AccountModel();
        $hasil = $model->deleteUser($id);
        return redirect()->to('kelola_user');
    }
}
