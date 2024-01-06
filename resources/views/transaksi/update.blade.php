@extends('layout.main');
@section('konten')
<link rel="stylesheet" type="text/css" href="{{url('assets/plugin/select2/dist/css/select2.min.css')}}"/>
<div class="row mt-2">
	<div class="col-lg-12 mb-lg-0 mb-4">
		<div class="card">
			<div class="card-body p-3">
				<div class="row">
					<div class="col-lg-12">
						<div class="d-flex flex-column h-100">
							<p class="mb-1 pt-2 text-bold">Ubah Data Transaksi</p>
							<p class="mb-2"></p>
							<form action="" method="post">
								@csrf
								@method('PATCH')
								<div class="form-group">
									<label>Kode Pesanan {{required()}}</label>
									<select name="id_pesanan" class="form-control select2" required>
										<option value="">Pilih</option>
										@foreach ($pesanan as $v)
										<option {{($val->id_pesanan==$v->id?'selected':null)}} value="{{$v->id}}">{{$v->kd_pesanan.' - '.$v->penyewa.' - Kurang bayar '.rupiah($v->total_biaya - $v->dibayarkan)}}</option>
										@endforeach
									</select>
									@error('id_pesanan')
									<span class="error">{{$message}}</span>
									@enderror
								</div>
								<div class="form-group">
									<label>Tgl. Pembayaran {{required()}}</label>
									<input type="date" name="tgl_transaksi" class="form-control" value="{{$val->tgl_transaksi}}" required>
									@error('tgl_transaksi')
									<span class="error">{{$message}}</span>
									@enderror
								</div>
								<div class="form-group">
									<label>Jml. Pembayaran {{required()}}</label>
									<input type="number" name="jumlah" class="form-control" value="{{$val->jumlah}}" required>
									@error('jumlah')
									<span class="error">{{$message}}</span>
									@enderror
								</div>
								<div class="form-group">
									<label>Metode Pembayaran {{required()}}</label>
									<input type="text" name="metode" class="form-control" value="{{$val->metode}}" required>
									@error('metode')
									<span class="error">{{$message}}</span>
									@enderror
								</div>
								<div class="form-group">
									<label>Status Pembayaran</label>
									<div class="form-check form-check-inline">
										<label class="form-check-label">
											<input class="form-check-input status" type="radio" name="status" id="status_1" value="0" {{$val->status==0?'checked':null}}> Belum
										</label>
									</div>
									<div class="form-check form-check-inline">
										<label class="form-check-label">
											<input class="form-check-input status" type="radio" name="status" id="status_2" value="1" {{$val->status==1?'checked':null}}> Lunas
										</label>
									</div>
									<div class="form-check form-check-inline">
										<label class="form-check-label">
											<input class="form-check-input status" type="radio" name="status" id="status_3" value="3" {{$val->status==2?'checked':null}}> Gagal
										</label>
									</div>
									@error('status')
									<span class="error">{{$message}}</span>
									@enderror
								</div>
								<div class="form-group">
									<label>Keterangan</label>
									<textarea name="keterangan" class="form-control teksarea" required>{{$val->keterangan}}</textarea>
									@error('keterangan')
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
<script src="{{url('assets/plugin/select2/dist/js/select2.min.js')}}"></script>
<script type='text/javascript'>
	$(document).ready(function(){
		$('.select2').select2();
		$('.teksarea').summernote({
			height: 250
		});
	});
</script>
@endsection