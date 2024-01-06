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
							<p class="mb-1 pt-2 text-bold">Tambah Data Role</p>
							<p class="mb-2"></p>
							<form action="" method="post">
								@csrf
								<div class="form-group">
									<label>Field01 {{required()}}</label>
									<input type="text" name="field01" class="form-control" value="{{old('field01')}}" required>
									@error('field01')
									<span class="error">{{$message}}</span>
									@enderror
								</div>
								<div class="form-group">
									<label>Field02 {{required()}}</label>
									<select name="field02" class="form-control select2" required>
										<option value="">Pilih</option>
									</select>
									@error('field02')
									<span class="error">{{$message}}</span>
									@enderror
								</div>
								<div class="form-group">
									<label>Field03</label>
									<div class="form-check form-check-inline">
										<label class="form-check-label">
											<input class="form-check-input field03" type="radio" name="field03" id="field03_1" value="1" {{old('field03')?'checked':null}}> Yes
										</label>
									</div>
									<div class="form-check form-check-inline">
										<label class="form-check-label">
											<input class="form-check-input field03" type="radio" name="field03" id="field03_2" value="0" {{!old('field03')?'checked':null}}> No
										</label>
									</div>
									@error('field03')
									<span class="error">{{$message}}</span>
									@enderror
								</div>
								<div class="form-group">
									<label>Field04 {{required()}}</label>
									<textarea name="field04" class="form-control teksarea" required>{{old('field04')}}</textarea>
									@error('field04')
									<span class="error">{{$message}}</span>
									@enderror
								</div>
								<div class="form-group">
									<label>Field05 {{required()}}</label>
									<input type="file" accept="image/*" name="field05" class="form-control dropify" value="{{old('field05')}}" required>
									@error('field05')
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