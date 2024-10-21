<?php

namespace App\Models;

use CodeIgniter\Model;

class PanenModel extends Model
{
    protected $DBGroup = 'default';
    protected $table = 'panen';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id', 'id_kebun', 'id_modul', 'nama_sayur', 'gambar', 'tanggal_semai', 'tanggal_tanam', 'tanggal_panen', 'jumlah_semai', 'jumlah_tanam', 'jumlah_panen', 'keterangan'];

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

    function searchData($key, $id_modul)
    {
        // Pastikan parameter tidak null
        if (is_null($key) || is_null($id_modul)) {
            return []; // Return an empty array if key or id_modul is null
        }


        $db = \Config\Database::connect();
        $build = $db->table('panen');
        $build->where('id_modul', $id_modul);

        // LIKE 
        $build->groupStart();
        $build->like('nama_sayur', $key, 'both');
        $build->orLike('jumlah_semai', $key, 'both');
        $build->orLike('jumlah_tanam', $key, 'both');
        $build->orLike('jumlah_panen', $key, 'both');
        $build->orLike('tanggal_semai', $key, 'both');
        $build->orLike('tanggal_tanam', $key, 'both');
        $build->orLike('tanggal_panen', $key, 'both');
        $build->orLike('keterangan', $key, 'both');
        $build->groupEnd();

        return $build->get()->getResult();
    }
}
