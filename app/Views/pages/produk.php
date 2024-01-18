<!-- data -->

<?php $total_sayuran = 0; ?>
<?php $total_buah = 0; ?>
<?php foreach ($all_product as $produk) : ?>
    <?php
    if ($produk['jenis'] == "Sayuran") {
        $total_sayuran++;
    } else {
        $total_buah++;
    }
    ?>
<?php endforeach; ?>
<!-- end data -->


<?= $this->extend('layouts/template.php') ?>


<?= $this->section('content') ?>
<!-- Main Content-->

<!-- Loader -->
<div id="global-loader">
    <img src="<?php echo base_url('assets/img/loader.svg') ?>" class="loader-img" alt="Loader">
</div>
<!-- End Loader -->

<div class="main-content side-content pt-0">

    <div class="main-container container-fluid">
        <div class="inner-body">

            <!-- Page Header -->
            <div class="page-header">
                <div>
                    <h2 class="main-content-title tx-24 mg-b-5">Manajemen Produk</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url('admin') ?>">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Kelola Produk</li>
                    </ol>
                </div>
            </div>
            <!-- End Page Header -->

            <!--Row-->
            <div class="row row-sm ">
                <div class="col-sm-12 col-lg-12 col-xl-12">

                    <!--Row-->
                    <div class="row row-sm">
                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                            <div class="card custom-card">
                                <div class="card-body">
                                    <div class="card-item">
                                        <div class="card-item-icon card-icon">
                                            <svg class="text-primary" xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24" viewBox="0 0 24 24" width="24">
                                                <g>
                                                    <rect height="14" opacity=".3" width="14" x="5" y="5" />
                                                    <g>
                                                        <rect fill="none" height="24" width="24" />
                                                        <g>
                                                            <path d="M19,3H5C3.9,3,3,3.9,3,5v14c0,1.1,0.9,2,2,2h14c1.1,0,2-0.9,2-2V5C21,3.9,20.1,3,19,3z M19,19H5V5h14V19z" />
                                                            <rect height="5" width="2" x="7" y="12" />
                                                            <rect height="10" width="2" x="15" y="7" />
                                                            <rect height="3" width="2" x="11" y="14" />
                                                            <rect height="2" width="2" x="11" y="10" />
                                                        </g>
                                                    </g>
                                                </g>
                                            </svg>
                                        </div>
                                        <div class="card-item-title mb-2">
                                            <label class="main-content-label tx-13 font-weight-bold mb-1">Total
                                                Produk Sayuran</label>
                                        </div>
                                        <div class="card-item-body">
                                            <div class="card-item-stat">
                                                <h4 class="font-weight-bold"><?= $total_sayuran
                                                                                ?></h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                            <div class="card custom-card">
                                <div class="card-body">
                                    <div class="card-item">
                                        <div class="card-item-icon card-icon">
                                            <svg class="text-primary" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24">
                                                <path d="M0 0h24v24H0V0z" fill="none" />
                                                <path d="M12 4c-4.41 0-8 3.59-8 8s3.59 8 8 8 8-3.59 8-8-3.59-8-8-8zm1.23 13.33V19H10.9v-1.69c-1.5-.31-2.77-1.28-2.86-2.97h1.71c.09.92.72 1.64 2.32 1.64 1.71 0 2.1-.86 2.1-1.39 0-.73-.39-1.41-2.34-1.87-2.17-.53-3.66-1.42-3.66-3.21 0-1.51 1.22-2.48 2.72-2.81V5h2.34v1.71c1.63.39 2.44 1.63 2.49 2.97h-1.71c-.04-.97-.56-1.64-1.94-1.64-1.31 0-2.1.59-2.1 1.43 0 .73.57 1.22 2.34 1.67 1.77.46 3.66 1.22 3.66 3.42-.01 1.6-1.21 2.48-2.74 2.77z" opacity=".3" />
                                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm.31-8.86c-1.77-.45-2.34-.94-2.34-1.67 0-.84.79-1.43 2.1-1.43 1.38 0 1.9.66 1.94 1.64h1.71c-.05-1.34-.87-2.57-2.49-2.97V5H10.9v1.69c-1.51.32-2.72 1.3-2.72 2.81 0 1.79 1.49 2.69 3.66 3.21 1.95.46 2.34 1.15 2.34 1.87 0 .53-.39 1.39-2.1 1.39-1.6 0-2.23-.72-2.32-1.64H8.04c.1 1.7 1.36 2.66 2.86 2.97V19h2.34v-1.67c1.52-.29 2.72-1.16 2.73-2.77-.01-2.2-1.9-2.96-3.66-3.42z" />
                                            </svg>
                                        </div>
                                        <div class="card-item-title mb-2">
                                            <label class="main-content-label tx-13 font-weight-bold mb-1">Total Produk Buah-buahan</label>
                                        </div>
                                        <div class="card-item-body">
                                            <div class="card-item-stat">
                                                <h4 class="font-weight-bold"><?= $total_buah
                                                                                ?></h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--End row-->

                    <div class="row row-sm" id="tampil-produk">
                        <div class="col-lg-12">
                            <div class="card mg-b-20">
                                <div class="card-header">
                                    <h2 class="main-content-title tx-24">Produk</h2>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered border-bottom" id="example1">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama Produk</th>
                                                    <th>Jenis</th>
                                                    <th>Harga</th>
                                                    <th>Stok</th>
                                                    <th>Deskripsi</th>
                                                    <th>Foto Produk</th>
                                                    <th>Status</th>
                                                    <th>Nama Penjual</th>
                                                    <th>Alamat</th>
                                                    <th>No Telpon</th>
                                                    <th>Pilihan Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $no = 0 ?>
                                                <?php foreach ($all_product as $produk) : ?>
                                                    <?php $no++ ?>
                                                    <tr>
                                                        <td><?= $no ?></td>
                                                        <td><?= nl2br(wordwrap($produk['produk_nama'], 20, "\n", true)) ?></td>
                                                        <td align="center"><?= $produk['jenis'] ?></td>
                                                        <td align="center"><?= $produk['harga'] ?></td>
                                                        <td align="center"><?= $produk['stok'] ?></td>
                                                        <td><?= nl2br(wordwrap($produk['deskripsi'], 20, "\n", true)) ?></td>
                                                        <td align="center"><img src="<?= $produk['produk_foto'] ?>" data-bs-toggle="modal" data-bs-target="#modalProdukFoto<?= $produk['kode'] ?>" width="50" height="50" style="cursor:pointer"></td>
                                                        <td align="center"><?= $produk['status'] ?></td>
                                                        <td align="center"><?= $produk['petani_nama'] ?></td>
                                                        <td><?= nl2br(wordwrap($produk['alamat'], 20, "\n", true)) ?></td>
                                                        <td align="center"><?= $produk['no_telpon'] ?></td>
                                                        <td align="center">
                                                            <!-- Button trigger modal -->
                                                            <div class="row d-flex justify-content-between">
                                                                <div class="col-6">
                                                                    <form method="POST">
                                                                        <button type="button" class="btn btn-secondary btn-sm" onclick="editProduk('<?= $produk['kode'] ?>')">
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                                                                            </svg>
                                                                        </button>
                                                                    </form>
                                                                </div>
                                                                <div class="col-6">
                                                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#konfirmasiModal<?= $produk['kode'] ?>">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z" />
                                                                            <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z" />
                                                                        </svg>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <!-- Tambahkan sel lain sesuai kebutuhan -->
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--row-->

                    <!-- form edit produk -->
                    <?php foreach ($all_product as $produk) : ?>
                        <div class="row row-sm" id="edit-produk<?= $produk['kode'] ?>" style="display: none;">
                            <div class="col-lg-12">
                                <div class="card mg-b-20">
                                    <div class="card-header d-flex justify-content-between">
                                        <div class="title">
                                            <h2 class="main-content-title tx-24"> Edit Produk</h2>
                                        </div>
                                        <div class="delete">
                                            <button onclick="kembaliTampilProduk('<?= $produk['kode'] ?>')" type="button" class="btn btn-secondary my-2 btn-icon-text">
                                                </i> Kembali
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <form class="needs-validation" novalidate action="kelola_produk/ubah/<?= $produk['kode'] ?>" method="post" enctype="multipart/form-data">
                                            <div class="row row-sm">
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label for="nama-produk" class="form-label">Nama Produk</label>
                                                        <input type="text" name="nama" value="<?= $produk['produk_nama'] ?>" class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid' : '' ?>" id="nama-produk" placeholder="contoh: Selada 1/2 Kg" required>
                                                        <div class="invalid-feedback">
                                                            Masukkan Nama
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="harga" class="form-label">Harga</label>
                                                        <input type="number" name="harga" value="<?= $produk['harga'] ?>" class="form-control" id="harga" placeholder="contoh: 1200" required>
                                                        <div class="invalid-feedback">
                                                            Masukkan Harga
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="deskripsi" class="form-label">Deskripsi</label>
                                                        <textarea class="form-control" name="deskripsi" id="deskripsi" rows="3" style="resize: none;" required><?= $produk['deskripsi'] ?></textarea>
                                                        <div class="invalid-feedback">
                                                            Masukkan Deskripsi
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label for="Jenis" class="form-label">Jenis</label>
                                                        <select name="jenis" class="form-select pb-1 pt-2" aria-label="Default select example" required>
                                                            <option selected value="<?= ($produk['jenis'] == 'Sayuran') ? 'Sayuran' : 'Buah'; ?>"><?= ($produk['jenis'] == 'Sayuran') ? 'Sayuran' : 'Buah'; ?></option>
                                                            <option value="<?= ($produk['jenis'] == 'Sayuran') ? 'Buah' : 'Sayuran'; ?>"><?= ($produk['jenis'] == 'Sayuran') ? 'Buah' : 'Sayuran'; ?></option>
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="stok" class="form-label">Stok</label>
                                                        <input type="number" name="stok" value="<?= $produk['stok'] ?>" class="form-control" id="stok" placeholder="contoh: 2" required>
                                                        <div class="invalid-feedback">
                                                            Masukkan Stok
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="status" class="form-label">Status</label>
                                                        <select name="status" class="form-select pb-1 pt-2" aria-label="Default select example" required>
                                                            <option selected value="<?= ($produk['status'] == 'tampil') ? 'tampil' : 'arsip'; ?>"><?= ($produk['status'] == 'tampil') ? 'tampil' : 'arsip'; ?></option>
                                                            <option value="<?= ($produk['status'] == 'tampil') ? 'arsip' : 'tampil'; ?>"><?= ($produk['status'] == 'tampil') ? 'arsip' : 'tampil'; ?></option>
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="custom-file-upload">
                                                            <i class="fas fa-cloud-upload-alt"></i> Pilih gambar
                                                            <input type="file" class="custom-file-upload" id="gambar" name="foto" accept="image/*" onchange="showPreview(event, 'produk_foto')">
                                                        </label>
                                                        <div class="image-preview">
                                                            <input type="hidden" name="gambar_lama" value="<?= $produk['produk_foto'] ?>" class="form-control" id="produk_foto">
                                                            <img id="preview" src="<?= $produk['produk_foto'] ?>" alt="Preview" data-bs-toggle="modal" data-bs-target="#imageModal<?= $produk['kode'] ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3 d-grid gap-2">
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal Unggah Foto  -->
                        <div class="modal fade" id="imageModal<?= $produk['kode'] ?>" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="imageModalLabel">Pratinjau Gambar</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <img id="previewModal" src="<?= $produk['produk_foto'] ?>" alt="Preview">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- modal gambar produk -->
                        <div class="modal fade" id="modalProdukFoto<?= $produk['kode'] ?>" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="imageModalLabel">Pratinjau Gambar</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <img id="previewModal" src="<?= $produk['produk_foto'] ?>" alt="Preview">
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>

                    <!-- Modal konfirmasi ya atau tidak -->
                    <!-- Modal -->
                    <?php foreach ($all_product as $produk) : ?>
                        <div class="modal fade" id="konfirmasiModal<?= $produk['kode'] ?>" tabindex="-1" aria-labelledby="konfirmasiModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="konfirmasiModalLabel">Konfirmasi Penghapusan</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Apakah Anda yakin ingin menghapus produk ini?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <form id="konfirmasiForm" method="post" action="kelola_produk/delete/<?= $produk['kode'] ?>">
                                            <button class="btn btn-danger" type="submit">Ya</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>

                </div><!-- Row end -->
            </div>
        </div>
    </div>
</div>
<!-- End Main Content-->

<?= $this->endSection() ?>