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
							<p class="mb-1 pt-2 text-bold">Ubah Data Pesanan</p>
							<p class="mb-2"></p>
							<form action="" method="post">
								@csrf
								@method('PATCH')
								<div class="form-group">
									<label>Penyewa {{required()}}</label>
									<select name="id_penyewa" class="form-control select2" required>
										<option value="">Pilih</option>
										@foreach ($penyewa as $v)
										<option {{$val->id_penyewa == $v->id?'selected':null}} value="{{$v->id}}">{{$v->penyewa}}</option>
										@endforeach
									</select>
									@error('id_penyewa')
									<span class="error">{{$message}}</span>
									@enderror
								</div>
								<div class="form-group">
									<label>Tgl. Mulai Sewa {{required()}}</label>
									<input type="date" name="tgl_mulai_sewa" class="form-control get_available" value="{{$val->tgl_mulai_sewa}}" required>
									@error('tgl_mulai_sewa')
									<span class="error">{{$message}}</span>
									@enderror
								</div>
								<div class="form-group">
									<label>Tgl. Selesai Sewa {{required()}}</label>
									<input type="date" name="tgl_selesai_sewa" class="form-control get_available" value="{{$val->tgl_selesai_sewa}}" required>
									@error('tgl_selesai_sewa')
									<span class="error">{{$message}}</span>
									@enderror
								</div>
								<div class="form-group">
									<label>Waktu Pick-up / Penjemputan {{required()}}</label>
									<input type="time" name="waktu_pickup" class="form-control" value="{{$val->waktu_pickup}}" required>
									@error('waktu_pickup')
									<span class="error">{{$message}}</span>
									@enderror
								</div>
								<div class="form-group">
									<label>Bus {{required()}}</label>
									<select name="id_bus" id="id_bus" class="form-control select2" required>
										<option value="">Pilih</option>
										@foreach ($bus as $v)
										<option {{$v->id==$val->id_bus?'selected':null}} value="{{$v->id}}">{{$v->bus}}</option>
										@endforeach
									</select>
									@error('id_bus')
									<span class="error">{{$message}}</span>
									@enderror
								</div>
								<div class="form-group">
									<label>Keterangan {{required()}}</label>
									<textarea name="keterangan" class="form-control teksarea" required>{{$val->keterangan}}</textarea>
									@error('keterangan')
									<span class="error">{{$message}}</span>
									@enderror
								</div>
								<div class="form-group">
									<label>Total Biaya {{required()}}</label>
									<input type="number" min="0" name="total_biaya" class="form-control" value="{{$val->total_biaya}}" required>
									@error('total_biaya')
									<span class="error">{{$message}}</span>
									@enderror
								</div>
								<div class="form-group">
									<label>Status</label>
									<div class="form-check form-check-inline">
										<label class="form-check-label">
											<input class="form-check-input status" type="radio" name="status" id="status_1" value="belum" {{$val->status=='belum'?'checked':null}}> Belum
										</label>
									</div>
									<div class="form-check form-check-inline">
										<label class="form-check-label">
											<input class="form-check-input status" type="radio" name="status" id="status_2" value="dp" {{$val->status=='dp'?'checked':null}}> DP
										</label>
									</div>
									<div class="form-check form-check-inline">
										<label class="form-check-label">
											<input class="form-check-input status" type="radio" name="status" id="status_3" value="lunas" {{$val->status=='lunas'?'checked':null}}> Lunas
										</label>
									</div>
									@error('status')
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