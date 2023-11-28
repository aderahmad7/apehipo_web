<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Order</title>

    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/vendor/bootstrap/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/vendor/simple-datatables/style.css') ?>">
</head>

<body>

    <header>

    </header>

    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Order</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"></li>
                    <li class="breadcrumb-item active">Order</li>
                </ol>
            </nav>
        </div>

    </main>

    <section class="section">
        <div class="row">
            <div class="col-12">
                <div class="card recent-sales overflow-auto">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <h5 class="card-title">Order Pesanan</h5>
                            </div>
                        </div>
                        <table class="table table-borderless datatable">
                            <thead>
                                <tr>
                                    <th scope="col">ID Produk</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Harga</th>
                                    <th scope="col">Jumlah</th>
                                    <th scope="col">Total Harga</th>
                                    <th scope="col">Waktu Kedaluarsa</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">ID Pembeli</th>
                                    <th scope="col">ID Penjual</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                var_dump($belum_bayar);
                                foreach ($belum_bayar as $item) : 
                                ?>
                                    <tr>
                                        <th scope="row"><?=$item['id_produk'] ?></th>
                                        <td><?=$item['nama'] ?></td>
                                        <td><?=$item['harga'] ?></td>
                                        <td><?=$item['qty'] ?></td>
                                        <td><?=$item['total_harga_produk'] ?></td>
                                        <td><?=$item['waktu_kedaluarsa'] ?></td>
                                        <td><?=$item['status'] ?></td>
                                        <td><?=$item['id_pembeli'] ?></td>
                                        <td><?=$item['id_penjual'] ?></td>
                                        <td>
                                            <a href="#" class="btn btn-danger">Batalkan</a>
                                            <a href="#" class="btn btn-success">Pindah Status</a>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="<?= base_url('assets/vendor/simple-datatables/simple-datatables.js') ?>"></script>
    <script src="<?= base_url('assets/vendor/bootstrap/js/bootstrap.min.js') ?>"></script>
    <script src="<?= base_url('assets/vendor/simple-datatables/simple-datatables.js') ?>"></script>
</body>

</html>