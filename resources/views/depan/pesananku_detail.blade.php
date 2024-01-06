@extends('depan.main')
@section('konten')
<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('<?=url('assets/depan/images/bg_3.jpg')?>');" data-stellar-background-ratio="0.5">
 <div class="overlay"></div>
 <div class="container">
  <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
   <div class="col-md-9 ftco-animate pb-5">
    <p class="breadcrumbs"><span class="mr-2"><a href="<?=url('/')?>">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Pesanan <i class="ion-ios-arrow-forward"></i></span></p>
    <h1 class="mb-3 bread">Pesanan <?=$r->kd_pesanan?></h1>
   </div>
  </div>
 </div>
</section>

<section class="ftco-section">
 <div class="container">
  <div class="row justify-content-center mb-5">
   <div class="col-md-7 text-center heading-section ftco-animate">
    <span class="subheading">Detail Pesanan</span>
    <h2 class="mb-3"><?=$r->kd_pesanan?></h2>
   </div>
  </div>
  <div class="row">
   <div class="col-sm-12">
    <div class="table-responsive">
     <table class="table table-striped">
      <thead>
       <tr>
        <th>Kode Pesanan</th>
        <td><?=$r->kd_pesanan?></td>
       </tr>
       <tr>
        <th>Bus</th>
        <td><?=$r->bus?></td>
       </tr>
       <tr>
        <th>Tgl. Pesan</th>
        <td><?=date('d/m/Y', strtotime($r->tgl_pesan))?></td>
       </tr>
       <tr>
        <th>Tgl. Sewa</th>
        <td><?=date('d/m/Y', strtotime($r->tgl_mulai_sewa)).' s/d '.date('d/m/Y', strtotime($r->tgl_selesai_sewa))?></td>
       </tr>
       <tr>
        <th>Waktu Penjemputan</th>
        <td><?=$r->waktu_pickup?></td>
       </tr>
       <tr>
        <th>Total Bayar</th>
        <td><?=rupiah($r->total_biaya)?></td>
       </tr>
       <tr>
        <th>Kurang Bayar</th>
        <td><?=rupiah($r->total_biaya - $r->dibayarkan)?></td>
       </tr>
       <tr>
        <th>Status Pesanan</th>
        <td class="text-uppercase">
         <?=$r->status?>
        </td>
       </tr>
      </thead>
     </table>
     <a href="<?=url('pesanan')?>" class="btn btn-warning">Kembali</a>
    </div>
   </div>
  </div>
 </div>
</section>
@endsection