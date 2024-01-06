<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Bus extends Model
{
	use HasFactory;
    protected $table = 'bus';
    public $timestamps = true;
    protected $fillable = [
         'bus',
    ];

    public static function get($where = null)
    {
        return DB::table('bus AS b')->join('merek AS m', 'm.id', '=', 'b.id_merek')
                ->join('tipe AS t', 't.id', '=', 'b.id_tipe')
                ->select('b.*', 't.tipe', 'm.merek')
                ->where($where)
                ->get();
    }

    public static function get_gambar($where = null)
    {
        return DB::table('bus_gambar AS bg')->join('bus AS b', 'b.id', '=', 'bg.id_bus')
                ->select('bg.*', 'b.bus')
                ->where($where)
                ->get();
    }

    public static function add_gambar($data)
    {
        return DB::table('bus_gambar')->insert($data);
    }
}