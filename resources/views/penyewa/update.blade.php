@extends('layout.main');
@section('konten')
<link rel="stylesheet" type="text/css" href="{{url('assets/plugin/select2/dist/css/select2.min.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{url('assets/plugin/dropify/css/dropify.min.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{url('assets/plugin/summernote/summernote-lite.min.css')}}"/>
<div class="row mt-2">
	<div class="col-lg-12 mb-lg-0 mb-4">
		<div class="card">
			<div class="card-body p-3">
				<div class="row">
					<div class="col-lg-12">
						<div class="d-flex flex-column h-100">
							<p class="mb-1 pt-2 text-bold">Ubah Data Penyewa</p>
							<p class="mb-2"></p>
							<form action="" method="post">
								@csrf
								@method('PATCH')
								<div class="form-group">
									<label>Penyewa {{required()}}</label>
									<input type="text" name="penyewa" class="form-control" value="{{$val->penyewa}}" required>
									@error('penyewa')
									<span class="error">{{$message}}</span>
									@enderror
								</div>
								<div class="form-group">
									<label>No. KTP / KITAS {{required()}}</label>
									<input type="text" name="kitas" class="form-control" value="{{$val->kitas}}" required>
									@error('kitas')
									<span class="error">{{$message}}</span>
									@enderror
								</div>
								<div class="form-group">
									<label>Jenis Kelamin</label>
									<div class="form-check form-check-inline">
										<label class="form-check-label">
											<input class="form-check-input jk" type="radio" name="jk" id="jk_1" value="Laki-Laki" {{$val->jk?'checked':null}}> Laki-Laki
										</label>
									</div>
									<div class="form-check form-check-inline">
										<label class="form-check-label">
											<input class="form-check-input jk" type="radio" name="jk" id="jk_2" value="Perempuan" {{!$val->jk?'checked':null}}> Perempuan
										</label>
									</div>
									@error('jk')
									<span class="error">{{$message}}</span>
									@enderror
								</div>
								<div class="form-group">
									<label>No. HP / Telp {{required()}}</label>
									<input type="number" name="no_hp" minlength="9" maxlength="15" class="form-control" value="{{$val->no_hp}}" required>
									@error('no_hp')
									<span class="error">{{$message}}</span>
									@enderror
								</div>
								<div class="form-group">
									<label>Alamat {{required()}}</label>
									<input type="text" name="alamat" class="form-control" value="{{$val->alamat}}" required>
									@error('alamat')
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
<script src="{{url('assets/plugin/summernote/summernote-lite.min.js')}}"></script>
<script type='text/javascript'>
	$(document).ready(function(){
		$('.select2').select2();
		$('.dropify').dropify();
		$('.teksarea').summernote({
			height: 250
		});
	});
</script>
@endsection