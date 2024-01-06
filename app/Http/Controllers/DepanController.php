<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Bus as mb;
use Illuminate\Support\Facades\Validator;
use App\Models\Penyewa as mp;
use App\Models\Pesanan as mps;
use App\Models\Transaksi as mt;
use App\Models\Api as ma;
use Session;
use DateTime;

class DepanController extends Controller
{

    public function __construct()
    {
    }

    public function index()
    {
        $data['car'] = mb::where('is_aktif', 1)->get();
        return depan('depan.index', '/', 'Beranda', $data);
    }

    public function cars()
    {
        $data['cars'] = mb::where('is_aktif', 1)->paginate(10);
        return depan('depan.cars', '/cars', 'Daftar Bus', $data);
    }

    private function validasi_booking($req)
    {
        return Validator::make(
            $req->input(),
            [
                'lokasi_awal' => 'required',
                'lokasi_tujuan' => 'required',
                'tgl_mulai_sewa' => 'required|date',
                'tgl_selesai_sewa' => 'required|date',
                'waktu_pickup' => 'required'
            ]
        );
    }

    private function busavailable($req, $tgl_mulai_sewa, $tgl_selesai_sewa, $id_bus)
    {
        $cek = mps::getAvailableBus($id_bus, $tgl_mulai_sewa, $tgl_selesai_sewa);
        if ($cek == 0) {
            return true;
        } else {
            return false;
        }
    }

    public function cars_detail(Request $req, $id = null)
    {
        if (!empty($id)) {
            $data['r'] = mb::where(['is_aktif' => 1, 'id' => $id])->first();
            if (!empty($req->input())) {
                $val = $this->validasi_booking($req);
                if (!$val->fails()) {
                    if ($this->busavailable($req, $req->input('tgl_mulai_sewa'), $req->input('tgl_selesai_sewa'), $id)) {
                        $lama_sewa = null;
                        $tgl1 = new DateTime($req->input('tgl_mulai_sewa'));
                        $tgl2 = new DateTime($req->input('tgl_selesai_sewa'));
                        $jarak = $tgl2->diff($tgl1);

                        $lama_sewa = $jarak->d + 1;
                        $harga_sewa = $data['r']->harga_sewa * $lama_sewa;

                        $pesanan = array(
                            'kd_pesanan' => 'PS' . time(),
                            'id_penyewa' => session('guest_id'),
                            'id_bus' => $id,
                            'tgl_pesan' => date('Y-m-d'),
                            'tgl_mulai_sewa' => $req->input('tgl_mulai_sewa'),
                            'tgl_selesai_sewa' => $req->input('tgl_selesai_sewa'),
                            'waktu_pickup' => $req->input('waktu_pickup'),
                            'keterangan' => 'Lama penyewaan ' . $lama_sewa . ' hari. Titik penjemputan di lokasi sekitaran ' . $req->input('lokasi_awal') . ' dan berakhir menuju lokasi ' . $req->input('lokasi_tujuan'),
                            'total_biaya' => $harga_sewa,
                            'status' => 'belum',
                            'created_at' => date('Y-m-d H:i:s'),
                            'created_by' => null,
                            'updated_at' => null,
                            'updated_by' => null
                        );
                        DB::beginTransaction();
                        try {
                            $id_pesanan = mps::insertGetId($pesanan);

                            $kd_transaksi = 'TF' . time();
                            $transaksi = [
                                'kd_transaksi' => $kd_transaksi,
                                'id_pesanan' => $id_pesanan,
                                'tgl_transaksi' => date('Y-m-d'),
                                'jumlah' => $harga_sewa,
                                'metode' => null,
                                'status' => 0,
                                'keterangan' => null,
                                'created_at' => date('Y-m-d'),
                                'created_by' => null,
                                'updated_at' => null,
                                'updated_by' => null,
                            ];
                            mt::insert($transaksi);

                            DB::commit();
                            notif($req, 'Berhasil memproses pesanan, silahkan melakukan pembayaran!');
                            return redirect('transaksiku/detail/' . $kd_transaksi);
                        } catch (\Exception $e) {
                            DB::rollback();
                            notif($req, 'Gagal memproses pesanan, silahkan melakukan pembayaran!');

                            return redirect('cars/detail/' . $id);
                        }
                    } else {
                        notif($req, 'Kendaraan pada tanggal ' . date('d/m/Y', strtotime($req->input('tgl_mulai_sewa'))) . ' s/d ' . date('d/m/Y', strtotime($req->input('tgl_selesai_sewa'))) . ' telah dibooking orang lain!');
                        $val->validate();
                    }
                } else {
                    notif($req, 'Cek kembali inputan Anda!');
                    $val->validate();
                }
            }
            return depan('depan.cars_detail', '/cars_detail', 'Informasi Bus', $data);
        } else {
            return abort(403, 'Access forbidden!');
        }
    }

