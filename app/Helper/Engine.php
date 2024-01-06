<?php 

namespace App\Helper;

class engine
{
	protected $pathC;
	protected $pathM;
	protected $pathV;
	protected $folder;
	protected $nmFile;

	function __construct($folder = 'admin', $nmFile)
	{
		$this->pathC = app_path().'/Http/Controllers/';
		$this->pathM = app_path().'/Models/';
			$this->pathV = base_path().'/resources/views/';
		$this->folder = $folder;
		$this->nmFile = $nmFile;

		$this->buatFile($folder, $nmFile);
	}

		// File Builder
	function buatFile($folder, $nmFile)
	{
		$controller = $this->pathC.(!empty($folder)?$folder.'/':null).ucwords($nmFile).'Controller.php';
			// Controller
		if (!file_exists($controller)) {
			if (!empty($folder) && !file_exists($this->pathC.$folder)) {
				// Buatkan folder dulu
				mkdir($this->pathC.$folder);
				chmod($this->pathC.$folder, 0777);
			}
			$file = fopen($controller, 'w');
			chmod($controller, 0777);
			fwrite($file, $this->stringC($folder, $nmFile, 'Controller'));
			fclose($file);
		}

			// Model
			$model = $this->pathM.ucwords($nmFile).'.php';
			if (!file_exists($model)) {
				$file = fopen($model, 'w');
				chmod($model, 0777);
				fwrite($file, $this->stringM($nmFile));
				fclose($file);				
			}

			// View
			// Buat folder dulu
			$lokasi = $this->pathV.(!empty($folder)?$folder.'/':null).strtolower($nmFile);
			if (!file_exists($lokasi)) {
				if (!empty($folder) && !file_exists($this->pathV.$folder)) {
					// Buatkan folder dulu
					mkdir($this->pathV.$folder);
					chmod($this->pathV.$folder, 0777);
				}
				mkdir($lokasi);
				chmod($lokasi, 0777);
			}

			// 1. View utama
			$view = $lokasi.'/'.strtolower($nmFile).'.blade.php';
			if (!file_exists($view)) {
				$file = fopen($view, 'w');
				chmod($view, 0777);
				fwrite($file, $this->stringV($nmFile));
				fclose($file);
			}

			// 2. add
			$add = $lokasi.'/create.blade.php';
			if (!file_exists($add)) {
				$file = fopen($add, 'w');
				chmod($add, 0777);
				fwrite($file, $this->stringAdd($nmFile));
				fclose($file);
			}

			// 3. edit
			$edit = $lokasi.'/update.blade.php';
			if (!file_exists($edit)) {
				$file = fopen($edit, 'w');
				chmod($edit, 0777);
				fwrite($file, $this->stringEdit($nmFile));
				fclose($file);
			}
	}

