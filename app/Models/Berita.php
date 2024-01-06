<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Berita extends Model
{
	use HasFactory;
    protected $table = 'berita';
    public $timestamps = true;
    protected $fillable = [
         'berita',
    ];

    public static function get($where = null)
    {
        return DB::table('berita as b')
                ->join('kategori_berita as kb', 'kb.id', '=' ,'b.kategori_berita_id')
                ->where($where)
                ->select('b.*', 'kb.kategori_berita', 'kb.slug')
                ->get();
    }
}