<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use \App\Models\Kategori_berita as mk;
use Illuminate\Support\Str;

class Kategori_beritaController extends Controller
{

	public function __construct()
    {
    	$this->middleware('auth');
        $this->_kd = 'kategori_berita';
    }

	public function index()
    {
    	$data['val'] = mk::get();
        return render($this->_kd, $this->_kd.'.kategori_berita', 'Kategori Berita', $data);
    }

    private function validasi($req, $id = null)
    {
        $is_aktif = (!empty($id) ? 'required|in:0,1' : '');
        return Validator::make($req->input(),
        [
            'kategori_berita' => 'required|max:100',
            'is_aktif' => $is_aktif
        ]);
    }

    public function create(Request $req)
    {
        if (!empty($req->input())) {
            $val = $this->validasi($req);

            if (!$val->fails()) {
                $res = mk::insert([
                    'kategori_berita' => $req->input('kategori_berita'),
                    'slug' => Str::slug($req->input('kategori_berita')),
                    'is_aktif' => 1
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

        return render($this->_kd, $this->_kd.'.create', 'Kategori Berita', null, 'c');
    }

    public function update(Request $req, $id)
    {
        $data['val'] = mk::findOrFail(['id'=>$id])[0];
        if (!empty($req->input())) {
            $val = $this->validasi($req, $id);

            if (!$val->fails()) {
                $res = mk::where('id', $id)->update([
                    'kategori_berita' => $req->input('kategori_berita'),
                    'slug' => Str::slug($req->input('kategori_berita')),
                    'is_aktif' => $req->input('is_aktif')
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
            $cek = mk::find($req->input('id'));
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