	private function stringC($folder, $nmClass, $lblController)
	{
		$inisial = 'm'.strtolower(substr($nmClass, 0,1));
		$string = '<?php';
		$string .= "\nnamespace App\Http\Controllers;\n";
		$string .= "use Illuminate\Http\Request;\n";
		$string .= "use Illuminate\Support\Facades\Validator;\n";
		$string .= "use Illuminate\Validation\Rules\File; // Untuk validasi input file\n";
		$string .= "use Yajra\DataTables\DataTables; // Untuk datatables\n";
		$string .= "use \App\Models\\".ucwords($nmClass)." as ".$inisial.";\n\n";

		$string .= "class ".ucwords($nmClass.''.$lblController)." extends Controller
{\n";

		// Construct
		$string .= "
	public function __construct()
    {
    	\$this->middleware('auth');
        \$this->_kd = '".strtolower($nmClass)."';
    }\n";

		// Index
		$string .= "
	public function index()
    {
        return render(\$this->_kd, \$this->_kd.'.".strtolower($nmClass)."', '".ucwords(str_replace('_', ' ', $nmClass))."');
    }\n";

    	// Get Ajax
    	$string .= "
    public function get_ajax(){
      	if (!empty(session('action')) && in_array('c', session('action'))) {
			return DataTables::of(".$inisial."::get())
			->addColumn('action', function(\$val){
			    \$act = edit(url(\$this->_kd), \$val->id, 'update', true);
			    \$act .= ' '.hapus(url(\$this->_kd), \$val->id, \$val->".strtolower($nmClass).", 'destroy', true);
			    return \$act;
			})
			->rawColumns(['action'])->make(true);
	  	} else {
	  		return abort(403, 'Access forbidden!');
	  	}
	}\n";

    	// Validasi
    	$string .= "
    private function validasi(\$req, \$id = null)
    {
        return Validator::make(\$req->input(),
        [
            '".strtolower($nmClass)."' => 'required|max:100',
        ]);
    }\n";

    	// Create
    	$string .= "
    public function create(Request \$req)
    {
        if (!empty(\$req->input())) {
            \$val = \$this->validasi(\$req);

            if (!\$val->fails()) {
                \$res = ".$inisial."::insert([
                    '".strtolower($nmClass)."' => \$req->input('".strtolower($nmClass)."'),
                ]);
                if (\$res) {
                    notif(\$req, 'Berhasil menambah data!');
                } else {
                    notif(\$req, 'Gagal menambah data!');
                }

                return redirect(\$this->_kd);
            } else {
                notif(\$req, 'Cek kembali inputan Anda!');
                \$val->validate();
            }
        }

        return render(\$this->_kd, \$this->_kd.'.create', '".ucwords(str_replace('_', ' ', $nmClass))."', null, 'c');
    }\n";

    	// Update
    	$string .= "
    public function update(Request \$req, \$id)
    {
        \$data['val'] = ".$inisial."::findOrFail(['id'=>\$id])[0];
        if (!empty(\$req->input())) {
            \$val = \$this->validasi(\$req, \$id);

            if (!\$val->fails()) {
                \$res = ".$inisial."::where('id', \$id)->update([
                    '".strtolower($nmClass)."' => \$req->input('".strtolower($nmClass)."'),
                ]);

                if (\$res) {
                    notif(\$req, 'Berhasil memperbarui data!');
                } else {
                    notif(\$req, 'Gagal memperbarui data atau tidak ada data yang berubah!');
                }

                return redirect(\$this->_kd.'/update/'.\$id);
            } else {
                notif(\$req, 'Cek kembali inputan Anda!');
                \$val->validate();
            }
        }

        return render(\$this->_kd, \$this->_kd.'.update', 'Ubah Data', \$data, 'e');
    }\n";

    	// Destroy
    	$string .= "
    public function destroy(Request \$req)
    {
        if (!empty(\$req->input('id'))) {
            \$cek = ".$inisial."::find(\$req->input('id'));
            if (\$cek->delete()) {
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
}";
		return $string;
	}

	private function stringM($nmClass)
	{
		$lower = strtolower($nmClass);
		$string = "<?php";
		$string .= "\n\nnamespace App\Models;\n\n";
		$string .= "use Illuminate\Database\Eloquent\Factories\HasFactory;\n";
		$string .= "use Illuminate\Database\Eloquent\Model;\n";
		$string .= "use Illuminate\Support\Facades\DB;\n\n";

		$string .= "class ".ucwords($nmClass)." extends Model
{";
		$string .= "
	use HasFactory;
    protected \$table = '".$lower."';
    public \$timestamps = true;
    protected \$fillable = [
         '".$lower."',
    ];

    public static function get(\$where = null)
    {
        return DB::table('".$lower."')
                ->where(\$where)
                ->get();
    }
}";

		return $string;
	}

	private function stringV($nmClass)
	{
		$string = "@extends('layout.main');\n";
		$string .= "@section('konten')\n";
		$string .= "<link rel=\"stylesheet\" type=\"text/css\" href=\"{{url('assets/plugin/DataTables/datatables.min.css')}}\"/>\n";

		$string .= '
<div class="row">
	<div class="col-sm-12">
		<div class="card">
			<div class="card-header">
				<h6>
					{{tambah($menu_active, $title)}}
				</h6>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table align-items-center mb-0 tabel">
						<thead>
							<tr>
								<th class="text-center">#</th>
								<th>'.ucwords(str_replace('_', ' ', $nmClass)).'</th>
								<th class="text-center">..</th>
								<th>Action</th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>';

		$string .= "
\n<script src=\"{{url('assets/plugin/DataTables/datatables.min.js')}}\"></script>";
		$string .= "
<script type='text/javascript'>
	$(document).ready(function(){
		$('.tabel').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{\$menu_active.\"/get_ajax\"}}',
                type: 'GET'
            },
            columns: [
                { data: 'no', name:'id', render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }},
                { data: '".$nmClass."', name: '".$nmClass."' },
                { data: null, name: null },
                { data: 'action', name: 'action'}
            ]
        });
	});
</script>
@endsection";

		return $string;
	}