    private function validasi_signin($req)
    {
        return Validator::make(
            $req->input(),
            [
                'no_hp' => 'required|numeric'
            ]
        );
    }

    public function signin(Request $req)
    {
        if (empty(session('guest_id'))) {
            if (!empty($req->input())) {
                $val = $this->validasi_signin($req);
                if (!$val->fails()) {
                    $cek = mp::where('no_hp', $req->no_hp)->first();
                    if (!empty($cek->id)) {
                        $session = array(
                            'guest_id' => $cek->id,
                            'nama' => $cek->penyewa
                        );
                        Session::put($session);
                        return redirect('/');
                    } else {
                        notif($req, 'Akun tidak ditemukan!');
                    }
                } else {
                    notif($req, 'Cek kembali inputan Anda!');
                    $val->validate();
                }
            }
            return depan('depan.signin', '/signin', 'Login');
        } else {
            return redirect('/');
        }
    }

    private function validasi_signup($req)
    {
        return Validator::make(
            $req->input(),
            [
                'nama' => 'required|max:255',
                'alamat' => 'required',
                'kitas' => 'required',
                'jk' => 'required|in:Laki-Laki,Perempuan',
                'no_hp' => 'required|numeric|unique:penyewa,no_hp'
            ]
        );
    }

    public function signup(Request $req)
    {
        if (empty(session('guest_id'))) {
            if (!empty($req->input())) {
                $val = $this->validasi_signup($req);
                if (!$val->fails()) {
                    $res = mp::insert([
                        'penyewa' => $req->input('nama'),
                        'alamat' => $req->input('alamat'),
                        'kitas' => $req->input('kitas'),
                        'jk' => $req->input('jk'),
                        'no_hp' => $req->input('no_hp'),
                        'created_by' => NULL
                    ]);
                    if ($res) {
                        notif($req, 'Berhasil melakukan registrasi!');
                        return redirect('signin');
                    } else {
                        notif($req, 'Gagal melakukan registrasi!');
                    }
                    return redirect('signup');
                } else {
                    notif($req, 'Cek kembali inputan Anda!');
                    $val->validate();
                }
            }
            return depan('depan.signup', '/signup', 'Registrasi');
        } else {
            return redirect('/');
        }
    }

    public function pesananku(Request $req)
    {
        if (!empty(session('guest_id'))) {
            $data['val'] = mps::get(['p.id_penyewa' => session('guest_id')]);
            return depan('depan.pesananku', '/pesananku', 'Riwayat Pesananku', $data);
        } else {
            return redirect('signin');
        }
    }

    public function pesananku_detail(Request $req, $kode)
    {
        if (!empty(session('guest_id'))) {
            $data['r'] = mps::get(['p.id_penyewa' => session('guest_id'), 'p.kd_pesanan' => $kode]);
            if (!empty($data['r'][0]->id)) {
                $data['r'] = $data['r'][0];
                return depan('depan.pesananku_detail', '/pesananku_detail', 'Detail Pesananku', $data);
            } else {
                return abort(404, 'Not found!');
            }
        } else {
            return redirect('signin');
        }
    }

    public function transaksiku(Request $req)
    {
        if (!empty(session('guest_id'))) {
            $data['val'] = mt::get(['py.id' => session('guest_id')]);
            return depan('depan.transaksiku', '/transaksiku', 'Riwayat Transaksiku', $data);
        } else {
            return redirect('signin');
        }
    }

