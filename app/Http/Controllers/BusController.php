<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\File; // Untuk validasi input file
use Yajra\DataTables\DataTables; // Untuk datatables
use Illuminate\Support\Facades\DB;
use \App\Models\Bus as mb;
use App\Models\Merek as mm;
use App\Models\Type as mt;

class BusController extends Controller
{

	public function __construct()
    {
    	$this->middleware('auth');
        $this->_kd = 'bus';
    }

	public function index()
    {
        return render($this->_kd, $this->_kd.'.bus', 'Bus');
    }

    public function get_ajax(){
      	if (!empty(session('action')) && in_array('c', session('action'))) {
			return DataTables::of(mb::get())
            ->addColumn('is_aktif', function($val){
              return '<span class="badge badge-sm bg-gradient-'.($val->is_aktif?'success':'danger').'">
              '.($val->is_aktif?'Aktif':'Tidak Aktif').'
              </span>';
            })
			->addColumn('action', function($val){
			    $act = edit(url($this->_kd), $val->id, 'update', true);
			    $act .= ' '.hapus(url($this->_kd), $val->id, $val->bus, 'destroy', true);
			    return $act;
			})
			->rawColumns(['action', 'is_aktif'])->make(true);
	  	} else {
	  		return abort(403, 'Access forbidden!');
	  	}
	}

    private function validasi($req, $id = null)
    {
        return Validator::make($req->input(),
        [
            'bus' => 'required|max:100',
            'id_merek' => 'required|numeric',
            'id_tipe' => 'required|numeric',
            'harga_sewa' => 'required|numeric',
            'kapasitas' => 'required|numeric|max:32',
            'tahun_bus' => 'numeric',
            'no_rangka' => 'max:100',
            'no_mesin' => 'max:100',
            'no_plat' => 'max:30',
            'tahun_operasi' => 'numeric',
            'mileage' => 'max:10',
            'transmission' => 'max:20|in:Manual,Otomatis',
            'luggage' => 'required|max:30',
            'fuel' => 'max:20',
            'is_aktif' => 'required|in:1,0'
        ]);
    }

    public function create(Request $req)
    {
        if (!empty($req->input())) {
            $val = $this->validasi($req);

            if (!$val->fails()) {
                $gambar = NULL;
                if (!empty($_FILES['gambar']['name'])) {
                    $f = $req->file('gambar')->store('photo');
                    if ($f) {
                        $gambar = $f;
                    }
                }

                $res = mb::insert([
                    'bus' => $req->input('bus'),
                    'id_merek' => $req->input('id_merek'),
                    'id_tipe' => $req->input('id_tipe'),
                    'harga_sewa' => $req->input('harga_sewa'),
                    'kapasitas' => $req->input('kapasitas'),
                    'tahun_bus' => $req->input('tahun_bus'),
                    'no_rangka' => $req->input('no_rangka'),
                    'no_mesin' => $req->input('no_mesin'),
                    'no_plat' => $req->input('no_plat'),
                    'tahun_operasi' => $req->input('tahun_operasi'),
                    'mileage' => $req->input('mileage'),
                    'transmission' => $req->input('transmission'),
                    'luggage' => $req->input('luggage'),
                    'fuel' => $req->input('fuel'),
                    'fitur' => $req->input('fitur'),
                    'deskripsi' => $req->input('deskripsi'),
                    'is_aktif' => $req->input('is_aktif'),
                    'gambar' => $gambar,
                    'created_by' => session('id')
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

        $data['merek'] = mm::all();
        $data['tipe'] = mt::all();
        return render($this->_kd, $this->_kd.'.create', 'Bus', $data, 'c');
    }

    public function update(Request $req, $id)
    {
        $data['val'] = mb::findOrFail(['id'=>$id])[0];
        if (!empty($req->input())) {
            $val = $this->validasi($req, $id);

            if (!$val->fails()) {
                $gambar = $data['val']->gambar;
                if (!empty($_FILES['gambar']['name'])) {
                    $f = $req->file('gambar')->store('photo');
                    if ($f) {
                        if (!empty($gambar)) {
                            if (file_exists(storage_path('app/public/'.$gambar)) && unlink(storage_path('app/public/'.$gambar))) {
                                
                            }
                        }
                        $gambar = $f;
                    }
                }

                $res = mb::where('id', $id)->update([
                    'bus' => $req->input('bus'),
                    'id_merek' => $req->input('id_merek'),
                    'id_tipe' => $req->input('id_tipe'),
                    'harga_sewa' => $req->input('harga_sewa'),
                    'kapasitas' => $req->input('kapasitas'),
                    'tahun_bus' => $req->input('tahun_bus'),
                    'no_rangka' => $req->input('no_rangka'),
                    'no_mesin' => $req->input('no_mesin'),
                    'no_plat' => $req->input('no_plat'),
                    'tahun_operasi' => $req->input('tahun_operasi'),
                    'mileage' => $req->input('mileage'),
                    'transmission' => $req->input('transmission'),
                    'luggage' => $req->input('luggage'),
                    'fuel' => $req->input('fuel'),
                    'fitur' => $req->input('fitur'),
                    'deskripsi' => $req->input('deskripsi'),
                    'is_aktif' => $req->input('is_aktif'),
                    'gambar' => $gambar,
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

        $data['merek'] = mm::all();
        $data['tipe'] = mt::all();
        $data['gambar'] = mb::get_gambar(['bg.id_bus'=>$id]);
        return render($this->_kd, $this->_kd.'.update', 'Ubah Data', $data, 'e');
    }

    private function validasi_gambar($req)
    {
        return Validator::make($req->input(),
        [
            'id_bus' => 'required|numeric'
        ]);
    }

    public function upload(Request $req)
    {
        if (!empty($req->input())) {
            $val = $this->validasi_gambar($req);

            if (!$val->fails()) {
                $gambar = NULL;
                if (!empty($_FILES['gambar']['name'])) {
                    $f = $req->file('gambar')->store('photo');
                    if ($f) {
                        $gambar = $f;
                    }
                }

                $res = mb::add_gambar([
                    'id_bus' => $req->input('id_bus'),
                    'gambar' => $gambar,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => NULL
                ]);
                if ($res) {
                    notif($req, 'Berhasil menambah data!');
                } else {
                    notif($req, 'Gagal menambah data!');
                }

                return redirect($this->_kd.'/update/'.$req->input('id_bus'));
            } else {
                notif($req, 'Cek kembali inputan Anda!');
                $val->validate();
            }
        }

        $data['merek'] = mm::all();
        $data['tipe'] = mt::all();
        return render($this->_kd, $this->_kd.'.create', 'Bus', $data, 'c');
    }

    public function destroy(Request $req)
    {
        if (!empty($req->input('id'))) {
            $cek = mb::find($req->input('id'));
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

    public function destroy_gambar(Request $req)
    {
        if (!empty($req->input('id'))) {
            $cek = DB::table('bus_gambar')->where('id',$req->input('id'))->first();
            if (!empty($cek->id)) {
                if (!empty($cek->gambar)) {
                    if (file_exists(storage_path('app/public/'.$cek->gambar)) && unlink(storage_path('app/public/'.$cek->gambar))) {
                        
                    }
                }
            }
            if (DB::table('bus_gambar')->where('id', $cek->id)->delete()) {
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