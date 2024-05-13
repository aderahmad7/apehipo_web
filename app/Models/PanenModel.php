<?php

namespace App\Models;

use CodeIgniter\Model;

class PanenModel extends Model
{
    function insertData($data)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('panen');
        $builder->insert($data);
    }

    function getLastId()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('panen');
        $builder->select('id');
        $builder->orderBy('id', 'DESC');
        $builder->limit(1);
        $query = $builder->get();
        if ($query->getNumRows() > 0) {
            $row = $query->getRow();
            return $row->id;
        } else {
            return "P0001";
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
            $nextId = "P" . str_pad($bagianNumerik, 4, '0', STR_PAD_LEFT);

            $builder = $db->table('panen');
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
