@extends('layout.main')

@section('konten')
<link rel="stylesheet" type="text/css" href="{{url('assets/plugin/DataTables/datatables.min.css')}}"/>

<div class="row">
	<div class="col-12">
		<div class="card mb-4">
			<div class="card-header">
				<h6>
					{{tambah($menu_active, $title, 'create', false)}}
				</h6>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table align-items-center tabel">
						<thead>
							<tr>
								<th class="text-center">#</th>
								<th>Nama</th>
								<th>Email</th>
								<th>Jenis Kelamin</th>
								<th class="text-center">Status</th>
								<th>Role</th>
								<th>Action</th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<script src="{{url('assets/plugin/DataTables/datatables.min.js')}}"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('.tabel').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{$menu_active."/get_ajax"}}',
                type: 'GET'
            },
            columns: [
                { data: 'no', name:'id', render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }},
                { data: 'nama', name: 'nama' },
                { data: 'email', name: 'email' },
                { data: 'jk', name: 'jk' },
                { data: 'is_aktif', name: 'is_aktif'},
                { data: 'level', name: 'level' },
                { data: 'action', name: 'action'}
            ]
        });
	});
</script>
@endsection