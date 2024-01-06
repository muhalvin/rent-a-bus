<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use \App\Models\Api as ma;

class ApiController extends Controller
{

	public function __construct()
    {
        $this->middleware('auth');
        $this->_kd = 'api';
    }

	public function index()
    {
    	$data['val'] = ma::get();
        return render($this->_kd, $this->_kd.'.api', 'Api', $data);
    }

    private function validasi($req, $id = null)
    {
        return Validator::make($req->input(),
        [
            'api' => 'required|max:100',
            'key' => 'required',
            'value' => 'required'
        ]);
    }

    public function create(Request $req)
    {
        if (!empty($req->input())) {
            $val = $this->validasi($req);

            if (!$val->fails()) {
                $value = [];
                for ($i=0; $i < count($req->input('value')); $i++) { 
                    $value += array($req->input('key')[$i] => $req->input('value')[$i]);
                }

                $res = ma::insert([
                    'api' => $req->input('api'),
                    'value' => json_encode($value),
                    'created_at' => date('Y-m-d H:i:s')
                ]);
                if ($res) {
                    notif($req, 'Berhasil menambah data!');
                } else {
                    notif($req, 'Gagal menambah data!');
                }

                return redirect($this->_kd);
            } else {
                notif($req, 'Cek kembali inputan Anda!');
                $val->validate();
            }
        }

        return render($this->_kd, $this->_kd.'.create', 'Manajemen API', null, 'c');
    }

    public function update(Request $req, $id)
    {
        $data['val'] = ma::findOrFail(['id'=>$id])[0];
        if (!empty($req->input())) {
            $val = $this->validasi($req, $id);

            if (!$val->fails()) {
                $value = [];
                for ($i=0; $i < count($req->input('value')); $i++) { 
                    $value += array($req->input('key')[$i] => $req->input('value')[$i]);
                }
                
                $res = ma::where('id', $id)->update([
                    'api' => $req->input('api'),
                    'value' => json_encode($value),
                    'updated_at' => date('Y-m-d H:i:s')
                ]);

                if ($res) {
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
            $cek = ma::find($req->input('id'));
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