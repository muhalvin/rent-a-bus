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
							<p class="mb-1 pt-2 text-bold">Tambah Data Bus</p>
							<p class="mb-2"></p>
							<form action="" method="post" enctype="multipart/form-data">
								@csrf
								<div class="form-group">
									<label>Bus {{required()}}</label>
									<input type="text" name="bus" class="form-control" value="{{old('bus')}}" required>
									@error('bus')
									<span class="error">{{$message}}</span>
									@enderror
								</div>
								<div class="form-group">
									<label>Merek {{required()}}</label>
									<select name="id_merek" class="form-control select2" required>
										<option value="">Pilih</option>
										@foreach($merek as $v)
										<option {{old('id_merek') == $v['id'] ? 'selected':null}} value="{{$v['id']}}">{{$v['merek']}}</option>
										@endforeach
									</select>
									@error('id_merek')
									<span class="error">{{$message}}</span>
									@enderror
								</div>
								<div class="form-group">
									<label>Tipe {{required()}}</label>
									<select name="id_tipe" class="form-control select2" required>
										<option value="">Pilih</option>
										@foreach($tipe as $v)
										<option {{(old('id_tipe') == $v['id'] ? 'selected':null)}} value="{{$v['id']}}">{{$v['tipe']}}</option>
										@endforeach
									</select>
									@error('id_tipe')
									<span class="error">{{$message}}</span>
									@enderror
								</div>
								<div class="form-group">
									<label>Harga sewa {{required()}}</label>
									<input type="number" name="harga_sewa" class="form-control" value="{{old('harga_sewa')}}" required>
									@error('harga_sewa')
									<span class="error">{{$message}}</span>
									@enderror
								</div>
								<div class="form-group">
									<label>Kapasitas {{required()}}</label>
									<input type="number" name="kapasitas" class="form-control" value="{{old('kapasitas')}}" required>
									@error('kapasitas')
									<span class="error">{{$message}}</span>
									@enderror
								</div>
								<div class="form-group">
									<label>Tahun bus {{required()}}</label>
									<input type="number" maxlength="4" minlength="4" name="tahun_bus" class="form-control" value="{{old('tahun_bus')}}" required>
									@error('tahun_bus')
									<span class="error">{{$message}}</span>
									@enderror
								</div>
								<div class="form-group">
									<label>No. Rangka {{required()}}</label>
									<input type="text" name="no_rangka" class="form-control" value="{{old('no_rangka')}}" required>
									@error('no_rangka')
									<span class="error">{{$message}}</span>
									@enderror
								</div>
								<div class="form-group">
									<label>No. Mesin {{required()}}</label>
									<input type="text" name="no_mesin" class="form-control" value="{{old('no_mesin')}}" required>
									@error('no_mesin')
									<span class="error">{{$message}}</span>
									@enderror
								</div>
								<div class="form-group">
									<label>No. Plat {{required()}}</label>
									<input type="text" name="no_plat" class="form-control" value="{{old('no_plat')}}" required>
									@error('no_plat')
									<span class="error">{{$message}}</span>
									@enderror
								</div>
								<div class="form-group">
									<label>Tahun Operasi {{required()}}</label>
									<input type="number" minlength="4" maxlength="4" name="tahun_operasi" class="form-control" value="{{old('tahun_operasi')}}" required>
									@error('tahun_operasi')
									<span class="error">{{$message}}</span>
									@enderror
								</div>
								<div class="form-group">
									<label>Mileage {{required()}}</label>
									<input type="text" name="mileage" class="form-control" value="{{old('mileage')}}">
									@error('mileage')
									<span class="error">{{$message}}</span>
									@enderror
								</div>
								<div class="form-group">
									<label>Transmisi {{required()}}</label>
									<select name="transmission" class="form-control select2" required>
										<option value="">Pilih</option>
										<option {{(old('transmission') == 'Manual' ? 'selected':null)}} value="Manual">Manual</option>
										<option {{(old('transmission') == 'Otomatis' ? 'selected':null)}} value="Otomatis">Otomatis</option>
									</select>
									@error('transmission')
									<span class="error">{{$message}}</span>
									@enderror
								</div>
								<div class="form-group">
									<label>Luggage {{required()}}</label>
									<input type="text" maxlength="30" name="luggage" class="form-control" value="{{old('luggage')}}" placeholder="Ex: 32 Bags">
									@error('luggage')
									<span class="error">{{$message}}</span>
									@enderror
								</div>
								<div class="form-group">
									<label>Bahan Bakar {{required()}}</label>
									<select name="fuel" class="form-control select2" required>
										<option value="">Pilih</option>
										<option {{(old('fuel') == 'Bensin' ? 'selected':null)}} value="Bensin">Bensin</option>
										<option {{(old('fuel') == 'Solar' ? 'selected':null)}} value="Solar">Solar</option>
									</select>
									@error('fuel')
									<span class="error">{{$message}}</span>
									@enderror
								</div>
								<div class="form-group">
									<label>Fitur</label>
									<textarea name="fitur" class="form-control teksarea">{{old('fitur')}}</textarea>
									@error('fitur')
									<span class="error">{{$message}}</span>
									@enderror
								</div>
								<div class="form-group">
									<label>Deskripsi</label>
									<textarea name="deskripsi" class="form-control teksarea">{{old('deskripsi')}}</textarea>
									@error('deskripsi')
									<span class="error">{{$message}}</span>
									@enderror
								</div>
								<div class="form-group">
									<label>Status</label>
									<div class="form-check form-check-inline">
										<label class="form-check-label">
											<input class="form-check-input is_aktif" type="radio" name="is_aktif" id="is_aktif_1" value="1" {{old('is_aktif')?'checked':null}}> Aktif
										</label>
									</div>
									<div class="form-check form-check-inline">
										<label class="form-check-label">
											<input class="form-check-input is_aktif" type="radio" name="is_aktif" id="is_aktif_2" value="0" {{!old('is_aktif')?'checked':null}}> Non Aktif
										</label>
									</div>
									@error('is_aktif')
									<span class="error">{{$message}}</span>
									@enderror
								</div>
								<div class="form-group">
									<label>Gambar {{required()}}</label>
									<input type="file" accept="image/*" name="gambar" class="form-control dropify" value="{{old('gambar')}}">
									@error('gambar')
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