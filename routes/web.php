<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//SYnc Produk
Route::get('/sync_produk', [App\Http\Controllers\SyncProdukController::class, 'index'])->name('sync_produk');
Route::post('/start_sync_produk', [App\Http\Controllers\SyncProdukController::class, 'start_sync_produk'])->name('start_sync_produk');

//lap penjualan
Route::get('/lap_penjualan', [App\Http\Controllers\LaporanPenjualanController::class, 'lap_penjualan'])->name('lap_penjualan');
Route::get('/cari_penjualan', [App\Http\Controllers\LaporanPenjualanController::class, 'cari_penjualan'])->name('cari_penjualan');
Route::get('/export_penjualan_excel', [App\Http\Controllers\LaporanPenjualanController::class, 'export_penjualan_excel'])->name('export_penjualan_excel');

//lap retur penjualan
Route::get('/lap_retur_penjualan', [App\Http\Controllers\LaporanReturPenjualanController::class, 'lap_retur_penjualan'])->name('lap_retur_penjualan');
Route::get('/cari_retur_penjualan', [App\Http\Controllers\LaporanReturPenjualanController::class, 'cari_retur_penjualan'])->name('cari_retur_penjualan');
Route::get('/export_retur_penjualan', [App\Http\Controllers\LaporanReturPenjualanController::class, 'export_retur_penjualan'])->name('export_retur_penjualan');

//lap histori Login
Route::get('/lap_histori_login', [App\Http\Controllers\HistoriLoginController::class, 'lap_histori_login'])->name('lap_histori_login');
Route::get('/cari_histori_login', [App\Http\Controllers\HistoriLoginController::class, 'cari_histori_login'])->name('cari_histori_login');
Route::get('/export_histori_login', [App\Http\Controllers\HistoriLoginController::class, 'export_histori_login'])->name('export_histori_login');

//lap histori edit hapus
Route::get('/lap_histori_edit_hapus', [App\Http\Controllers\HistoriLoginController::class, 'lap_histori_edit_hapus'])->name('lap_histori_edit_hapus');
Route::get('/cari_histori_edit_hapus', [App\Http\Controllers\HistoriLoginController::class, 'cari_histori_edit_hapus'])->name('cari_histori_edit_hapus');
Route::get('/export_histori_edit_hapus', [App\Http\Controllers\HistoriLoginController::class, 'export_histori_edit_hapus'])->name('export_histori_edit_hapus');

//lap histori edit hapus
Route::get('/lap_rekap_sarimbit', [App\Http\Controllers\LaporanRekapSarimbitController::class, 'lap_rekap_sarimbit'])->name('lap_rekap_sarimbit');
Route::get('/cari_rekap_sarimbit', [App\Http\Controllers\LaporanRekapSarimbitController::class, 'cari_rekap_sarimbit'])->name('cari_rekap_sarimbit');
Route::get('/export_rekap_sarimbit', [App\Http\Controllers\LaporanRekapSarimbitController::class, 'export_rekap_sarimbit'])->name('export_rekap_sarimbit');

//lap preorder
Route::get('/lap_preorder', [App\Http\Controllers\LaporanPreOrderController::class, 'lap_preorder'])->name('lap_preorder');
Route::get('/cari_preorder', [App\Http\Controllers\LaporanPreOrderController::class, 'cari_preorder'])->name('cari_preorder');
Route::get('/export_preorder', [App\Http\Controllers\LaporanPreOrderController::class, 'export_preorder'])->name('export_preorder');

//lap preorder
Route::get('/lap_perbandingan_po_vendor', [App\Http\Controllers\LaporanPerbandinganPoVendorController::class, 'index'])->name('lap_perbandingan_po_vendor');
Route::get('/lap_barmas_produksi', [App\Http\Controllers\LaporanBarmasProduksiController::class, 'index'])->name('lap_barmas_produksi');
Route::get('/lap_barmasVendor', [App\Http\Controllers\LaporanBarmasVendorController::class, 'index'])->name('lap_barmas_vendor');
Route::get('/barmas_produksi_vendor', [App\Http\Controllers\BarmasProdkusiVendorController::class, 'index'])->name('barmas_produksi_vendor');

