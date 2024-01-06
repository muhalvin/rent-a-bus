<?php

use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [\App\Http\Controllers\DepanController::class, 'index']);

Route::get('/login', [\App\Http\Controllers\AutentikasiController::class, 'login']);
Route::post('/login', [\App\Http\Controllers\AutentikasiController::class, 'login']);

// A

Route::prefix('api')->group(function () {
    Route::get('/', [\App\Http\Controllers\ApiController::class, 'index']);
    Route::get('/create', [\App\Http\Controllers\ApiController::class, 'create']);
    Route::post('/create', [\App\Http\Controllers\ApiController::class, 'create']);
    Route::get('/update/{id}', [\App\Http\Controllers\ApiController::class, 'update']);
    Route::patch('/update/{id}', [\App\Http\Controllers\ApiController::class, 'update']);
    Route::delete('/destroy', [\App\Http\Controllers\ApiController::class, 'destroy']);
});

// B

Route::prefix('berita')->group(function () {
    Route::get('/', [\App\Http\Controllers\BeritaController::class, 'index']);
    Route::get('/get_ajax', [\App\Http\Controllers\BeritaController::class, 'get_ajax']);
    Route::get('/create', [\App\Http\Controllers\BeritaController::class, 'create']);
    Route::post('/create', [\App\Http\Controllers\BeritaController::class, 'create']);
    Route::get('/update/{id}', [\App\Http\Controllers\BeritaController::class, 'update']);
    Route::patch('/update/{id}', [\App\Http\Controllers\BeritaController::class, 'update']);
    Route::delete('/destroy', [\App\Http\Controllers\BeritaController::class, 'destroy']);
});

Route::prefix('bus')->group(function () {
    Route::get('/', [\App\Http\Controllers\BusController::class, 'index']);
    Route::get('/get_ajax', [\App\Http\Controllers\BusController::class, 'get_ajax']);
    Route::get('/create', [\App\Http\Controllers\BusController::class, 'create']);
    Route::post('/create', [\App\Http\Controllers\BusController::class, 'create']);
    Route::get('/update/{id}', [\App\Http\Controllers\BusController::class, 'update']);
    Route::patch('/update/{id}', [\App\Http\Controllers\BusController::class, 'update']);
    Route::post('/upload', [\App\Http\Controllers\BusController::class, 'upload']);
    Route::delete('/destroy', [\App\Http\Controllers\BusController::class, 'destroy']);
    Route::delete('/destroy_gambar', [\App\Http\Controllers\BusController::class, 'destroy_gambar']);
});

// C
Route::prefix('cars')->group(function () {
    Route::get('/', [\App\Http\Controllers\DepanController::class, 'cars']);
    Route::get('/detail/{id}', [\App\Http\Controllers\DepanController::class, 'cars_detail']);
    Route::post('/detail/{id}', [\App\Http\Controllers\DepanController::class, 'cars_detail']);
});

// H

Route::prefix('hak_akses')->group(function () {
    Route::get('/', [\App\Http\Controllers\Hak_aksesController::class, 'index']);
    Route::get('/create', [\App\Http\Controllers\Hak_aksesController::class, 'create']);
    Route::post('/create', [\App\Http\Controllers\Hak_aksesController::class, 'create']);
    Route::get('/update/{id}', [\App\Http\Controllers\Hak_aksesController::class, 'update']);
    Route::patch('/update/{id}', [\App\Http\Controllers\Hak_aksesController::class, 'update']);
    Route::delete('/destroy', [\App\Http\Controllers\Hak_aksesController::class, 'destroy']);
});

Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index']);

// I

Route::prefix('icons')->group(function () {
    Route::get('/', [\App\Http\Controllers\IconsController::class, 'index']);
    Route::get('/create', [\App\Http\Controllers\IconsController::class, 'create']);
    Route::post('/create', [\App\Http\Controllers\IconsController::class, 'create']);
    Route::get('/update/{id}', [\App\Http\Controllers\IconsController::class, 'update']);
    Route::patch('/update/{id}', [\App\Http\Controllers\IconsController::class, 'update']);
    Route::delete('/destroy', [\App\Http\Controllers\IconsController::class, 'destroy']);
});

Route::get('info_sistem', [\App\Http\Controllers\Info_sistemController::class, 'index']);
Route::post('info_sistem', [\App\Http\Controllers\Info_sistemController::class, 'index']);

// K

