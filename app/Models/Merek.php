<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Merek extends Model
{
	use HasFactory;
    protected $table = 'merek';
    public $timestamps = true;
    protected $fillable = [
         'merek',
    ];

    public static function get($where = null)
    {
        return DB::table('merek')
                ->where($where)
                ->get();
    }
}