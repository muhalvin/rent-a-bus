@extends('layout.main');
@section('konten')

<div class="row mt-2">
	<div class="col-lg-12 mb-lg-0 mb-4">
		<div class="card">
			<div class="card-body p-3">
				<div class="row">
					<div class="col-lg-12">
						<div class="d-flex flex-column h-100">
							<p class="mb-1 pt-2 text-bold">Ubah Data level</p>
							<p class="mb-2"></p>
							<form action="" method="post">
								@csrf
								@method('PATCH')
								<div class="form-group">
									<label>Level {{required()}}</label>
									<input autofocus type="text" name="level" class="form-control" value="{{$val->level}}" required>
									@error('level')
									<span class="error">{{$message}}</span>
									@enderror
								</div>
								<div class="form-group">
									<label>Setup Hak Akses ?</label>
									<div class="form-check form-check-inline">
										<label class="form-check-label">
											<input class="form-check-input field03" type="radio" name="setup" id="setup_1" value="1" {{old('setup'?'checked':null)}}> Yes
										</label>
									</div>
									<div class="form-check form-check-inline">
										<label class="form-check-label">
											<input class="form-check-input setup" type="radio" name="setup" id="setup_2" value="0" {{!old('setup'?'checked':null)}}> No
										</label>
									</div>
									@error('setup')
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