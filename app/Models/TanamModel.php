<?php

namespace App\Models;

use CodeIgniter\Model;

class TanamModel extends Model
{
    function insertData($data)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('tanam');
        $builder->insert($data);
    }

    function insertManage($data)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('manage');
        $builder->insert($data);
    }

    function getImage($id)
    {
        $db = \Config\Database::connect();
        $build = $db->table('tanam');
        $build->select('gambar');
        $build->where('id', $id);
        return $build->get()->getResult();
    }

    function getIdKebun($id)
    {
        $db = \Config\Database::connect();
        $build = $db->table('tanam');
        $build->select('id_kebun');
        $build->where('id', $id);
        return $build->get()->getResult();
    }

    function getSayur($id)
    {
        $db = \Config\Database::connect();
        $build = $db->table('tanam');
        $build->select('nama_sayur');
        $build->where('id', $id);
        return $build->get()->getResult();
    }

    function updateData($id, $data)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('tanam');
        $builder->where('id', $id);
        $builder->update($data);
    }

    function getLastId()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('tanam');
        $builder->select('id');
        $builder->orderBy('id', 'DESC');
        $builder->limit(1);
        $query = $builder->get();
        if ($query->getNumRows() > 0) {
            $row = $query->getRow();
            return $row->id;
        } else {
            return "T0001";
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
            $nextId = "T" . str_pad($bagianNumerik, 4, '0', STR_PAD_LEFT);

            $builder = $db->table('tanam');
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

    function getLastIdManage()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('manage');
        $builder->select('id');
        $builder->orderBy('id', 'DESC');
        $builder->limit(1);
        $query = $builder->get();
        if ($query->getNumRows() > 0) {
            $row = $query->getRow();
            return $row->id;
        } else {
            return "M0001";
        }
    }

    function getNextIdManage($lastId)
    {
        $db = \Config\Database::connect();
        try {
            $lastIdFromDb = $this->getLastIdManage();

            if ($lastIdFromDb !== $lastId) {
                $lastId = $lastIdFromDb;
            }

            // Get the next ID
            $bagianNumerik = intval(substr($lastId, 1)) + 1;
            $nextId = "M" . str_pad($bagianNumerik, 4, '0', STR_PAD_LEFT);

            $builder = $db->table('manage');
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
