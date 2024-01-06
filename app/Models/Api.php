<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Api extends Model
{
	use HasFactory;
    protected $table = 'api';
    public $timestamps = false;

    public static function get($where = null)
    {
        return DB::table('api')
                ->where($where)
                ->get();
    }
}