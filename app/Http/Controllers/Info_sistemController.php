<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use \App\Models\Info_sistem as mi;

class Info_sistemController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->_kd = 'info_sistem';
    }

    public function index(Request $req)
    {
        $result = mi::firstOrCreate(
        [
            // No filter
        ],
        [
            'title_header'   => 'CRUD Builder',
            'title_footer'   => 'PT. Digital Media Bangsa',
            'logo'           => null,
            'app_name'       => 'CRUD Builder',
            'deskripsi'      => null,
            'email'          => 'yourmail@mail.com',
            'alamat'         => 'Mojokerto - Indonesia',
            'no_telepon'     => '6285755056530',
            'website_status' => 1,
            'id_bahasa'      => 1
        ]);

        if (!empty($req->input())) {
            $val = Validator::make($req->input(), 
            [
                'title_header' => 'required|max:100',
                'title_footer' => 'required|max:100',
                'app_name'     => 'required|max:100',
                'email'        => 'email|max:100',
                'no_telepon'   => 'max:15',
                'website_status' => 'in:1,0'
            ]);

            if (!$val->fails()) {
                $res = mi::where([])->update(['title_header' => $req->input('title_header'),
                            'title_footer' => $req->input('title_footer'),
                            'app_name' => $req->input('app_name'),
                            'deskripsi' => $req->input('deskripsi'),
                            'email' => $req->input('email'),
                            'alamat' => $req->input('alamat'),
                            'no_telepon' => $req->input('no_telepon'),
                            'website_status' => $req->input('website_status')]);
                if ($res) {
                    notif($req, 'Berhasil memperbarui data!');
                } else {
                    notif($req, 'Gagal memperbarui data!');
                }

                return redirect($this->_kd);
            } else {
                notif($req, 'Cek kembali inputan Anda!');
                $val->validate();
            }
        }


        $data = array('title' => 'Info Sistem',
                    'url' => 'info_sistem',
                    'val' => $result);
        return render($this->_kd, $this->_kd, 'Info Sistem', $data, 'e');
    }
}
