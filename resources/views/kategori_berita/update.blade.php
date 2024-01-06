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
							<p class="mb-1 pt-2 text-bold">Ubah Data Kategori Berita</p>
							<p class="mb-2"></p>
							<form action="" method="post">
								@csrf
								@method('PATCH')
								<div class="form-group">
									<label>Kategori Berita {{required()}}</label>
									<input autofocus maxlength="100" type="text" name="kategori_berita" class="form-control" value="{{$val->kategori_berita}}" required>
									@error('kategori_berita')
									<span class="error">{{$message}}</span>
									@enderror
								</div>
								<div class="form-group">
									<label>Status</label>
									<div class="form-check form-check-inline">
										<label class="form-check-label">
											<input class="form-check-input is_aktif" type="radio" name="is_aktif" id="is_aktif_1" value="1" {{$val->is_aktif?'checked':null}}> Yes
										</label>
									</div>
									<div class="form-check form-check-inline">
										<label class="form-check-label">
											<input class="form-check-input is_aktif" type="radio" name="is_aktif" id="is_aktif_2" value="0" {{!$val->is_aktif?'checked':null}}> No
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