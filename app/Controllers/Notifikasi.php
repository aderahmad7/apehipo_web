<?php 
namespace App\Controllers;

use App\Models\NotifikasiModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\HTTP\RequestTrait;

class Notifikasi extends ResourceController {
    use RequestTrait;

    public function show($id = null) {
        $model = new NotifikasiModel();
        $data = $model->showData($id);
        $response = [
            'status' => 200,
            'error' => null,
            'messages' => [
                'success' => 'Data notifikasi berhasil ditampilkan'
            ]
            ];
            return $this->respond($data);
    }

    public function create() {
        $model = new NotifikasiModel();
        // id
        $id_sebelumnya = $model->getLastId("N001", "notifikasi", "id");
        $id_notifikasi = $model->getNextId($id_sebelumnya, "N");
        $currentDateTime = date('Y-m-d H:i:s');
        
        $data = [
            'id' => $id_notifikasi,
            'date_time' => $currentDateTime,
            'pesan' => $this->request->getVar("pesan"),
            'detail_pesan' => $this->request->getVar('detail_pesan'),
            'id_penerima' => $this->request->getVar('id_penerima'),
            'id_pengirim' => $this->request->getVar('id_pengirim'),
            'status' => "false",
        ];
        
        $model->createData($data);
        $response = [
            'status' => 201,
            'error' => null,
            'messages' => [
                'success' => 'Data notifikasi berhasil ditambah'
            ]
        ];

        return $this->respondCreated($response);
    }

    public function ubah($id) {
        $model = new NotifikasiModel();
        $data = [
            'status' => $this->request->getVar("status"),
        ];
        $model->ubahData($id, $data);
        $response = [
            'status' => 201,
            'error' => null,
            'messages' => [
                'success' => 'Data notifikasi berhasil diubah'
            ]
            ];
            return $this->respondUpdated($response);
    }

    public function delete($id = null) {
        $model = new NotifikasiModel();
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