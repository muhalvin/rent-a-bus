<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\File;
use \App\Models\Berita as mb;
use \App\Models\Kategori_berita as mk;
use \App\Models\Berita_tags as mbt;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;
use Session;

class BeritaController extends Controller
{

	public function __construct()
    {
    	$this->middleware('auth');
        $this->_kd = 'berita';
    }

    public function index()
    {
        return render($this->_kd, $this->_kd.'.berita', 'Berita');
    }

    public function get_ajax(){
        if (!empty(session('action')) && in_array('c', session('action'))) {
            return DataTables::of(mb::get())
            ->addColumn('gambar', function($val){
                return '<img src="'.asset('storage/'.$val->gambar).'" style="max-width: 100px; height: auto;">';
            })
            ->addColumn('permalink', function($val){
                return '<a href="'.url('berita/'.$val->permalink).'">'.$val->permalink.'</a>';
            })
            ->addColumn('action', function($val){
                $act = edit(url($this->_kd), $val->id, 'update', true);
                $act .= ' '.hapus(url($this->_kd), $val->id, $val->judul, 'destroy', true);
                return $act;
            })
            ->rawColumns(['gambar','permalink','action'])->make(true);
        } else {
            return abort(403, 'Access forbidden!');
        }
    }

    private function validasi($req, $id = null)
    {
        $is_required = (empty($id) ? 'required':'nullable');
        return Validator::make($req->input(),
            [
                'judul' => (empty($id) ? 'required|max:100' : ''),
                'kategori_berita_id' => 'required|numeric',
                'isi' => 'required|min:10',
                'is_publish' => 'required|in:0,1,2',
                'gambar' => [
                    'nullable',
                    File::types(['jpg', 'jpeg', 'png', 'gif', 'webp'])
                    ->max(2048)
                ],
                'berita_tags' => 'required'
            ]);
    }

    public function create(Request $req)
    {
        if (!empty($req->input())) {
            $val = $this->validasi($req);
            if (!$val->fails()) {
                $gambar = $req->file('gambar')->store('berita');
                $res = mb::insert([
                    'judul' => $req->input('judul'),
                    'gambar' => $gambar,
                    'isi' => $req->input('isi'),
                    'permalink' => Str::slug($req->input('judul')),
                    'dibaca' => 0,
                    'tanggal' => date('Y-m-d'),
                    'is_publish' => $req->input('is_publish'),
                    'kategori_berita_id' => $req->input('kategori_berita_id'),
                    'created_at' => date('Y-m-d H:i:s'),
                    'created_by' => Session::get('id'),
                    'updated_at' => null,
                    'updated_by' => null
                ]);
                if ($res) {
                    $tag = explode(',', $req->input('berita_tags'));
                    $tags = [];
                    foreach ($tag as $v) {
                        if (!empty($v)) {
                         $tags[] = array('berita_id' => $res->id,
                            'berita_tags' => trim($v),
                            'slug' => Str::slug(trim($v))); 
                     } 
                 };
                 mbt::insert($tags);

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

    $data['kat'] = mk::all();
    return render($this->_kd, $this->_kd.'.create', 'Berita', $data, 'c');
}

public function update(Request $req, $id)
{
    $data['val'] = mb::findOrFail(['id'=>$id])[0];
    if (!empty($req->input())) {
        $val = $this->validasi($req, $id);

        if (!$val->fails()) {
            $gambar = $data['val']->gambar;
            if (!empty($_FILES['gambar']['name'])) {
                $f = $req->file('gambar')->store('berita');
                if ($f) {
                    if (!empty($gambar)) {
                        if (file_exists(storage_path('app/public/'.$gambar)) && unlink(storage_path('app/public/'.$gambar))) {

                        }
                    }
                    $gambar = $f;
                }
            }
            $res = mb::where('id', $id)->update([
                'gambar' => $gambar,
                'isi' => $req->input('isi'),
                'tanggal' => date('Y-m-d'),
                'is_publish' => $req->input('is_publish'),
                'kategori_berita_id' => $req->input('kategori_berita_id'),
                'updated_at' => date('Y-m-d H:i:s'),
                'updated_by' => Session::get('id')
            ]);

            if ($res) {
                mbt::where('berita_id', $id)->delete();
                $tag = explode(',', $req->input('berita_tags'));
                $tags = [];
                foreach ($tag as $v) {
                    if (!empty($v)) {
                     $tags[] = array('berita_id' => $id,
                        'berita_tags' => trim($v),
                        'slug' => Str::slug(trim($v))); 
                 } 
             };
             mbt::insert($tags);
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

$data['kat'] = mk::all();
$data['tags'] = mbt::where('berita_id', $id)->get();
return render($this->_kd, $this->_kd.'.update', 'Ubah Data', $data, 'e');
}

public function destroy(Request $req)
{
    if (!empty($req->input('id'))) {
        $cek = mb::find($req->input('id'))->first();
        if (!empty($cek->id)) {
            mb::where('id', $req->input('id'))->delete();
            mbt::where('berita_id', $req->input('id'))->delete();

            if (!empty($cek->gambar)) {
                if (file_exists(storage_path('app/public/'.$cek->gambar)) && unlink(storage_path('app/public/'.$cek->gambar))) {

                }
            }
            
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