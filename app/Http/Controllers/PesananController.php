<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\File; // Untuk validasi input file
use Yajra\DataTables\DataTables; // Untuk datatables
use App\Models\Pesanan as mp;
use App\Models\Penyewa as mpy;
use App\Models\Bus as mb;

class PesananController extends Controller
{

	public function __construct()
    {
    	$this->middleware('auth');
        $this->_kd = 'pesanan';
    }

	public function index()
    {
        return render($this->_kd, $this->_kd.'.pesanan', 'Pesanan');
    }

    public function get_ajax(){
      	if (!empty(session('action')) && in_array('c', session('action'))) {
			return DataTables::of(mp::get())
            ->addColumn('waktu_sewa', function($val){
                return date('d/m/Y', strtotime($val->tgl_mulai_sewa)).' s/d '.date('d/m/Y', strtotime($val->tgl_selesai_sewa)).'<br>Penjemputan pukul: <b>'.$val->waktu_pickup.'</b>';
            })
            ->addColumn('total_biaya', function($val){
                return rupiah($val->total_biaya);
            })
            ->addColumn('dibayarkan', function($val){
                return rupiah($val->dibayarkan);
            })
			->addColumn('action', function($val){
			    $act = edit(url($this->_kd), $val->id, 'update', true);
			    $act .= ' '.hapus(url($this->_kd), $val->id, $val->kd_pesanan, 'destroy', true);
			    return $act;
			})
			->rawColumns(['waktu_sewa','action'])->make(true);
	  	} else {
	  		return abort(403, 'Access forbidden!');
	  	}
	}

    public function get_available(Request $req)
    {
        $result = ['msg'=>'bad request!'];
        if (!empty($req->input('tgl1')) && !empty($req->input('tgl2'))) {
            $result = mp::getAvailable($req->input('tgl1'), $req->input('tgl2'));

            http_response_code(200);
        } else {
            http_response_code(400);
        }

        echo json_encode($result);
    }

    private function validasi($req, $id = null)
    {
        return Validator::make($req->input(),
        [
            'id_bus' => 'required|numeric',
            'id_penyewa' => 'required|numeric',
            'tgl_mulai_sewa' => 'required|date',
            'tgl_selesai_sewa' => 'required|date',
            'waktu_pickup' => 'required',
            'keterangan' => 'required',
            'total_biaya' => 'required|numeric|min:0',
            'status' => 'required|in:belum,dp,lunas'
        ]);
    }

    public function create(Request $req)
    {
        if (!empty($req->input())) {
            $val = $this->validasi($req);

            if (!$val->fails()) {
                $res = mp::insertGetId([
                    'id_penyewa' => $req->input('id_penyewa'),
                    'kd_pesanan' => 'PS'.time(),
                    'id_bus' => $req->input('id_bus'),
                    'tgl_pesan' => date('Y-m-d'),
                    'tgl_mulai_sewa' => $req->input('tgl_mulai_sewa'),
                    'tgl_selesai_sewa' => $req->input('tgl_selesai_sewa'),
                    'waktu_pickup' => $req->input('waktu_pickup'),
                    'keterangan' => $req->input('keterangan'),
                    'total_biaya' => $req->input('total_biaya'),
                    'status' => $req->input('status'),
                    'created_at' => date('Y-m-d H:i:s'),
                    'created_by' => session('id'),
                    'updated_at' => null,
                    'updated_by' => null
                ]);
                if ($res) {
                    notif($req, 'Berhasil menambah data!');

                    return redirect('transaksi/add?pesanan_id='.$res);
                } else {
                    notif($req, 'Gagal menambah data!');
                }

                return redirect($this->_kd);
            } else {
                notif($req, 'Cek kembali inputan Anda!');
                $val->validate();
            }
        }

        $data['penyewa'] = mpy::get();
        return render($this->_kd, $this->_kd.'.create', 'Pesanan', $data, 'c');
    }

    public function update(Request $req, $id)
    {
        $data['val'] = mp::findOrFail(['id'=>$id])[0];
        if (!empty($req->input())) {
            $val = $this->validasi($req, $id);

            if (!$val->fails()) {
                $res = mp::where('id', $id)->update([
                    'id_penyewa' => $req->input('id_penyewa'),
                    'id_bus' => $req->input('id_bus'),
                    'tgl_pesan' => date('Y-m-d'),
                    'tgl_mulai_sewa' => $req->input('tgl_mulai_sewa'),
                    'tgl_selesai_sewa' => $req->input('tgl_selesai_sewa'),
                    'waktu_pickup' => $req->input('waktu_pickup'),
                    'keterangan' => $req->input('keterangan'),
                    'total_biaya' => $req->input('total_biaya'),
                    'status' => $req->input('status'),
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

        $data['penyewa'] = mpy::get();
        $data['bus'] = mb::get();
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