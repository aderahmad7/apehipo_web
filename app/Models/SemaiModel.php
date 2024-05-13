<?php

namespace App\Models;

use CodeIgniter\Model;

class SemaiModel extends Model
{
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
}
