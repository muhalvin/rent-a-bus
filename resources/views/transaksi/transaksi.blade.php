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
								<th>Kd. Transaksi</th>
								<th>Penyewa</th>
								<th>Tanggal Sewa</th>
								<th>Nominal</th>
								<th>Metode Pembayaran</th>
								<th>Status</th>
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
<script type='text/javascript'>
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
                { data: 'kd_transaksi', name: 'kd_transaksi' },
                { data: 'penyewa', name: 'penyewa' },
                { data: 'tgl_sewa', name: 'tgl_sewa' },
                { data: 'nominal', name: 'nominal' },
                { data: 'metode', name: 'metode' },
                { data: 'status', name: 'status' },
                { data: 'action', name: 'action'}
            ]
        });
	});
</script>
@endsection