<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\File;
use \App\Models\Users as mu;
use Session;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->_kd = 'profile';
    }

    public function index(Request $req)
    {
        $data['val'] = mu::where('id', Session::get('id'))->first();
        if (!empty($req->input())) {
            $val = Validator::make($req->input(),
                    [
                        'nama' => 'required|max:255',
                        'jk' => 'required|in:Laki-Laki,Perempuan|max:10',
                        'alamat' => 'max:200',
                        'tgl_lahir' => 'size:10',
                        'no_hp' => 'max:15|min:9',
                        'foto' => [
                            'nullable',
                            File::types(['jpg', 'jpeg', 'png', 'gif', 'webp'])
                            ->max(2048)
                        ],
                    ]);

            if (!$val->fails()) {
                $password = (!empty($req->input('password')) ? bcrypt($req->input('password')) : $data['val']->password);
                $foto = $data['val']->foto;
                if (!empty($_FILES['foto']['name'])) {
                    $f = $req->file('foto')->store('photo');
                    if ($f) {
                        if (!empty($foto)) {
                            if (file_exists(storage_path('app/public/'.$foto)) && unlink(storage_path('app/public/'.$foto))) {
                                
                            }
                        }
                        $foto = $f;
                    }
                }

                $res = mu::where(['id'=>Session::get('id')])
                ->update([
                    'nama' => $req->input('nama'),
                    'password' => $password,
                    'jk' => $req->input('jk'),
                    'alamat' => $req->input('alamat'),
                    'tgl_lahir' => $req->input('tgl_lahir'),
                    'no_hp' => $req->input('no_hp'),
                    'foto' => $foto,
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
                if ($res) {
                    Session::put(['nama'=>$req->input('nama'), 'foto'=>$foto]);

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
        
        return render($this->_kd, $this->_kd.'.profile', 'Profile', $data);
    }
}
