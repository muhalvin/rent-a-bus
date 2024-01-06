<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Type extends Model
{
	use HasFactory;
    protected $table = 'tipe';
    public $timestamps = true;
    protected $fillable = [
         'tipe',
    ];

    public static function get($where = null)
    {
        return DB::table('tipe')
                ->where($where)
                ->get();
    }
}