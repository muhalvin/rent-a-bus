@extends('depan.main')

@section('konten')
<div class="hero-wrap ftco-degree-bg" style="background-image: url('<?=url('assets/depan/images/bg_1.jpg')?>');" data-stellar-background-ratio="0.5">
	<div class="overlay"></div>
	<div class="container">
		<div class="row no-gutters slider-text justify-content-start align-items-center justify-content-center">
			<div class="col-lg-8 ftco-animate">
				<div class="text w-100 text-center mb-md-5 pb-md-5">
					<h1 class="mb-4">Booking Sekarang Juga!</h1>
					<p style="font-size: 18px;">Langkah simpel untuk membantu perjalanan Anda sampai ke tujuan dengan armada kami.</p>
					<a href="<?=url('cars')?>" class="icon-wrap d-flex align-items-center mt-4 justify-content-center">
						<div class="icon d-flex align-items-center justify-content-center">
							<span class="ion-ios-play"></span>
						</div>
						<div class="heading-title ml-5">
							<span>Lihat Kendaraan</span>
						</div>
					</a>
				</div>
			</div>
		</div>
	</div>
</div>


<section class="ftco-section ftco-no-pt bg-light">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-12 heading-section text-center ftco-animate mb-5">
				<span class="subheading">Apa yang kami tawarkan?</span>
				<h2 class="mb-2">Beragam jenis kendaraan untuk memenuhi kebutuhan Anda</h2>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="carousel-car owl-carousel">
					<?php foreach ($car as $v): ?>
						<div class="item">
							<div class="car-wrap rounded ftco-animate">
								<div class="img rounded d-flex align-items-end" style="background-image: url('{{asset('storage/'.$v->gambar)}}');">
								</div>
								<div class="text">
									<h2 class="mb-0"><a href="<?=url('cars/detail/'.$v->id)?>"><?=$v->bus?></a></h2>
									<div class="d-flex mb-3">
										<span class="cat"><?=$v->merek?></span>
										<p class="price ml-auto"><?=rupiah($v->harga_sewa)?><span>/hari</span></p>
									</div>
									<p class="d-flex mb-0 d-block"><a href="<?=url('cars/detail/'.$v->id)?>" class="btn btn-primary py-2 mr-1">Book now</a></p>
								</div>
							</div>
						</div>
					<?php endforeach ?>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="ftco-section ftco-about">
	<div class="container">
		<div class="row no-gutters">
			<div class="col-md-6 p-md-5 img img-2 d-flex justify-content-center align-items-center" style="background-image: url(<?=url('assets/depan/images/about.jpg')?>);">
			</div>
			<div class="col-md-6 wrap-about ftco-animate">
				<div class="heading-section heading-section-white pl-md-5" style="color: white;">
					<span class="subheading">Tentang Kami</span>
					<h2 class="mb-4"></h2>
					<?=htmlspecialchars_decode($xis->deskripsi)?>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="ftco-counter ftco-section img bg-light" id="section-counter">
	<div class="overlay"></div>
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-lg-3 justify-content-center counter-wrap ftco-animate">
				<div class="block-18">
					<div class="text text-border d-flex align-items-center">
						<strong class="number" data-number="60">0</strong>
						<span>Year <br>Experienced</span>
					</div>
				</div>
			</div>
			<div class="col-md-6 col-lg-3 justify-content-center counter-wrap ftco-animate">
				<div class="block-18">
					<div class="text text-border d-flex align-items-center">
						<strong class="number" data-number="1090">0</strong>
						<span>Total <br>Cars</span>
					</div>
				</div>
			</div>
			<div class="col-md-6 col-lg-3 justify-content-center counter-wrap ftco-animate">
				<div class="block-18">
					<div class="text text-border d-flex align-items-center">
						<strong class="number" data-number="2590">0</strong>
						<span>Happy <br>Customers</span>
					</div>
				</div>
			</div>
			<div class="col-md-6 col-lg-3 justify-content-center counter-wrap ftco-animate">
				<div class="block-18">
					<div class="text d-flex align-items-center">
						<strong class="number" data-number="67">0</strong>
						<span>Total <br>Branches</span>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection