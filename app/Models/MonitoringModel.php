<?php

namespace App\Models;

use CodeIgniter\Model;

class MonitoringModel extends Model
{
    protected $DBGroup = 'default';
    protected $table = 'monitoring';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id', 'id_modul', 'tanggal', 'waktu', 'ppm-awal', 'ph-awal', 'ppm-tambah', 'ph-tambah', 'ppm-akhir', 'ph-akhir'];

    function insertData($data)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('monitoring');
        $builder->insert($data);
    }
    function getLastId()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('monitoring');
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
            $nextId = "M" . str_pad($bagianNumerik, 4, '0', STR_PAD_LEFT);

            $builder = $db->table('monitoring');
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
