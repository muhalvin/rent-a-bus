<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\File; // Untuk validasi input file
use Yajra\DataTables\DataTables; // Untuk datatables
use \App\Models\Type as mt;

class TypeController extends Controller
{

	public function __construct()
    {
    	$this->middleware('auth');
        $this->_kd = 'type';
    }

	public function index()
    {
        return render($this->_kd, $this->_kd.'.type', 'Type');
    }

    public function get_ajax(){
      	if (!empty(session('action')) && in_array('c', session('action'))) {
			return DataTables::of(mt::get())
			->addColumn('action', function($val){
			    $act = edit(url($this->_kd), $val->id, 'update', true);
			    $act .= ' '.hapus(url($this->_kd), $val->id, $val->tipe, 'destroy', true);
			    return $act;
			})
			->rawColumns(['action'])->make(true);
	  	} else {
	  		return abort(403, 'Access forbidden!');
	  	}
	}

    private function validasi($req, $id = null)
    {
        return Validator::make($req->input(),
        [
            'tipe' => 'required|max:100',
        ]);
    }

    public function create(Request $req)
    {
        if (!empty($req->input())) {
            $val = $this->validasi($req);

            if (!$val->fails()) {
                $res = mt::insert([
                    'tipe' => $req->input('tipe'),
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

        return render($this->_kd, $this->_kd.'.create', 'Type', null, 'c');
    }

    public function update(Request $req, $id)
    {
        $data['val'] = mt::findOrFail(['id'=>$id])[0];
        if (!empty($req->input())) {
            $val = $this->validasi($req, $id);

            if (!$val->fails()) {
                $res = mt::where('id', $id)->update([
                    'tipe' => $req->input('tipe'),
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
            $cek = mt::find($req->input('id'));
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