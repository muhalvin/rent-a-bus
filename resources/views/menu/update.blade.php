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
								@method('PATCH')
								<div class="form-group">
									<label>Menu {{required()}}</label>
									<input autofocus type="text" name="menu" class="form-control" value="{{$val->menu}}" required>
									@error('menu')
									<span class="error">{{$message}}</span>
									@enderror
								</div>
								<div class="form-group">
									<label>Icon {{required()}}</label>
									<select name="icon_id" class="form-control select2" required>
										<option value="">Pilih</option>
										@foreach ($icon as $v)
										<option kode="{{$v->icon}}" {{$val->icon_id==$v->id?'selected':null}} value="{{$v->id}}">{{$v->icon}}</option>
										@endforeach
									</select>
									@error('icon_id')
									<span class="error">{{$message}}</span>
									@enderror
								</div>
								<div class="form-group">
									<label>Is Link {{required()}}</label>
									<div class="form-check form-check-inline">
										<label class="form-check-label">
											<input class="form-check-input is_link" type="radio" name="is_link" id="is_link_1" value="1" {{$val->is_link?'checked':null}}> Yes
										</label>
									</div>
									<div class="form-check form-check-inline">
										<label class="form-check-label">
											<input class="form-check-input is_link" type="radio" name="is_link" id="is_link_2" value="0" {{!$val->is_link?'checked':null}}> No
										</label>
									</div>
									@error('is_link')
									<span class="error">{{$message}}</span>
									@enderror
								</div>
								<div class="form-group link" style="display: {{$val->is_link?'block':'none'}};">
									<label>Link</label>
									<input type="text" name="link" class="form-control" value="{{$val->link}}">
									@error('link')
									<span class="error">{{$message}}</span>
									@enderror
								</div>
								<div class="form-group">
									<label>Is Separator</label>
									<div class="form-check form-check-inline">
										<label class="form-check-label">
											<input class="form-check-input is_separator" type="radio" name="is_separator" id="is_separator_1" value="1" {{$val->is_separator?'checked':null}}> Yes
										</label>
									</div>
									<div class="form-check form-check-inline">
										<label class="form-check-label">
											<input class="form-check-input is_separator" type="radio" name="is_separator" id="is_separator_2" value="0" {{!$val->is_separator?'checked':null}}> No
										</label>
									</div>
									@error('is_separator')
									<span class="error">{{$message}}</span>
									@enderror
								</div>
								<div id="for_separator"></div>
								<div class="form-group">
									<label>Urutan {{required()}}</label>
									<input type="number" required value="{{$val->urutan}}" min="1" class="form-control" id="urutan" name="urutan" placeholder="Urutan menu">
									@error('urutan')
									<span class="error">{{$message}}</span>
									@enderror
								</div>
								<div class="form-group">
									<label>Buat CRUD Builder ?</label>
									<div class="form-check form-check-inline">
										<label class="form-check-label">
											<input class="form-check-input create_crud" type="radio" name="create_crud" id="create_crud_1" value="1"> Yes
										</label>
									</div>
									<div class="form-check form-check-inline">
										<label class="form-check-label">
											<input class="form-check-input create_crud" type="radio" name="create_crud" id="create_crud_2" value="0"> No
										</label>
									</div>
									@error('create_crud')
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
		separator();
		$('.select2').select2();
	})

	$('.is_separator').on('change', function(){
		separator();
	});

	$('.is_link').on('change', function(){
		let is_link = $('input[name="is_link"]:checked').val();
		if (is_link == '1') {
			$('.link').show();
		} else {
			$('.link').hide();
			$('input[name="link"]').val('');
		}
	});

	function separator() {
		var is_separator = $("input[name='is_separator']:checked").val();
		if (is_separator== '1') {
			$("#for_separator").html(`<div class="form-group">
					<label>Separator</label>
					<input type="text" class="form-control" name="separator" id="separator" value="{{$val->separator}}" required placeholder="Separator..">
					@error('separator')
					<span class="error">{{$message}}</span>
					@enderror
				</div>`);
		} else {
			$("#for_separator").html('');
		}
	}

	$(".select2").on('change', function(){
		var icon = $('option:selected', this).attr('kode');
		$("#icon").html('<h3><i class="'+icon+'"></i></h3>');
	});
</script>
@endsection