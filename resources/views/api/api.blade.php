@extends('layout.main');
@section('konten')
<link rel="stylesheet" type="text/css" href="{{url('assets/plugin/DataTables/datatables.min.css')}}"/>


<div class="row">
	<div class="col-sm-12">
		<div class="card">
			<div class="card-header">
				<h6>
					{{tambah($menu_active, $title)}}
				</h6>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table align-items-center mb-0 tabel">
						<thead>
							<tr>
								<th class="text-center">#</th>
								<th>api</th>
								<th class="text-center">Param</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach($val as $v)
							<?php
								$value = json_decode($v->value, true);
							?>
							<tr>
								<th class="text-center">{{$loop->iteration}}</th>
								<th>{{$v->api}}</th>
								<td>
									<?php 
										echo "<pre>";
										print_r ($value);
										echo "</pre>";
									?>
								</td>
								<td>
									{{edit($menu_active, $v->id)}}
									{{hapus($menu_active, $v->id, $v->api)}}
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<script src="{{url('assets/plugin/DataTables/datatables.min.js')}}"></script>
<script type='text/javascript'>
	$(document).ready(function(){
		$('.tabel').DataTable();
	});
</script>
@endsection