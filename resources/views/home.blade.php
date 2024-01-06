@extends('layout.main')

@section('konten')
<div class="row">
 <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
  <div class="card">
   <div class="card-body p-3">
    <div class="row">
     <div class="col-8">
      <div class="numbers">
       <p class="text-sm mb-0 text-capitalize font-weight-bold">Jml. Pelanggan</p>
       <h5 class="font-weight-bolder mb-0">
        {{$pelanggan}}
       </h5>
      </div>
     </div>
     <div class="col-4 text-end">
      <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
       <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
      </div>
     </div>
    </div>
   </div>
  </div>
 </div>
 <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
  <div class="card">
   <div class="card-body p-3">
    <div class="row">
     <div class="col-8">
      <div class="numbers">
       <p class="text-sm mb-0 text-capitalize font-weight-bold">Jml. Kendaraan</p>
       <h5 class="font-weight-bolder mb-0">
        {{$kendaraan}}
       </h5>
      </div>
     </div>
     <div class="col-4 text-end">
      <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
       <i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i>
      </div>
     </div>
    </div>
   </div>
  </div>
 </div>
 <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
  <div class="card">
   <div class="card-body p-3">
    <div class="row">
     <div class="col-8">
      <div class="numbers">
       <p class="text-sm mb-0 text-capitalize font-weight-bold">Tipe Kendaraan</p>
       <h5 class="font-weight-bolder mb-0">
        {{$tipe}}
       </h5>
      </div>
     </div>
     <div class="col-4 text-end">
      <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
       <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i>
      </div>
     </div>
    </div>
   </div>
  </div>
 </div>
 <div class="col-xl-3 col-sm-6">
  <div class="card">
   <div class="card-body p-3">
    <div class="row">
     <div class="col-8">
      <div class="numbers">
       <p class="text-sm mb-0 text-capitalize font-weight-bold">Jml. Transaksi</p>
       <h5 class="font-weight-bolder mb-0">
        {{$transaksi}}
       </h5>
      </div>
     </div>
     <div class="col-4 text-end">
      <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
       <i class="ni ni-cart text-lg opacity-10" aria-hidden="true"></i>
      </div>
     </div>
    </div>
   </div>
  </div>
 </div>
</div>
<div class="row mt-4">
 <div class="col-lg-6">
  <div class="card table-card">
   <div class="card-header">
    <h5>Riwayat Pesanan Terbaru</h5>
   </div>
   <div class="card-block">
    <div class="table-responsive">
     <table class="table table-hover table-borderless">
      <thead>
       <tr>
        <th>Status</th>
        <th>Kode Pesanan</th>
        <th>Bus</th>
        <th>Date</th>
       </tr>
      </thead>
      <tbody>
       <?php foreach ($pesanan as $v): ?>
        <tr>
         <td><label class="label label-<?=($v->status=='belum'?'danger' : ($v->status=='dp' ? 'info' : 'success'))?>"><?=($v->status=='belum'?'Belum Bayar' : ($v->status=='dp' ? 'DP' : 'Lunas'))?></label></td>
         <td><?=$v->kd_pesanan?></td>
         <td><?=$v->bus?></td>
         <td><?=date('d/m/Y', strtotime($v->tgl_mulai_sewa)).' s/d '.date('d/m/Y', strtotime($v->tgl_selesai_sewa))?></td>
        </tr>
       <?php endforeach ?>
      </tbody>
     </table>
     <div class="text-right m-r-20">
      <a href="<?=url('pesanan')?>" class="btn btn-primary">Lihat Semua Pesanan</a>
     </div>
    </div>
   </div>
  </div>
 </div>
 <div class="col-lg-6">
  <div class="card latest-update-card">
   <div class="card-block">
    <div class="table-responsive">
     <table class="table table-hover table-borderless">
      <thead>
       <tr>
        <th>Status</th>
        <th>Kode Transaksi</th>
        <th>Tanggal</th>
        <th>Jml. Bayar</th>
       </tr>
      </thead>
      <tbody>
       <?php foreach ($bayar as $v): ?>
        <tr style="cursor: pointer;" onclick="return location='<?=url('transaksi/update/'.$v->id)?>'">
         <td><label class="label label-<?=($v->status==0?'danger' : ($v->status==1 ? 'success' : 'warning'))?>"><?=($v->status==0?'Belum Bayar' : ($v->status==1 ? 'Lunas' : 'Gagal'))?></label></td>
         <td><?=$v->kd_transaksi?></td>
         <td><?=date('d/m/Y', strtotime($v->tgl_transaksi))?></td>
         <td><?=rupiah($v->jumlah)?></td>
        </tr>
       <?php endforeach ?>
      </tbody>
     </table>
     <div class="text-right m-r-20">
      <a href="<?=url('pesanan')?>" class="btn btn-primary">Lihat Semua Transaksi</a>
     </div>
    </div>
   </div>
  </div>
 </div>
</div>
@endsection