//keuangan agen

Route::get('/rekap_piutang', [App\Http\Controllers\KeuanganRekapPiutangController::class, 'index'])->name('rekap_piutang');
Route::get('/kartu_piutang', [App\Http\Controllers\KeuanganKartuPiutangController::class, 'index'])->name('kartu_piutang');
Route::get('/komisi', [App\Http\Controllers\KeuangankomisiController::class, 'index'])->name('komisi');
Route::get('/rekap_deposit', [App\Http\Controllers\KeuanganRekapDepositController::class, 'index'])->name('rekap_deposit');
Route::get('/kartu_deposit', [App\Http\Controllers\KeuanganKartuDepositController::class, 'index'])->name('kartu_deposit');
Route::get('/lap_net_sales_harga_transfer', [App\Http\Controllers\KeuanganLapNetSalesHargaTransferController::class, 'index'])->name('lap_net_sales_harga_transfer');
Route::get('/fa_agen_pusat', [App\Http\Controllers\KeuanganfaAgenPusatController::class, 'index'])->name('fa_agen_pusat');

//keuangan produksi vendor
Route::get('/rekap_hutang_vendor', [App\Http\Controllers\KeuanganRekapHutangVendorController::class, 'index'])->name('rekap_hutang_vendor');
Route::get('/kartu_hutang_vendor', [App\Http\Controllers\KeuanganKartuHutangVendorController::class, 'index'])->name('kartu_hutang_vendor');

//laporan penjualan
Route::get('/rangking_produk', [App\Http\Controllers\LapPenjualanRangkingProdukController::class, 'index'])->name('rangking_produk');
Route::get('/inventory_gudang', [App\Http\Controllers\LapPenjualanInventoryGudangController::class, 'index'])->name('inventory_gudang');
Route::get('/rangking_mitra', [App\Http\Controllers\LapPenjualanRangkingMitraController::class, 'index'])->name('rangking_mitra');
Route::get('/penjualan_costumer', [App\Http\Controllers\LapPenjualanPenjualan_costumerController::class, 'index'])->name('penjualan_costumer');
Route::get('/lap_retur_penjualan', [App\Http\Controllers\LapPenjualanReturPenjualanController::class, 'index'])->name('lap_retur_penjualan');
Route::get('/point_customer', [App\Http\Controllers\LapPenjualanPointCustomerController::class, 'index'])->name('point_customer');
Route::get('/lap_penyerapan_produk', [App\Http\Controllers\LapPenjualanPenyerapanProdukController::class, 'index'])->name('lap_penyerapan_produk');
Route::get('/penjualan_bazar', [App\Http\Controllers\LapPenjualanPenjualanBazarController::class, 'index'])->name('penjualan_bazar');
Route::get('/penjualan_agen_pusat', [App\Http\Controllers\LapPenjualanPenjualanAgenPusatController::class, 'index'])->name('penjualan_agen_pusat');
Route::get('/penjualan_agen_pusat', [App\Http\Controllers\LapPenjualanPenjualanAgenPusatController::class, 'index'])->name('penjualan_agen_pusat');

//lap barang masuk vendor
Route::get('/pencapaian_sales', [App\Http\Controllers\PencapaianSalesController::class, 'index'])->name('pencapaian_sales');
Route::get('/penjualan_sales_dari_stok', [App\Http\Controllers\PenjualanSalesDariStokController::class, 'index'])->name('penjualan_sales_dari_stok');

