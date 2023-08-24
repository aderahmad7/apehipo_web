<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\AuthModel;
use CodeIgniter\Model;

class Auth extends ResourceController
{
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function create()
    {
        $model = new AuthModel();
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');

        $login = $model->doLogin($username, $password);

        return $this->respond($login);
    }

    public function register() {
        $model = new AuthModel();

        // id untuk table user
        $id_sebelumnya = $model->getLastId("U001", "user", "id_user");
        $id_user = $model->getNextId($id_sebelumnya, "U");

        //id untuk table petani
        $id_sebelumnya = $model->getLastId("T001", "petani", "id");
        $id_petani = $model->getNextId($id_sebelumnya, "T");

        //id untuk table konsumen
        $id_sebelumnya = $model->getLastId("K001", "konsumen", "id");
        $id_konsumen = $model->getNextId($id_sebelumnya, "K");
        $data = [
            // PR relasi petani dan user dan ngambil id nya
            'user_data' => [
                'id_user' => $id_user,
                'username' => $this->request->getVar('username'),
                'email' => $this->request->getVar('email'),
                'password' => $this->request->getVar('password'),
                'role' => $this->request->getVar('role'),
            ],
            'petani_data' => [
                'id' => $id_petani,
                'id_user' => $id_user,
                'nama' => $this->request->getVar('nama'),
                'no_telpon' => $this->request->getVar('no_telpon'),
                'no_rekening' => $this->request->getVar('no_rekening'),
                'alamat' => $this->request->getVar('alamat'),
            ],
            'konsumen_data' => [
                'id' => $id_konsumen,
                'id_user' => $id_user,
                'nama' => $this->request->getVar('nama'),
                'no_telpon' => $this->request->getVar('no_telpon'),
                'alamat' => $this->request->getVar('alamat'),
            ]
            
        ];
        
        $model->doRegister($data);
        $response = [
            'status' => '201',
            'error' => 'null',
            'message' => [
                'success' => 'Data user berhasil ditambahkan'
            ]
        ];
       
        return $this->respondCreated($response);


    }

    public function show( $username = null) {
        $model = new AuthModel();
        
       $result =  $model->show($username);
       return $this->respond($result);
    }

    // public function create() {
    //     $model = new AuthModel();
        
    // }

}


?>