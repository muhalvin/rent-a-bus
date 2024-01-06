@extends('layout.main');
@section('konten')
<link rel="stylesheet" type="text/css" href="{{url('assets/plugin/select2/dist/css/select2.min.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{url('assets/plugin/dropify/css/dropify.min.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{url('assets/plugin/summernote/summernote-lite.min.css')}}"/>

<div class="modal" id="mfoto" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Upload Foto</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<p>
					<form action="{{url($menu_active.'/upload')}}" method="post" enctype="multipart/form-data">
						@csrf
						<input type="hidden" name="id_bus" readonly value="{{$val->id}}">
						<div class="form-group">
							<label for="">Gambar</label>
							<input placeholder="" type="file" id="gambar" name="gambar" class="dropify" required />
							@error('gambar')
							<span class="error">{{$message}}</span>
							@enderror
						</div>
						{{prosback($menu_active)}}
					</form>
				</p>
			</div>
		</div>
	</div>
</div>

<div class="row mt-2">
	<div class="col-lg-8 mb-lg-0 mb-4">
		<div class="card">
			<div class="card-body p-3">
				<div class="row">
					<div class="col-lg-12">
						<div class="d-flex flex-column h-100">
							<p class="mb-1 pt-2 text-bold">Ubah Data Bus</p>
							<p class="mb-2"></p>
							<form action="" method="post" enctype="multipart/form-data">
								@csrf
								@method('PATCH')
								<div class="form-group">
									<label>Bus {{required()}}</label>
									<input type="text" name="bus" class="form-control" value="{{$val->bus}}" required>
									@error('bus')
									<span class="error">{{$message}}</span>
									@enderror
								</div>
								<div class="form-group">
									<label>Merek {{required()}}</label>
									<select name="id_merek" class="form-control select2" required>
										<option value="">Pilih</option>
										@foreach($merek as $v)
										<option {{$val->id_merek == $v['id'] ? 'selected':null}} value="{{$v['id']}}">{{$v['merek']}}</option>
										@endforeach
									</select>
									@error('id_merek')
									<span class="error">{{$message}}</span>
									@enderror
								</div>
								<div class="form-group">
									<label>Tipe {{required()}}</label>
									<select name="id_tipe" class="form-control select2" required>
										<option value="">Pilih</option>
										@foreach($tipe as $v)
										<option {{($val->id_tipe == $v['id'] ? 'selected':null)}} value="{{$v['id']}}">{{$v['tipe']}}</option>
										@endforeach
									</select>
									@error('id_tipe')
									<span class="error">{{$message}}</span>
									@enderror
								</div>
								<div class="form-group">
									<label>Harga sewa {{required()}}</label>
									<input type="number" name="harga_sewa" class="form-control" value="{{$val->harga_sewa}}" required>
									@error('harga_sewa')
									<span class="error">{{$message}}</span>
									@enderror
								</div>
								<div class="form-group">
									<label>Kapasitas {{required()}}</label>
									<input type="number" name="kapasitas" class="form-control" value="{{$val->kapasitas}}" required>
									@error('kapasitas')
									<span class="error">{{$message}}</span>
									@enderror
								</div>
								<div class="form-group">
									<label>Tahun bus {{required()}}</label>
									<input type="number" maxlength="4" minlength="4" name="tahun_bus" class="form-control" value="{{$val->tahun_bus}}" required>
									@error('tahun_bus')
									<span class="error">{{$message}}</span>
									@enderror
								</div>
								<div class="form-group">
									<label>No. Rangka {{required()}}</label>
									<input type="text" name="no_rangka" class="form-control" value="{{$val->no_rangka}}" required>
									@error('no_rangka')
									<span class="error">{{$message}}</span>
									@enderror
								</div>
								<div class="form-group">
									<label>No. Mesin {{required()}}</label>
									<input type="text" name="no_mesin" class="form-control" value="{{$val->no_mesin}}" required>
									@error('no_mesin')
									<span class="error">{{$message}}</span>
									@enderror
								</div>
								<div class="form-group">
									<label>No. Plat {{required()}}</label>
									<input type="text" name="no_plat" class="form-control" value="{{$val->no_plat}}" required>
									@error('no_plat')
									<span class="error">{{$message}}</span>
									@enderror
								</div>
								<div class="form-group">
									<label>Tahun Operasi {{required()}}</label>
									<input type="number" minlength="4" maxlength="4" name="tahun_operasi" class="form-control" value="{{$val->tahun_operasi}}" required>
									@error('tahun_operasi')
									<span class="error">{{$message}}</span>
									@enderror
								</div>
								<div class="form-group">
									<label>Mileage {{required()}}</label>
									<input type="text" name="mileage" class="form-control" value="{{$val->mileage}}">
									@error('mileage')
									<span class="error">{{$message}}</span>
									@enderror
								</div>
								<div class="form-group">
									<label>Transmisi {{required()}}</label>
									<select name="transmission" class="form-control select2" required>
										<option value="">Pilih</option>
										<option {{($val->transmission == 'Manual' ? 'selected':null)}} value="Manual">Manual</option>
										<option {{($val->transmission == 'Otomatis' ? 'selected':null)}} value="Otomatis">Otomatis</option>
									</select>
									@error('transmission')
									<span class="error">{{$message}}</span>
									@enderror
								</div>
								<div class="form-group">
									<label>Luggage {{required()}}</label>
									<input type="text" maxlength="30" name="luggage" class="form-control" value="{{$val->luggage}}" placeholder="Ex: 32 Bags">
									@error('luggage')
									<span class="error">{{$message}}</span>
									@enderror
								</div>
								<div class="form-group">
									<label>Bahan Bakar {{required()}}</label>
									<select name="fuel" class="form-control select2" required>
										<option value="">Pilih</option>
										<option {{($val->fuel == 'Bensin' ? 'selected':null)}} value="Bensin">Bensin</option>
										<option {{($val->fuel == 'Solar' ? 'selected':null)}} value="Solar">Solar</option>
									</select>
									@error('fuel')
									<span class="error">{{$message}}</span>
									@enderror
								</div>
								<div class="form-group">
									<label>Fitur</label>
									<textarea name="fitur" class="form-control teksarea">{{$val->fitur}}</textarea>
									@error('fitur')
									<span class="error">{{$message}}</span>
									@enderror
								</div>
								<div class="form-group">
									<label>Deskripsi</label>
									<textarea name="deskripsi" class="form-control teksarea">{{$val->deskripsi}}</textarea>
									@error('deskripsi')
									<span class="error">{{$message}}</span>
									@enderror
								</div>
								<div class="form-group">
									<label>Status</label>
									<div class="form-check form-check-inline">
										<label class="form-check-label">
											<input class="form-check-input is_aktif" type="radio" name="is_aktif" id="is_aktif_1" value="1" {{$val->is_aktif?'checked':null}}> Aktif
										</label>
									</div>
									<div class="form-check form-check-inline">
										<label class="form-check-label">
											<input class="form-check-input is_aktif" type="radio" name="is_aktif" id="is_aktif_2" value="0" {{!$val->is_aktif?'checked':null}}> Non Aktif
										</label>
									</div>
									@error('is_aktif')
									<span class="error">{{$message}}</span>
									@enderror
								</div>
								<div class="form-group">
									<label>Gambar {{required()}}</label>
									<input type="file" accept="image/*" name="gambar" data-default-file="{{asset('storage/'.$val->gambar)}}" value="{{$val->gambar}}" class="form-control dropify" value="{{$val->gambar}}">
									@error('gambar')
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
	<div class="col-lg-4 mb-lg-0 mb-4">
		<div class="card">
			<div class="card-header">
    <h4>Tambah Foto</h4> <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#mfoto">Tambah Foto</button>
   </div>
			<div class="card-body p-3">
				<div class="table-responsive">
     <table class="table table-striped table-hover">
      <thead>
       <tr>
        <th class="text-center">#</th>
        <th>Gambar</th>
        <th>Action</th>
       </tr>
      </thead>
      <tbody>
       <?php 
       $no = 1;
       foreach ($gambar as $v) {
        ?>
        <tr>
         <th class="text-center"><?=$no++?></th>
         <td>
          <img src="{{asset('storage/'.$v->gambar)}}" style="width: 100px; height: auto;">
         </td>
         <td class="text-center">
          <?=hapus($menu_active, $v->id, $v->gambar, 'destroy_gambar', true)?>
         </td>
        </tr>
        <?php
       }
       ?>
      </tbody>
     </table>
    </div>
			</div>
		</div>
	</div>
</div>
<script src="{{url('assets/plugin/select2/dist/js/select2.min.js')}}"></script>
<script src="{{url('assets/plugin/dropify/js/dropify.min.js')}}"></script>
<script src="{{url('assets/plugin/summernote/summernote-lite.min.js')}}"></script>
<script type='text/javascript'>
	$(document).ready(function(){
		$('.select2').select2();
		$('.dropify').dropify();
		$('.teksarea').summernote({
			height: 250
		});
	});
</script>
@endsection