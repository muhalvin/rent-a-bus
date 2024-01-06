@extends('layout.main');
@section('konten')
<div class="row mt-2">
	<div class="col-lg-12 mb-lg-0 mb-4">
		<div class="card">
			<div class="card-body p-3">
				<div class="row">
					<div class="col-lg-12">
						<div class="d-flex flex-column h-100">
							<p class="mb-1 pt-2 text-bold">Tambah Data Kategori Berita</p>
							<p class="mb-2"></p>
							<form action="" method="post">
								@csrf
								<div class="form-group">
									<label>Kategori Berita {{required()}}</label>
									<input autofocus maxlength="100" type="text" name="kategori_berita" class="form-control" value="{{old('kategori_berita')}}" required>
									@error('kategori_berita')
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
@endsection