<?php

namespace App\Models;

use CodeIgniter\Model;

class TanamModel extends Model
{
    protected $DBGroup = 'default';
    protected $table = 'tanam';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id', 'id_kebun', 'id_modul', 'nama_sayur', 'gambar', 'tanggal_semai', 'tanggal_tanam', 'jumlah_semai', 'jumlah_bibit', 'masa_tanam', 'keterangan', 'status_panen'];

    function insertData($data)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('tanam');
        $builder->insert($data);
    }

    function editManage($id, $data)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('tanam');
        $builder->where('id', $id);
        $builder->update($data);
    }

    function getImage($id)
    {
        $db = \Config\Database::connect();
        $build = $db->table('tanam');
        $build->select('gambar');
        $build->where('id', $id);
        return $build->get()->getResult();
    }

    function getJumSemai($id)
    {
        $db = \Config\Database::connect();
        $build = $db->table('tanam');
        $build->select('jumlah_semai');
        $build->where('id', $id);
        return $build->get()->getResult();
    }

    function getJumTanam($id)
    {
        $db = \Config\Database::connect();
        $build = $db->table('tanam');
        $build->select('jumlah_bibit');
        $build->where('id', $id);
        return $build->get()->getResult();
    }

    function getIdModul($id)
    {
        $db = \Config\Database::connect();
        $build = $db->table('tanam');
        $build->select('id_modul');
        $build->where('id', $id);
        return $build->get()->getResult();
    }

    function getTglSemai($id)
    {
        $db = \Config\Database::connect();
        $build = $db->table('tanam');
        $build->select('tanggal_semai');
        $build->where('id', $id);
        return $build->get()->getResult();
    }

    function getTglTanam($id)
    {
        $db = \Config\Database::connect();
        $build = $db->table('tanam');
        $build->select('tanggal_tanam');
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

    function searchData($key, $id_modul)
    {
        // Pastikan parameter tidak null
        if (is_null($key) || is_null($id_modul)) {
            return []; // Return an empty array if key or id_modul is null
        }


        $db = \Config\Database::connect();
        $build = $db->table('tanam');
        $build->where('id_modul', $id_modul);
        $build->where('status_panen', 'belum');

        // LIKE 
        $build->groupStart();
        $build->like('nama_sayur', $key, 'both');
        $build->orLike('jumlah_bibit', $key, 'both');
        $build->orLike('tanggal_semai', $key, 'both');
        $build->orLike('tanggal_tanam', $key, 'both');
        $build->orLike('masa_tanam', $key, 'both');
        $build->orLike('keterangan', $key, 'both');
        $build->groupEnd();

        return $build->get()->getResult();
    }

    function searchTgl($tgl, $id_kebun)
    {
        // Pastikan parameter tidak null
        if (is_null($tgl) || is_null($id_kebun)) {
            return [];
        }


        $db = \Config\Database::connect();
        $build = $db->table('tanam');
        $build->where('id_kebun', $id_kebun);
        $build->where('tanggal_tanam', $tgl);
        $build->where('status_panen', 'belum');


        return $build->get()->getResult();
    }
}
