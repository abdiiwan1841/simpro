<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'UserController@index')->name('home');

Route::resource('user', 'UserController');

Route::get('/user/{id}/ubah_password', [
    'as' => 'user.update_password',
    'uses' => 'UserController@ubah_password'
]);

Route::post('/user/ubah_password', function(\Illuminate\Http\Request $request){})->name('user.simpan_password')->uses('UserController@simpan_password');

//Route::get('/proyek_progress/{id}-kode={kode?}/edit', [
//    'as' => 'proyek_progress.edit',
//    'uses' => 'ProyekProgressController@edit'
//]);

Route::resource('kegiatan', 'KegiatanController');

Route::get('kegiatan/{id}/hapus_anggota', [
    'as' => 'kegiatan.anggota',
    'uses' => 'KegiatanController@anggota_proyek'
]);

Route::get('kegiatan/{id}/tambah_anggota', [
    'as' => 'kegiatan.tambah_anggota',
    'uses' => 'KegiatanController@tambah_anggota'
]);

Route::get('kegiatan/tandai_selesai/{id}', [
    'as' => 'kegiatan.tandai_selesai',
    'uses' => 'KegiatanController@tandai_selesai'
]);

Route::get('kegiatan/belum_selesai/{id}', [
    'as' => 'kegiatan.belum_selesai',
    'uses' => 'KegiatanController@belum_selesai'
]);

Route::post('kegiatan/{id}/tambah_anggota', function(\Illuminate\Http\Request $request){})->name('kegiatan.tambah_anggota_proyek')->uses('KegiatanController@tambah_anggota_proyek');

Route::get('kegiatan/{id}/hapus_anggota/{kode}')->name('kegiatan.hapus_anggota')->uses('KegiatanController@hapus_anggota_proyek');

Route::resource('proyek_progress', 'ProyekProgressController');

Route::get('proyek_progress/{id}/create', [
    'as' => 'proyek_progress.create',
    'uses' => 'ProyekProgressController@create'
]);

Route::get('proyek_progress/{id}/destroy', [
    'as' => 'proyek_progress.destroy',
    'uses' => 'ProyekProgressController@destroy'
]);

Route::resource('proyek_tugas', 'ProyekTugasController');

Route::get('proyek_tugas/{id}/kerjakan', [
    'as' => 'proyek_tugas.kerjakan',
    'uses' => 'ProyekTugasController@kerjakan'
]);

Route::get('proyek_tugas/{id}/pindah_kanan', [
    'as' => 'proyek_tugas.pindah_kanan',
    'uses' => 'ProyekTugasController@pindah_kanan'
]);

Route::get('proyek_tugas/{id}/pindah_kiri', [
    'as' => 'proyek_tugas.pindah_kiri',
    'uses' => 'ProyekTugasController@pindah_kiri'
]);

Route::get('proyek_tugas/{id}/destroy', [
    'as' => 'proyek_tugas.destroy',
    'uses' => 'ProyekTugasController@destroy'
]);

Route::group(['middleware' => 'checkRole:1'], function () {
    Route::resource('administrator', 'AdministratorController');

    Route::get('/administrator/{id}/ubah_password', [
        'as' => 'administrator.ubah_password',
        'uses' => 'AdministratorController@ubah_password'
    ]);
});

Route::group(['middleware' => 'checkRole:2'], function () {
    Route::resource('kadiv', 'KadivController');

    Route::get('/kadiv/{id}/ubah_password', [
        'as' => 'kadiv.ubah_password',
        'uses' => 'KadivController@ubah_password'
    ]);
});

Route::group(['middleware' => 'checkRole:3'], function () {
    Route::resource('pegawai', 'PegawaiController');

    Route::get('/pegawai/{id}/ubah_password', [
        'as' => 'pegawai.ubah_password',
        'uses' => 'PegawaiController@ubah_password'
    ]);
});

Route::resource('dokumen', 'DokumenController');

Route::get('dokumen/{id}-{kode}/download', [
    'as' => 'dokumen.download',
    'uses' => 'DokumenController@download'
]);

Route::get('dokumen/{id}-{kode}/show', [
    'as' => 'dokumen.show',
    'uses' => 'DokumenController@show'
]);

Route::get('dokumen/{id}-{kode}/destroy', [
    'as' => 'dokumen.destroy',
    'uses' => 'DokumenController@destroy'
]);



