<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DokumenController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BimbinganController;
use App\Http\Controllers\DosenpembimbingController;
use App\Http\Controllers\DosenpengujiController;
use App\Http\Controllers\PembimbingController;
use App\Http\Controllers\ProposalController;
use App\Http\Controllers\ProdiController;
use App\Http\Controllers\TugasakhirController;
use App\Http\Controllers\TugasController;
use App\Http\Controllers\PengajuanjudulController;
use App\Http\Controllers\ArtefakController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LupapasswordController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\KelompokController;
use App\Http\Controllers\AnggotakelompokController;
use App\Http\Controllers\PenilaianController;
use Illuminate\Support\Facades\Auth;

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

// Route::get('/', function () {
//     return view('layouts.app');
// });

Route::get('/', [LoginController::class, 'index'])->name('login');
Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('postlogin', [LoginController::class, 'postLogin'])->name('postlogin');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');
Route::resource('register', RegisterController::class);
Route::post('cekemail', [LupapasswordController::class, 'cekEmail'])->name('cekemail');
Route::resource('lupapassword', LupapasswordController::class);

Route::group(['middleware' => ['auth']], function() {
    // User
    Route::resource('user', UserController::class);

    // Dashboard
    Route::resource('dashboard', DashboardController::class);

    // Dokumen
    Route::get('dokumen/proposal', [DokumenController::class, 'proposal'])->name('dokumen.proposal');
    Route::post('dokumen/kirimproposal', [DokumenController::class, 'kirimproposal'])->name('dokumen.kirimproposal');
    Route::post('dokumen/hapusproposal', [DokumenController::class, 'hapusproposal'])->name('dokumen.hapusproposal');
    Route::get('dokumen/tugasakhir', [DokumenController::class, 'tugasakhir'])->name('dokumen.tugasakhir');
    Route::post('dokumen/kirimtugasakhir', [DokumenController::class, 'kirimtugasakhir'])->name('dokumen.kirimtugasakhir');
    Route::post('dokumen/hapustugasakhir', [DokumenController::class, 'hapustugasakhir'])->name('dokumen.hapustugasakhir');
    Route::resource('dokumen', DokumenController::class);

    // Anggota Kelompok
    Route::post('anggotakelompok/delete', [AnggotakelompokController::class, 'destroy'])->name('anggotakelompok.delete');
    Route::resource('anggotakelompok', AnggotakelompokController::class);

    // Kelompok
    Route::post('kelompok/delete', [KelompokController::class, 'destroy'])->name('kelompok.delete');
    Route::resource('kelompok', KelompokController::class);

    // Dosen Pembimbing
    Route::post('dosenpembimbing/delete', [DosenpembimbingController::class, 'destroy'])->name('dosenpembimbing.delete');
    Route::post('dosenpembimbing/pengajuan', [DosenpembimbingController::class, 'pengajuan'])->name('dosenpembimbing.pengajuan');
    Route::resource('dosenpembimbing', DosenpembimbingController::class);

    // Dosen Penguji
    Route::get('dosenpenguji/dokumen', [DosenpengujiController::class, 'dokumen'])->name('dosenpenguji.dokumen');
    Route::post('dosenpenguji/delete', [DosenpengujiController::class, 'destroy'])->name('dosenpenguji.delete');
    Route::resource('dosenpenguji', DosenpengujiController::class);

    // Pembimbing
    Route::post('pembimbing/delete', [PembimbingController::class, 'destroy'])->name('pembimbing.delete');
    Route::post('pembimbing/pengajuan', [PembimbingController::class, 'pengajuan'])->name('pembimbing.pengajuan');
    Route::resource('pembimbing', PembimbingController::class);

    // Bimbingan
    Route::post('bimbingan/delete', [BimbinganController::class, 'destroy'])->name('bimbingan.delete');
    Route::post('bimbingan/pengajuan', [BimbinganController::class, 'pengajuan'])->name('bimbingan.pengajuan');
    Route::resource('bimbingan', BimbinganController::class);

    // Proposal
    Route::post('proposal/delete', [ProposalController::class, 'destroy'])->name('proposal.delete');
    Route::resource('proposal', ProposalController::class);

    // Penilaian
    // Penilaian Seminar Proposal Penguji
    Route::post('penilaian/deletesempropenguji', [PenilaianController::class, 'destroy_sempro_penguji'])->name('penilaian.deletesempropenguji');
    Route::post('penilaian/addsempropenguji', [PenilaianController::class, 'add_sempro_penguji'])->name('penilaian.addsempropenguji');
    Route::get('penilaian/sempropenguji', [PenilaianController::class, 'sempro_penguji'])->name('penilaian.sempropenguji');
    
    Route::get('penilaian/editsempro/{id}', [PenilaianController::class, 'edit_sempro'])->name('penilaian.editsempro');
    Route::post('penilaian/updatesempro', [PenilaianController::class, 'update_sempro'])->name('penilaian.updatesempro');

    Route::get('penilaian/editseminar/{id}', [PenilaianController::class, 'edit_seminar'])->name('penilaian.editseminar');
    Route::post('penilaian/updateseminar', [PenilaianController::class, 'update_seminar'])->name('penilaian.updateseminar');

    Route::get('penilaian/editprasidang/{id}', [PenilaianController::class, 'edit_prasidang'])->name('penilaian.editprasidang');
    Route::post('penilaian/updateprasidang', [PenilaianController::class, 'update_prasidang'])->name('penilaian.updateprasidang');

    Route::get('penilaian/editsidang/{id}', [PenilaianController::class, 'edit_sidang'])->name('penilaian.editsidang');
    Route::post('penilaian/updatesidang', [PenilaianController::class, 'update_sidang'])->name('penilaian.updatesidang');

    Route::get('penilaian/editpembimbing/{id}', [PenilaianController::class, 'edit_pembimbing'])->name('penilaian.editpembimbing');
    Route::post('penilaian/updatepembimbing', [PenilaianController::class, 'update_pembimbing'])->name('penilaian.updatepembimbing');

    Route::get('penilaian/editnilaiadm/{id}', [PenilaianController::class, 'edit_nilaiadm'])->name('penilaian.editnilaiadm');
    Route::post('penilaian/updatenilaiadm', [PenilaianController::class, 'update_nilaiadm'])->name('penilaian.updatenilaiadm');
    
    // Penilaian Seminar Penguji
    Route::post('penilaian/deleteseminarpenguji', [PenilaianController::class, 'destroy_seminar_penguji'])->name('penilaian.deleteseminarpenguji');
    Route::post('penilaian/addseminarpenguji', [PenilaianController::class, 'add_seminar_penguji'])->name('penilaian.addseminarpenguji');
    Route::get('penilaian/seminarpenguji', [PenilaianController::class, 'seminar_penguji'])->name('penilaian.seminarpenguji');

    // Penilaian Seminar Proposal Pembimbing
    Route::post('penilaian/deletesempropembimbing', [PenilaianController::class, 'destroy_sempro_pembimbing'])->name('penilaian.deletesempropembimbing');
    Route::post('penilaian/addsempropembimbing', [PenilaianController::class, 'add_sempro_pembimbing'])->name('penilaian.addsempropembimbing');
    Route::get('penilaian/sempropembimbing', [PenilaianController::class, 'sempro_pembimbing'])->name('penilaian.sempropembimbing');

    // Penilaian Nilai Pembimbing TA 1
    Route::post('penilaian/deletenilaipembimbingta_1', [PenilaianController::class, 'destroy_nilai_pembimbing_ta_1'])->name('penilaian.deletenilaipembimbingta_1');
    Route::post('penilaian/addnilaipembimbingta_1', [PenilaianController::class, 'add_nilai_pembimbing_ta_1'])->name('penilaian.addnilaipembimbingta_1');
    Route::get('penilaian/nilaipembimbingta_1', [PenilaianController::class, 'nilai_pembimbing_ta_1'])->name('penilaian.nilaipembimbingta_1');

    // Penilaian Nilai Pembimbing TA 2
    Route::post('penilaian/deletenilaipembimbingta_2', [PenilaianController::class, 'destroy_nilai_pembimbing_ta_2'])->name('penilaian.deletenilaipembimbingta_2');
    Route::post('penilaian/addnilaipembimbingta_2', [PenilaianController::class, 'add_nilai_pembimbing_ta_2'])->name('penilaian.addnilaipembimbingta_2');
    Route::get('penilaian/nilaipembimbingta_2', [PenilaianController::class, 'nilai_pembimbing_ta_2'])->name('penilaian.nilaipembimbingta_2');

    // Penilaian Nilai Administrasi TA 1
    Route::post('penilaian/deletenilaiadmta_1', [PenilaianController::class, 'destroy_nilai_adm_ta_1'])->name('penilaian.deletenilaiadmta_1');
    Route::post('penilaian/addnilaiadmta_1', [PenilaianController::class, 'add_nilai_adm_ta_1'])->name('penilaian.addnilaiadmta_1');
    Route::get('penilaian/nilaiadmta_1', [PenilaianController::class, 'nilai_adm_ta_1'])->name('penilaian.nilaiadmta_1');

    // Penilaian Nilai Administrasi TA 2
    Route::post('penilaian/deletenilaiadmta_2', [PenilaianController::class, 'destroy_nilai_adm_ta_2'])->name('penilaian.deletenilaiadmta_2');
    Route::post('penilaian/addnilaiadmta_2', [PenilaianController::class, 'add_nilai_adm_ta_2'])->name('penilaian.addnilaiadmta_2');
    Route::get('penilaian/nilaiadmta_2', [PenilaianController::class, 'nilai_adm_ta_2'])->name('penilaian.nilaiadmta_2');

    // Penilaian Seminar Pembimbing
    Route::post('penilaian/deleteseminarpembimbing', [PenilaianController::class, 'destroy_seminar_pembimbing'])->name('penilaian.deleteseminarpembimbing');
    Route::post('penilaian/addseminarpembimbing', [PenilaianController::class, 'add_seminar_pembimbing'])->name('penilaian.addseminarpembimbing');
    Route::get('penilaian/seminarpembimbing', [PenilaianController::class, 'seminar_pembimbing'])->name('penilaian.seminarpembimbing');

    // Penilaian Pra Sidang Pembimbing
    Route::post('penilaian/deleteprasidangpembimbing', [PenilaianController::class, 'destroy_prasidang_pembimbing'])->name('penilaian.deleteprasidangpembimbing');
    Route::post('penilaian/addprasidangpembimbing', [PenilaianController::class, 'add_prasidang_pembimbing'])->name('penilaian.addprasidangpembimbing');
    Route::get('penilaian/prasidangpembimbing', [PenilaianController::class, 'prasidang_pembimbing'])->name('penilaian.prasidangpembimbing');

    // Penilaian Pra Sidang Penguji
    Route::post('penilaian/deleteprasidangpenguji', [PenilaianController::class, 'destroy_prasidang_penguji'])->name('penilaian.deleteprasidangpenguji');
    Route::post('penilaian/addprasidangpenguji', [PenilaianController::class, 'add_prasidang_penguji'])->name('penilaian.addprasidangpenguji');
    Route::get('penilaian/prasidangpenguji', [PenilaianController::class, 'prasidang_penguji'])->name('penilaian.prasidangpenguji');

    // Penilaian Sidang Pembimbing
    Route::post('penilaian/deletesidangpembimbing', [PenilaianController::class, 'destroy_sidang_pembimbing'])->name('penilaian.deletesidangpembimbing');
    Route::post('penilaian/addsidangpembimbing', [PenilaianController::class, 'add_sidang_pembimbing'])->name('penilaian.addsidangpembimbing');
    Route::get('penilaian/sidangpembimbing', [PenilaianController::class, 'sidang_pembimbing'])->name('penilaian.sidangpembimbing');

    // Penilaian Sidang Penguji
    Route::post('penilaian/deletesidangpenguji', [PenilaianController::class, 'destroy_sidang_penguji'])->name('penilaian.deletesidangpenguji');
    Route::post('penilaian/addsidangpenguji', [PenilaianController::class, 'add_sidang_penguji'])->name('penilaian.addsidangpenguji');
    Route::get('penilaian/sidangpenguji', [PenilaianController::class, 'sidang_penguji'])->name('penilaian.sidangpenguji');
    
    Route::post('penilaian/store_ta2', [PenilaianController::class, 'store_ta_2'])->name('penilaian.store_ta2');

    // Mengambil data nilai
    Route::get('penilaian/getnilai/{id}/{judul}', [PenilaianController::class, 'get_nilai'])->name('penilaian.getnilai');
    Route::get('penilaian/getnilai_ta2/{id}/{judul}', [PenilaianController::class, 'get_nilai_ta2'])->name('penilaian.getnilai_ta2');
    Route::get('penilaian/detailnilai/{id}', [PenilaianController::class, 'detail_nilai'])->name('penilaian.detailnilai');
    Route::get('penilaian/detailnilai_ta2/{id}', [PenilaianController::class, 'detail_nilai_ta2'])->name('penilaian.detailnilai_ta2');
    Route::get('penilaian/getadm/{id}', [PenilaianController::class, 'get_adm'])->name('penilaian.getadm');
    Route::get('penilaian/getadmta2/{id}', [PenilaianController::class, 'get_adm_ta2'])->name('penilaian.getadmta2');
    Route::get('penilaian/nilai', [PenilaianController::class, 'nilai'])->name('penilaian.nilai');
    Route::get('penilaian/nilai_ta2', [PenilaianController::class, 'nilai_ta2'])->name('penilaian.nilai_ta2');
    Route::get('penilaian/nilaita_2', [PenilaianController::class, 'nilai_ta_2'])->name('penilaian.nilaita_2');

    // Export Penilaian Excel
    Route::get('penilaian/exportta_1', [PenilaianController::class, 'export_ta_1'])->name('penilaian.exportta_1');
    Route::get('penilaian/exportta_2', [PenilaianController::class, 'export_ta_2'])->name('penilaian.exportta_2');

    // Export Penilaian PDF
    Route::get('penilaian/exportpdfta_1', [PenilaianController::class, 'export_pdf_ta_1'])->name('penilaian.exportpdfta_1');
    Route::get('penilaian/exportpdfta_2', [PenilaianController::class, 'export_pdf_ta_2'])->name('penilaian.exportpdfta_2');

    Route::post('penilaian/delete', [PenilaianController::class, 'destroy'])->name('penilaian.delete');
    Route::resource('penilaian', PenilaianController::class);

    // Tugas
    Route::get('tugas/selesai', [TugasController::class, 'selesai'])->name('tugas.selesai');
    Route::post('tugas/delete', [TugasController::class, 'destroy'])->name('tugas.delete');
    Route::post('tugas/save', [TugasController::class, 'save'])->name('tugas.save');
    Route::post('tugas/ubah', [TugasController::class, 'update'])->name('tugas.ubah');
    Route::resource('tugas', TugasController::class);

    // Tugas Akhir
    Route::post('tugasakhir/delete', [TugasakhirController::class, 'destroy'])->name('tugasakhir.delete');
    Route::post('tugasakhir/kirim', [TugasakhirController::class, 'kirim'])->name('tugasakhir.kirim');
    Route::resource('tugasakhir', TugasakhirController::class);

    // Pengajuan Judul
    Route::post('pengajuanjudul/delete', [PengajuanjudulController::class, 'destroy'])->name('pengajuanjudul.delete');
    Route::post('pengajuanjudul/pengajuan', [PengajuanjudulController::class, 'pengajuan'])->name('pengajuanjudul.pengajuan');
    Route::resource('pengajuanjudul', PengajuanjudulController::class);

    // Artefak
    Route::resource('artefak', ArtefakController::class);

    // Pengumuman
    Route::post('pengumuman/delete', [PengumumanController::class, 'destroy'])->name('pengumuman.delete');
    Route::post('pengumuman/ubah', [PengumumanController::class, 'update'])->name('pengumuman.ubah');
    Route::resource('pengumuman', PengumumanController::class);
});

