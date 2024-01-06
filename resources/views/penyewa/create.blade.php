@extends('layout.main');
@section('konten')
<div class="row mt-2">
	<div class="col-lg-12 mb-lg-0 mb-4">
		<div class="card">
			<div class="card-body p-3">
				<div class="row">
					<div class="col-lg-12">
						<div class="d-flex flex-column h-100">
							<p class="mb-1 pt-2 text-bold">Tambah Data Penyewa</p>
							<p class="mb-2"></p>
							<form action="" method="post">
								@csrf
								<div class="form-group">
									<label>Penyewa {{required()}}</label>
									<input type="text" name="penyewa" class="form-control" value="{{old('penyewa')}}" required>
									@error('penyewa')
									<span class="error">{{$message}}</span>
									@enderror
								</div>
								<div class="form-group">
									<label>No. KTP / KITAS {{required()}}</label>
									<input type="text" name="kitas" class="form-control" value="{{old('kitas')}}" required>
									@error('kitas')
									<span class="error">{{$message}}</span>
									@enderror
								</div>
								<div class="form-group">
									<label>Jenis Kelamin</label>
									<div class="form-check form-check-inline">
										<label class="form-check-label">
											<input class="form-check-input jk" type="radio" name="jk" id="jk_1" value="Laki-Laki" {{old('jk')?'checked':null}}> Laki-Laki
										</label>
									</div>
									<div class="form-check form-check-inline">
										<label class="form-check-label">
											<input class="form-check-input jk" type="radio" name="jk" id="jk_2" value="Perempuan" {{!old('jk')?'checked':null}}> Perempuan
										</label>
									</div>
									@error('jk')
									<span class="error">{{$message}}</span>
									@enderror
								</div>
								<div class="form-group">
									<label>No. HP / Telp {{required()}}</label>
									<input type="number" name="no_hp" minlength="9" maxlength="15" class="form-control" value="{{old('no_hp')}}" required>
									@error('no_hp')
									<span class="error">{{$message}}</span>
									@enderror
								</div>
								<div class="form-group">
									<label>Alamat {{required()}}</label>
									<input type="text" name="alamat" class="form-control" value="{{old('alamat')}}" required>
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
@endsection