//lap Laporan Stok FGW
Route::get('/rekap_stok', [App\Http\Controllers\FgwRekapStokController::class, 'index'])->name('rekap_stok');
Route::get('/kartu_stok', [App\Http\Controllers\FgwKartuStokController::class, 'index'])->name('kartu_stok');
Route::get('/persediaan_akhir_barang', [App\Http\Controllers\FgwPersediaanAkhirBarangController::class, 'index'])->name('persediaan_akhir_barang');
Route::get('/detail_rekap_stok', [App\Http\Controllers\FgwDetailRekapStokController::class, 'index'])->name('detail_rekap_stok');
Route::get('/laporan_inventory', [App\Http\Controllers\FgwLaporanInvetoryController::class, 'index'])->name('laporan_inventory');
Route::get('/data_stok', [App\Http\Controllers\FgwDataStokController::class, 'index'])->name('data_stok');
Route::get('/lap_perbandingan_barmas_barkel', [App\Http\Controllers\FgwLapPerbandinganBarmasBarkelController::class, 'index'])->name('lap_perbandingan_barmas_barkel');


//User
Route::get('/user', [App\Http\Controllers\UserController::class, 'index'])->name('user');
Route::get('/add_user', [App\Http\Controllers\UserController::class, 'create'])->name('add_user');
Route::post('/store_user', [App\Http\Controllers\UserController::class, 'store'])->name('store_user');
Route::get('/edit_user/{id}', [App\Http\Controllers\UserController::class, 'edit'])->name('edit_user');
Route::post('/update_user/{id}', [App\Http\Controllers\UserController::class, 'update'])->name('update_user');
Route::get('/destroy_user/{id}', [App\Http\Controllers\UserController::class, 'destroy'])->name('destroy_user');

//Role
Route::get('/role', [App\Http\Controllers\RoleController::class, 'index'])->name('role');
Route::get('/add_role', [App\Http\Controllers\RoleController::class, 'create'])->name('add_role');
Route::post('/store_role', [App\Http\Controllers\RoleController::class, 'store'])->name('store_role');
Route::get('/edit_role/{id}', [App\Http\Controllers\RoleController::class, 'edit'])->name('edit_role');
Route::post('/update_role/{id}', [App\Http\Controllers\RoleController::class, 'update'])->name('update_role');
Route::post('/destroy_role/{id}', [App\Http\Controllers\RoleController::class, 'destroy'])->name('destroy_role');

// MENU SAMPLE

// Sample
Route::get('sample', [App\Http\Controllers\SampleController::class, 'index'])->name('sample');
Route::get('sample/create', [App\Http\Controllers\SampleController::class, 'store'])->name('sample.store');
Route::get('sample/edit/{id}', [App\Http\Controllers\SampleController::class, 'edit'])->name('sample.edit');
Route::get('sample/destroy', [App\Http\Controllers\SampleController::class, 'destroy'])->name('sample.destroy');

// Worksheet
Route::get('worksheet', [App\Http\Controllers\WorksheetController::class, 'index'])->name('worksheet');
Route::get('worksheet/create', [App\Http\Controllers\WorksheetController::class, 'store'])->name('worksheet.store');
Route::get('worksheet/edit/{id}', [App\Http\Controllers\WorksheetController::class, 'edit'])->name('worksheet.edit');
Route::get('worksheet/destroy', [App\Http\Controllers\WorksheetController::class, 'destroy'])->name('worksheet.destroy');

// Approval Sample
Route::get('appr_sample', [App\Http\Controllers\ApprovalSampleController::class, 'index'])->name('appr_sample');
Route::get('appr_sample/create', [App\Http\Controllers\ApprovalSampleController::class, 'store'])->name('appr_sample.store');
Route::get('appr_sample/edit/{id}', [App\Http\Controllers\ApprovalSampleController::class, 'edit'])->name('appr_sample.edit');
Route::get('appr_sample/destroy', [App\Http\Controllers\ApprovalSampleController::class, 'destroy'])->name('appr_sample.destroy');

// Approval Sample HPP
Route::get('appr_sample_hpp', [App\Http\Controllers\ApprovalSampleHPPController::class, 'index'])->name('appr_sample_hpp');
Route::get('appr_sample_hpp/create', [App\Http\Controllers\ApprovalSampleHPPController::class, 'store'])->name('appr_sample_hpp.store');
Route::get('appr_sample_hpp/edit/{id}', [App\Http\Controllers\ApprovalSampleHPPController::class, 'edit'])->name('appr_sample_hpp.edit');
Route::get('appr_sample_hpp/destroy', [App\Http\Controllers\ApprovalSampleHPPController::class, 'destroy'])->name('appr_sample_hpp.destroy');