    public function transaksiku_detail(Request $req, $kode)
    {
        if (!empty(session('guest_id'))) {
            if (!empty($kode)) {
                $data['r'] = mt::get(['t.kd_transaksi' => $kode, 'py.id' => session('guest_id')])[0];
                if (!empty($req->input())) {
                    $resjson = json_decode($req->input('result-json'), true);
                    $order_id = $resjson['order_id'];
                    $va = (!empty($resjson['va_numbers'][0]['va_number']) ? $resjson['va_numbers'][0]['va_number'] : (!empty($resjson['bill_key']) ? $resjson['bill_key'] : null));

                    $biller_code = (!empty($resjson['biller_code']) ? $resjson['biller_code'] : null);

                    $update_transaksi = array(
                        'kd_transaksi' => $order_id,
                        'transaction_id' => $resjson['transaction_id'],
                        'payment_type' => $resjson['payment_type'],
                        'merchant_code' => $va,
                        'biller_code' => $biller_code,
                        'keterangan' => json_encode($resjson),
                        'updated_at' => date('Y-m-d H:i:s'),
                        'updated_by' => null
                    );
                    mt::where('id', $data['r']->id)->update($update_transaksi);
                    return redirect('transaksiku/detail/' . $order_id);
                }
                $data['pesanan'] = mps::get(['p.id' => $data['r']->id_pesanan])[0];
                $data['bus'] = mb::get(['b.id' => $data['pesanan']->id_bus])[0];
                $data['i'] = DB::table('info_sistem')->first();
                $data['midtrans'] = [];
                if ($data['pesanan']->status != 'lunas' || empty($data['r']->transaction_id)) {
                    $data['midtrans'] = $this->paynow($data['r'], $data['pesanan'], $data['bus']);
                }

                return depan('depan.invoice', '/transaksiku_detail', 'Detail Transaksi', $data);
            } else {
                return abort(404, 'Not found!');
            }
        } else {
            return redirect('signin');
        }
    }

    private function paynow($tr, $pesanan, $bus)
    {
        $api = ma::where(['api' => 'midtrans'])->first();
        $api = json_decode($api->value, true);
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = ($api['is_sandbox'] ? $api['server_key_sandbox'] : $api['server_key']);
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = ($api['is_sandbox'] ? 0 : 1);
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $lama_sewa = null;
        $tgl1 = new DateTime($pesanan->tgl_mulai_sewa);
        $tgl2 = new DateTime($pesanan->tgl_selesai_sewa);
        $jarak = $tgl2->diff($tgl1);

        $lama_sewa = $jarak->d + 1;

        $params = array(
            'transaction_details' => [
                'order_id' => $tr->kd_transaksi . rand(),
                'gross_amount' => (int) $tr->jumlah,
            ],
            'item_details' => [
                [
                    'id' => $bus->id,
                    'price' => $tr->jumlah,
                    'quantity' => 1,
                    'name' => 'Sewa bus ' . $bus->bus . ' selama ' . $lama_sewa . ' hari'
                ]
            ]
        );

        $clientKey = ($api['is_sandbox'] ? $api['client_key_sandbox'] : $api['client_key']);
        $snapToken = \Midtrans\Snap::getSnapToken($params);
        return ['snapToken' => $snapToken, 'clientKey' => $clientKey, 'is_sandbox' => $api['is_sandbox']];
    }

    public function check($kode = '')
    {
        if (!empty($kode)) {
            $data['r'] = mt::get(['t.kd_transaksi' => $kode, 'py.id' => session('guest_id')])[0];
            if (!empty($data['r']->id)) {
                $api = ma::where(['api' => 'midtrans'])->first();
                $api = json_decode($api->value, true);
                // Set your Merchant Server Key
                \Midtrans\Config::$serverKey = ($api['is_sandbox'] ? $api['server_key_sandbox'] : $api['server_key']);

                \Midtrans\Config::$isProduction = ($api['is_sandbox'] ? 0 : 1);

                $midtrans = new \Midtrans\Transaction;
                $response = $midtrans->status($data['r']->kd_transaksi);

                $settle = ['settlement', 'capture'];
                if ($data['r']->status != 1 && in_array($response->transaction_status, $settle)) {
                    // Update transaksi jadi 1
                    mt::where('id', $data['r']->id)->update(['status' => 1]);

                    // Cek pesanan
                    $pesanan = mps::get(['p.id' => $data['r']->id_pesanan])[0];
                    $sisa = $pesanan->total_biaya - $pesanan->dibayarkan;
                    if ($sisa <= 0) {
                        // Update jadi lunas pesanannya
                        mps::where('id', $pesanan->id)->update(['status' => 'lunas']);
                    }
                }
                return redirect('transaksiku/detail/' . $kode);
            } else {
                return abort(404, 'Not found!');
            }
        } else {
            return abort(404, 'Not found!');
        }
    }

    public function webhook(Request $req)
    {
    }
}