Route::prefix('kategori_berita')->group(function () {
    Route::get('/', [\App\Http\Controllers\Kategori_beritaController::class, 'index']);
    Route::get('/create', [\App\Http\Controllers\Kategori_beritaController::class, 'create']);
    Route::post('/create', [\App\Http\Controllers\Kategori_beritaController::class, 'create']);
    Route::get('/update/{id}', [\App\Http\Controllers\Kategori_beritaController::class, 'update']);
    Route::patch('/update/{id}', [\App\Http\Controllers\Kategori_beritaController::class, 'update']);
    Route::delete('/destroy', [\App\Http\Controllers\Kategori_beritaController::class, 'destroy']);
});

// L

Route::prefix('level')->group(function () {
    Route::get('/', [\App\Http\Controllers\LevelController::class, 'index']);
    Route::get('/create', [\App\Http\Controllers\LevelController::class, 'create']);
    Route::post('/create', [\App\Http\Controllers\LevelController::class, 'create']);
    Route::get('/update/{id}', [\App\Http\Controllers\LevelController::class, 'update']);
    Route::patch('/update/{id}', [\App\Http\Controllers\LevelController::class, 'update']);
    Route::delete('/destroy', [\App\Http\Controllers\LevelController::class, 'destroy']);
});

Route::get('/login', [\App\Http\Controllers\AutentikasiController::class, 'login'])->name('login');
Route::post('/login', [\App\Http\Controllers\AutentikasiController::class, 'login']);

Route::get('/logout', [\App\Http\Controllers\AutentikasiController::class, 'logout']);

// M

Route::prefix('menu')->group(function () {
    // Parent
    Route::get('/', [\App\Http\Controllers\MenuController::class, 'index']);
    Route::get('/create', [\App\Http\Controllers\MenuController::class, 'create']);
    Route::post('/create', [\App\Http\Controllers\MenuController::class, 'create']);
    Route::get('/update/{id}', [\App\Http\Controllers\MenuController::class, 'update']);
    Route::patch('/update/{id}', [\App\Http\Controllers\MenuController::class, 'update']);
    Route::delete('/destroy', [\App\Http\Controllers\MenuController::class, 'destroy']);

    // Child
    Route::get('/create_detail', [\App\Http\Controllers\MenuController::class, 'create_detail']);
    Route::post('/create_detail', [\App\Http\Controllers\MenuController::class, 'create_detail']);
    Route::get('/update_detail/{id}', [\App\Http\Controllers\MenuController::class, 'update_detail']);
    Route::patch('/update_detail/{id}', [\App\Http\Controllers\MenuController::class, 'update_detail']);
    Route::delete('/destroy_detail', [\App\Http\Controllers\MenuController::class, 'destroy_detail']);
});

Route::prefix('merek')->group(function () {
    Route::get('/', [App\Http\Controllers\MerekController::class, 'index']);
    Route::get('/get_ajax', [App\Http\Controllers\MerekController::class, 'get_ajax']);
    Route::get('/create', [App\Http\Controllers\MerekController::class, 'create']);
    Route::post('/create', [App\Http\Controllers\MerekController::class, 'create']);
    Route::get('/update/{id}', [App\Http\Controllers\MerekController::class, 'update']);
    Route::patch('/update/{id}', [App\Http\Controllers\MerekController::class, 'update']);
    Route::delete('/destroy', [App\Http\Controllers\MerekController::class, 'destroy']);
});

// O

Route::prefix('openai')->group(function () {
    Route::get('/', [\App\Http\Controllers\OpenaiController::class, 'index']);
    Route::post('/', [\App\Http\Controllers\OpenaiController::class, 'index']);
});

// P

Route::prefix('penyewa')->group(function () {
    Route::get('/', [App\Http\Controllers\PenyewaController::class, 'index']);
    Route::get('/get_ajax', [App\Http\Controllers\PenyewaController::class, 'get_ajax']);
    Route::get('/create', [App\Http\Controllers\PenyewaController::class, 'create']);
    Route::post('/create', [App\Http\Controllers\PenyewaController::class, 'create']);
    Route::get('/update/{id}', [App\Http\Controllers\PenyewaController::class, 'update']);
    Route::patch('/update/{id}', [App\Http\Controllers\PenyewaController::class, 'update']);
    Route::delete('/destroy', [App\Http\Controllers\PenyewaController::class, 'destroy']);
});