// Permintaan Material Sample
Route::get('permintaanmaterialsample', [App\Http\Controllers\PermintaanMaterialSampleController::class, 'index'])->name('permintaanmaterialsample');
Route::get('permintaanmaterialsample/create', [App\Http\Controllers\PermintaanMaterialSampleController::class, 'store'])->name('permintaanmaterialsample.store');
Route::get('permintaanmaterialsample/print', [App\Http\Controllers\PermintaanMaterialSampleController::class, 'print'])->name('permintaanmaterialsample.print');
Route::get('permintaanmaterialsample/edit/{id}', [App\Http\Controllers\PermintaanMaterialSampleController::class, 'edit'])->name('permintaanmaterialsample.edit');
Route::get('permintaanmaterialsample/destroy', [App\Http\Controllers\PermintaanMaterialSampleController::class, 'destroy'])->name('permintaanmaterialsample.destroy');


// MENU DESAIN

// Master Desain
Route::get('m_designer', [App\Http\Controllers\DesainerController::class, 'index'])->name('m_designer');
Route::get('create_designer', [App\Http\Controllers\DesainerController::class, 'create'])->name('create_designer');
Route::post('store_designer', [App\Http\Controllers\DesainerController::class, 'store'])->name('store_designer');
Route::get('edit_designer/{id}', [App\Http\Controllers\DesainerController::class, 'edit'])->name('edit_designer');
Route::post('update_designer/{id}', [App\Http\Controllers\DesainerController::class, 'update'])->name('update_designer');
Route::get('destroy_designer/{id}', [App\Http\Controllers\DesainerController::class, 'destroy'])->name('destroy_designer');

// Desain
Route::get('design', [App\Http\Controllers\DesainController::class, 'index'])->name('design');
Route::get('create_design', [App\Http\Controllers\DesainController::class, 'create'])->name('create_design');
Route::post('store_design', [App\Http\Controllers\DesainController::class, 'store'])->name('store_design');
Route::get('download_design/{id}', [App\Http\Controllers\DesainController::class, 'download'])->name('download_design');
Route::get('edit_design/{id}', [App\Http\Controllers\DesainController::class, 'edit'])->name('edit_design');
Route::get('edit_designer/{id}', [App\Http\Controllers\DesainController::class, 'edit_designer'])->name('edit_designer');
Route::post('edit_nama_designer/{id}', [App\Http\Controllers\DesainController::class, 'edit_nama_designer'])->name('edit_nama_designer');
Route::get('lihat_design/{id}', [App\Http\Controllers\DesainController::class, 'show'])->name('lihat_design');
Route::post('update_design/{id}', [App\Http\Controllers\DesainController::class, 'update'])->name('update_design');
Route::get('destroy_design/{id}', [App\Http\Controllers\DesainController::class, 'destroy'])->name('destroy_design');
Route::get('cari_kode/{id}', [App\Http\Controllers\DesainController::class, 'cari_kode'])->name('cari_kode');
Route::get('download_design/{id}', [App\Http\Controllers\DesainController::class, 'download_design'])->name('download_design');

// Form Intruksi Design
Route::get('f-intruksidesign', [App\Http\Controllers\FormIntruksiDesignController::class, 'index'])->name('f-intruksidesign');
Route::get('f-intruksidesign/create', [App\Http\Controllers\FormIntruksiDesignController::class, 'store'])->name('f-intruksidesign.store');
Route::get('f-intruksidesign/print', [App\Http\Controllers\FormIntruksiDesignController::class, 'print'])->name('f-intruksidesign.print');
Route::get('f-intruksidesign/edit/{id}', [App\Http\Controllers\FormIntruksiDesignController::class, 'edit'])->name('f-intruksidesign.edit');
Route::get('f-intruksidesign/destroy', [App\Http\Controllers\FormIntruksiDesignController::class, 'destroy'])->name('f-intruksidesign.destroy');

