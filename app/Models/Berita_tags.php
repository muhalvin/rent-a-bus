<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita_tags extends Model
{
    use HasFactory;
    protected $table = 'berita_tags';
    protected $primaryKey = null;
    public $incrementing = false;
    
    protected $guarded = [];
}
