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
		                        <th width="8%"><center>#</center></th>
		                        <th>Kode</th>
		                        <th>Penyewa</th>
		                        <th>Bus</th>
		                        <th>Tgl. Pesan</th>
		                        <th>Waktu Sewa</th>
		                        <th>Total Biaya</th>
		                        <th>Dibayarkan</th>
		                        <th>Status</th>
		                        <th><center>Action</center></th>
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
                { data: 'kd_pesanan', name: 'kd_pesanan' },
                { data: 'penyewa', name: 'penyewa' },
                { data: 'bus', name: 'bus' },
                { data: 'tgl_pesan', name: 'tgl_pesan' },
                { data: 'waktu_sewa', name: 'waktu_sewa' },
                { data: 'total_biaya', name: 'total_biaya' },
                { data: 'dibayarkan', name: 'dibayarkan' },
                { data: 'status', name: 'status' },
                { data: 'action', name: 'action'}
            ]
        });
	});
</script>
@endsection