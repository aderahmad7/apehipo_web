<?php 
namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\AccountModel;

class Account extends ResourceController
{
    public function show($id = null) {
        $model = new AccountModel();

        $data = $model->showData($id);
        $data->foto = base_url('gambar_account/'.$data->foto);
        return $this->respond($data);
    }

    public function update($id = null)
    {
        $model = new AccountModel();
        if($gambar = $this->request->getFile('foto')) {
            var_dump($gambar);
            $namaGambar = $gambar->getRandomName();
            $gambar->move('gambar_account', $namaGambar);
            // unlink("/gambar_account".$this->request->getVar('fotoLama'));
            $data = [
                'user_data' => [
                    'username' => $this->request->getVar('username'),
                    'email' => $this->request->getVar('email'),
                    'role' => $this->request->getVar('role')
                ],
                'petani_data' => [
                    'nama' => $this->request->getVar('nama'),
                    'alamat' => $this->request->getVar('alamat'),
                    'no_telpon' => $this->request->getVar('no_telpon'),
                    'no_rekening' => $this->request->getVar('no_rekening'),
                    'foto' => $namaGambar,
                ],
                'konsumen_data' => [
                    'nama' => $this->request->getVar('nama'),
                    'alamat' => $this->request->getVar('alamat'),
                    'no_telpon' => $this->request->getVar('no_telpon'),
                    'foto' => $namaGambar,
                ]
            ];
        }else {
            $data = [
                'user_data' => [
                    'username' => $this->request->getVar('username'),
                    'email' => $this->request->getVar('email'),
                    'role' => $this->request->getVar('role')
                ],
                'petani_data' => [
                    'nama' => $this->request->getVar('nama'),
                    'alamat' => $this->request->getVar('alamat'),
                    'no_telpon' => $this->request->getVar('no_telpon'),
                    'no_rekening' => $this->request->getVar('no_rekening'),
                ],
                'konsumen_data' => [
                    'nama' => $this->request->getVar('nama'),
                    'alamat' => $this->request->getVar('alamat'),
                    'no_telpon' => $this->request->getVar('no_telpon'),
                ]
            ];
        }

        $model->updateData($id, $data);
        $response = [
            'status' => $data,
            'error' => null,
            'messages' => [
                'success' => 'Data akun berhasil diubah'
            ]
        ];
            return $this->respondUpdated($response); 
    }
}


?>