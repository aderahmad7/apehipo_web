<?php

namespace App\Models;

use CodeIgniter\Model;

class DashboardModel extends Model
{

    function getAllData()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('product');
        $builder->select(
            '
        product.kode AS kode, 
        product.nama AS produk_nama, 
        product.jenis,
        product.harga, 
        product.stok, 
        product.deskripsi, 
        product.foto AS foto_produk, 
        product.status, 
        product.id_user, 
        petani.nama AS petani_nama, 
        petani.alamat, 
        petani.foto AS foto_petani,
        petani.no_telpon',
        );
        $builder->join('petani', 'petani.id_user = product.id_user', 'inner');
        $builder->where("status", "tampil");
        return $builder->get()->getResult();
    }

    function getKlasifikasi($jenis)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('product');
        $builder->select('
        product.kode AS kode, 
        product.nama AS produk_nama, 
        product.jenis,
        product.harga, 
        product.stok, 
        product.deskripsi, 
        product.foto AS foto_produk, 
        product.status, 
        product.id_user, 
        petani.nama AS petani_nama, 
        petani.alamat, 
        petani.foto AS foto_petani, 
        petani.no_telpon
        ');
        $builder->join('petani', 'petani.id_user = product.id_user', 'inner');
        $builder->where('jenis', $jenis);
        $builder->where('status', "tampil");
        return $builder->get()->getResult();
    }

    // contoh 
    // jadi nanti untuk penjualan eksklusif, penjualan terbaik dan sedang laris itu dibagi tiap function lalu dipanggil di satu controller untuk memanggil data. nanti key => value itu, key nya adalah judul value itu adalah hasil ngambil dari model.

    function insertData($data)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('product');
        $builder->insert($data);
    }

    function updateData($id, $data)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('product');
        $builder->where('kode', $id);
        $builder->update($data);
    }

    function searchData($keyword)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('product');
        $builder->select(
            'product.kode AS kode, 
        product.nama AS produk_nama, 
        product.jenis,
        product.harga, 
        product.stok, 
        product.deskripsi, 
        product.foto AS foto_produk, 
        product.status, 
        product.id_user, 
        petani.nama AS petani_nama, 
        petani.alamat, 
        petani.foto AS foto_petani,
        petani.no_telpon',
        );
        $builder->join('petani', 'petani.id_user = product.id_user', 'inner');
        // Mencari kata kunci dengan LIKE menggunakan wildcard %
        $builder->where('product.status', "tampil");
        $builder->groupStart(); // Mulai grup klausa OR
        $builder->like('product.nama', $keyword, 'both'); // 'both' berarti wildcard % di awal dan akhir
        $builder->orLike('product.jenis', $keyword, 'both'); // 'both' berarti wildcard % di awal dan akhir
        $builder->groupEnd(); // Akhir grup klausa OR
        $result = $builder->get()->getResult();
        return $result;
    }


    function showData($id)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('product');
        $builder->where('kode', $id);
        $result = $builder->get()->getRow();
        return $result;
    }

    function deleteData($id)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('product');
        $builder->where('kode', $id);
        $builder->delete();
    }
}
