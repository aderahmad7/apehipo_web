<?php

namespace App\Models;

use CodeIgniter\Model;

class AuthModel extends Model
{
    function doLogin($username, $password)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('user');
        $builder->select('username, role');
        $builder->where('username', $username);
        $builder->where('password', $password);
        $result = $builder->get()->getRow();
        return $result;
    }

    function doRegister($data)
    {
        $db = \Config\Database::connect();
        $db->transStart();
        try {
            // select dua kolom
            $builder = $db->table('user');
            $builder->select('username, email');
            $result = $builder->get()->getResult();

            // Mengakses data
            foreach ($result as $row) {
                $username = $row->username;
                $email = $row->email;
                if ($data['user_data']['username'] == $username || $data['user_data']['email'] == $email) {
                    return false;
                }
                // Lakukan sesuatu dengan data yang Anda dapatkan
            }

            // insert ke tabel User (parent)
            $builder = $db->table('user');
            $builder->insert($data['user_data']);

            // insert ke tabel petani (child) atau tabel konsumen (child)
            if ($data['user_data']['role'] == "petani") {
                $builder = $db->table('petani');
                $builder->insert($data['petani_data']);

                $kebun_build = $db->table('kebun');
                $kebun_build->insert($data['kebun_data']);
            } else {
                $builder = $db->table('konsumen');
                $builder->insert($data['konsumen_data']);
            }
            $db->transComplete();

            if ($db->transStatus() === false) {
                return false;
            } else {
                return true;
            }
        } catch (\Exception $e) {
            $db->transRollback(); //rollback transaksi
            return false;
        }
    }

    function show($username)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('user');
        $builder->select('user.username, user.role,
                            COALESCE(petani.id_user, konsumen.id_user) AS id_user,
                            COALESCE(petani.nama, konsumen.nama) AS nama,
                        ');
        $builder->join('petani', 'petani.id_user = user.id_user', "left");
        $builder->join('konsumen', 'konsumen.id_user = user.id_user', "left");
        $builder->where('user.username', $username);
        $result = $builder->get()->getRow();
        return $result;
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
}
