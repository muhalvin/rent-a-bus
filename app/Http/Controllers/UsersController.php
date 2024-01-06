<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use \App\Models\Users as mu;
use \App\Models\Level as ml;
use Yajra\DataTables\DataTables;

class UsersController extends Controller
{

	public function __construct()
  {
    $this->middleware('auth');
    $this->_kd = 'users';
  }

  public function index()
  {
   return render($this->_kd, $this->_kd.'.users', 'Users');
  }

 public function get_ajax(){
  if (!empty(session('action')) && in_array('c', session('action'))) {
    return DataTables::of(mu::get())
    ->addColumn('is_aktif', function($val){
      return '<span class="badge badge-sm bg-gradient-'.($val->is_aktif?'success':'danger').'">
      '.($val->is_aktif?'Aktif':'Tidak Aktif').'
      </span>';
    })
    ->addColumn('action', function($val){
      $act = edit(url($this->_kd), $val->id, 'update', true);
      $act .= ' '.hapus(url($this->_kd), $val->id, $val->nama, 'destroy', true);
      return $act;
    })
    ->rawColumns(['is_aktif','action'])->make(true);
  } else {
    return abort(403, 'Access forbidden!');
  }
}

public function create(Request $req)
{
  if (!empty($req->input())) {
    $val = Validator::make($req->input(),
      [
        'nama' => 'required|max:255',
        'email' => 'required|unique:users|max:255',
        'password' => 'required|min:6',
        'jk' => 'required|in:Laki-Laki,Perempuan|max:10',
        'alamat' => 'max:200',
        'tgl_lahir' => 'size:10',
        'no_hp' => 'max:15|min:9',
        'id_level' => 'required|numeric'
      ]);

    if (!$val->fails()) {
      $res = mu::insert([
        'nama' => $req->input('nama'),
        'email' => $req->input('email'),
        'email_verified_at' => null,

        'password' => bcrypt($req->input('password')),
        'jk' => $req->input('jk'),
        'alamat' => $req->input('alamat'),
        'tgl_lahir' => $req->input('tgl_lahir'),
        'no_hp' => $req->input('no_hp'),
        'foto' => null,
        'is_aktif' => 1,
        'id_level' => $req->input('id_level'),
        'remember_token' => null,
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

  $data['lvl'] = ml::all();
  return render($this->_kd, $this->_kd.'.create', 'Akun', $data, 'c');
}

public function update(Request $req, $id)
{
  $data['val'] = mu::findOrFail(['id'=>$id])[0];
  if (!empty($req->input())) {
    $val = Validator::make($req->input(),
      [
        'nama' => 'required|max:255',
        'password' => 'max:255',
        'jk' => 'required|in:Laki-Laki,Perempuan|max:10',
        'alamat' => 'max:200',
        'tgl_lahir' => 'size:10',
        'no_hp' => 'max:15|min:9',
        'is_aktif' => 'required|in:0,1',
        'id_level' => 'required|numeric'
      ]);

    if (!$val->fails()) {
      $upd = [
        'nama' => $req->input('nama'),
        'email_verified_at' => null,
        'jk' => $req->input('jk'),
        'alamat' => $req->input('alamat'),
        'tgl_lahir' => $req->input('tgl_lahir'),
        'no_hp' => $req->input('no_hp'),
        'is_aktif' => $req->input('is_aktif'),
        'id_level' => $req->input('id_level')
      ];

      if (!empty($req->input('password'))) {
        $upd += ['password' => bcrypt($req->input('password'))];
      }

      $res = mu::where('id', $id)->update($upd);
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

  $data['lvl'] = ml::all();
  return render($this->_kd, $this->_kd.'.update', 'Ubah Data', $data, 'e');
}

public function destroy(Request $req)
{
  if (!empty($req->input('id'))) {
    $cek = mu::find($req->input('id'));
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