@extends('layout.main')

@section('konten')
<div class="row">
	<div class="col-sm-12">
		<div class="card">
			<div class="card-body">
				<form action="" method="post">
					@csrf
					@method('PATCH')
					<div class="form-group">
						<label>Icon {{required()}}</label>
						<div class="input-group">
							<div class="input-group-text">
								<i class="{{$val->icon}}"></i>
							</div>
							<input type="text" name="icon" class="form-control" value="{{$val->icon}}" placeholder="Icon font-awesome" autofocus>
						</div>
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