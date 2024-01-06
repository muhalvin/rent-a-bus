<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Hak_akses as mh;
use App\Models\Level AS ml;
use App\Models\Menu as mm;
use Session;

class Hak_aksesController extends Controller
{

	public function __construct()
    {
        $this->middleware('auth');
        $this->_kd = 'hak_akses';
    }

	public function index()
    {
    	$data['val'] = ml::select('level.*')
                    ->selectRaw('(SELECT IFNULL(COUNT(ha.id),0) FROM hak_akses AS ha WHERE ha.level_id = level.id) AS jumlah')
                    ->get();
        return render($this->_kd, $this->_kd.'.hak_akses', 'Role', $data);
    }

    public function create(Request $req)
    {
        if (!empty($req->input())) {
            $val = Validator::make($req->input(),
                    [
                        'hak_akses' => 'required|size:100',
                    ]);

            if (!$val->fails()) {
                $res = mh::insert([
                    'hak_akses' => $req->input('hak_akses'),
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

        return render($this->_kd, $this->_kd.'.create', 'Manajemen Menu', null, 'c');
    }

    public function update(Request $req, $id)
    {
        $data['val'] = ml::where(['id'=>$id])->firstOrFail();
        if (!empty($req->input())) {
            $val = Validator::make($req->input(),
                    [
                        'menu_id' => 'required'
                    ]);

            if (!$val->fails()) {
                // Hapus semua akses level yang sudah ada pada $id tersebut
                $hak_akses = [];
                foreach ($req->input('menu_id') as $key => $v) {
                    $hak_akses[] = array('level_id' => $id,
                                    'menu_id' => $v,
                                    'tambah' => (in_array($v.'t', $req->input('tambah') ?? []) ? 1 : 0),
                                    'ubah' => (in_array($v.'e', $req->input('edit') ?? []) ? 1 : 0),
                                    'hapus' => (in_array($v.'h', $req->input('hapus') ?? []) ? 1 : 0),
                                    'lihat' => (in_array($v.'l', $req->input('lihat') ?? []) ? 1 : 0));
                }
                
                mh::where('level_id', $id)->delete();
                $res = mh::insert($hak_akses);
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

        $data['parent'] = mm::where('parent_id', NULL)->get();
        $data['child'] = mm::whereNotNull('parent_id')->get();
        $akses = mh::get(['ha.level_id'=>$id]);
        $data['akses'] = [];
        $data['aksesl'] = [];
        $data['aksest'] = [];
        $data['aksese'] = [];
        $data['aksesh'] = [];

        foreach ($akses as $key => $v) {
            $data['akses'][$key] = $v->menu_id;
            $data['aksesl'][$key] = ($v->lihat? $v->menu_id.'l' : null);
            $data['aksest'][$key] = ($v->tambah? $v->menu_id.'t' : null);
            $data['aksese'][$key] = ($v->ubah? $v->menu_id.'e' : null);
            $data['aksesh'][$key] = ($v->hapus? $v->menu_id.'h' : null);
        }
        
        return render($this->_kd, $this->_kd.'.update', 'Ubah Data', $data, 'e');
    }

    public function destroy(Request $req)
    {
        if (!empty($req->input('id'))) {
            $cek = mh::find($req->input('id'));
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