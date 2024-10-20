<?php

namespace App\Models;

use CodeIgniter\Model;

class RumahModel extends Model
{
    protected $DBGroup = 'default';
    protected $table = 'rumah';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_kebun', 'nama_rumah', 'kapasitas', 'gambar', 'deskripsi'];

    function insertData($data)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('rumah');
        $builder->insert($data);
    }

    function getImage($id)
    {
        $db = \Config\Database::connect();
        $build = $db->table('rumah');
        $build->select('gambar');
        $build->where('id', $id);
        return $build->get()->getResult();
    }

    function getLastId()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('rumah');
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

            $builder = $db->table('rumah');
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
