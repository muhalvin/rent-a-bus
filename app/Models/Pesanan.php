<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Pesanan extends Model
{
	use HasFactory;
    protected $table = 'pesanan';
    public $timestamps = true;

    public static function get($where = null)
    {
        return DB::table('pesanan AS p')
            ->join('penyewa AS py', 'py.id', '=', 'p.id_penyewa')
            ->join('bus AS b', 'b.id', '=', 'p.id_bus')
            ->leftJoin('users AS u', 'u.id', '=', 'p.created_by')
            ->select('p.*', 'b.bus', 'py.penyewa', 'u.nama',
                DB::raw('(SELECT COALESCE(SUM(jumlah), 0) FROM transaksi AS t WHERE t.id_pesanan = p.id AND t.status = 1) AS dibayarkan')
            )
            ->orderByDesc('p.id') // Menggunakan orderByDesc agar lebih jelas
            ->where($where)
            ->get();

    }

    public static function getAvailable($tgl1, $tgl2)
    {
        $query = "SELECT b.* FROM bus b WHERE b.id NOT IN (
        SELECT p.id_bus FROM pesanan p 
        WHERE ('$tgl1' BETWEEN p.tgl_mulai_sewa AND p.tgl_selesai_sewa
               OR '$tgl2' BETWEEN p.tgl_mulai_sewa AND p.tgl_selesai_sewa
               OR p.tgl_mulai_sewa BETWEEN '$tgl1' AND '$tgl2'
               OR p.tgl_selesai_sewa BETWEEN '$tgl1' AND '$tgl2')
        )";

        $result = DB::select($query);

        return $result;
    }

    public static function getAvailableBus($id, $tgl1, $tgl2)
    {
        $query = "SELECT COUNT(*) as count FROM pesanan 
            WHERE id_bus = $id AND (
                '$tgl1' BETWEEN tgl_mulai_sewa AND tgl_selesai_sewa
                OR '$tgl2' BETWEEN tgl_mulai_sewa AND tgl_selesai_sewa
                OR tgl_mulai_sewa BETWEEN '$tgl1' AND '$tgl2'
                OR tgl_selesai_sewa BETWEEN '$tgl1' AND '$tgl2'
            )";

        $result = DB::select($query);

        return $result[0]->count;
    }


}