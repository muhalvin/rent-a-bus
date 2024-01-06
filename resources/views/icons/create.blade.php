@extends('layout.main')

@section('konten')
<div class="row">
	<div class="col-sm-12">
		<div class="card">
			<div class="card-body">
				<form action="" method="post">
					@csrf
					<div class="form-group">
						<label>Icon {{required()}}</label>
						<input type="text" name="icon" class="form-control" value="{{old('icon')}}" placeholder="Icon font-awesome" autofocus>
						@error('icon')
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