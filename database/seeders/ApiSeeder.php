<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\Api;

class ApiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $api[] = array('id' => 1,
                        'api' => 'Duitku',
                        'value' => json_encode([
                            'api_key' => 'your_api_key',
                            'merchant_code' => 'your_merchant_code',
                            'sandbox' => 1,
                            'durasi_payment' => 1440,
                            'tipe_durasi' => 'minutes',
                            'url_notification' => url('webhook/duitku')
                        ]));

        $api[] = array('id' => 2,
                        'api' => 'OpenAI',
                        'value' => json_encode([
                            'api_key' => 'your_api_key',
                            'max_tokens' => 500
                        ]));

        Api::insert($api);
    }
}
