<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use \App\Models\Level as ml;
use \App\Models\Hak_akses as mh;

class LevelController extends Controller
{

	public function __construct()
    {
        $this->middleware('auth');
        $this->_kd = 'level';
    }

	public function index()
    {
    	$data['val'] = ml::all();
        return render($this->_kd, $this->_kd.'.level', 'Level', $data);
    }

    public function create(Request $req)
    {
        if (!empty($req->input())) {
            $val = Validator::make($req->input(),
                    [
                        'level' => 'required|max:50|unique:level',
                    ]);

            if (!$val->fails()) {
                $res = ml::insert([
                    'level' => $req->input('level'),
                    'created_at' => date('Y-m-d H:i:s')
                ]);
                if ($res) {
                     mh::insert([
                                'id_level' => $res->id,
                                'menu_id' => null,
                                'menu_detail_id' => null,
                                'created_at' => date('Y-m-d H:i:s'),
                                'updated_at' => date('Y-m-d H:i:s')
                            ]);

                    notif($req, 'Berhasil menambah data!');
                } else {
                    notif($req, 'Gagal menambah data!');
                }

                return redirect('/level');
            } else {
                notif($req, 'Cek kembali inputan Anda!');
                $val->validate();
            }
        }

        return render($this->_kd, $this->_kd.'.create', 'Manajemen Menu', null, 'c');
    }

    public function update(Request $req, $id)
    {
        $data['val'] = ml::findOrFail(['id'=>$id])[0];
        if (!empty($req->input())) {
            $val = Validator::make($req->input(),
                    [
                        'level' => 'required|max:50',
                    ]);

            if (!$val->fails()) {
                $res = ml::where('id', $id)->update([
                    'level' => $req->input('level'),
                ]);

                if ($res) {
                    if ($req->input('setup')) {
                        mh::firstOrCreate(['id_level'=>$id],
                            [
                                'id_level' => $id,
                                'menu_id' => null,
                                'menu_detail_id' => null,
                                'created_at' => date('Y-m-d H:i:s'),
                                'updated_at' => date('Y-m-d H:i:s')
                            ]);
                    }

                    notif($req, 'Berhasil memperbarui data!');
                } else {
                    notif($req, 'Gagal memperbarui data atau tidak ada data yang berubah!');
                }

                return redirect($this->_kd.'/update/'.$id);
            } else {
                notif($req, 'Cek kembali inputan Anda!');
                $val->validate();
            }
        }

        return render($this->_kd, $this->_kd.'.update', 'Ubah Data', $data, 'e');
    }

    public function destroy(Request $req)
    {
        if (!empty($req->input('id'))) {
            $cek = ml::find($req->input('id'));
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