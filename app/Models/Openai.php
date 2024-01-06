<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Openai extends Model
{
	use HasFactory;
    protected $table = 'openai';
    public $timestamps = true;
    protected $fillable = [
         'openai',
    ];

    public static function get($where = null)
    {
        return DB::table('openai')
                ->where($where)
                ->get();
    }
}