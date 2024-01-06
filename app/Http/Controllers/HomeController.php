<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bus as mb;
use App\Models\Type as mtp;
use App\Models\Transaksi as mt;
use App\Models\Penyewa as mpy;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->_kd = 'home';
    }

    public function index(Request $req)
    {
        $data = array('pelanggan' => mpy::count(),
                    'kendaraan' => mb::where('is_aktif', 1)->count(),
                    'tipe' => mtp::count(),
                    'transaksi' => mt::count(),
                    'bayar' => DB::table('transaksi')->limit(10)->orderByDesc('id')->get(),
                    'pesanan' => DB::table('pesanan AS p')->join('bus AS b', 'b.id', '=', 'p.id_bus')->select('p.*', 'b.bus')->limit(10)->orderByDesc('id')->get());
        return render($this->_kd, $this->_kd, 'Beranda', $data);
    }
}
