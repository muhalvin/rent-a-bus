<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\Users;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Users::insert([
            'nama' => 'Administrator',
            'email' => 'admin@admin.com',
            'email_verified_at' => null,
            'password' => bcrypt('bismillah'),
            'jk' => 'Laki-Laki',
            'alamat' => 'Indonesia',
            'tgl_lahir' => date('Y-m-d'),
            'no_hp' => '628571235873',
            'foto' => null,
            'is_aktif' => 1,
            'id_level' => 1,
            'remember_token' => null,
            'created_at' => date('Y-m-d H:i:s')
        ]);
    }
}
