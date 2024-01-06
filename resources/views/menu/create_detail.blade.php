@extends('layout.main')

@section('konten')

<link rel="stylesheet" href="{{url('assets/plugin/select2/dist/css/select2.min.css')}}">

<div class="row mt-2">
	<div class="col-lg-12 mb-lg-0 mb-4">
		<div class="card">
			<div class="card-body p-3">
				<div class="row">
					<div class="col-lg-12">
						<div class="d-flex flex-column h-100">
							<p class="mb-1 pt-2 text-bold">{{$title}}</p>
							<p class="mb-2"></p>
							<form action="" method="post">
								@csrf
								<div class="form-group">
									<label>Menu {{required()}}</label>
									<input autofocus type="text" name="menu" class="form-control" value="{{old('menu')}}" required>
									@error('menu')
									<span class="error">{{$message}}</span>
									@enderror
								</div>
								<div class="form-group">
									<label>Menu Parent {{required()}}</label>
									<select name="parent_id" class="form-control select2" required>
										<option value="">Pilih</option>
										@foreach ($menu as $v)
										<option kode="{{$v->menu}}" {{old('parent_id')==$v->id?'selected':null}} value="{{$v->id}}">{{$v->menu}}</option>
										@endforeach
									</select>
									@error('parent_id')
									<span class="error">{{$message}}</span>
									@enderror
								</div>
								<div class="form-group">
									<label>Link {{required()}}</label>
									<input type="text" name="link" class="form-control" value="{{old('link')}}">
									@error('link')
									<span class="error">{{$message}}</span>
									@enderror
								</div>
								<div class="form-group">
									<label>Urutan {{required()}}</label>
									<input type="number" required value="{{old('urutan')}}" min="1" class="form-control" id="urutan" name="urutan" placeholder="Urutan menu">
									@error('urutan')
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
<script type="text/javascript">
	$(document).ready(function(){
		$('.select2').select2();
	});
</script>
@endsection