Route::prefix('pesanan')->group(function () {
    Route::get('/', [App\Http\Controllers\PesananController::class, 'index']);
    Route::get('/get_ajax', [App\Http\Controllers\PesananController::class, 'get_ajax']);
    Route::get('/get_available', [App\Http\Controllers\PesananController::class, 'get_available']);
    Route::get('/create', [App\Http\Controllers\PesananController::class, 'create']);
    Route::post('/create', [App\Http\Controllers\PesananController::class, 'create']);
    Route::get('/update/{id}', [App\Http\Controllers\PesananController::class, 'update']);
    Route::patch('/update/{id}', [App\Http\Controllers\PesananController::class, 'update']);
    Route::delete('/destroy', [App\Http\Controllers\PesananController::class, 'destroy']);
});

Route::get('/pesananku', [\App\Http\Controllers\DepanController::class, 'pesananku']);
Route::get('/pesananku/detail/{id}', [\App\Http\Controllers\DepanController::class, 'pesananku_detail']);
Route::post('/pesananku', [\App\Http\Controllers\DepanController::class, 'pesananku']);

Route::get('/profile', [\App\Http\Controllers\ProfileController::class, 'index']);
Route::patch('/profile', [\App\Http\Controllers\ProfileController::class, 'index']);

// S
Route::get('/signin', [\App\Http\Controllers\DepanController::class, 'signin']);
Route::post('/signin', [\App\Http\Controllers\DepanController::class, 'signin']);

Route::get('/signup', [\App\Http\Controllers\DepanController::class, 'signup']);
Route::post('/signup', [\App\Http\Controllers\DepanController::class, 'signup']);

// T
Route::prefix('transaksi')->group(function () {
    Route::get('/', [App\Http\Controllers\TransaksiController::class, 'index']);
    Route::get('/get_ajax', [App\Http\Controllers\TransaksiController::class, 'get_ajax']);
    Route::get('/create', [App\Http\Controllers\TransaksiController::class, 'create']);
    Route::post('/create', [App\Http\Controllers\TransaksiController::class, 'create']);
    Route::get('/update/{id}', [App\Http\Controllers\TransaksiController::class, 'update']);
    Route::patch('/update/{id}', [App\Http\Controllers\TransaksiController::class, 'update']);
    Route::delete('/destroy', [App\Http\Controllers\TransaksiController::class, 'destroy']);
});

Route::get('/transaksiku', [\App\Http\Controllers\DepanController::class, 'transaksiku']);
Route::post('/transaksiku', [\App\Http\Controllers\DepanController::class, 'transaksiku']);
Route::get('/transaksiku/detail/{id}', [\App\Http\Controllers\DepanController::class, 'transaksiku_detail']);
Route::get('/transaksiku/check/{id}', [\App\Http\Controllers\DepanController::class, 'check']);

Route::post('/transaksiku/detail/{id}', [\App\Http\Controllers\DepanController::class, 'transaksiku_detail']);

Route::prefix('type')->group(function () {
    Route::get('/', [App\Http\Controllers\TypeController::class, 'index']);
    Route::get('/get_ajax', [App\Http\Controllers\TypeController::class, 'get_ajax']);
    Route::get('/create', [App\Http\Controllers\TypeController::class, 'create']);
    Route::post('/create', [App\Http\Controllers\TypeController::class, 'create']);
    Route::get('/update/{id}', [App\Http\Controllers\TypeController::class, 'update']);
    Route::patch('/update/{id}', [App\Http\Controllers\TypeController::class, 'update']);
    Route::delete('/destroy', [App\Http\Controllers\TypeController::class, 'destroy']);
});

// U

Route::prefix('users')->group(function () {
    Route::get('/', [\App\Http\Controllers\UsersController::class, 'index']);
    Route::get('/get_ajax', [\App\Http\Controllers\UsersController::class, 'get_ajax']);
    Route::get('/create', [\App\Http\Controllers\UsersController::class, 'create']);
    Route::post('/create', [\App\Http\Controllers\UsersController::class, 'create']);
    Route::get('/update/{id}', [\App\Http\Controllers\UsersController::class, 'update']);
    Route::patch('/update/{id}', [\App\Http\Controllers\UsersController::class, 'update']);
    Route::delete('/destroy', [\App\Http\Controllers\UsersController::class, 'destroy']);
});

// W
Route::post('/webhook', [\App\Http\Controllers\DepanController::class, 'webhook']);
