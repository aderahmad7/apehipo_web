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
					<h2 class="main-content-title tx-24 mg-b-5">Admin Dashboard</h2>
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
						<li class="breadcrumb-item active" aria-current="page"> Dashboard</li>
					</ol>
				</div>
			</div>
			<!-- End Page Header -->

			<!--Row-->
			<div class="row row-sm">
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
												Pendapatan</label>
										</div>
										<div class="card-item-body">
											<div class="card-item-stat">
												<?php $total_transaksi = 0; ?>
												<?php foreach ($sudah_bayar as $produk) : ?>
													<?php
													if ($produk['status_transaksi'] == "selesai") {
														$total_transaksi++;
													}
													?>
												<?php endforeach; ?>
												<?php $total_pendapatan = $total_transaksi * 1000 ?>
												<h4 class="font-weight-bold">Rp<?= $total_pendapatan ?></h4>
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
											<label class="main-content-label tx-13 font-weight-bold mb-1">Total Transaksi</label>
										</div>
										<div class="card-item-body">
											<div class="card-item-stat">
												<h4 class="font-weight-bold"><?= $total_transaksi ?></h4>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!--End row-->

					<div class="row row-sm">
						<div class="col-lg-12">
							<div class="card mg-b-20">
								<div class="card-header">
									<h2 class="main-content-title tx-24"> Table Order</h2>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table class="table table-bordered border-bottom" id="example1">
											<thead>
												<tr>
													<th>No</th>
													<th>Username Pembeli</th>
													<th>Nama</th>
													<th>Foto</th>
													<th>Harga</th>
													<th>Qty</th>
													<th>Bukti Pembayaran</th>
													<th>Status Order</th>
													<th>Status Transaksi</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody>
												<?php $no = 0 ?>
												<?php foreach ($belum_bayar as $produk) : ?>
													<?php $no++ ?>
													<tr>
														<td><?= $no ?></td>
														<td align="center"><?= $produk['username'] ?></td>
														<td><?= nl2br(wordwrap($produk['nama'], 20, "\n", true)) ?></td>
														<td><img src="<?= $produk['foto'] ?>" width="50" height="50"></td>
														<td><?= $produk['harga'] ?></td>
														<td><?= $produk['qty'] ?></td>
														<td align="center"><img src="<?= $produk['bukti_pembayaran'] ?>" data-bs-toggle="modal" data-bs-target="#modalBuktiPembayaran<?= $produk['id_produk'] ?>" width="50" height="50" style="cursor:pointer"></td>
														<td><?= $produk['status'] ?></td>
														<td><?= $produk['status_transaksi'] ?></td>
														<td>
															<!-- Button trigger modal -->
															<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#konfirmasiModal">
																Konfirmasi Pembayaran
															</button>
														</td>
														<!-- Tambahkan sel lain sesuai kebutuhan -->
													</tr>
												<?php endforeach; ?>

												<?php foreach ($sudah_bayar as $produk) : ?>
													<?php $no++ ?>
													<tr>
														<td><?= $no?></td>
														<td align="center"><?= $produk['username'] ?></td>
														<td><?= nl2br(wordwrap($produk['nama'], 20, "\n", true)) ?></td>
														<td><img src="<?= $produk['foto'] ?>" width="50" height="50"></td>
														<td><?= $produk['harga'] ?></td>
														<td><?= $produk['qty'] ?></td>
														<td align="center"><img src="<?= $produk['bukti_pembayaran'] ?>" data-bs-toggle="modal" data-bs-target="#modalBuktiPembayaran<?= $produk['id_produk'] ?>" width="50" height="50" style="cursor:pointer"></td>
														<td><?= $produk['status'] ?></td>
														<td><?= $produk['status_transaksi'] ?></td>
														<td>
															<button disabled type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#konfirmasiModal">
																Pembayaran telah dikonfirmasi
															</button>
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


					<!-- modal gambar belum bayar -->
					<?php foreach ($belum_bayar as $produk) : ?>
						<div class="modal fade" id="modalBuktiPembayaran<?= $produk['id_produk'] ?>">
							<div class="modal-dialog modal-dialog-centered">
								<div class="modal-content">
									<!-- Konten modal -->
									<div class="modal-body">
										<img src="<?= $produk['bukti_pembayaran'] ?>" alt="Gambar" id="modalImage" class="img-fluid">
									</div>
								</div>
							</div>
						</div>
					<?php endforeach; ?>
					<!-- Modal end belum bayar -->

					<!-- modal gambar sudah bayar -->
					<?php foreach ($sudah_bayar as $produk) : ?>
						<div class="modal fade" id="modalBuktiPembayaran<?= $produk['id_produk'] ?>">
							<div class="modal-dialog modal-dialog-centered">
								<div class="modal-content">
									<!-- Konten modal -->
									<div class="modal-body">
										<img src="<?= $produk['bukti_pembayaran'] ?>" alt="Gambar" id="modalImage" class="img-fluid">
									</div>
								</div>
							</div>
						</div>
					<?php endforeach; ?>
					<!-- Modal End sudah bayar  -->

					<!-- Modal konfirmasi ya atau tidak -->
					<!-- Modal -->
					<?php foreach ($belum_bayar as $produk) : ?>
						<div class="modal fade" id="konfirmasiModal" tabindex="-1" aria-labelledby="konfirmasiModalLabel" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="konfirmasiModalLabel">Konfirmasi Pembayaran</h5>
										<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
									</div>
									<div class="modal-body">
										Apakah Anda yakin ingin melakukan konfirmasi pembayaran?
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
										<form id="konfirmasiForm" method="POST" action="admin/status/<?= $produk['id_order'] ?>">

											<!-- order -->
											<input type="hidden" name="status" value="sudah bayar">
											<!-- end order  -->

											<!-- transaksi -->
											<input type="hidden" name="total_harga_produk" value="<?= $produk['total_harga_produk'] ?>">
											<input type="hidden" name="status_transaksi" value="sudah bayar">
											<input type="hidden" name="id_order" value="<?= $produk['id_order'] ?>">
											<input type="hidden" name="id_user" value="<?= $produk['id_pembeli'] ?>">
											<!-- end transaksi  -->

											<!-- detail transaksi -->
											<input type="hidden" name="id_produk" value="<?= $produk['id_produk'] ?>">
											<input type="hidden" name="harga" value="<?= $produk['harga'] ?>">
											<input type="hidden" name="qty" value="<?= $produk['qty'] ?>">
											<!-- end detail transaksi -->

											<button class="btn btn-primary" type="submit">Ya</button>
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
	<!-- End Main Content-->

	<?= $this->endSection() ?>