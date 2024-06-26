<?php

namespace App\Models;

use CodeIgniter\Model;

final class AccountModel extends Model
{
    function showData($id)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('user');
        $builder->select('user.username, user.role, user.email,  
                            COALESCE(petani.id_user, konsumen.id_user) AS id_user,
                            COALESCE(petani.nama, konsumen.nama) AS nama,
                            COALESCE(petani.alamat, konsumen.alamat) AS alamat,
                            COALESCE(petani.no_telpon, konsumen.no_telpon) AS no_telpon,
                            COALESCE(petani.foto, konsumen.foto) AS foto,
                            petani.no_rekening,
                        ');
        $builder->join('petani', 'petani.id_user = user.id_user', "left");
        $builder->join('konsumen', 'konsumen.id_user = user.id_user', "left");
        $builder->where('user.id_user', $id);
        $result = $builder->get()->getRow();
        return $result;
    }

    function updateData($id, $data)
    {
        $db = \Config\Database::connect();
        $db->transStart();
        try {
            // insert ke tabel User (parent)
            $builder = $db->table('user');
            $builder->where("id_user", $id);
            $builder->update($data['user_data']);
            // mencari id
            $builder = $db->table('user');
            $builder->select('
            COALESCE(petani.id, konsumen.id) AS id');
            $builder->join('petani', 'petani.id_user = user.id_user', "left");
            $builder->join('konsumen', 'konsumen.id_user = user.id_user', "left");
            $builder->where("user.id_user", $id);
            $query = $builder->get()->getRow();
            $id_child = $query->id;
            //insert ke tabel petani (child) atau tabel konsumen (child)
            if ($data['user_data']['role'] == "petani") {
                $builder = $db->table('petani');
                $builder->where("id", $id_child);
                $builder->update($data['petani_data']);
            } else {
                $builder = $db->table('konsumen');
                $builder->where("id", $id_child);
                $builder->update($data['konsumen_data']);
            }
            $db->transComplete();


            if ($db->transStatus() === false) {
                return false;
            } else {
                return true;
            }
        } catch (\Throwable $th) {
            $db->transRollback();
            return false;
        }
    }

    function getLastId($user_id, $table, $select)
    {
        $db = \Config\Database::connect();
        $builder = $db->table($table);
        $builder->select($select);
        $builder->orderBy($select, 'DESC');
        $builder->limit(1);
        $query = $builder->get();
        if ($query->getNumRows() > 0) {
            $row = $query->getRow();
            return $row->$select;
        } else {
            return $user_id;
        }
    }

    function getNextId($lastId, $firstWord)
    {
        $bagianNumerik = intval(substr($lastId, 1)) + 1;
        return $firstWord . str_pad($bagianNumerik, 3, '0', STR_PAD_LEFT);
    }


    // function for web development
    function updateRoleData($id, $data)
    {
        $db = \Config\Database::connect();
        if (array_key_exists('no_rekening', $data)) {
            $builder = $db->table('petani');
        } else {
            $builder = $db->table('konsumen');
        }
        $builder->where('id', $id);
        return $builder->update($data);
    }

    function showPetani()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('petani');
        $result = $builder->get()->getResult();
        return $result;
    }

    function showKebun()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('kebun');
        $result = $builder->get()->getResult();
        return $result;
    }

    function showKonsumen()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('konsumen');
        $result = $builder->get()->getResult();
        return $result;
    }

    function deleteUser($id)
    {
        $db = \Config\Database::connect();
        $db->transStart();
        try {
            if (substr($id, 0, 1) === 'T') {
                $builder = $db->table('petani');
            } else {
                $builder = $db->table('konsumen');
            }
            // mencari nilai id_user pada table user
            $builder->select('id, id_user');
            $builder->where('id', $id);
            $query = $builder->get()->getRow();
            $id_user = $query->id_user;

            // delete role
            $builder->where('id', $id);
            $hasil = $builder->delete();

            // delete user
            $builder = $db->table('user');
            $builder->where('id_user', $id_user);
            $hasil = $builder->delete();
            $db->transComplete();

            if ($db->transStatus() === false) {
                return false;
            } else {
                return true;
            }
        } catch (\Throwable $th) {
            //throw $th;
            $db->transRollback();
            return false;
        }
    }
}
