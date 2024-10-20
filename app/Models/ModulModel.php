<?php

namespace App\Models;

use CodeIgniter\Model;

class ModulModel extends Model
{
    protected $DBGroup = 'default';
    protected $table = 'modul';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id', 'id_kebun', 'nama', 'kapasitas', 'keterangan', 'gambar', 'terisi', 'kosong'];

    function getLastId()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('modul');
        $builder->select('id');
        $builder->orderBy('id', 'DESC');
        $builder->limit(1);
        $query = $builder->get();
        if ($query->getNumRows() > 0) {
            $row = $query->getRow();
            return $row->id;
        } else {
            return "MOD0001";
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
            $nextId = "MOD" . str_pad($bagianNumerik, 4, '0', STR_PAD_LEFT);

            $builder = $db->table('modul');
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

    public function getImage($id)
    {
        return $this->select('gambar')->where('id', $id)->first();
    }
}
