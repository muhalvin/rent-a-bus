@extends('layout.main')

@section('konten')
<div class="row">
	<div class="col-12">
		<div class="page-header min-height-300 border-radius-xl mt-4" style="background-image: url('../assets/img/curved-images/curved0.jpg'); background-position-y: 50%;">
			<span class="mask bg-gradient-primary opacity-6"></span>
		</div>
		<div class="card card-body blur shadow-blur mx-4 mt-n6 overflow-hidden">
			<div class="row gx-4">
				<div class="col-auto">
					<div class="avatar avatar-xl position-relative">
						<img src="{{asset('storage/'.Session::get('foto'))}}" alt="{{$val->nama}}" class="w-100 border-radius-lg shadow-sm">
					</div>
				</div>
				<div class="col-auto my-auto">
					<div class="h-100">
						<h5 class="mb-1">
							{{$val->nama}}
						</h5>
						<p class="mb-0 font-weight-bold text-sm">
							{{$val->email}}
						</p>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
					<div class="nav-wrapper position-relative end-0">
						<ul class="nav nav-pills nav-fill p-1 bg-transparent" role="tablist">
							<li class="nav-item">
								<a class="nav-link mb-0 px-0 py-1 active " data-bs-toggle="tab" href="javascript:;" role="tab" aria-selected="true">
									<i class="fa fa-cube"></i>
									<span class="ms-1">App</span>
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link mb-0 px-0 py-1 " data-bs-toggle="tab" href="javascript:;" role="tab" aria-selected="false">
									<i class="fa fa-inbox"></i>
									<span class="ms-1">Messages</span>
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link mb-0 px-0 py-1 " data-bs-toggle="tab" href="javascript:;" role="tab" aria-selected="false">
									<i class="fa fa-wrench"></i>
									<span class="ms-1">Settings</span>
								</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row mt-3">
	<div class="col-12 col-xl-4">
		<div class="card h-100">
			<div class="card-header pb-0 p-3">
				<div class="row">
					<div class="col-md-8 d-flex align-items-center">
						<h6 class="mb-0">Ubah Profil</h6>
					</div>
					<div class="col-md-4 text-end">
						<a href="javascript:;">
							<i class="fas fa-user-edit text-secondary text-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Ubah Profil"></i>
						</a>
					</div>
				</div>
			</div>
			<div class="card-body p-3">
				<h6 class="text-uppercase text-body text-xs font-weight-bolder">Account</h6>
				<form action="" method="post" enctype="multipart/form-data">
					@csrf
					@method('PATCH')
					<div class="form-group">
						<label>Email {{required()}}</label>
						<input type="email" class="form-control" readonly maxlength="255" value="{{$val->email}}">
						@error('email')
						<span class="error">{{$message}}</span>
						@enderror
					</div>
					<div class="form-group">
						<label>Password <span class="error">*) Biarkan kosong jika tidak ingin mengganti password!</span></label>
						<input type="password" name="password" class="form-control" maxlength="255" value="">
						@error('password')
						<span class="error">{{$message}}</span>
						@enderror
					</div>
					<div class="form-group">
						<label>Nama {{required()}}</label>
						<input type="text" name="nama" class="form-control" required maxlength="255" value="{{$val->nama}}">
						@error('nama')
						<span class="error">{{$message}}</span>
						@enderror
					</div>
					<div class="form-group">
						<label>Jenis Kelamin {{required()}}</label><br>
						<div class="form-check form-check-inline">
							<label class="form-check-label">
								<input class="form-check-input jk" type="radio" name="jk" id="jk_1" value="Laki-Laki" {{$val->jk=='Laki-Laki'?'checked':null}}> Laki-Laki
							</label>
						</div>
						<div class="form-check form-check-inline">
							<label class="form-check-label">
								<input class="form-check-input jk" type="radio" name="jk" id="jk_2" value="Perempuan" {{$val->jk=='Perempuan'?'checked':null}}> Perempuan
							</label>
						</div>
						@error('jk')
						<span class="error">{{$message}}</span>
						@enderror
					</div>
					<div class="form-group">
						<label>Alamat</label>
						<textarea name="alamat" class="form-control teksarea">{{$val->alamat}}</textarea>
						@error('alamat')
						<span class="error">{{$message}}</span>
						@enderror
					</div>
					<div class="form-group">
						<label>Tgl. Lahir</label>
						<input type="date" name="tgl_lahir" class="form-control" required value="{{$val->tgl_lahir}}">
						@error('tgl_lahir')
						<span class="error">{{$message}}</span>
						@enderror
					</div>
					<div class="form-group">
						<label>No. HP</label>
						<input type="text" name="no_hp" class="form-control" required minlength="9" maxlength="15" value="{{$val->no_hp}}">
						@error('no_hp')
						<span class="error">{{$message}}</span>
						@enderror
					</div>
					<div class="form-group">
						<label>Foto</label>
						<input type="file" name="foto" id="foto" class="form-control" accept="image/*">
						@error('foto')
						<span class="error">{{$message}}</span>
						@enderror
					</div>
					{{proses()}}
				</form>
			</div>
		</div>
	</div>
	<div class="col-12 col-xl-4">
		<div class="card h-100">
			<div class="card-header pb-0 p-3">
				<div class="row">
					<div class="col-md-8 d-flex align-items-center">
						<h6 class="mb-0">Informasi Anda</h6>
					</div>
					<div class="col-md-4 text-end">
						<a href="javascript:;">
							<i class="fa fa-user text-secondary text-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Profil Anda"></i>
						</a>
					</div>
				</div>
			</div>
			<div class="card-body p-3">
				<p class="text-sm">
					Hi, I’m Alec Thompson, Decisions: If you can’t decide, the answer is no. If two equally difficult paths, choose the one more painful in the short term (pain avoidance is creating an illusion of equality).
				</p>
				<hr class="horizontal gray-light my-4">
				<ul class="list-group">
					<li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Full Name:</strong> &nbsp; {{$val->nama}}</li>
					<li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Mobile:</strong> &nbsp; {{$val->no_hp}}</li>
					<li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Email:</strong> &nbsp; {{$val->email}}</li>
					<li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Gender:</strong> &nbsp; {{$val->jk}}</li>
					<li class="list-group-item border-0 ps-0 pb-0">
						<strong class="text-dark text-sm">Social:</strong> &nbsp;
						<a class="btn btn-facebook btn-simple mb-0 ps-1 pe-2 py-0" href="javascript:;">
							<i class="fab fa-facebook fa-lg"></i>
						</a>
						<a class="btn btn-twitter btn-simple mb-0 ps-1 pe-2 py-0" href="javascript:;">
							<i class="fab fa-twitter fa-lg"></i>
						</a>
						<a class="btn btn-instagram btn-simple mb-0 ps-1 pe-2 py-0" href="javascript:;">
							<i class="fab fa-instagram fa-lg"></i>
						</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
	<div class="col-12 col-xl-4">
		<div class="card h-100">
			<div class="card-header pb-0 p-3">
				<h6 class="mb-0">Conversations</h6>
			</div>
			<div class="card-body p-3">
				<ul class="list-group">
					<li class="list-group-item border-0 d-flex align-items-center px-0 mb-2">
						<div class="avatar me-3">
							<img src="../assets/img/kal-visuals-square.jpg" alt="kal" class="border-radius-lg shadow">
						</div>
						<div class="d-flex align-items-start flex-column justify-content-center">
							<h6 class="mb-0 text-sm">Sophie B.</h6>
							<p class="mb-0 text-xs">Hi! I need more information..</p>
						</div>
						<a class="btn btn-link pe-3 ps-0 mb-0 ms-auto" href="javascript:;">Reply</a>
					</li>
					<li class="list-group-item border-0 d-flex align-items-center px-0 mb-2">
						<div class="avatar me-3">
							<img src="../assets/img/marie.jpg" alt="kal" class="border-radius-lg shadow">
						</div>
						<div class="d-flex align-items-start flex-column justify-content-center">
							<h6 class="mb-0 text-sm">Anne Marie</h6>
							<p class="mb-0 text-xs">Awesome work, can you..</p>
						</div>
						<a class="btn btn-link pe-3 ps-0 mb-0 ms-auto" href="javascript:;">Reply</a>
					</li>
					<li class="list-group-item border-0 d-flex align-items-center px-0 mb-2">
						<div class="avatar me-3">
							<img src="../assets/img/ivana-square.jpg" alt="kal" class="border-radius-lg shadow">
						</div>
						<div class="d-flex align-items-start flex-column justify-content-center">
							<h6 class="mb-0 text-sm">Ivanna</h6>
							<p class="mb-0 text-xs">About files I can..</p>
						</div>
						<a class="btn btn-link pe-3 ps-0 mb-0 ms-auto" href="javascript:;">Reply</a>
					</li>
					<li class="list-group-item border-0 d-flex align-items-center px-0 mb-2">
						<div class="avatar me-3">
							<img src="../assets/img/team-4.jpg" alt="kal" class="border-radius-lg shadow">
						</div>
						<div class="d-flex align-items-start flex-column justify-content-center">
							<h6 class="mb-0 text-sm">Peterson</h6>
							<p class="mb-0 text-xs">Have a great afternoon..</p>
						</div>
						<a class="btn btn-link pe-3 ps-0 mb-0 ms-auto" href="javascript:;">Reply</a>
					</li>
					<li class="list-group-item border-0 d-flex align-items-center px-0">
						<div class="avatar me-3">
							<img src="../assets/img/team-3.jpg" alt="kal" class="border-radius-lg shadow">
						</div>
						<div class="d-flex align-items-start flex-column justify-content-center">
							<h6 class="mb-0 text-sm">Nick Daniel</h6>
							<p class="mb-0 text-xs">Hi! I need more information..</p>
						</div>
						<a class="btn btn-link pe-3 ps-0 mb-0 ms-auto" href="javascript:;">Reply</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
	<div class="col-12 mt-4">
		<div class="card mb-4">
			<div class="card-header pb-0 p-3">
				<h6 class="mb-1">Projects</h6>
				<p class="text-sm">Architects design houses</p>
			</div>
			<div class="card-body p-3">
				<div class="row">
					<div class="col-xl-3 col-md-6 mb-xl-0 mb-4">
						<div class="card card-blog card-plain">
							<div class="position-relative">
								<a class="d-block shadow-xl border-radius-xl">
									<img src="../assets/img/home-decor-1.jpg" alt="img-blur-shadow" class="img-fluid shadow border-radius-xl">
								</a>
							</div>
							<div class="card-body px-1 pb-0">
								<p class="text-gradient text-dark mb-2 text-sm">Project #2</p>
								<a href="javascript:;">
									<h5>
										Modern
									</h5>
								</a>
								<p class="mb-4 text-sm">
									As Uber works through a huge amount of internal management turmoil.
								</p>
								<div class="d-flex align-items-center justify-content-between">
									<button type="button" class="btn btn-outline-primary btn-sm mb-0">View Project</button>
									<div class="avatar-group mt-2">
										<a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Elena Morison">
											<img alt="Image placeholder" src="../assets/img/team-1.jpg">
										</a>
										<a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Ryan Milly">
											<img alt="Image placeholder" src="../assets/img/team-2.jpg">
										</a>
										<a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Nick Daniel">
											<img alt="Image placeholder" src="../assets/img/team-3.jpg">
										</a>
										<a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Peterson">
											<img alt="Image placeholder" src="../assets/img/team-4.jpg">
										</a>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-3 col-md-6 mb-xl-0 mb-4">
						<div class="card card-blog card-plain">
							<div class="position-relative">
								<a class="d-block shadow-xl border-radius-xl">
									<img src="../assets/img/home-decor-2.jpg" alt="img-blur-shadow" class="img-fluid shadow border-radius-lg">
								</a>
							</div>
							<div class="card-body px-1 pb-0">
								<p class="text-gradient text-dark mb-2 text-sm">Project #1</p>
								<a href="javascript:;">
									<h5>
										Scandinavian
									</h5>
								</a>
								<p class="mb-4 text-sm">
									Music is something that every person has his or her own specific opinion about.
								</p>
								<div class="d-flex align-items-center justify-content-between">
									<button type="button" class="btn btn-outline-primary btn-sm mb-0">View Project</button>
									<div class="avatar-group mt-2">
										<a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Nick Daniel">
											<img alt="Image placeholder" src="../assets/img/team-3.jpg">
										</a>
										<a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Peterson">
											<img alt="Image placeholder" src="../assets/img/team-4.jpg">
										</a>
										<a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Elena Morison">
											<img alt="Image placeholder" src="../assets/img/team-1.jpg">
										</a>
										<a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Ryan Milly">
											<img alt="Image placeholder" src="../assets/img/team-2.jpg">
										</a>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-3 col-md-6 mb-xl-0 mb-4">
						<div class="card card-blog card-plain">
							<div class="position-relative">
								<a class="d-block shadow-xl border-radius-xl">
									<img src="../assets/img/home-decor-3.jpg" alt="img-blur-shadow" class="img-fluid shadow border-radius-xl">
								</a>
							</div>
							<div class="card-body px-1 pb-0">
								<p class="text-gradient text-dark mb-2 text-sm">Project #3</p>
								<a href="javascript:;">
									<h5>
										Minimalist
									</h5>
								</a>
								<p class="mb-4 text-sm">
									Different people have different taste, and various types of music.
								</p>
								<div class="d-flex align-items-center justify-content-between">
									<button type="button" class="btn btn-outline-primary btn-sm mb-0">View Project</button>
									<div class="avatar-group mt-2">
										<a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Peterson">
											<img alt="Image placeholder" src="../assets/img/team-4.jpg">
										</a>
										<a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Nick Daniel">
											<img alt="Image placeholder" src="../assets/img/team-3.jpg">
										</a>
										<a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Ryan Milly">
											<img alt="Image placeholder" src="../assets/img/team-2.jpg">
										</a>
										<a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Elena Morison">
											<img alt="Image placeholder" src="../assets/img/team-1.jpg">
										</a>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-3 col-md-6 mb-xl-0 mb-4">
						<div class="card h-100 card-plain border">
							<div class="card-body d-flex flex-column justify-content-center text-center">
								<a href="javascript:;">
									<i class="fa fa-plus text-secondary mb-3"></i>
									<h5 class=" text-secondary"> New project </h5>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection