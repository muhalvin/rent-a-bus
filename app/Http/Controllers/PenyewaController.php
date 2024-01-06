<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\File; // Untuk validasi input file
use Yajra\DataTables\DataTables; // Untuk datatables
use \App\Models\Penyewa as mp;

class PenyewaController extends Controller
{

	public function __construct()
    {
    	$this->middleware('auth');
        $this->_kd = 'penyewa';
    }

	public function index()
    {
        return render($this->_kd, $this->_kd.'.penyewa', 'Penyewa');
    }

    public function get_ajax(){
      	if (!empty(session('action')) && in_array('c', session('action'))) {
			return DataTables::of(mp::get())
			->addColumn('action', function($val){
			    $act = edit(url($this->_kd), $val->id, 'update', true);
			    $act .= ' '.hapus(url($this->_kd), $val->id, $val->penyewa, 'destroy', true);
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
            'penyewa' => 'required|max:100',
            'kitas' => 'required'.(empty($id) ? '|unique:penyewa,kitas' : null),
            'jk' => 'required|in:Laki-Laki,Perempuan',
            'alamat' => 'required',
            'no_hp' => 'required|numeric'
        ]);
    }

    public function create(Request $req)
    {
        if (!empty($req->input())) {
            $val = $this->validasi($req);

            if (!$val->fails()) {
                $res = mp::insert([
                    'penyewa' => $req->input('penyewa'),
                    'alamat' => $req->input('alamat'),
                    'kitas' => $req->input('kitas'),
                    'jk' => $req->input('jk'),
                    'no_hp' => $req->input('no_hp'),
                    'created_at' => date('Y-m-d H:i:s'),
                    'created_by' => session('id'),
                    'updated_at' => null,
                    'updated_by' => null
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

        return render($this->_kd, $this->_kd.'.create', 'Penyewa', null, 'c');
    }

    public function update(Request $req, $id)
    {
        $data['val'] = mp::findOrFail(['id'=>$id])[0];
        if (!empty($req->input())) {
            $val = $this->validasi($req, $id);

            if (!$val->fails()) {
                $res = mp::where('id', $id)->update([
                    'penyewa' => $req->input('penyewa'),
                    'alamat' => $req->input('alamat'),
                    'kitas' => $req->input('kitas'),
                    'jk' => $req->input('jk'),
                    'no_hp' => $req->input('no_hp'),
                    'updated_at' => date('Y-m-d H:i:s'),
                    'updated_by' => session('id')
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
            $cek = mp::find($req->input('id'));
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