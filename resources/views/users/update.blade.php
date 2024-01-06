@extends('layout.main');
@section('konten')
<link rel="stylesheet" type="text/css" href="{{url('assets/plugin/select2/dist/css/select2.min.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{url('assets/plugin/dropify/css/dropify.min.css')}}"/>
<div class="row mt-2">
	<div class="col-lg-12 mb-lg-0 mb-4">
		<div class="card">
			<div class="card-body p-3">
				<div class="row">
					<div class="col-lg-12">
						<div class="d-flex flex-column h-100">
							<p class="mb-1 pt-2 text-bold">Ubah Data users</p>
							<p class="mb-2"></p>
							<form action="" method="post">
								@csrf
								@method('PATCH')

								<div class="form-group">
									<label>Email {{required()}}</label>
									<input type="email" class="form-control" readonly maxlength="255" value="{{$val->email}}">
									@error('email')
									<span class="error">{{$message}}</span>
									@enderror
								</div>
								<div class="form-group">
									<label>Password <span class="error">*) Biarkan kosong jika tidak ingin mengganti password!</span></label>
									<input type="password" name="password" class="form-control" maxlength="255" value="">
									@error('password')
									<span class="error">{{$message}}</span>
									@enderror
								</div>
								<div class="form-group">
									<label>Nama {{required()}}</label>
									<input type="text" name="nama" class="form-control" required maxlength="255" value="{{$val->nama}}">
									@error('nama')
									<span class="error">{{$message}}</span>
									@enderror
								</div>
								<div class="form-group">
									<label>Jenis Kelamin {{required()}}</label>
									<div class="form-check form-check-inline">
										<label class="form-check-label">
											<input class="form-check-input jk" type="radio" name="jk" id="jk_1" value="Laki-Laki" {{$val->jk=='Laki-Laki'?'checked':null}}> Laki-Laki
										</label>
									</div>
									<div class="form-check form-check-inline">
										<label class="form-check-label">
											<input class="form-check-input jk" type="radio" name="jk" id="jk_2" value="Perempuan" {{$val->jk=='Perempuan'?'checked':null}}> Perempuan
										</label>
									</div>
									@error('jk')
									<span class="error">{{$message}}</span>
									@enderror
								</div>
								<div class="form-group">
									<label>Alamat</label>
									<textarea name="alamat" class="form-control teksarea">{{$val->alamat}}</textarea>
									@error('alamat')
									<span class="error">{{$message}}</span>
									@enderror
								</div>
								<div class="form-group">
									<label>Tgl. Lahir</label>
									<input type="date" name="tgl_lahir" class="form-control" required value="{{$val->tgl_lahir}}">
									@error('tgl_lahir')
									<span class="error">{{$message}}</span>
									@enderror
								</div>
								<div class="form-group">
									<label>No. HP</label>
									<input type="text" name="no_hp" class="form-control" required minlength="9" maxlength="15" value="{{$val->no_hp}}">
									@error('no_hp')
									<span class="error">{{$message}}</span>
									@enderror
								</div>
								<div class="form-group">
									<label>Role {{required()}}</label>
									<select name="id_level" class="form-control select2">
										<option value="">Pilih</option>
										@foreach ($lvl as $v)
										<option {{$val->id_level==$v->id?'selected':null}} value="{{$v->id}}">{{$v->level}}</option>
										@endforeach
									</select>
									@error('id_level')
									<span class="error">{{$message}}</span>
									@enderror
								</div>
								<div class="form-group">
									<label>Status {{required()}}</label>
									<div class="form-check form-check-inline">
										<label class="form-check-label">
											<input class="form-check-input is_aktif" type="radio" name="is_aktif" id="is_aktif_1" value="1" {{$val->is_aktif?'checked':null}}> Aktif
										</label>
									</div>
									<div class="form-check form-check-inline">
										<label class="form-check-label">
											<input class="form-check-input is_aktif" type="radio" name="is_aktif" id="is_aktif_2" value="0" {{!$val->is_aktif?'checked':null}}> Tidak Aktif
										</label>
									</div>
									@error('is_aktif')
									<span class="error">{{$message}}</span>
									@enderror
								</div>
								{{prosback($menu_active)}}
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script src="{{url('assets/plugin/select2/dist/js/select2.min.js')}}"></script>

<script src="{{url('assets/plugin/dropify/js/dropify.min.js')}}"></script>
<script type='text/javascript'>
	$(document).ready(function(){
		$('.select2').select2();
		$('.dropify').dropify();
	});
</script>
@endsection