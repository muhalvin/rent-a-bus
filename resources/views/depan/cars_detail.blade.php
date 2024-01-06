@extends('depan.main')
@section('konten')
<style type="text/css">
	.error {
		color: red !important;
	}
</style>
<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('<?=url('assets/depan/images/bg_3.jpg')?>');" data-stellar-background-ratio="0.5">
	<div class="overlay"></div>
	<div class="container">
		<div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
			<div class="col-md-9 ftco-animate pb-5">
				<p class="breadcrumbs"><span class="mr-2"><a href="<?=url('/')?>">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Car details <i class="ion-ios-arrow-forward"></i></span></p>
				<h1 class="mb-3 bread"><?=$r->bus?></h1>
			</div>
		</div>
	</div>
</section>


<section class="ftco-section ftco-car-details">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-12">
				<div class="car-details">
					<div class="img rounded" style="background-image: url('{{asset('storage/'.$r->gambar)}}');"></div>
					<div class="text text-center">
						<span class="subheading"><?=$r->merek?></span>
						<h2><?=$r->bus?></h2>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md d-flex align-self-stretch ftco-animate">
				<div class="media block-6 services">
					<div class="media-body py-md-4">
						<div class="d-flex mb-3 align-items-center">
							<div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-dashboard"></span></div>
							<div class="text">
								<h3 class="heading mb-0 pl-3">
									Mileage
									<span><?=$r->mileage?></span>
								</h3>
							</div>
						</div>
					</div>
				</div>      
			</div>
			<div class="col-md d-flex align-self-stretch ftco-animate">
				<div class="media block-6 services">
					<div class="media-body py-md-4">
						<div class="d-flex mb-3 align-items-center">
							<div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-pistons"></span></div>
							<div class="text">
								<h3 class="heading mb-0 pl-3">
									Transmission
									<span><?=$r->transmission?></span>
								</h3>
							</div>
						</div>
					</div>
				</div>      
			</div>
			<div class="col-md d-flex align-self-stretch ftco-animate">
				<div class="media block-6 services">
					<div class="media-body py-md-4">
						<div class="d-flex mb-3 align-items-center">
							<div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-car-seat"></span></div>
							<div class="text">
								<h3 class="heading mb-0 pl-3">
									Seats
									<span><?=$r->kapasitas?> Seats</span>
								</h3>
							</div>
						</div>
					</div>
				</div>      
			</div>
			<div class="col-md d-flex align-self-stretch ftco-animate">
				<div class="media block-6 services">
					<div class="media-body py-md-4">
						<div class="d-flex mb-3 align-items-center">
							<div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-backpack"></span></div>
							<div class="text">
								<h3 class="heading mb-0 pl-3">
									Luggage
									<span><?=$r->luggage?> Bags</span>
								</h3>
							</div>
						</div>
					</div>
				</div>      
			</div>
			<div class="col-md d-flex align-self-stretch ftco-animate">
				<div class="media block-6 services">
					<div class="media-body py-md-4">
						<div class="d-flex mb-3 align-items-center">
							<div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-diesel"></span></div>
							<div class="text">
								<h3 class="heading mb-0 pl-3">
									Fuel
									<span><?=$r->fuel?></span>
								</h3>
							</div>
						</div>
					</div>
				</div>      
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 pills">
				<div class="bd-example bd-example-tabs">
					<div class="d-flex justify-content-center">
						<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">

							<li class="nav-item">
								<a class="nav-link active" id="pills-description-tab" data-toggle="pill" href="#pills-description" role="tab" aria-controls="pills-description" aria-expanded="true">Features</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" id="pills-manufacturer-tab" data-toggle="pill" href="#pills-manufacturer" role="tab" aria-controls="pills-manufacturer" aria-expanded="true">Description</a>
							</li>
						</ul>
					</div>

					<div class="tab-content" id="pills-tabContent">
						<div class="tab-pane fade show active" id="pills-description" role="tabpanel" aria-labelledby="pills-description-tab">
							<div class="row">
								<div class="col-md-12">
									<?=htmlspecialchars_decode($r->fitur)?>
								</div>
							</div>
						</div>

						<div class="tab-pane fade" id="pills-manufacturer" role="tabpanel" aria-labelledby="pills-manufacturer-tab">
							<?=htmlspecialchars_decode($r->deskripsi)?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="ftco-section ftco-no-pt">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-12 heading-section text-center ftco-animate mb-5">
				<span class="subheading text-dark">Pilih Kendaraan</span>
				<h2 class="mb-2"><?=$r->bus?></h2>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 featured-top">
				<div class="row no-gutters">
					<div class="col-md-4 d-flex align-items-center">
						<form action="" method="post" class="request-form ftco-animate bg-primary">
							@csrf
							<h2>Buat Perjalanan Anda</h2>
							@if(!empty(session('notif')))
							<div class="alert alert-danger">
								{{session('notif')}}
							</div>
							@endif
							<div class="form-group">
								<label for="" class="label">Lokasi Penjemputan</label>
								<input type="text" name="lokasi_awal" class="form-control" placeholder="City, Airport, Station, etc" value="<?=old('lokasi_awal')?>">
								@error('lokasi_awal')
								<span class="error">{{$message}}</span>
								@enderror
							</div>
							<div class="form-group">
								<label for="" class="label">Lokasi Tujuan</label>
								<input type="text" name="lokasi_tujuan" class="form-control" placeholder="City, Airport, Station, etc" value="<?=old('lokasi_tujuan')?>">
								@error('lokasi_tujuan')
								<span class="error">{{$message}}</span>
								@enderror
							</div>
							<div class="d-flex">
								<div class="form-group mr-2">
									<label for="" class="label">Tgl. Mulai Sewa</label>
									<input type="date" class="form-control" name="tgl_mulai_sewa" placeholder="Date" value="<?=old('tgl_mulai_sewa')?>">
								</div>
								<div class="form-group ml-2">
									<label for="" class="label">Tgl. Akhir Sewa</label>
									<input type="date" name="tgl_selesai_sewa" class="form-control" placeholder="Date" value="<?=old('tgl_selesai_sewa')?>">
								</div>
							</div>
							<div class="form-group">
								@error('tgl_mulai_sewa')
								<span class="error">{{$message}}</span>
								@enderror
							</div>
							<div class="form-group">
								<label for="" class="label">Waktu Penjemputan</label>
								<input type="time" name="waktu_pickup" class="form-control" placeholder="Time" value="<?=old('waktu_pickup')?>">
								@error('waktu_pickup')
								<span class="error">{{$message}}</span>
								@enderror
							</div>
							<div class="form-group">
								<?php if (empty(session('guest_id'))): ?>
								<a class="btn btn-secondary py-3 mb-4" href="<?=url('signup')?>" class="text-warning">Belum Punya Akun? Registrasi Yuk!</a>

								<p class="text-white text-center">
									Atau
								</p>

								<a class="btn btn-danger py-3 px-4" href="<?=url('signin')?>" class="text-warning">Sudah Punya Akun? Login Yuk!</a>

								<?php else: ?>
									<button type="submit" class="btn btn-secondary py-3 px-4">Sewa Sekarang!</button>
								<?php endif ?>
							</div>
						</form>
					</div>
					<div class="col-md-8 d-flex align-items-center">
						<div class="services-wrap rounded-right w-100">
							<h3 class="heading-section mb-4">Cara yang lebih baik untuk menyewa kendaraan sesuai kebutuhan Anda</h3>
							<div class="row d-flex mb-4">
								<div class="col-md-4 d-flex align-self-stretch ftco-animate">
									<div class="services w-100 text-center">
										<div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-route"></span></div>
										<div class="text w-100">
											<h3 class="heading mb-2">Pilih Lokasi Penjemputan Anda</h3>
										</div>
									</div>      
								</div>
								<div class="col-md-4 d-flex align-self-stretch ftco-animate">
									<div class="services w-100 text-center">
										<div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-handshake"></span></div>
										<div class="text w-100">
											<h3 class="heading mb-2">Setujui Harga Sewa</h3>
										</div>
									</div>      
								</div>
								<div class="col-md-4 d-flex align-self-stretch ftco-animate">
									<div class="services w-100 text-center">
										<div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-rent"></span></div>
										<div class="text w-100">
											<h3 class="heading mb-2">Memproses Pesanan Anda</h3>
										</div>
									</div>      
								</div>
							</div>
							<p><a href="javascript:;" class="btn btn-primary py-3 px-4">Sewa Kendaraan ini Sekarang Juga!</a></p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

@endsection