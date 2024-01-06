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
							<p class="mb-1 pt-2 text-bold">Ubah Data berita</p>
							<p class="mb-2"></p>
							<form action="" method="post" enctype="multipart/form-data">
								@csrf
								@method('PATCH')
								<div class="form-group">
									<label>Judul</label>
									<input type="text" readonly class="form-control" maxlength="150" value="{{$val->judul}}" required>
									@error('judul')
									<span class="error">{{$message}}</span>
									@enderror
								</div>
								<div class="form-group">
									<label>Kategori Berita {{required()}}</label>
									<select name="kategori_berita_id" class="form-control select2" required>
										<option value="">Pilih</option>
										@foreach ($kat as $v)
										<option {{$val->kategori_berita_id==$v->id?'selected':null}} value="{{$v->id}}">{{$v->kategori_berita}}</option>
										@endforeach
									</select>
									@error('kategori_berita_id')
									<span class="error">{{$message}}</span>
									@enderror
								</div>
								<div class="form-group">
									<label>Isi {{required()}}</label>
									<textarea name="isi" class="form-control teksarea" required>{{$val->isi}}</textarea>
									@error('isi')
									<span class="error">{{$message}}</span>
									@enderror
								</div>
								<div class="form-group">
									<label>Is Publish {{required()}}</label>
									<div class="form-check form-check-inline">
										<label class="form-check-label">
											<input class="form-check-input is_publish" type="radio" name="is_publish" id="is_publish_3" value="2" {{$val->is_publish==2?'checked':null}}> Review
										</label>
									</div>
									<div class="form-check form-check-inline">
										<label class="form-check-label">
											<input class="form-check-input is_publish" type="radio" name="is_publish" id="is_publish_1" value="1" {{$val->is_publish==1?'checked':null}}> Publish
										</label>
									</div>
									<div class="form-check form-check-inline">
										<label class="form-check-label">
											<input class="form-check-input is_publish" type="radio" name="is_publish" id="is_publish_2" value="0" {{$val->is_publish==0?'checked':null}}> Unpublish
										</label>
									</div>
									@error('is_publish')
									<span class="error">{{$message}}</span>
									@enderror
								</div>
								<div class="form-group">
									<label>Cover {{required()}}</label>
									<input type="file" accept="image/*" name="gambar" data-default-file="{{asset('storage/'.$val->gambar)}}" class="form-control dropify" value="{{$val->gambar}}">
									@error('gambar')
									<span class="error">{{$message}}</span>
									@enderror
								</div>
								<?php 
									$tag = '';
									foreach ($tags as $v) {
										$tag .= $v->berita_tags.', ';
									}
								?>
								<div class="form-group">
									<label>Tags {{required()}}, pisahkan dengan koma untuk setiap tags</label>
									<input type="text" name="berita_tags" class="form-control" value="{{$tag}}" required>
									@error('berita_tags')
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