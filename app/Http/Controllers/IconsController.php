<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Icons as mi;
use Illuminate\Support\Facades\Validator;

class IconsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->_kd = 'icons';
    }

    public function index()
    {
        $data['val'] = mi::orderBy('id', 'desc')->get();
        return render($this->_kd, $this->_kd.'.icons', 'Icons', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $req)
    {
        if (!empty($req->input())) {
            $val = $this->validasi($req);

            if (!$val->fails()) {
                $res = mi::insert([
                    'icon' => $req->input('icon'),
                ]);
                if ($res) {
                    notif($req, 'Berhasil menambah data!');
                } else {
                    notif($req, 'Gagal menambah data!');
                }

                return redirect($this->_kd);
            } else {
                notif($req, 'Gagal menambah data!');
                $val->validate();
            }
        }

        return render($this->_kd, $this->_kd.'.create', 'Tambah Icon', null, 'c');
    }

    private function validasi($req, $id = null)
    {
        return Validator::make($req->input(),
        [
            'icon' => 'required|max:50'.(empty($id) ? '|unique:icons' : null),
        ]);
    }

    public function update(Request $req, $id)
    {
        $data['val'] = mi::findOrFail(['id'=>$id])[0];
        if (!empty($req->input())) {
            $val = $this->validasi($req, $id);

            if (!$val->fails()) {
                $res = mi::where('id', $id)->update([
                    'icon' => $req->input('icon'),
                ]);

                if ($res) {
                    notif($req, 'Berhasil memperbarui data!');
                } else {
                    notif($req, 'Gagal memperbarui data atau tidak ada data yang berubah!');
                }

                return redirect($this->_kd.'/update/'.$id);
            } else {
                notif($req, 'Gagal menambah data!');
                $val->validate();
            }
        }

        return render($this->_kd, $this->_kd.'.update', 'Ubah Data', $data, 'e');
    }

    public function destroy(Request $req)
    {
        if (!empty($req->input('id'))) {
            $cek = mi::find($req->input('id'));
            if ($cek->delete()) {
                http_response_code(200);
                echo json_encode(['msg'=>'Berhasil menghapus data!']);
            } else {
                http_response_code(500);
                echo json_encode(['msg'=>'Gagal menghapus data!']);
            }
        } else {
            http_response_code(403);
            echo json_encode(['msg'=>'Access forbidden!']);
        }
    }
}
