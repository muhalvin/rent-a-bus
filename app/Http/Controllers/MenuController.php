<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Menu as mm;
use \App\Models\Icons as mi;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Helper\Engine;

class MenuController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->_kd = 'menu';
    }

    public function index()
    {
        $data['val'] = mm::where('parent_id', NULL)->get();
        $data['detail'] = mm::join('menu AS parent', 'parent.id', '=', 'menu.parent_id')
                    ->whereNotNull('menu.parent_id')
                    ->select('menu.*', 'parent.menu AS parent_menu')
                    ->get();
        return render($this->_kd, $this->_kd.'.menu', 'Menu', $data);
    }

    public function create(Request $req)
    {
        if (!empty($req->input())) {
            $val = Validator::make($req->input(),
                    [
                        'menu' => 'required|max:100',
                        'icon_id' => 'required|numeric',
                        'is_link' => 'required|in:0,1',
                        'link' => 'max:255',
                        'is_separator' => 'required|in:0,1',
                        'separator_text' => 'max:30',
                        'urutan' => 'required|numeric'
                    ]);

            if (!$val->fails()) {
                $res = mm::insert([
                    'menu' => $req->input('menu'),
                    'lang_text' => Str::slug($req->input('menu'), '_'),
                    'icon_id' => $req->input('icon_id'),
                    'is_link' => $req->input('is_link'),
                    'link' => ($req->input('is_link') ? $req->input('link') : null),
                    'is_separator' => $req->input('is_separator'),
                    'separator_text' => $req->input('separator'),
                    'urutan' => $req->input('urutan'),
                    'parent_id' => null
                ]);

                if ($res) {
                    if ($req->input('is_link')) {
                        $cek = explode('/', $req->input('link'));
                        $folder = (count($cek) > 1 ? strtolower($cek[0]) : null);
                        $file = (count($cek) > 1 ? strtolower($cek[1]) : strtolower($cek[0]));

                        new Engine($folder, $file);
                    }
                    notif($req, 'Berhasil menambah data!');
                } else {
                    notif($req, 'Gagal menambah data!');
                }

                return redirect('/menu');
            } else {
                notif($req, 'Gagal menambah data!');
                $val->validate();
            }
        }

        $data['icon'] = mi::all();
        return render($this->_kd, $this->_kd.'.create', 'Manajemen Menu', $data, 'c');
    }

    public function update(Request $req, $id)
    {
        $data['val'] = mm::findOrFail(['id'=>$id])[0];
        if (!empty($req->input())) {
            $val = Validator::make($req->input(),
                    [
                        'menu' => 'required|max:100',
                        'icon_id' => 'required|numeric',
                        'is_link' => 'required|in:0,1',
                        'link' => 'max:255',
                        'is_separator' => 'required|in:0,1',
                        'separator_text' => 'max:30',
                        'urutan' => 'required|numeric'
                    ]);

            if (!$val->fails()) {
                $res = mm::where('id', $id)->update([
                    'menu' => $req->input('menu'),
                    'lang_text' => Str::slug($req->input('menu'), '_'),
                    'icon_id' => $req->input('icon_id'),
                    'is_link' => $req->input('is_link'),
                    'link' => ($req->input('is_link') ? $req->input('link') : null),
                    'is_separator' => $req->input('is_separator'),
                    'separator_text' => $req->input('separator'),
                    'urutan' => $req->input('urutan'),
                    'parent_id' => null
                ]);

                if ($req->input('create_crud') && $req->input('is_link')) {
                    $cek = explode('/', $req->input('link'));
                    $folder = (count($cek) > 1 ? strtolower($cek[0]) : null);
                    $file = (count($cek) > 1 ? strtolower($cek[1]) : strtolower($cek[0]));

                    new Engine($folder, $file);
                }

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

        $data['icon'] = mi::all();
        return render($this->_kd, $this->_kd.'.update', 'Ubah Data', $data, 'e');
    }

    public function destroy(Request $req)
    {
        if (!empty($req->input('id'))) {
            $cek = mm::find($req->input('id'));
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

    // Chile Menu
    public function create_detail(Request $req)
    {
        if (!empty($req->input())) {
            $val = Validator::make($req->input(),
                    [
                        'menu' => 'required|max:100',
                        'parent_id' => 'required|numeric',
                        'link' => 'required',
                        'urutan' => 'required|numeric'
                    ]);

            if (!$val->fails()) {
                $res = mm::insert([
                    'menu' => $req->input('menu'),
                    'lang_text' => Str::slug($req->input('menu'), '_'),
                    'icon_id' => null,
                    'is_link' => 1,
                    'link' => $req->input('link'),
                    'is_separator' => 0,
                    'separator_text' => null,
                    'urutan' => $req->input('urutan'),
                    'parent_id' => $req->input('parent_id')
                ]);

                if ($res) {
                    $cek = explode('/', $req->input('link'));
                    $folder = (count($cek) > 1 ? strtolower($cek[0]) : null);
                    $file = (count($cek) > 1 ? strtolower($cek[1]) : strtolower($cek[0]));

                    new Engine($folder, $file);
                    notif($req, 'Berhasil menambah data!');
                } else {
                    notif($req, 'Gagal menambah data!');
                }

                return redirect('/menu');
            } else {
                notif($req, 'Gagal menambah data!');
                $val->validate();
            }
        }

        $data['menu'] = mm::where('is_link', 0)->get();
        return render($this->_kd, $this->_kd.'.create_detail', 'Manajemen Menu', $data);
    }

    public function update_detail(Request $req, $id)
    {
        $data['val'] = mm::findOrFail(['id'=>$id])[0];
        if (!empty($req->input())) {
            $val = Validator::make($req->input(),
                    [
                        'menu' => 'required|max:100',
                        'parent_id' => 'required|numeric',
                        'link' => 'required',
                        'urutan' => 'required|numeric'
                    ]);

            if (!$val->fails()) {
                $res = mm::where('id', $id)->update([
                    'menu' => $req->input('menu'),
                    'lang_text' => Str::slug($req->input('menu'), '_'),
                    'icon_id' => null,
                    'is_link' => 1,
                    'link' => $req->input('link'),
                    'is_separator' => 0,
                    'separator_text' => null,
                    'urutan' => $req->input('urutan'),
                    'parent_id' => $req->input('parent_id')
                ]);

                if ($req->input('create_crud')) {
                    $cek = explode('/', $req->input('link'));
                    $folder = (count($cek) > 1 ? strtolower($cek[0]) : null);
                    $file = (count($cek) > 1 ? strtolower($cek[1]) : strtolower($cek[0]));

                    new Engine($folder, $file);
                }

                if ($res) {
                    notif($req, 'Berhasil memperbarui data!');
                } else {
                    notif($req, 'Gagal memperbarui data atau tidak ada data yang berubah!');
                }

                return redirect($this->_kd.'/update_detail/'.$id);
            } else {
                notif($req, 'Gagal menambah data!');
                $val->validate();
            }
        }

        $data['menu'] = mm::where('is_link', 0)->get();
        return render($this->_kd, $this->_kd.'.update_detail', 'Ubah Data', $data);
    }

    public function destroy_detail(Request $req)
    {
        if (!empty($req->input('id'))) {
            $cek = mm::find($req->input('id'));
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
