@extends('layout.main')

@section('konten')
<div class="row">
	<div class="col-sm-12">
		<div class="card">
			<div class="card-body">
				<form action="" method="post">
					@csrf
					<div class="form-group">
						<label>Nama {{required()}}</label>
						<input autofocus type="text" name="nama" class="form-control" required maxlength="255" value="{{old('nama')}}">
						@error('nama')
						<span class="error">{{$message}}</span>
						@enderror
					</div>

					<div class="form-group">
						<label>Email {{required()}}</label>
						<input type="email" name="email" class="form-control" required maxlength="255" value="{{old('email')}}">
						@error('email')
						<span class="error">{{$message}}</span>
						@enderror
					</div>
					<div class="form-group">
						<label>Password {{required()}}</label>
						<input type="password" name="password" class="form-control" required maxlength="255" value="{{old('password')}}">
						@error('password')
						<span class="error">{{$message}}</span>
						@enderror
					</div>
					<div class="form-group">
						<label>Jenis Kelamin {{required()}}</label>
						<div class="form-check form-check-inline">
							<label class="form-check-label">
								<input class="form-check-input jk" type="radio" name="jk" id="jk_1" value="Laki-Laki" {{old('jk')=='Laki-Laki'?'checked':null}}> Laki-Laki
							</label>
						</div>
						<div class="form-check form-check-inline">
							<label class="form-check-label">
								<input class="form-check-input jk" type="radio" name="jk" id="jk_2" value="Perempuan" {{old('jk')=='Perempuan'?'checked':null}}> Perempuan
							</label>
						</div>
						@error('jk')
						<span class="error">{{$message}}</span>
						@enderror
					</div>
					<div class="form-group">
						<label>Alamat</label>
						<textarea name="alamat" class="form-control teksarea">{{old('alamat')}}</textarea>
						@error('alamat')
						<span class="error">{{$message}}</span>
						@enderror
					</div>
					<div class="form-group">
						<label>Tgl. Lahir</label>
						<input type="date" name="tgl_lahir" class="form-control" required value="{{old('tgl_lahir')}}">
						@error('tgl_lahir')
						<span class="error">{{$message}}</span>
						@enderror
					</div>
					<div class="form-group">
						<label>No. HP</label>
						<input type="text" name="no_hp" class="form-control" required minlength="9" maxlength="15" value="{{old('no_hp')}}">
						@error('no_hp')
						<span class="error">{{$message}}</span>
						@enderror
					</div>
					<div class="form-group">
						<label>Role {{required()}}</label>
						<select name="id_level" class="form-control select2">
							<option value="">Pilih</option>
							@foreach ($lvl as $v)
							<option {{old('id_level')==$v->id?'selected':null}} value="{{$v->id}}">{{$v->level}}</option>
							@endforeach
						</select>
						@error('id_level')
						<span class="error">{{$message}}</span>
						@enderror
					</div>
					{{prosback($menu_active)}}
				</form>
			</div>
		</div>
	</div>
</div>
@endsection