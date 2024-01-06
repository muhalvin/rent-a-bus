@extends('layout.main');
@section('konten')

<div class="row mt-2">
	<div class="col-lg-12 mb-lg-0 mb-4">
		<div class="card">
			<div class="card-body p-3">
				<div class="row">
					<div class="col-lg-12">
						<div class="d-flex flex-column h-100">
							<p class="mb-1 pt-2 text-bold">Tambah Data api</p>
							<p class="mb-2"></p>
							<form action="" method="post">
								@csrf
								<div class="form-group">
									<label>API {{required()}}</label>
									<div class="input-group">
										<div class="input-group-text">
											<i class="fa fa-fire"></i>
										</div>
										<input placeholder="" type="text" name="api" class="form-control" required value="{{old('api')}}">
									</div>
									@error('api')
									<div class="error">{{$message}}</div>
									@enderror
								</div>
								<div class="form-group">
									<label>Key {{required()}}</label>
									<div class="input-group">
										<div class="input-group-text">
											<i class="fa fa-key"></i>
										</div>
										<input placeholder="" type="text" name="key[]" class="form-control" required value="{{old('key[]')}}">
									</div>
									@error('key[]')
									<div class="error">{{$message}}</div>
									@enderror
								</div>
								<div class="form-group">
									<label>Value {{required()}}</label>
									<div class="input-group">
										<div class="input-group-text">
											<i class="fa fa-paper-plane"></i>
										</div>
										<input placeholder="" type="text" name="value[]" class="form-control" required value="{{old('value[]')}}">
									</div>
									@error('value[]')
									<div class="error">{{$message}}</div>
									@enderror
								</div>
								<div id="list">
									@if (!empty(old('key')))
										{{$loop = 0;}}
										@for ($i=0; $i < count(old('key')); $i++)
										{{$loop++}}
										<div class="form-group kv{{$loop}}">
											<button class="btn btn-danger btn-sm" onclick="del({{$loop}})"><i class="fa fa-trash"></i></button> #HAPUS PARAMETER {{$loop}}
										</div>
										<div class="form-group kv{{$loop}}">
											<label>Key</label>
											<div class="input-group">
												<div class="input-group-text">
													<i class="fa fa-key"></i>
												</div>
												<input placeholder="" type="text" name="key[]" class="form-control" required value="{{old('key[$i]')}}">
											</div>
											@error('key[]')
											<div class="error">{{$message}}</div>
											@enderror
										</div>
										<div class="form-group kv{{$loop}}">
											<label>Value</label>
											<div class="input-group">
												<div class="input-group-text">
													<i class="fa fa-paper-plane"></i>
												</div>
												<input placeholder="" type="text" name="value[]" class="form-control" required value="{{old('value[$i]')}}">
											</div>
											@error('value[]')
											<div class="error">{{$message}}</div>
											@enderror
										</div>
										@endfor
									@endif
								</div>
								<div class="form-group">
									<button type="button" class="btn btn-primary btn-sm tambah"><i class="fa fa-plus-circle"></i> Tambah Parameter</button>
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

<script type="text/javascript">
    let no = 1;
    $('.tambah').on('click', function(){
        no++;
        let html = `
        <div class="form-group kv`+no+`">
            <button class="btn btn-danger btn-sm" onclick="del(`+no+`)"><i class="fa fa-trash"></i></button> #HAPUS PARAMETER `+no+`
        </div>
        <div class="form-group kv`+no+`">
            <label>Key</label>
            <div class="input-group">
                <div class="input-group-text">
                    <i class="fa fa-key"></i>
                </div>
                <input placeholder="" type="text" name="key[]" class="form-control" required value="{{old('key[]')}}">
            </div>
            @error('key[]')
            <div class="error">{{$message}}</div>
            @enderror
        </div>
        <div class="form-group kv`+no+`">
            <label>Value</label>
            <div class="input-group">
                <div class="input-group-text">
                    <i class="fa fa-paper-plane"></i>
                </div>
                <input placeholder="" type="text" name="value[]" class="form-control" required value="{{old('value[]')}}">
            </div>
            @error('value[]')
            <div class="error">{{$message}}</div>
            @enderror
        </div>`;

        $('#list').append(html);
    });

    function del(id) {
        $('.kv'+id).remove();
    }
</script>
@endsection