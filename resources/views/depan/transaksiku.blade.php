@extends('depan.main')
@section('konten')
<link rel="stylesheet" type="text/css" href="{{url('assets/plugin/DataTables/datatables.min.css')}}"/>

<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('<?=url('assets/depan/images/bg_3.jpg')?>');" data-stellar-background-ratio="0.5">
	<div class="overlay"></div>
	<div class="container">
		<div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
			<div class="col-md-9 ftco-animate pb-5">
				<p class="breadcrumbs"><span class="mr-2"><a href="<?=url('/')?>">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Transaksi <i class="ion-ios-arrow-forward"></i></span></p>
				<h1 class="mb-3 bread">Riwayat Transaksi</h1>
			</div>
		</div>
	</div>
</section>

<section class="ftco-section bg-light">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="card">
					<div class="card-header text-center">
						<h3>Riwayat Transaksi</h3>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table id="data" class="table table-striped tabel" width="100%">
								<thead>
									<tr>
										<th width="8%"><center>#</center></th>
										<th>Kd. Transaksi</th>
										<th>Total Bayar</th>
										<th>Kode Bayar</th>
										<th>Status</th>
										<th><center>Action</center></th>
									</tr>
								</thead>
								<tbody>
									<?php 
									$no = 1;
									foreach ($val as $v) {
										?>
										<tr>
											<th class="text-center"><?=$no++?></th>
											<td>
												<?=$v->kd_transaksi?><br>
											</td>
											<td><?=rupiah($v->jumlah)?></td>
											<td>
												Kode Bayar: <?=$v->merchant_code?><br>
												Kode Penagih: <?=$v->biller_code?>
											</td>
											<td class="text-center">
												<span class="badge badge-<?=($v->status==0?'danger':($v->status == 1?'success':'warning'))?>">
													<?=($v->status==0?'Belum Lunas':($v->status == 1?'Lunas':'Gagal'))?>
												</span>
											</td>
											<td class="text-center">
												<a href="<?=url('transaksiku/detail/'.$v->kd_transaksi)?>" class="btn btn-primary btn-md">Invoice</a>
												<?php if (!empty($v->transaction_id) && $v->status != 1): ?>
													<a href="<?=url('transaksiku/check/'.$v->kd_transaksi)?>" class="btn btn-warning btn-md">Check</a>
												<?php endif ?>
											</td>
										</tr>
										<?php
									}
									?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>


<script src="{{url('assets/plugin/DataTables/datatables.min.js')}}"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$(".tabel").DataTable();
	});
</script>
@endsection