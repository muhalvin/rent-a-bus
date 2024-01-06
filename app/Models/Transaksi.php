<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Transaksi extends Model
{
	use HasFactory;
    protected $table = 'transaksi';
    public $timestamps = true;
    protected $fillable = [
         'transaksi',
    ];

    public static function get($where = null)
    {
        return DB::table('transaksi AS t')
                ->join('pesanan AS p', 'p.id', '=', 't.id_pesanan')
                ->join('bus AS b', 'b.id', '=', 'p.id_bus')
                ->join('penyewa AS py', 'py.id', '=', 'p.id_penyewa')
                ->select('t.*', 'p.kd_pesanan', 'p.tgl_mulai_sewa', 'p.tgl_selesai_sewa', 'py.penyewa', 'py.jk', 'py.alamat', 'py.no_hp')
                ->orderByDesc('t.id')
                ->where($where)
                ->get();
    }
}