<?php

namespace App\Models;

use CodeIgniter\Model;

class KebunModel extends Model
{
    function getNamaPetani($id)
    {
        $db = \Config\Database::connect();
        $build = $db->table('petani');
        $build->select('petani.nama');
        $build->join('kebun', 'petani.id = kebun.id_petani', "left");
        $build->where('petani.id', $id);
        $result = $build->get()->getRowArray();
        return $result;
    }

    function showSemai($id)
    {
        $db = \Config\Database::connect();
        $build = $db->table('semai');
        $build->select('*');
        $build->where('id_kebun', $id);
        $build->where('status_tanam', 'belum');
        return $build->get()->getResult();
    }

    function showTanam($id)
    {
        $db = \Config\Database::connect();
        $build = $db->table('tanam');
        $build->select('*');
        $build->where('id_kebun', $id);
        $build->where('status_panen', 'belum');
        return $build->get()->getResult();
    }

    function showReport($id)
    {
        $db = \Config\Database::connect();
        $build = $db->table('report');
        $build->select('*');
        $build->where('id_kebun', $id);
        return $build->get()->getResult();
    }

    function getLastId()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('kebun');
        $builder->select('id');
        $builder->orderBy('id', 'DESC');
        $builder->limit(1);
        $query = $builder->get();
        if ($query->getNumRows() > 0) {
            $row = $query->getRow();
            return $row->id;
        } else {
            return "K0001";
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
            $nextId = "K" . str_pad($bagianNumerik, 4, '0', STR_PAD_LEFT);

            $builder = $db->table('kebun');
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