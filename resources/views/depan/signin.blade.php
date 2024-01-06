@extends('depan.main')
@section('konten')
<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('<?=url('assets/depan/images/bg_3.jpg')?>');" data-stellar-background-ratio="0.5">
	<div class="overlay"></div>
	<div class="container">
		<div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
			<div class="col-md-9 ftco-animate pb-5">
				<p class="breadcrumbs"><span class="mr-2"><a href="{{url('/')}}">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Sign In <i class="ion-ios-arrow-forward"></i></span></p>
				<h1 class="mb-3 bread">Form Login</h1>
			</div>
		</div>
	</div>
</section>

<section class="ftco-section contact-section">
	<div class="container">
		<div class="row d-flex mb-5">
			<div class="col-md-12 text-center">
				<h3>Form Login</h3>
			</div>
			<div class="col-md-12">
				@if(!empty(session('notif')))
				<div class="alert alert-danger">
					{{session('notif')}}
				</div>
				@endif
			</div>
			<div class="col-md-12 block-9 mb-md-5">
				<form action="" class="p-5" method="post">
					@csrf
					<div class="form-group">
						<label>Masukkan No. Telepon Terdaftar Anda</label>
						<input type="number" name="no_hp" class="form-control" required value="<?=old('no_hp')?>" placeholder="No. HP">
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-primary py-3 px-5">Login Sekarang!</button>
						<p>
							<small>Belum punya akun?, login <a href="<?=url('signup')?>">di sini</a></small>
						</p>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>
@endsection