@extends('layout.main');
@section('konten')

<div class="row">
	<div class="col-sm-7">
		<div class="card">
			<div class="card-header">
				<h6>
					Write your imagination in here..
				</h6>
			</div>
			<div class="card-body">
				<form action="" method="post">
					@csrf
					<div class="form-group">
						<label>Model Learning System</label>
						<select name="model" id="model" class="form-control" required>
							<option value="">Choose</option>
							<option value="text-davinci-003">text-davinci-003</option>
							<option value="text-curie-001">text-curie-001</option>
							<option value="text-babbage-001">text-babbage-001</option>
							<option value="text-ada-001">text-ada-001</option>
						</select>
						@error('model')
						<span class="error">{{$message}}</span>
						@enderror
					</div>
					<div class="form-group">
						<label>Question</label>
						<textarea name="question" class="form-control" style="height: 120px;">{{old('question')}}</textarea>
						@error('question')
						<span class="error">{{$message}}</span>
						@enderror
					</div>
					{{proses(true, 'Proses')}}
				</form>
			</div>
		</div>
	</div>
	<div class="col-sm-5">
		<div class="card">
			<div class="card-header">
				<h5>Output:</h5>
				Questions : <b>{{$question}}</b>
			</div>
			<div class="card-body">
				<textarea style="height: 250px;" class="form-control">{{json_decode($result)}}</textarea>
			</div>
		</div>
	</div>
</div>
@endsection