// Form Intruksi Design
Route::get('f-intruksippic', [App\Http\Controllers\FormIntruksippicController::class, 'index'])->name('f-intruksippic');
Route::get('f-intruksippic/create', [App\Http\Controllers\FormIntruksippicController::class, 'store'])->name('f-intruksippic.store');
Route::get('f-intruksippic/print', [App\Http\Controllers\FormIntruksippicController::class, 'print'])->name('f-intruksippic.print');
Route::get('f-intruksippic/edit/{id}', [App\Http\Controllers\FormIntruksippicController::class, 'edit'])->name('f-intruksippic.edit');
Route::get('f-intruksippic/destroy', [App\Http\Controllers\FormIntruksippicController::class, 'destroy'])->name('f-intruksippic.destroy');

// Nama Desain
Route::get('namadesign', [App\Http\Controllers\NamaDesainController::class, 'index'])->name('namadesign');
Route::get('create_namadesign', [App\Http\Controllers\NamaDesainController::class, 'create'])->name('create_namadesign');
Route::post('store_namadesign', [App\Http\Controllers\NamaDesainController::class, 'store'])->name('store_namadesign');
Route::get('edit_namadesign/{id}', [App\Http\Controllers\NamaDesainController::class, 'edit'])->name('edit_namadesign');
Route::post('update_namadesign/{id}', [App\Http\Controllers\NamaDesainController::class, 'update'])->name('update_namadesign');
Route::get('destroy_namadesign/{id}', [App\Http\Controllers\NamaDesainController::class, 'destroy'])->name('destroy_namadesign');

// Approval Desain
Route::get('appr_design', [App\Http\Controllers\ApprovalDesainController::class, 'index'])->name('appr_design');
Route::get('appr_design_show/{id}', [App\Http\Controllers\ApprovalDesainController::class, 'show'])->name('appr_design_show');
Route::get('appr_design_approve/{id}', [App\Http\Controllers\ApprovalDesainController::class, 'edit'])->name('appr_design_approve');
Route::post('update_appr_design', [App\Http\Controllers\ApprovalDesainController::class, 'update'])->name('update_appr_design');
Route::get('cari_kode_design/{id}', [App\Http\Controllers\ApprovalDesainController::class, 'cari_kode_design'])->name('cari_kode_design');
// Menu Merchandise

// PO Produksi
Route::get('poproduksi', [App\Http\Controllers\POProduksiController::class, 'index'])->name('poproduksi');
Route::get('poproduksi/create', [App\Http\Controllers\POProduksiController::class, 'store'])->name('poproduksi.store');
Route::get('poproduksi/print', [App\Http\Controllers\POProduksiController::class, 'print'])->name('poproduksi.print');
Route::get('poproduksi/edit/{id}', [App\Http\Controllers\POProduksiController::class, 'edit'])->name('poproduksi.edit');
Route::get('poproduksi/destroy', [App\Http\Controllers\POProduksiController::class, 'destroy'])->name('poproduksi.destroy');

// Jadwal Produksi
Route::get('jadwalproduksi', [App\Http\Controllers\JadwalProduksiController::class, 'index'])->name('jadwalproduksi');
Route::get('jadwalproduksi/create', [App\Http\Controllers\JadwalProduksiController::class, 'store'])->name('jadwalproduksi.store');
Route::get('jadwalproduksi/print', [App\Http\Controllers\JadwalProduksiController::class, 'print'])->name('jadwalproduksi.print');
Route::get('jadwalproduksi/edit/{id}', [App\Http\Controllers\JadwalProduksiController::class, 'edit'])->name('jadwalproduksi.edit');
Route::get('jadwalproduksi/destroy', [App\Http\Controllers\JadwalProduksiController::class, 'destroy'])->name('jadwalproduksi.destroy');