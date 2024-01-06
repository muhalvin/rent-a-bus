@extends('depan.main')

@section('konten')
<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('<?=url('assets/depan/images/bg_3.jpg')?>');" data-stellar-background-ratio="0.5">
	<div class="overlay"></div>
	<div class="container">
		<div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
			<div class="col-md-9 ftco-animate pb-5">
				<p class="breadcrumbs"><span class="mr-2"><a href="<?=url('/')?>">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Cars <i class="ion-ios-arrow-forward"></i></span></p>
				<h1 class="mb-3 bread">Choose Your Car</h1>
			</div>
		</div>
	</div>
</section>


<section class="ftco-section bg-light">
	<div class="container">
		<div class="row">
			<?php foreach ($cars as $v): ?>
			<div class="col-md-4">
				<div class="car-wrap rounded ftco-animate">
					<div class="img rounded d-flex align-items-end" style="background-image: url('{{asset('storage/'.$v->gambar)}}');">
					</div>
					<div class="text">
						<h2 class="mb-0"><a href="<?=url('cars/detail/'.$v->id)?>"><?=$v->bus?></a></h2>
						<div class="d-flex mb-3">
							<span class="cat"><?=$v->merek?></span>
							<p class="price ml-auto"><?=rupiah($v->harga_sewa)?> <span>/hari</span></p>
						</div>
						<p class="d-flex mb-0 d-block"><a href="<?=url('cars/detail/'.$v->id)?>" class="btn btn-primary py-2 mr-1">Book now</a></p>
					</div>
				</div>
			</div>
			<?php endforeach ?>
		</div>
		<div class="row mt-5">
			<div class="col text-center">
				<div class="block-27">
					{{ $cars->links() }}
				</div>
			</div>
		</div>
	</div>
</section>

@endsection