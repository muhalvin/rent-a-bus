<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Invoice <?= $r->kd_transaksi ?></title>
</head>

<body>
    <link rel="stylesheet" href="<?= url('assets/depan/magazine/css/bootstrap.css') ?>">
    <link href="<?= url('assets/depan/assets/css/animate.min.css') ?>" />
    <script src="{{ url('assets/depan') }}/js/jquery.min.js"></script>
    <script src="<?= url('assets/depan/magazine/js/vendor/bootstrap.min.js') ?>"></script>

    <style type="text/css">
        #invoice {
            padding: 30px;
        }

        .invoice {
            position: relative;
            background-color: #FFF;
            min-height: 680px;
            padding: 15px
        }

        .invoice header {
            padding: 10px 0;
            margin-bottom: 20px;
            border-bottom: 1px solid #3989c6
        }

        .invoice .company-details {
            text-align: right
        }

        .invoice .company-details .name {
            margin-top: 0;
            margin-bottom: 0
        }

        .invoice .contacts {
            margin-bottom: 20px
        }

        .invoice .invoice-to {
            text-align: left
        }

        .invoice .invoice-to .to {
            margin-top: 0;
            margin-bottom: 0
        }

        .invoice .invoice-details {
            text-align: right
        }

        .invoice .invoice-details .invoice-id {
            margin-top: 0;
            color: #3989c6
        }

        .invoice main {
            padding-bottom: 50px
        }

        .invoice main .thanks {
            margin-top: -100px;
            font-size: 2em;
            margin-bottom: 50px
        }

        .invoice main .notices {
            padding-left: 6px;
            border-left: 6px solid #3989c6
        }

        .invoice main .notices .notice {
            font-size: 1.2em
        }

        .invoice table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            margin-bottom: 20px
        }

        .invoice table td,
        .invoice table th {
            padding: 15px;
            background: #eee;
            border-bottom: 1px solid #fff
        }

        .invoice table th {
            white-space: nowrap;
            font-weight: 400;
            font-size: 16px
        }

        .invoice table td h3 {
            margin: 0;
            font-weight: 400;
            color: #3989c6;
            font-size: 1.2em
        }

        .invoice table .qty,
        .invoice table .total,
        .invoice table .unit {
            text-align: right;
            font-size: 1.2em
        }

        .invoice table .no {
            color: #fff;
            font-size: 1.6em;
            background: #3989c6
        }

        .invoice table .unit {
            background: #ddd
        }

        .invoice table .total {
            background: #3989c6;
            color: #fff
        }

        .invoice table tbody tr:last-child td {
            border: none
        }

        .invoice table tfoot td {
            background: 0 0;
            border-bottom: none;
            white-space: nowrap;
            text-align: right;
            padding: 10px 20px;
            font-size: 1.2em;
            border-top: 1px solid #aaa
        }

        .invoice table tfoot tr:first-child td {
            border-top: none
        }

        .invoice table tfoot tr:last-child td {
            color: #3989c6;
            font-size: 1.4em;
            border-top: 1px solid #3989c6
        }

        .invoice table tfoot tr td:first-child {
            border: none
        }

        .invoice footer {
            width: 100%;
            text-align: center;
            color: #777;
            border-top: 1px solid #aaa;
            padding: 8px 0
        }

        @media print {
            .invoice {
                font-size: 11px !important;
                overflow: hidden !important
            }

            .invoice footer {
                position: absolute;
                bottom: 10px;
                page-break-after: always
            }

            .invoice>div:last-child {
                page-break-before: always
            }
        }
    </style>

    <div class="site-main-container">
        <!-- Start contact-page Area -->
        <section class="contact-page-area pt-50 pb-120">
            <div class="container">
                <div class="row contact-wrap">

                    <div class="col-lg-12 d-flex flex-column address-wrap">
                        <div id="invoice">

                            <div class="toolbar hidden-print">
                                <div class="text-right">
                                    <a href="<?= url('transaksiku') ?>" class="btn btn-warning"><i class="fa fa-angle-double-left"></i> Kembali</a>
                                </div>
                                <hr>
                            </div>
                            <div class="invoice overflow-auto">
                                <div style="min-width: 600px">
                                    <header>
                                        <div class="row">
                                            <div class="col">
                                                <a target="_blank" href="<?= url('/') ?>"></a>
                                            </div>
                                            <div class="col company-details">
                                                <h2 class="name">
                                                    <a target="_blank" href="<?= url('/') ?>">
                                                        <?= $i->title_header ?>
                                                    </a>
                                                </h2>
                                                <div><?= $i->alamat ?></div>
                                                <div><?= $i->no_telepon ?></div>
                                                <div><?= $i->email ?></div>
                                            </div>
                                        </div>
                                    </header>
                                    <main>
                                        <div class="row contacts">
                                            <div class="col invoice-to">
                                                <div class="text-gray-light">Kepada:</div>
                                                <h2 class="to"><?= $r->penyewa ?></h2>
                                                <div class="address"><?= $r->alamat ?></div>
                                            </div>
                                            <div class="col invoice-to">
                                                <div class="text-gray-light">Metode Pembayaran: <?= $r->payment_type ?></div>
                                            </div>
                                            <div class="col invoice-to">
                                                <div class="text-gray-light">Kode Pembayaran: <b><?= $r->merchant_code ?></b></div>
                                            </div>
                                            <?php if (!empty($r->biller_code)): ?>
                                            <div class="col invoice-to">
                                                <div class="text-gray-light">Kode Penagihan: <b><?= $r->biller_code ?></b></div>
                                            </div>
                                            <?php endif ?>
                                            <div class="col invoice-details">
                                                <h1 class="invoice-id" style="font-size: 20px;">INVOICE : <?= $r->kd_transaksi ?></h1>
                                                <div class="date">Tgl Invoice: <?= date('d/m/Y H:i:s', strtotime($r->created_at)) ?></div>
                                                <div class="date">Status Pembayaran: <?= $r->status == 0 ? 'Belum Lunas' : ($r->status == 1 ? 'Lunas' : 'Gagal') ?></div>
                                            </div>
                                        </div>
                                        <table border="0" cellspacing="0" cellpadding="0">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th class="text-left">DESKRIPSI</th>
                                                    <th class="text-right">HARGA</th>
                                                    <th class="text-right">JUMLAH</th>
                                                    <th class="text-right">TOTAL</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="no">#</td>
                                                    <td class="text-left">
                                                        <?= 'Sewa: <b>' . $bus->bus . '</b><br>' . $pesanan->keterangan ?>
                                                    </td>
                                                    <td class="unit"><?= rupiah($r->jumlah) ?></td>
                                                    <td class="qty">1</td>
                                                    <td class="total"><?= rupiah($r->jumlah) ?></td>
                                                </tr>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="2"></td>
                                                    <td colspan="2">TOTAL</td>
                                                    <td><?= rupiah($r->jumlah) ?></td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                        <div class="thanks" style="margin-top: 30px;">Terima Kasih!</div>
                                        <div class="notices">
                                            <div>NOTICE:</div>
                                            <div class="notice">
                                                <?php if ($r->status == 1): ?>
                                                Pembayaran Anda telah tervalidasi.
                                                <?php else: ?>
                                                Segera lunasi tagihan kamu.<br>
                                                <form action="" method="post" id="form-byr">
                                                    @csrf
                                                    <input type="hidden" name="result-json" id="result-json" readonly>
                                                    <button type="button" id="btnByr" class="btn btn-primary">Bayar Sekarang!</button>
                                                </form>
                                                <?php endif ?>
                                            </div>
                                            <div class="notice">
                                                <?php if (!empty($r->transaction_id) && $r->status != 1): ?>
                                                <button class="btn btn-warning">
                                                    <a href="<?= url('transaksiku/check/' . $r->kd_transaksi) ?>" style="text-decoration: none; color: #000;">
                                                        Check
                                                    </a>
                                                </button>
                                                <?php endif ?>
                                            </div>
                                        </div>
                                    </main>
                                    <footer>
                                        Invoice was created on a computer and is valid without the signature and seal.
                                    </footer>
                                </div>
                                <!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
                                <div></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <?php if ($pesanan->status != 'lunas'): ?>
    <script src="https://app.<?= $midtrans['is_sandbox'] ? 'sandbox.' : '' ?>midtrans.com/snap/snap.js" data-client-key="<?= $midtrans['clientKey'] ?>"></script>

    <script type="text/javascript">
        document.getElementById('btnByr').onclick = function() {
            // SnapToken acquired from previous step
            snap.pay('<?= $midtrans['snapToken'] ?>', {
                // Optional
                onSuccess: function(result) {
                    $('#result-json').val(JSON.stringify(result, null, 2));
                    $('#form-byr').submit();
                },
                // Optional
                onPending: function(result) {
                    $('#result-json').val(JSON.stringify(result, null, 2));
                    $('#form-byr').submit();
                },
                // Optional
                onError: function(result) {
                    $('#result-json').val(JSON.stringify(result, null, 2));
                    $('#form-byr').submit();
                }
            });
        };
    </script>
    <?php endif ?>

</body>

</html>
