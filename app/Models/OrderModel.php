<?php 

namespace App\Models;

use CodeIgniter\Model;

class OrderModel extends Model {

    function insertData($data) {
        $db = \Config\Database::connect();
        $db->transStart();
        try {
            $model = new OrderModel();
            // insert ke tabel tbl_order (parent)
            $builder = $db->table('tbl_order');
            $builder->insert($data['order']);
            // insert ke tabel order_details 
            $builder = $db->table('detail_order');
            foreach ($data['detail_order'] as $item) {
                $id_sebelumnya = $model->getLastId("D001", "detail_order", "id");
                $id_detail_order = $model->getNextId($id_sebelumnya, "D");
                $detail_produk = array(
                    'id' =>  $id_detail_order,
                    'id_produk' => $item->id_produk,
                    'harga' => $item->harga,
                    'qty' => $item->qty,
                    'id_order' => $data['order']['id'],
                );
                $builder->insert($detail_produk);
            }
            $db->transComplete();

            if($db->transStatus() === false) {
                return false;
            }else {
                return true;
            }
        } catch (\Throwable $th) {
            $db->transRollback();
            return false;
        }
    }

    function showAllData($status) {
        $db = \Config\Database::connect();
        $builder = $db->table('tbl_order');
        $builder->select('
        detail_order.id_produk,
        product.nama,
        product.foto,
        detail_order.harga,
        detail_order.qty,
        detail_order.id_order,
        tbl_order.total_harga_produk,
        tbl_order.waktu_kedaluarsa,
        tbl_order.status,
        tbl_order.id_user AS id_pembeli,
        tbl_transaksi.status AS status_transaksi,
        tbl_order.bukti_pembayaran,
        product.id_user AS id_penjual
        ');
        $builder->join('detail_order', 'detail_order.id_order = tbl_order.id');
        $builder->join('product', 'product.kode = detail_order.id_produk');
        $builder->join('tbl_transaksi', 'tbl_transaksi.id_order = tbl_order.id', "LEFT");
        $builder->where('tbl_order.status', $status);
        $result = $builder->get()->getResult();
        return $result;
    }

    function showData($status, $id) {
        $db = \Config\Database::connect();
        $builder = $db->table('tbl_order');
        $builder->select('
        detail_order.id_produk,
        product.nama,
        product.foto,
        detail_order.harga,
        detail_order.qty,
        detail_order.id_order,
        tbl_order.total_harga_produk,
        tbl_order.waktu_kedaluarsa,
        tbl_order.status,
        tbl_order.id_user AS id_pembeli,
        tbl_transaksi.status AS status_transaksi, 
        tbl_order.bukti_pembayaran,
        product.id_user AS id_penjual
        ');
        $builder->join('detail_order', 'detail_order.id_order = tbl_order.id');
        $builder->join('product', 'product.kode = detail_order.id_produk');
        $builder->join('tbl_transaksi', 'tbl_transaksi.id_order = tbl_order.id', "LEFT");
        $builder->where('tbl_order.id_user', $id);
        $builder->where('tbl_order.status', $status);
        $result = $builder->get()->getResult();
        return $result;
    }

    // Backend - Frontend
    function showDataWithUsername($status) {
        $db = \Config\Database::connect();
        $builder = $db->table('tbl_order');
        $builder->select('
        detail_order.id_produk,
        product.nama,
        product.foto,
        detail_order.harga,
        detail_order.qty,
        detail_order.id_order,
        tbl_order.total_harga_produk,
        tbl_order.waktu_kedaluarsa,
        tbl_order.status,
        tbl_order.id_user AS id_pembeli,
        tbl_transaksi.status AS status_transaksi, 
        tbl_order.bukti_pembayaran,
        product.id_user AS id_penjual,
        user.username AS username,
        ');
        $builder->join('detail_order', 'detail_order.id_order = tbl_order.id');
        $builder->join('product', 'product.kode = detail_order.id_produk');
        $builder->join('user','user.id_user = tbl_order.id_user');
        $builder->join('tbl_transaksi', 'tbl_transaksi.id_order = tbl_order.id', "LEFT");
        $builder->where('tbl_order.status', $status);
        $result = $builder->get()->getResult();
        return $result;
    }

    function ubahData($id, $data) {
        $db = \Config\Database::connect();
        $builder = $db->table('tbl_order');
        $builder->where('id', $id);
        $builder->update($data); 
        $result = $builder->get()->getResult();
        return $result;

    }

    function kirimDataGambar($id, $data) {
        $db = \Config\Database::connect();
        $builder = $db->table('tbl_order');
        $builder->where('id', $id);
        $builder->update($data);
        $result = $builder->get()->getResult();
        return $result;
    }

    function deleteData($id) {
        $db = \Config\Database::connect();
        $db->transStart();

        try {
            // delete tabel tbl_order (parent)
            $builder = $db->table('tbl_order');
            $builder->where('id', $id);
            $builder->delete();
            // delete tabel detail_order (child)
            $builder = $db->table('detail_order');
            $builder->where('id_order', $id);
            $builder->delete();

            $db->transComplete();

            if($db->transStatus() === false) {
                return false;
            }else {
                return true;
            }
        } catch (\Throwable $th) {
            $db->transRollback();
            return false;
            //throw $th;
        }
        // $builder = $db->table('tbl_order');
        // $builder->where('id', $id);
        // $builder->delete();
    }

    function getLastId($user_id, $table, $select) {
        $db = \Config\Database::connect();
        $builder = $db->table($table);
        $builder->select($select);
        $builder->orderBy($select, 'DESC');
        $builder->limit(1);
        $query = $builder->get();
        if($query->getNumRows() > 0) {
            $row = $query->getRow();
            return $row->$select;
        }else {
            return $user_id;
        }
    }

    function getNextId($lastId, $firstWord) {
        $bagianNumerik = intval(substr($lastId, 1)) + 1;
        return $firstWord . str_pad($bagianNumerik, 3, '0', STR_PAD_LEFT);
    }
}