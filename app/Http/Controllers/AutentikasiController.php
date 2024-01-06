<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Autentikasi as ma;
use \App\Models\Info_sistem as mi;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Session;

class AutentikasiController extends Controller
{

    public function login(Request $req)
    {
        if (Session::has('id')) {
            return redirect('home');
        } else {
            if (!empty($req->input())) {
                $val = Validator::make($req->input(),
                    [
                        'email' => 'required|email',
                        'password' => 'required'
                    ]);
                if (!$val->fails()) {
                    $auth = ['email'=>$req['email'], 'password'=>$req['password']];
                    if (Auth::attempt($auth)) {
                        $cek = Auth::user();
                        if ($cek->is_aktif) {
                            $session = array('id' => $cek->id,
                                'nama' => $cek->nama,
                                'id_level' => $cek->id_level,
                                'foto' => $cek->foto);
                            Session::put($session);

                            return redirect()->intended('home');
                        } else {
                            notif($req, 'Akun Anda telah dinonaktifkan, silahkan hubungi CS!');
                        }
                    } else {
                        notif($req, 'Username tidak ditemukan!');
                    }
                } else {
                    notif($req, 'Cek kembali inputan Anda!');
                    $val->validate();
                }
            }

            $data = array('title' => 'Halaman Login',
                'xis' => mi::first());
            return view('login', $data);
        }
    }

    public function logout()
    {
        session()->flush();
        return redirect('login');
    }
}
