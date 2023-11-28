<?php

namespace App\Models;

use CodeIgniter\Model;

class TransaksiModel extends Model
{

    function insertData($data)
    {
        $db = \Config\Database::connect();
        $db->transStart();
        try {
            $model = new TransaksiModel();
            // insert ke tabel tbl_order (parent)
            $builder = $db->table('tbl_transaksi');
            $result = $builder->insert($data['transaksi']);
            // insert ke tabel detail_transaksi (child)
            $builder = $db->table('detail_transaksi');
            foreach ($data['detail_transaksi'] as $item) {
                $id_sebelumnya = $model->getLastId("S001", "detail_transaksi", "id");
                $id_detail_transaksi = $model->getNextId($id_sebelumnya, "S");
                $detail_produk = array(
                    'id' => $id_detail_transaksi,
                    'id_produk' => $item->id_produk,
                    'harga' => $item->harga,
                    'qty' => $item->qty,
                    'id_transaksi' => $data['transaksi']['id'],
                );
                $result = $builder->insert($detail_produk);
                var_dump($result);
            }
            $db->transComplete();

            if ($db->transStatus() === false) {
                return false;
            } else {
                return true;
            }
        } catch (\Throwable $th) {
            $db->transRollback();
            return false;
        }
    }

    function showData($id, $status, $status2 = null, $status3 = null)
    {
        $db = \Config\Database::connect();
        $builder = $db->table("detail_transaksi");
        $builder->select("
        detail_transaksi.id_produk,
        product.nama,
        product.foto,
        detail_transaksi.harga, 
        detail_transaksi.qty AS amount,
        tbl_transaksi.total_harga_produk,
        tbl_transaksi.status AS status,
        tbl_transaksi.id_order,
        detail_transaksi.id_transaksi,
        product.id_user AS id_penjual,
        tbl_transaksi.id_user AS id_pembeli,
        konsumen.alamat,
        konsumen.no_telpon
        ");
        $builder->join("product", "detail_transaksi.id_produk = product.kode");
        $builder->join("tbl_transaksi", "detail_transaksi.id_transaksi = tbl_transaksi.id");
        $builder->join("konsumen", "tbl_transaksi.id_user = konsumen.id_user");
        $builder->where("product.id_user", $id);
        $builder->groupStart(); // Mulai grup klausa OR
        $builder->where("tbl_transaksi.status", $status); // Klausa AND untuk status pertama
        $builder->orWhere("tbl_transaksi.status", $status2); // Klausa OR untuk status kedua
        $builder->orWhere("tbl_transaksi.status", $status3); // Klausa OR untuk status ketiga
        $builder->groupEnd(); // Akhiri grup klausa OR
        $result = $builder->get()->getResult();
        return $result;
    }

    function ubahData($data, $id_transaksi)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('tbl_transaksi');
        $builder->where('id', $id_transaksi);
        $builder->orWhere('id_order', $id_transaksi);
        $builder->update($data);
    }

    function getLastId($user_id, $table, $select)
    {
        $db = \Config\Database::connect();
        $builder = $db->table($table);
        $builder->select($select);
        $builder->orderBy($select, 'DESC');
        $builder->limit(1);
        $query = $builder->get();
        if ($query->getNumRows() > 0) {
            $row = $query->getRow();
            return $row->$select;
        } else {
            return $user_id;
        }
    }

    function getNextId($lastId, $firstWord)
    {
        $bagianNumerik = intval(substr($lastId, 1)) + 1;
        return $firstWord . str_pad($bagianNumerik, 3, '0', STR_PAD_LEFT);
    }
}
