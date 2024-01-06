<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use \App\Models\Api as ma;
use Orhanerday\OpenAi\OpenAi as oAI;

class OpenaiController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->_kd = 'openai';
    }

    public function index(Request $req)
    {
        $data['result'] = null;
        $data['question'] = null;
        if (!empty($req->input())) {
            $val = $this->validasi($req);
            if (!$val->fails()) {
                $data['val'] = ma::where(['api' => 'OpenAI'])->first();
                $json = json_decode($data['val']->value, true);        
                
                $open_ai = new oAI($json['api_key']);
                $complete = $open_ai->completion([
                    'model' => $req->input('model'),
                    'prompt' => $req->input('question'),
                    'temperature' => 0.9,
                    'max_tokens' => (int) $json['max_tokens'],
                    'frequency_penalty' => 0,
                    'presence_penalty' => 0.6,
                ]);

                if (!empty($complete)) {
                    $data['result'] = $this->parseAI($req->input('model'), json_decode($complete, true));
                }
                $data['question'] = $req->input('question');
            }
        }

        return render($this->_kd, $this->_kd.'.openai', 'Openai', $data);
    }

    private function validasi($req, $id = null)
    {
        return Validator::make($req->input(),
            [
                'model' => 'required|in:text-davinci-003,text-curie-001,text-babbage-001,text-ada-001',
                'question' => 'required'
            ]);
    }

    private function parseAI($model, $complete)
    {
        $parse = [];
        if ($model == 'text-davinci-003') {
            $parse = $complete['choices'][0]['text'];
        } else if ($model == 'text-curie-001') {
            $parse = $complete['choices'][0]['text'];
        } else if ($model == 'text-babbage-001') {
            $parse = $complete['choices'][0]['text'];
        } else if ($model == 'text-ada-001') {
            $parse = $complete['choices'][0]['text'];
        }

        return json_encode($parse);
    }

    public function create(Request $req)
    {
        if (!empty($req->input())) {
            $val = $this->validasi($req);

            if (!$val->fails()) {
                $res = ma::insert([
                    'aiopen' => $req->input('aiopen'),
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

        return render($this->_kd, $this->_kd.'.create', 'Aiopen', null, 'c');
    }

    public function update(Request $req, $id)
    {
        $data['val'] = ma::findOrFail(['id'=>$id])[0];
        if (!empty($req->input())) {
            $val = $this->validasi($req, $id);

            if (!$val->fails()) {
                $res = ma::where('id', $id)->update([
                    'aiopen' => $req->input('aiopen'),
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
            $cek = ma::find($req->input('id'));
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