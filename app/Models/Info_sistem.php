<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Info_sistem extends Model
{
    use HasFactory;

    protected $table = 'info_sistem';
    protected $primaryKey = null;
    public $incrementing = false;
    
    protected $guarded = [];
}
