<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\BaseBuilder;

class SemaiModel extends Model
{
    protected $table = 'semai';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id', 'id_kebun', 'gambar', 'jenis_sayur', 'tanggal', 'jumlah', 'waktu', 'status_tanam'];

    function showData($id)
    {
        $db = \Config\Database::connect();
        $build = $db->table('semai');
        $build->where('id', $id);
        return $build->get()->getResult();
    }
    function insertData($data)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('semai');
        $builder->insert($data);
    }

    function updateData($id, $data)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('semai');
        $builder->where('id', $id);
        $builder->update($data);
    }

    function deleteData($id)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('semai');
        $builder->where('id', $id);
        $builder->delete();
    }

    function getImage($id)
    {
        $db = \Config\Database::connect();
        $build = $db->table('semai');
        $build->select('gambar');
        $build->where('id', $id);
        return $build->get()->getResult();
    }

    function getJumlah($id)
    {
        $db = \Config\Database::connect();
        $build = $db->table('semai');
        $build->select('jumlah');
        $build->where('id', $id);
        return $build->get()->getResult();
    }

    function getTanggal($id)
    {
        $db = \Config\Database::connect();
        $build = $db->table('semai');
        $build->select('tanggal');
        $build->where('id', $id);
        return $build->get()->getResult();
    }

    function getIdKebun($id)
    {
        $db = \Config\Database::connect();
        $build = $db->table('semai');
        $build->select('id_kebun');
        $build->where('id', $id);
        return $build->get()->getResult();
    }

    function getSayur($id)
    {
        $db = \Config\Database::connect();
        $build = $db->table('semai');
        $build->select('jenis_sayur');
        $build->where('id', $id);
        return $build->get()->getResult();
    }

    function getLastId()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('semai');
        $builder->select('id');
        $builder->orderBy('id', 'DESC');
        $builder->limit(1);
        $query = $builder->get();
        if ($query->getNumRows() > 0) {
            $row = $query->getRow();
            return $row->id;
        } else {
            return "S0001";
        }
    }

    function getNextId($lastId)
    {
        $db = \Config\Database::connect();
        try {
            $lastIdFromDb = $this->getLastId();
            if ($lastIdFromDb !== $lastId) {
                $lastId = $lastIdFromDb;
            }
            // Get the next ID
            $bagianNumerik = intval(substr($lastId, 1)) + 1;
            $nextId = "S" . str_pad($bagianNumerik, 4, '0', STR_PAD_LEFT);

            $builder = $db->table('semai');
            $builder->where('id', $nextId);
            $query = $builder->get();
            if ($query->getNumRows() > 0) {
                return $this->getNextIdManage($lastIdFromDb);
            }

            // Complete transaction
            $db->transComplete();

            return $nextId;
        } catch (\Throwable $th) {
            $db->transRollback();
            return null;
        }
    }

    function searchData($key, $id_kebun)
    {
        // Pastikan parameter tidak null
        if (is_null($key) || is_null($id_kebun)) {
            return []; // Return an empty array if key or id_kebun is null
        }


        $db = \Config\Database::connect();
        $build = $db->table('semai');
        $build->where('id_kebun', $id_kebun);
        $build->where('status_tanam', 'belum');

        // LIKE 
        $build->groupStart();
        $build->like('jenis_sayur', $key, 'both');
        $build->orLike('tanggal', $key, 'both');
        $build->orLike('jumlah', $key, 'both');
        $build->orLike('waktu', $key, 'both');
        $build->groupEnd();

        return $build->get()->getResult();
    }
}
