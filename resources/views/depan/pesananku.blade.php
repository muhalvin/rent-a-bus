@extends('depan.main')
@section('konten')
<link rel="stylesheet" type="text/css" href="{{url('assets/plugin/DataTables/datatables.min.css')}}"/>

<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('<?=url('assets/depan/images/bg_3.jpg')?>');" data-stellar-background-ratio="0.5">
	<div class="overlay"></div>
	<div class="container">
		<div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
			<div class="col-md-9 ftco-animate pb-5">
				<p class="breadcrumbs"><span class="mr-2"><a href="<?=url('/')?>">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Pesanan <i class="ion-ios-arrow-forward"></i></span></p>
				<h1 class="mb-3 bread">Riwayat Pesanan</h1>
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
						<h3>Riwayat Pesanan</h3>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table id="data" class="table table-striped tabel" width="100%">
								<thead>
									<tr>
										<th width="8%"><center>#</center></th>
										<th>Kd. Pesanan</th>
										<th>Bus</th>
										<th>Tgl. Sewa</th>
										<th>Waktu Pick Up</th>
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
												<?=$v->kd_pesanan?><br>
											</td>
											<td><?=$v->bus?></td>
											<td>
												<?php 
													echo date('d/m/Y', strtotime($v->tgl_mulai_sewa)).' s/d '.date('d/m/Y', strtotime($v->tgl_selesai_sewa));
												?>
											</td>
											<td><?=$v->waktu_pickup?></td>
											<td>
												<span class="badge badge-<?=($v->status=='belum'?'danger' : ($v->status=='dp'?'warning':'primary'))?>">
													<?=($v->status=='belum'?'Belum Diproses' : ($v->status=='dp'?'DP Pembayaran':'LUNAS & Diproses'))?>
												</span>
											</td>
											<td>
												<a href="<?=url('pesananku/detail/'.$v->kd_pesanan)?>" class="btn btn-primary btn-md">Detail</a>
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