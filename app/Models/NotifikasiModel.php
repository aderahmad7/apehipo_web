<?php 
namespace App\Models;

use CodeIgniter\Model;

class NotifikasiModel extends Model {
    function showData($id) {
        $db = \Config\Database::connect();
        $builder = $db->table("notifikasi");
        $builder->where('id_penerima', $id);
        $result = $builder->get()->getResult();
        return $result;

    }

    function createData($data) {
        $db = \Config\Database::connect();
        $builder = $db->table("notifikasi");
        $builder->insert($data);
    }

    function ubahData($id, $data) {
        $db = \Config\Database::connect();
        $builder = $db->table("notifikasi");
        $builder->where("id", $id);
        $hasil = $builder->update($data);
        return $hasil;
    }

    function deleteData($id) {
        $db = \Config\Database::connect();
        $builder = $db->table('notifikasi');
        $builder->where('id', $id);
        $builder->delete();
    }



    function getLastId($user_id, $table, $select) {
        $db = \Config\Database::connect();
        $builder = $db->table($table);
        $builder->select($select);
        $builder->orderBy($select, 'DESC');
        $builder->limit(1);
        $query = $builder->get();
        if($query->getNumRows() > 0) {
            $row = $query->getRow();
            return $row->$select;
        }else {
            return $user_id;
        }
    }

    function getNextId($lastId, $firstWord) {
        $bagianNumerik = intval(substr($lastId, 1)) + 1;
        return $firstWord . str_pad($bagianNumerik, 3, '0', STR_PAD_LEFT);
    }
}