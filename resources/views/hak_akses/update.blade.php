@extends('layout.main');
@section('konten')

<link rel="stylesheet" type="text/css" href="{{url('assets/plugin/select2/dist/css/select2.min.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{url('assets/plugin/dropify/css/dropify.min.css')}}"/>
<div class="row mt-2">
	<div class="col-lg-12 mb-lg-0 mb-4">
		<div class="card">
			<div class="card-body p-3">
				<div class="row">
					<div class="col-lg-12">
						<div class="d-flex flex-column h-100">
							<p class="mb-1 pt-2 text-bold">Ubah Data Akses</p>
							<p class="mb-2"></p>
							<form action="" method="post">
								@csrf
								@method('PATCH')
								<div class="form-group">
									<div class="table-responsive">
										<table class="table table-hover">
											<thead>
												<tr>
													<th class="text-center">#</th>
													<th>Parent</th>
													<th>Child</th>
												</tr>
											</thead>
											<tbody>
												@foreach ($parent as $p)
												<tr>
													<th class="text-center">{{$loop->iteration}}</th>
													<td>
														<label>
															<input type="checkbox" <?=(in_array($p->id, $akses) ? 'checked' : null)?> name="menu_id[]" value="{{$p->id}}"> {{$p->menu}}
														</label><br>
														<?php if ($p->is_link): ?>
															<label>
																<input type="checkbox" <?=(in_array($p->id.'l', $aksesl) ? 'checked' : null)?> name="lihat[]" value="{{$p->id}}l"> View
															</label>
															<label>
																<input type="checkbox" <?=(in_array($p->id.'t', $aksest) ? 'checked' : null)?> name="tambah[]" value="{{$p->id}}t"> Create
															</label>
															<label>
																<input type="checkbox" <?=(in_array($p->id.'e', $aksese) ? 'checked' : null)?> name="edit[]" value="{{$p->id}}e"> Edit
															</label>
															<label>
																<input type="checkbox" <?=(in_array($p->id.'h', $aksesh) ? 'checked' : null)?> name="hapus[]" value="{{$p->id}}h"> Delete
															</label>
														<?php endif ?>
													</td>
													<td>
														@foreach ($child as $c)
														@if ($c->parent_id == $p->id)
														<div class="form-group">
															<label>
																<input type="checkbox" <?=(in_array($c->id, $akses) ? 'checked' : null)?> name="menu_id[]" value="{{$c->id}}"> {{$c->menu}}
															</label><br>
															<label>
																<input type="checkbox" <?=(in_array($c->id.'l', $aksesl) ? 'checked' : null)?> name="lihat[]" value="{{$c->id}}l"> View
															</label>
															<label>
																<input type="checkbox" <?=(in_array($c->id.'t', $aksest) ? 'checked' : null)?> name="tambah[]" value="{{$c->id}}t"> Create
															</label>
															<label>
																<input type="checkbox" <?=(in_array($c->id.'e', $aksese) ? 'checked' : null)?> name="edit[]" value="{{$c->id}}e"> Edit
															</label>
															<label>
																<input type="checkbox" <?=(in_array($c->id.'h', $aksesh) ? 'checked' : null)?> name="hapus[]" value="{{$c->id}}h"> Delete
															</label>
														</div>
														@endif
														@endforeach
													</td>
												</tr>
												@endforeach
												@error('menu_id')
												<span class="error">{{$message}}</span>
												@enderror
											</tbody>
										</table>
									</div>
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

<script src="{{url('assets/plugin/dropify/js/dropify.min.js')}}"></script>
<script type='text/javascript'>
	$(document).ready(function(){
		$('.select2').select2();
		$('.dropify').dropify();
	});
</script>
@endsection