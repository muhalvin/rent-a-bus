<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Hak_akses extends Model
{
	use HasFactory;
    protected $table = 'hak_akses';

    protected $fillable = [
         'id_level',
     ];
	
    public static function get($where = null)
    {
        return DB::table('hak_akses as ha')
                ->join('level as l', 'l.id', '=', 'ha.level_id')
                ->where($where)
                ->select('ha.*', 'l.level')
                ->get();
    }
}
