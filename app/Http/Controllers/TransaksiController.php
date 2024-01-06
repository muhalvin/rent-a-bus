<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\File; // Untuk validasi input file
use Yajra\DataTables\DataTables; // Untuk datatables
use \App\Models\Transaksi as mt;
use App\Models\Pesanan as mp;

class TransaksiController extends Controller
{

	public function __construct()
    {
    	$this->middleware('auth');
        $this->_kd = 'transaksi';
    }

	public function index()
    {
        return render($this->_kd, $this->_kd.'.transaksi', 'Transaksi');
    }

    public function get_ajax(){
      	if (!empty(session('action')) && in_array('c', session('action'))) {
			return DataTables::of(mt::get())
            ->addColumn('penyewa', function($v){
                return '<a href="'.url('pesanan/edit/'.$v->id_pesanan).'">'.$v->kd_pesanan.' - '.$v->penyewa.'</a>';
            })
            ->addColumn('nominal', function($v){
                return rupiah($v->jumlah);
            })
            ->addColumn('tgl_sewa', function($v){
                return $v->tgl_mulai_sewa.' s/d '.$v->tgl_selesai_sewa;
            })
            ->addColumn('status', function($v){
                return '<span class="badge badge-sm bg-gradient-'.($v->status==1?'success':($v->status==0?'danger':'warning')).'">'.($v->status==1?'Lunas':($v->status==0?'Belum':'Gagal')).'</span>';
            })
			->addColumn('action', function($v){
			    $act = edit(url($this->_kd), $v->id, 'update', true);
			    $act .= ' '.hapus(url($this->_kd), $v->id, $v->kd_transaksi, 'destroy', true);
			    return $act;
			})
			->rawColumns(['penyewa','status','action'])->make(true);
	  	} else {
	  		return abort(403, 'Access forbidden!');
	  	}
	}

    private function validasi($req, $id = null)
    {
        $params = [
            'tgl_transaksi' => 'required|date',
            'jumlah' => 'required|numeric',
            'metode' => 'required',
            'status' => 'required|in:0,1,2',
            'keterangan' => 'nullable'
        ];
        if (empty($id)) {
          $params += ['id_pesanan' => 'required|numeric'];
        }

        return Validator::make($req->input(), $params);
    }

    private function sisabayar($id_pesanan, $jumlah)
    {
        $cek = mp::where(['id'=>$id_pesanan])->first();
        if (!empty($cek->id)) {
            // Apakah sudah lunas?
            $sisa = (int) $cek->total_biaya - (int) $cek->dibayarkan;
            if ($sisa <= 0) {
                return ['status'=>false, 'msg'=>'Tunggakan sudah lunas!'];
            } else {
                // Cek apakah nominal yg dibayarkan lebih dari sisa tunggakan?
                if ($jumlah <= $sisa) {
                    return ['status'=>true, 'msg'=>''];
                } else {
                    return ['status'=>false, 'msg'=>'nominal tunggakan harus tidak lebih dari '.rupiah($sisa)];
                }
            }
        } else {
            return ['status'=>false, 'msg'=>'Pesanan tidak ditemukan!'];
        }
    }

    public function create(Request $req)
    {
        if (!empty($req->input())) {
            $val = $this->validasi($req);

            if (!$val->fails()) {
                $cek_byr = $this->sisabayar($req->input('id_pesanan'), $req->input('jumlah'));
                if ($cek_byr['status']) {
                    $res = mt::insert([
                        'kd_transaksi' => 'TF'.time(),
                        'id_pesanan' => $req->input('id_pesanan'),
                        'tgl_transaksi' => $req->input('tgl_transaksi'),
                        'jumlah' => (int) $req->input('jumlah'),
                        'metode' => $req->input('metode'),
                        'status' => $req->input('status'),
                        'keterangan' => $req->input('keterangan'),
                        'created_at' => date('Y-m-d H:i:s'),
                        'created_by' => session('id'),
                        'updated_at' => null,
                        'updated_by' => null
                    ]);
                    if ($res) {
                        // Jika status lunas, cek apakah total biaya - dibayarkan sudah 0?
                        $cek_byr = mp::where(['id'=>$req->input('id_pesanan')])->first();
                        $sisa = $cek_byr->total_biaya - $cek_byr->dibayarkan;
                        
                        $status = 'belum';
                        if ($sisa == 0) {
                            // Update pesanan menjadi lunas
                            $status = 'lunas';
                        } else {
                            // Update pesanan menjadi DP jika dibayarkan > 0
                            if ($cek_byr->dibayarkan > 0) {
                                $status = 'dp';
                            }
                        }

                        $pesanan = array('status' => $status,
                                'updated_at' => date('Y-m-d H:i:s'),
                                'updated_by' => session('id'));
                        mp::where('id', $req->input('id_pesanan'))->update($pesanan);

                        notif($req, 'Berhasil menambah data!');
                    } else {
                        notif($req, 'Gagal menambah data!');
                    }    
                } else {
                    notif($req, $cek_byr['msg']);
                }

                return redirect($this->_kd.'/create');
            } else {
                notif($req, 'Cek kembali inputan Anda!');
                $val->validate();
            }
        }

        $data['pesanan'] = mp::get();
        return render($this->_kd, $this->_kd.'.create', 'Transaksi', $data, 'c');
    }

    public function update(Request $req, $id)
    {
        $data['val'] = mt::findOrFail(['id'=>$id])[0];
        if (!empty($req->input())) {
            $val = $this->validasi($req, $id);

            if (!$val->fails()) {
                $res = mt::where('id', $id)->update([
                    'tgl_transaksi' => $req->input('tgl_transaksi'),
                    'jumlah' => (int) $req->input('jumlah'),
                    'metode' => $req->input('metode'),
                    'status' => $req->input('status'),
                    'keterangan' => $req->input('keterangan'),
                    'updated_at' => date('Y-m-d H:i:s'),
                    'updated_by' => session('id')
                ]);

                if ($res) {
                    // Jika status lunas, cek apakah total biaya - dibayarkan sudah 0?
                    $cek_byr = mp::where(['id'=>$data['val']->id_pesanan])->first();
                    $sisa = $cek_byr->total_biaya - $cek_byr->dibayarkan;
                    
                    $status = 'belum';
                    if ($sisa == 0) {
                        // Update pesanan menjadi lunas
                        $status = 'lunas';
                    } else {
                        // Update pesanan menjadi DP jika dibayarkan > 0
                        if ($cek_byr->dibayarkan > 0) {
                            $status = 'dp';
                        }
                    }

                    $pesanan = array('status' => $status,
                            'updated_at' => date('Y-m-d H:i:s'),
                            'updated_by' => session('id'));
                    mp::where('id', $data['val']->id_pesanan)->update($pesanan);

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

        $data['pesanan'] = mp::get();
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