	private function stringAdd($nmClass)
	{
		$string = "@extends('layout.main');\n";
		$string .= "@section('konten')\n";
		$string .= "<link rel=\"stylesheet\" type=\"text/css\" href=\"{{url('assets/plugin/select2/dist/css/select2.min.css')}}\"/>\n";
		$string .= "<link rel=\"stylesheet\" type=\"text/css\" href=\"{{url('assets/plugin/dropify/css/dropify.min.css')}}\"/>\n";
		$string .= "<link rel=\"stylesheet\" type=\"text/css\" href=\"{{url('assets/plugin/summernote/summernote-lite.min.css')}}\"/>\n";

		$string .= '<div class="row mt-2">
	<div class="col-lg-12 mb-lg-0 mb-4">
		<div class="card">
			<div class="card-body p-3">
				<div class="row">
					<div class="col-lg-12">
						<div class="d-flex flex-column h-100">
							<p class="mb-1 pt-2 text-bold">Tambah Data '.ucwords(str_replace('_', ' ', $nmClass)).'</p>
							<p class="mb-2"></p>
							<form action="" method="post">
								@csrf
								<div class="form-group">
									<label>Field01 {{required()}}</label>
									<input type="text" name="field01" class="form-control" value="{{old(\'field01\')}}" required>
									@error(\'field01\')
									<span class="error">{{$message}}</span>
									@enderror
								</div>
								<div class="form-group">
									<label>Field02 {{required()}}</label>
									<select name="field02" class="form-control select2" required>
										<option value="">Pilih</option>
									</select>
									@error(\'field02\')
									<span class="error">{{$message}}</span>
									@enderror
								</div>
								<div class="form-group">
									<label>Field03</label>
									<div class="form-check form-check-inline">
										<label class="form-check-label">
											<input class="form-check-input field03" type="radio" name="field03" id="field03_1" value="1" {{old(\'field03\')?\'checked\':null}}> Yes
										</label>
									</div>
									<div class="form-check form-check-inline">
										<label class="form-check-label">
											<input class="form-check-input field03" type="radio" name="field03" id="field03_2" value="0" {{!old(\'field03\')?\'checked\':null}}> No
										</label>
									</div>
									@error(\'field03\')
									<span class="error">{{$message}}</span>
									@enderror
								</div>
								<div class="form-group">
									<label>Field04 {{required()}}</label>
									<textarea name="field04" class="form-control teksarea" required>{{old(\'field04\')}}</textarea>
									@error(\'field04\')
									<span class="error">{{$message}}</span>
									@enderror
								</div>
								<div class="form-group">
									<label>Field05 {{required()}}</label>
									<input type="file" accept="image/*" name="field05" class="form-control dropify" value="{{old(\'field05\')}}" required>
									@error(\'field05\')
									<span class="error">{{$message}}</span>
									@enderror
								</div>
								{{prosback($menu_active)}}
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>';

$string .= "\n<script src=\"{{url('assets/plugin/select2/dist/js/select2.min.js')}}\"></script>";
$string .= "\n<script src=\"{{url('assets/plugin/dropify/js/dropify.min.js')}}\"></script>";
$string .= "\n<script src=\"{{url('assets/plugin/summernote/summernote-lite.min.js')}}\"></script>";

		$string .= "
<script type='text/javascript'>
	$(document).ready(function(){
		$('.select2').select2();
		$('.dropify').dropify();
		$('.teksarea').summernote({
			height: 250
		});
	});
</script>
@endsection";

		return $string;
	}

	private function stringEdit($nmClass)
	{
		$string = "@extends('layout.main');\n";
		$string .= "@section('konten')\n";
		$string .= "<link rel=\"stylesheet\" type=\"text/css\" href=\"{{url('assets/plugin/select2/dist/css/select2.min.css')}}\"/>\n";
		$string .= "<link rel=\"stylesheet\" type=\"text/css\" href=\"{{url('assets/plugin/dropify/css/dropify.min.css')}}\"/>\n";
		$string .= "<link rel=\"stylesheet\" type=\"text/css\" href=\"{{url('assets/plugin/summernote/summernote-lite.min.css')}}\"/>\n";

		$string .= '<div class="row mt-2">
	<div class="col-lg-12 mb-lg-0 mb-4">
		<div class="card">
			<div class="card-body p-3">
				<div class="row">
					<div class="col-lg-12">
						<div class="d-flex flex-column h-100">
							<p class="mb-1 pt-2 text-bold">Ubah Data '.ucwords(str_replace('_', ' ', $nmClass)).'</p>
							<p class="mb-2"></p>
							<form action="" method="post">
								@csrf
								@method(\'PATCH\')
								<div class="form-group">
									<label>Field01 {{required()}}</label>
									<input type="text" name="field01" class="form-control" value="{{$val->field01}}" required>
									@error(\'field01\')
									<span class="error">{{$message}}</span>
									@enderror
								</div>
								<div class="form-group">
									<label>Field02 {{required()}}</label>
									<select name="field02" class="form-control select2" required>
										<option value="">Pilih</option>
									</select>
									@error(\'field02\')
									<span class="error">{{$message}}</span>
									@enderror
								</div>
								<div class="form-group">
									<label>Field03</label>
									<div class="form-check form-check-inline">
										<label class="form-check-label">
											<input class="form-check-input field03" type="radio" name="field03" id="field03_1" value="1" {{$val->field03?\'checked\':null}}> Yes
										</label>
									</div>
									<div class="form-check form-check-inline">
										<label class="form-check-label">
											<input class="form-check-input field03" type="radio" name="field03" id="field03_2" value="0" {{$val->field03?\'checked\':null}}> No
										</label>
									</div>
									@error(\'field03\')
									<span class="error">{{$message}}</span>
									@enderror
								</div>
								<div class="form-group">
									<label>Field04 {{required()}}</label>
									<textarea name="field04" class="form-control teksarea" required>{{$val->field04}}</textarea>
									@error(\'field04\')
									<span class="error">{{$message}}</span>
									@enderror
								</div>
								<div class="form-group">
									<label>Field05 {{required()}}</label>
									<input type="file" accept="image/*" name="field05" class="form-control dropify" data-default-file="{{asset(\'storage/\'.$val->field05)}}" value="{{$val->field05}}" required>
									@error(\'field05\')
									<span class="error">{{$message}}</span>
									@enderror
								</div>
								{{prosback($menu_active)}}
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>';

$string .= "\n<script src=\"{{url('assets/plugin/select2/dist/js/select2.min.js')}}\"></script>";
$string .= "\n<script src=\"{{url('assets/plugin/dropify/js/dropify.min.js')}}\"></script>";
$string .= "\n<script src=\"{{url('assets/plugin/summernote/summernote-lite.min.js')}}\"></script>";

		$string .= "
<script type='text/javascript'>
	$(document).ready(function(){
		$('.select2').select2();
		$('.dropify').dropify();
		$('.teksarea').summernote({
			height: 250
		});
	});
</script>
@endsection";

		return $string;
	}

}
?>