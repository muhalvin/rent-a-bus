@extends('depan.main')
@section('konten')
<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('<?=url('assets/depan/images/bg_3.jpg')?>');" data-stellar-background-ratio="0.5">
	<div class="overlay"></div>
	<div class="container">
		<div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
			<div class="col-md-9 ftco-animate pb-5">
				<p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Sign Up <i class="ion-ios-arrow-forward"></i></span></p>
				<h1 class="mb-3 bread">Form Pendaftaran</h1>
			</div>
		</div>
	</div>
</section>

<section class="ftco-section contact-section">
	<div class="container">
		<div class="row d-flex mb-5">
			<div class="col-md-12 text-center">
				<h3>Form Pendaftaran</h3>
			</div>
			<div class="col-sm-12">
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
						<label>Nama Lengkap :</label>
						<input type="text" name="nama" class="form-control" value="<?=old('nama')?>" placeholder="Nama Anda" required>
						@error('nama')
						<span class="error">{{$message}}</span>
						@enderror
					</div>
					<div class="form-group">
						<label>Jenis Kelamin :</label>
						<div class="form-check form-check-inline">
							<label class="form-check-label">
								<input class="form-check-input jk" type="radio" name="jk" id="jk_1" value="Laki-Laki" <?=(old('jk')=="Laki-Laki"?"checked":null)?>> Laki-Laki
							</label>
						</div>
						<div class="form-check form-check-inline">
							<label class="form-check-label">
								<input class="form-check-input jk" type="radio" name="jk" id="jk_2" value="Perempuan" <?=(old('jk')=="Perempuan"?"checked":null)?>> Perempuan
							</label>
						</div>
						@error('jk')
						<span class="error">{{$message}}</span>
						@enderror
					</div>
					<div class="form-group">
						<label>No. HP : <b>(Digunakan untuk keperluan login, harap ditulis dengan benar!)</b></label>
						<input type="number" minlength="9" maxlength="15" name="no_hp" class="form-control" value="<?=old('no_hp')?>" placeholder="No. HP" required>
						@error('no_hp')
						<span class="error">{{$message}}</span>
						@enderror
					</div>
					<div class="form-group">
						<label>No. KTP / SIM / KITAS Lainnya :</label>
						<input type="number" maxlength="50" name="kitas" class="form-control" value="<?=old('kitas')?>" placeholder="No. KTP / SIM / KITAS Lainnya" required>
						@error('kitas')
						<span class="error">{{$message}}</span>
						@enderror
					</div>
					<div class="form-group">
						<label>Alamat :</label>
						<textarea name="alamat" id="" cols="30" rows="7" class="form-control" placeholder="Alamat Anda" required><?=old('alamat')?></textarea>
						@error('alamat')
						<span class="error">{{$message}}</span>
						@enderror
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-primary py-3 px-5">Daftar Sekarang!</button>
						<p>
							<small>Sudah punya akun?, login <a href="<?=url('signin')?>">di sini</a></small>
						</p>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>
@endsection