<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Kategori_berita extends Model
{
	use HasFactory;
    protected $table = 'kategori_berita';
    public $timestamps = false;
    protected $fillable = [
         'kategori_berita',
    ];

    public static function get($where = null)
    {
        return DB::table('kategori_berita')
                ->where($where)
                ->get();
    }
}