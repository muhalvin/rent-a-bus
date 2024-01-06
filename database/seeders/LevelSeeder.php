<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\Level;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $level[] = array('level' => 'Super User',
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => null);
        $level[] = array('level' => 'Admin',
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => null);

        Level::insert($level);
    }
}
