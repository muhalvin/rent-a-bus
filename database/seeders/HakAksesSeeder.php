<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\Hak_akses;

class HakAksesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        $akses[] = array('id' => 1,
                        'level_id' => 1,
                        'menu_id' => 1,
                        'tambah' => 1,
                        'ubah' => 1,
                        'hapus' => 1,
                        'lihat' => 1,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => null);
        $akses[] = array('id' => 2,
                        'level_id' => 1,
                        'menu_id' => 2,
                        'tambah' => 1,
                        'ubah' => 1,
                        'hapus' => 1,
                        'lihat' => 1,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => null);

        $akses[] = array('id' => 3,
                        'level_id' => 1,
                        'menu_id' => 3,
                        'tambah' => 0,
                        'ubah' => 0,
                        'hapus' => 0,
                        'lihat' => 0,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => null);

        $akses[] = array('id' => 4,
                        'level_id' => 1,
                        'menu_id' => 4,
                        'tambah' => 0,
                        'ubah' => 0,
                        'hapus' => 0,
                        'lihat' => 0,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => null);

        $akses[] = array('id' => 5,
                        'level_id' => 1,
                        'menu_id' => 5,
                        'tambah' => 1,
                        'ubah' => 1,
                        'hapus' => 1,
                        'lihat' => 1,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => null);

        $akses[] = array('id' => 6,
                        'level_id' => 1,
                        'menu_id' => 6,
                        'tambah' => 1,
                        'ubah' => 1,
                        'hapus' => 1,
                        'lihat' => 1,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => null);

        $akses[] = array('id' => 7,
                        'level_id' => 1,
                        'menu_id' => 7,
                        'tambah' => 1,
                        'ubah' => 1,
                        'hapus' => 1,
                        'lihat' => 1,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => null);

        $akses[] = array('id' => 8,
                        'level_id' => 1,
                        'menu_id' => 8,
                        'tambah' => 1,
                        'ubah' => 1,
                        'hapus' => 1,
                        'lihat' => 1,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => null);

        $akses[] = array('id' => 9,
                        'level_id' => 1,
                        'menu_id' => 9,
                        'tambah' => 1,
                        'ubah' => 1,
                        'hapus' => 1,
                        'lihat' => 1,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => null);

        $akses[] = array('id' => 10,
                        'level_id' => 1,
                        'menu_id' => 10,
                        'tambah' => 0,
                        'ubah' => 1,
                        'hapus' => 0,
                        'lihat' => 1,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => null);

        $akses[] = array('id' => 11,
                        'level_id' => 1,
                        'menu_id' => 11,
                        'tambah' => 1,
                        'ubah' => 1,
                        'hapus' => 1,
                        'lihat' => 1,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => null);

        $akses[] = array('id' => 12,
                        'level_id' => 1,
                        'menu_id' => 12,
                        'tambah' => 1,
                        'ubah' => 1,
                        'hapus' => 1,
                        'lihat' => 1,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => null);

        $akses[] = array('id' => 13,
                        'level_id' => 1,
                        'menu_id' => 13,
                        'tambah' => 1,
                        'ubah' => 1,
                        'hapus' => 1,
                        'lihat' => 1,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => null);

        $akses[] = array('id' => 14,
                        'level_id' => 1,
                        'menu_id' => 14,
                        'tambah' => 1,
                        'ubah' => 1,
                        'hapus' => 1,
                        'lihat' => 1,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => null);

        Hak_akses::insert($akses);
    }
}
