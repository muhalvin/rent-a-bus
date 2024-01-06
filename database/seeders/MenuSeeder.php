<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\Menu;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menu[] = array('id' => 1,
                        'menu' => 'Dashboard',
                        'lang_text' => 'dashboard',
                        'icon_id' => 2,
                        'is_link' => 1,
                        'link' => 'home',
                        'is_separator' => 0,
                        'separator_text' => NULL,
                        'urutan' => '100',
                        'parent_id' => null);
        $menu[] = array('id' => 2,
                        'menu' => 'Modul Sistem',
                        'lang_text' => 'modul_sistem',
                        'icon_id' => 22,
                        'is_link' => 0,
                        'link' => NULL,
                        'is_separator' => 0,
                        'separator_text' => NULL,
                        'urutan' => '110',
                        'parent_id' => null);
        $menu[] = array('id' => 3,
                        'menu' => 'Manajemen API',
                        'lang_text' => 'manajemen_api',
                        'icon_id' => 144,
                        'is_link' => 0,
                        'link' => NULL,
                        'is_separator' => 0,
                        'separator_text' => NULL,
                        'urutan' => '120',
                        'parent_id' => null);
        $menu[] = array('id' => 4,
                        'menu' => 'Berita',
                        'lang_text' => 'berita',
                        'icon_id' => 78,
                        'is_link' => 0,
                        'link' => NULL,
                        'is_separator' => 0,
                        'separator_text' => NULL,
                        'urutan' => '130',
                        'parent_id' => null);
        $menu[] = array('id' => 5,
                        'menu' => 'Open AI',
                        'lang_text' => 'open_ai',
                        'icon_id' => 6,
                        'is_link' => 1,
                        'link' => 'openai',
                        'is_separator' => 0,
                        'separator_text' => NULL,
                        'urutan' => '121',
                        'parent_id' => null);
        // Area Menu Detail
        $menu[] = array('id' => 6,
                        'menu' => 'Info Sistem',
                        'lang_text' => 'info_sistem',
                        'icon_id' => NULL,
                        'is_link' => 1,
                        'link' => 'info_sistem',
                        'is_separator' => 0,
                        'separator_text' => NULL,
                        'urutan' => '10',
                        'parent_id' => 2);
        $menu[] = array('id' => 7,
                        'menu' => 'Modul Icon',
                        'lang_text' => 'modul_icon',
                        'icon_id' => NULL,
                        'is_link' => 1,
                        'link' => 'icons',
                        'is_separator' => 0,
                        'separator_text' => NULL,
                        'urutan' => '11',
                        'parent_id' => 2);
        $menu[] = array('id' => 8,
                        'menu' => 'Menu',
                        'lang_text' => 'menu',
                        'icon_id' => NULL,
                        'is_link' => 1,
                        'link' => 'menu',
                        'is_separator' => 0,
                        'separator_text' => NULL,
                        'urutan' => '12',
                        'parent_id' => 2);
        $menu[] = array('id' => 9,
                        'menu' => 'Level',
                        'lang_text' => 'level',
                        'icon_id' => NULL,
                        'is_link' => 1,
                        'link' => 'level',
                        'is_separator' => 0,
                        'separator_text' => NULL,
                        'urutan' => '13',
                        'parent_id' => 2);
        $menu[] = array('id' => 10,
                        'menu' => 'Hak Akses',
                        'lang_text' => 'hak_akses',
                        'icon_id' => NULL,
                        'is_link' => 1,
                        'link' => 'hak_akses',
                        'is_separator' => 0,
                        'separator_text' => NULL,
                        'urutan' => '14',
                        'parent_id' => 2);
        $menu[] = array('id' => 11,
                        'menu' => 'User',
                        'lang_text' => 'user',
                        'icon_id' => NULL,
                        'is_link' => 1,
                        'link' => 'users',
                        'is_separator' => 0,
                        'separator_text' => NULL,
                        'urutan' => '15',
                        'parent_id' => 2);
        $menu[] = array('id' => 12,
                        'menu' => 'Setup API',
                        'lang_text' => 'api',
                        'icon_id' => NULL,
                        'is_link' => 1,
                        'link' => 'api',
                        'is_separator' => 0,
                        'separator_text' => NULL,
                        'urutan' => '10',
                        'parent_id' => 3);
        $menu[] = array('id' => 13,
                        'menu' => 'Kategori Berita',
                        'lang_text' => 'kategori_berita',
                        'icon_id' => NULL,
                        'is_link' => 1,
                        'link' => 'kategori_berita',
                        'is_separator' => 0,
                        'separator_text' => NULL,
                        'urutan' => '10',
                        'parent_id' => 4);
        $menu[] = array('id' => 14,
                        'menu' => 'Berita',
                        'lang_text' => 'berita',
                        'icon_id' => NULL,
                        'is_link' => 1,
                        'link' => 'berita',
                        'is_separator' => 0,
                        'separator_text' => NULL,
                        'urutan' => '11',
                        'parent_id' => 4);

        Menu::insert($menu);

    }
}
