<?php

namespace App\Models;

use CodeIgniter\Model;

class ReportModel extends Model
{
    function insertData($data)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('report');
        $builder->insert($data);
    }

    function updateData($key, $id, $data)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('report');
        $builder->where($key, $id);
        $builder->update($data);
    }

    function deleteData($key, $id)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('report');
        $builder->where($key, $id);
        $builder->delete();
    }

    function sumTotalSemai($id)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('report');
        $builder->selectSum('jumlah_semai');
        $builder->where('id_kebun', $id);
        return $builder->get()->getResult();
    }

    function sumTotalTanam($id)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('report');
        $builder->selectSum('jumlah_tanam');
        $builder->where('id_kebun', $id);
        return $builder->get()->getResult();
    }

    function sumTotalPanen($id)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('report');
        $builder->selectSum('jumlah_panen');
        $builder->where('id_kebun', $id);
        return $builder->get()->getResult();
    }

    function sumJumlahSayur($id)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('report');
        $builder->where('id_kebun', $id);
        return $builder->countAllResults();
    }

    function getTanggalSemai($id_tanam)
    {
        $db = \Config\Database::connect();
        $build = $db->table('report');
        $build->select('tanggal_semai');
        $build->where('id_tanam', $id_tanam);
        return $build->get()->getResult();
    }

    function getLastId()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('report');
        $builder->select('id');
        $builder->orderBy('id', 'DESC');
        $builder->limit(1);
        $query = $builder->get();
        if ($query->getNumRows() > 0) {
            $row = $query->getRow();
            return $row->id;
        } else {
            return "R0001";
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
            $nextId = "R" . str_pad($bagianNumerik, 4, '0', STR_PAD_LEFT);

            $builder = $db->table('report');
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