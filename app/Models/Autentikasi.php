<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Autentikasi extends Model
{
    use HasFactory;
    protected $table = 'users';

    public static function get($username, $password)
    {
        return DB::table('users')
                    ->where('email', $username)
                    ->first();
    }
}
