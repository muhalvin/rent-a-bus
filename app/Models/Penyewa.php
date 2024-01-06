<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Penyewa extends Model
{
	use HasFactory;
    protected $table = 'penyewa';
    public $timestamps = true;
    protected $fillable = [
         'penyewa',
    ];

    public static function get($where = null)
    {
        return DB::table('penyewa')
                ->where($where)
                ->get();
    }
}