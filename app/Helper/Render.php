<?php 

use Illuminate\Support\Facades\DB;
use \App\Models\Info_sistem as mi;

function rupiah($val)
{
    return 'Rp. '.number_format($val??0);
}

function render($link_cek, $view, $title = 'No Title', $data = null, $feature = null) 
{
    $id_link = DB::table('menu')->where('link', $link_cek)->select('id')->first();
    if (empty($id_link->id) && $link_cek != 'profile') {
        return abort(404, 'Not found!');
    }

    $data['title'] = ucwords($title);
    $data['xis'] = mi::first();
    $data['menu_active'] = url($link_cek);

    $act = [];
    if ($link_cek == 'profile') {
        $act = ['e'];
    } else {
        $akses = DB::table('hak_akses')->where(['level_id'=> Session::get('id_level'), 'menu_id'=>$id_link->id])->first();
        
        if ($akses->tambah) {
            array_push($act, 'c');
        }

        if ($akses->ubah) {
            array_push($act, 'e');
        }

        if ($akses->hapus) {
            array_push($act, 'd');
        }

        if ($akses->lihat) {
            array_push($act, 'v');
        }
    }

    Session::put('action', $act);
    $data['xmenu'] = DB::table('hak_akses AS ha')
    ->join('menu AS m', 'm.id', '=', 'ha.menu_id')
    ->leftJoin('icons AS i', 'i.id', '=', 'm.icon_id')
    ->select('m.*', 'i.icon')
    ->where(['ha.level_id'=>Session::get('id_level'), 'm.parent_id'=>NULL])
    ->orderBy('m.urutan', 'ASC')->get();
    $data['xdetail'] = DB::table('hak_akses AS ha')
    ->join('menu AS m', 'm.id', '=', 'ha.menu_id')
    ->select('m.*')
    ->where('ha.level_id', Session::get('id_level'))
    ->whereNotNull('m.parent_id')
    ->orderBy('m.urutan', 'ASC')->get();
    
    if (!empty($feature)) {
        if (!in_array($feature, $act)) {
            return abort(403, 'Access forbidden!');
        }
    }
    return view($view, $data);
}

function depan($view, $link_cek, $title = '', $data = null)
{
    $data['title'] = ucwords($title);
    $data['xis'] = mi::first();
    $data['menu_active'] = url($link_cek);
    return view($view, $data); 
}

function resnull($val, $default = null)
{
    return (!empty($val) ? $val : $default);
}

function required()
{
	echo '<span class="error">*)</span>';
}

function notif($req, $msg)
{
    return $req->session()->flash('notif', $msg);
}

function tambah($menu_active, $title = null, $custom_function = 'create', $is_datatable = false)
{
    if (in_array('c', Session::get('action'))) {
        if ($is_datatable) {
            return '<a href="'.url($menu_active.'/'.$custom_function).'" class="btn btn-info"><i class="fa fa-plus"></i> Tambah '.$title.'</a>';
        } else {
            echo '<a href="'.url($menu_active.'/'.$custom_function).'" class="btn btn-info"><i class="fa fa-plus"></i> Tambah '.$title.'</a>';
        }
    }
}

function edit($menu_active, $id, $custom_function = 'update', $is_datatable = false)
{
    if (in_array('e', Session::get('action'))) {
        if ($is_datatable) {
            return '<a href="'.url($menu_active.'/'.$custom_function.'/'.$id).'" class="btn btn-xs btn-warning">Edit</a>';
        } else {
            echo '<a href="'.url($menu_active.'/'.$custom_function.'/'.$id).'" class="btn btn-xs btn-warning">Edit</a>';
        }
    }
}

function hapus($menu_active, $id, $nama, $custom_function = 'destroy', $is_datatable = false)
{
    if (in_array('d', Session::get('action'))) {
        if ($is_datatable) {
            return '<button onclick="hapus(this)" data-id="'.$id.'" data-nama="'.$nama.'" data-href="'.url($menu_active.'/'.$custom_function).'" class="btn btn-xs btn-danger"> Delete</button>';
        } else {
            echo '<button onclick="hapus(this)" data-id="'.$id.'" data-nama="'.$nama.'" data-href="'.url($menu_active.'/'.$custom_function).'" class="btn btn-xs btn-danger"> Delete</button>';
        }
    }
}

function prosback($menu_active, $is_formgroup = true)
{
    if ($is_formgroup) {
        echo '<div class="form-group">
        <button type="submit" class="btn btn-primary btn-md">Simpan</button>
        <a href="'.url($menu_active).'" class="btn btn-warning btn-md">Kembali</a>
        </div>';
    } else {
        echo '<button type="submit" class="btn btn-primary btn-md">Simpan</button>
        <a href="'.url($menu_active).'" class="btn btn-warning btn-md">Kembali</a>';
    }
}

function proses($is_formgroup = true, $kata = 'Simpan')
{
    if ($is_formgroup) {
        echo '<div class="form-group">
        <button type="submit" class="btn btn-primary btn-md">'.$kata.'</button>
        </div>';
    } else {
        echo '<button type="submit" class="btn btn-primary btn-md">'.$kata.'</button>';
    }
}

function btnback($menu_active, $is_formgroup = true)
{
    if ($is_formgroup) {
        echo '<div class="form-group">
        <a href="'.url($menu_active).'" class="btn btn-warning btn-md">Kembali</a>
        </div>';
    } else {
        echo '<a href="'.url($menu_active).'" class="btn btn-warning btn-md">Kembali</a>';
    }
}

// use Illuminate\Support\Facades\Crypt;
function enkrip($val)
{
    return Crypt::encryptString($val);
}

function dekrip($val)
{
    return Crypt::decryptString($val);
}
// End use Illuminate\Support\Facades\Crypt;

function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}