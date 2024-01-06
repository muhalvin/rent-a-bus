@extends('layout.main')

@section('konten')
<div class="row mt-2">
	<div class="col-lg-12 mb-lg-0 mb-4">
		<div class="card">
			<div class="card-body p-3">
				<div class="row">
					<div class="col-lg-12">
						<div class="d-flex flex-column h-100">
							<p class="mb-1 pt-2 text-bold">Setup Informasi Web Apps</p>
							<p class="mb-2"></p>
							<form action="" method="post">
								@csrf
								<div class="form-group">
									<label>Judul Atas {{required()}}</label>
									<input type="text" name="title_header" class="form-control" value="{{$val->title_header}}">
									@error('title_header')
									<span class="error">{{$message}}</span>
									@enderror
								</div>
								<div class="form-group">
									<label>Judul Bawah {{required()}}</label>
									<input type="text" name="title_footer" class="form-control" value="{{$val->title_footer}}">
									@error('title_footer')
									<span class="error">{{$message}}</span>
									@enderror
								</div>
								<div class="form-group">
									<label>App Name</label>
									<input type="text" name="app_name" class="form-control" value="{{$val->app_name}}">
									@error('app_name')
									<span class="error">{{$message}}</span>
									@enderror
								</div>
								<div class="form-group">
									<label>Deskripsi</label>
									<textarea name="deskripsi" class="form-control textarea">{{$val->deskripsi}}</textarea>
									@error('deskripsi')
									<span class="error">{{$message}}</span>
									@enderror
								</div>
								<div class="form-group">
									<label>Email</label>
									<input type="email" name="email" class="form-control" value="{{$val->email}}">
									@error('email')
									<span class="error">{{$message}}</span>
									@enderror
								</div>
								<div class="form-group">
									<label>No. Telepon</label>
									<input type="tel" name="no_telepon" class="form-control" value="{{$val->no_telepon}}">
									@error('no_telepon')
									<span class="error">{{$message}}</span>
									@enderror
								</div>
								<div class="form-group">
									<label>Alamat</label>
									<input type="text" name="alamat" class="form-control" value="{{$val->alamat}}">
									@error('alamat')
									<span class="error">{{$message}}</span>
									@enderror
								</div>
								<div class="form-group">
									<label>Status Website</label>
									<select name="website_status" class="form-control select2" required>
										<option value="">Pilih</option>
										<option {{$val->website_status?'selected':null}} value="1">Live</option>
										<option {{!$val->website_status?'selected':null}} value="0">Maintenance</option>
									</select>
									@error('website_status')
									<span class="error">{{$message}}</span>
									@enderror
								</div>
								<div class="form-group">
									<button type="submit" class="btn btn-primary btn-md">Simpan</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection