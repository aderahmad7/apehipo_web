<?php
 
namespace App\Models;
 
use CodeIgniter\Model;
 
class DashboardModel extends Model
{

    function getAllData() {
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
        product.klasifikasi, 
        product.status, 
        product.id_user, 
        petani.nama AS petani_nama, 
        petani.alamat, 
        petani.foto AS foto_petani,
        petani.no_rekening',
    );
        $builder->join('petani', 'petani.id_user = product.id_user', 'inner');
        return $builder->get()->getResult();
    }

    function getKlasifikasi($klasifikasi) {
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
        product.klasifikasi, 
        product.status, 
        product.id_user, 
        petani.nama AS petani_nama, 
        petani.alamat, 
        petani.foto AS foto_petani');
        $builder->join('petani', 'petani.id_user = product.id_user', 'inner');
        $builder->where('klasifikasi', $klasifikasi);
        // $builder->orwhere('klasifikasi', 'penjualan eksklusif');
        // $builder->orwhere('klasifikasi', 'sedang laris');
        return $builder->get()->getResult();
    }

    // contoh 
    // jadi nanti untuk penjualan eksklusif, penjualan terbaik dan sedang laris itu dibagi tiap function lalu dipanggil di satu controller untuk memanggil data. nanti key => value itu, key nya adalah judul value itu adalah hasil ngambil dari model.

    function insertData($data) {
        $db = \Config\Database::connect();
        $builder = $db->table('product');
        $builder->insert($data);
    }

    function updateData($id, $data) {
        $db = \Config\Database::connect();
        $builder = $db->table('product');
        $builder->where('kode', $id);
        $builder->update($data); 
    }
       

    function showData($id) {
        $db = \Config\Database::connect();
        $builder = $db->table('product');
        $builder->where('kode', $id);
        $result = $builder->get()->getRow();
        return $result;
    }

    function deleteData($id) {
        $db = \Config\Database::connect();
        $builder = $db->table('product');
        $builder->where('kode', $id);
        $builder->delete();
    }
}