@extends('layout.main')

@section('konten')
<link rel="stylesheet" type="text/css" href="{{url('assets/plugin/DataTables/datatables.min.css')}}"/>

<div class="row">
	<div class="col-12">
		<div class="card mb-4">
			<div class="card-header">
				<h6>
					{{tambah($menu_active, $title)}}
				</h6>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table align-items-center tabel">
						<thead>
							<tr>
								<th class="text-center">#</th>
								<th>Menu</th>
								<th>Link</th>
								<th>Separator</th>
								<th>Number</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach($val as $v)
							<tr>
								<th class="text-center">{{$loop->iteration}}</th>
								<th>{{$v->menu}}</th>
								<td>
									@if ($v->is_link)
									<a href="{{url($v->link)}}">{{$v->link}}</a>
									@else
									-
									@endif
								</td>
								<td>
									<span class="badge badge-sm bg-gradient-{{$v->is_separator?'success':null}}">{{$v->is_separator?$v->separator:'-'}}</span>
								</td>
								<td>
									{{$v->urutan}}
								</td>
								<td>
									{{edit($menu_active, $v->id)}}
									{{hapus($menu_active, $v->id, $v->menu)}}
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

<div class="row">
	<div class="col-12">
		<div class="card mb-4">
			<div class="card-header">
				<h6>
					{{tambah($menu_active, $title, 'create_detail')}}
				</h6>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table align-items-center tabel">
						<thead>
							<tr>
								<th class="text-center">#</th>
								<th>Menu</th>
								<th>Sub Menu</th>
								<th>Link</th>
								<th>Number</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach($detail as $v)
							<tr>
								<th class="text-center">{{$loop->iteration}}</th>
								<th>{{$v->parent_menu}}</th>
								<th>{{$v->menu}}</th>
								<td><a href="{{url($v->link)}}">{{$v->link}}</a></td>
								<td>
									{{$v->urutan}}
								</td>
								<td>
									{{edit($menu_active, $v->id, 'update_detail')}}
									{{hapus($menu_active, $v->id, $v->menu, 'destroy_detail')}}
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
<script type="text/javascript">
	$(document).ready(function(){
		$('.tabel').DataTable();
	});
</script>
@endsection