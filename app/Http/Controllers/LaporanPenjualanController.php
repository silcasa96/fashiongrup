<?php

namespace App\Http\Controllers;

use App\Helper_function;
use Illuminate\Http\Request;
use Auth;
use DB;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Xls;


class LaporanPenjualanController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function lap_penjualan()
    {
        $id=Auth::user()->id;
        $sqlcustomer="SELECT * FROM master_customer  WHERE 1=1 AND tgl_hapus is null ORDER BY nama";
        $customer=DB::connection('mysql_orion')->select($sqlcustomer);

        $sqladmin="SELECT * FROM master_pegawai  WHERE 1=1 AND tgl_hapus is null AND jenis_pegawai='ADMIN' ORDER BY nama";
        $admin=DB::connection('mysql_orion')->select($sqladmin);

        $sqlsales="SELECT * FROM master_pegawai  WHERE 1=1 AND jenis_pegawai='SALES' AND tgl_hapus is null ORDER BY nama";
        $sales=DB::connection('mysql_orion')->select($sqlsales);

        $sqlbrand="SELECT * FROM master_brand  WHERE 1=1 AND tgl_hapus is null ORDER BY kode";
        $brand=DB::connection('mysql_orion')->select($sqlbrand);

        $sqlgudang="SELECT * FROM master_gudang WHERE 1=1 AND tgl_hapus is null ORDER BY nama";
        $gudang=DB::connection('mysql_orion')->select($sqlgudang);

        $sqlkeagenan="SELECT * FROM master_keagenan WHERE 1=1 AND tgl_hapus is null ORDER BY nama";
        $keagenan=DB::connection('mysql_orion')->select($sqlkeagenan);

        $sqltipeproduk="SELECT DISTINCT type_produk FROM master_barang WHERE 1=1 ORDER BY type_produk";
        $tipeproduk=DB::connection('mysql_orion')->select($sqltipeproduk);

        $tglawal=date('d-m-Y');
        $tglakhir=date('d-m-Y');
        $idcus='';
        $idadmin='';
        $idsales='';
        $idbrand='';
        $idgudang='';
        $idkeagenan='';
        $idtipeproduk='';

        return view('lap_penjualan',compact('customer','admin','sales','brand','gudang','keagenan','tipeproduk','tglawal','tglakhir','idcus','idadmin','idsales','idbrand','idgudang','idkeagenan','idtipeproduk'));
    }

    public function cari_penjualan(Request $request){
        $idcus=$request->get('customer');
        $idadmin=$request->get('admin');
        $idsales=$request->get('sales');
        $idbrand=$request->get('brand');
        $idgudang=$request->get('gudang');
        //$idkeagenan=$request->get('keagenan');
        $idtipeproduk=$request->get('tipeproduk');
        $tglawal=date('Y-m-d',strtotime($request->get('tglawal')));
        $tglakhir=date('Y-m-d',strtotime($request->get('tglakhir')));

        $sqlcustomer="SELECT * FROM master_customer  WHERE 1=1 AND tgl_hapus is null ORDER BY nama";
        $customer=DB::connection('mysql_orion')->select($sqlcustomer);

        $sqladmin="SELECT * FROM master_pegawai  WHERE 1=1 AND tgl_hapus is null AND jenis_pegawai='ADMIN' ORDER BY nama";
        $admin=DB::connection('mysql_orion')->select($sqladmin);

        $sqlsales="SELECT * FROM master_pegawai  WHERE 1=1 AND jenis_pegawai='SALES' AND tgl_hapus is null ORDER BY nama";
        $sales=DB::connection('mysql_orion')->select($sqlsales);

        $sqlbrand="SELECT * FROM master_brand  WHERE 1=1 AND tgl_hapus is null ORDER BY kode";
        $brand=DB::connection('mysql_orion')->select($sqlbrand);

        $sqlgudang="SELECT * FROM master_gudang WHERE 1=1 AND tgl_hapus is null ORDER BY nama";
        $gudang=DB::connection('mysql_orion')->select($sqlgudang);

        $sqlkeagenan="SELECT * FROM master_keagenan WHERE 1=1 AND tgl_hapus is null ORDER BY nama";
        $keagenan=DB::connection('mysql_orion')->select($sqlkeagenan);

        $sqltipeproduk="SELECT DISTINCT type_produk FROM master_barang WHERE 1=1 ORDER BY type_produk";
        $tipeproduk=DB::connection('mysql_orion')->select($sqltipeproduk);


        if(!empty($idbrand)){
            $sqlbrand=" and f.kode IN('".$idbrand."')";
        }
        else{
            $sqlbrand="";
        }

        if(!empty($idgudang)){
            $sqlgudang=" and i.kode IN('".$idgudang."')";
        }
        else{
            $sqlgudang="";
        }

        $sqlpenjualan="
SELECT b.nama as nmcustomer,FORMAT(a.tanggal,'yyyy-dd-mm') as tanggal,a.nomor,c.nomor as nosj,f.nama as nmbrand,e.barcode,e.nama as nmartikel,
case when b.jenis='AGN' then 'AGEN'
when b.jenis='SAG' then 'SUB AGEN'
when b.jenis='ONL' then 'ONLINE RETAIL'
when b.jenis='LAI' then 'LAINNYA' end as jenis,g.nama as nmadmin,h.nama as nmsales,d.qty,d.harga,d.qty*d.harga as subtotal,
d.disc2*d.qty as diskon,a.diskon_global,d.total-a.diskon_global as total,a.ongkos_kirim,a.keterangan,a.alamat_kirim,a.user_id
FROM faktur_jual_mst a
LEFT JOIN master_customer b ON b.seq=a.cust_seq
LEFT JOIN surat_jalan_mst j ON j.seq=a.sj_seq
LEFT JOIN delivery_order_mst k ON k.seq=j.do_seq
LEFT JOIN sales_order_mst c ON c.seq=k.so_seq
LEFT JOIN faktur_jual_det d ON d.master_seq=a.seq
LEFT JOIN master_barang e ON e.seq=d.barang_seq
LEFT JOIN master_brand f ON f.seq=e.brand_seq
LEFT JOIN master_pegawai g ON g.seq=a.admin_seq
LEFT JOIN master_pegawai h ON h.seq=a.sales_seq
LEFT JOIN master_gudang i ON i.seq=c.gudang_seq
WHERE a.tanggal>='".$tglawal."' AND a.tanggal<='".$tglakhir."'
AND b.kode like '%".$idcus."%' AND g.kode like '%".$idadmin."%' AND h.kode like '%".$idsales."%'
AND e.type_produk like '%".$idtipeproduk."%' ".$sqlbrand." ".$sqlgudang." 

UNION all

SELECT b.nama as nmcustomer,FORMAT(a.tanggal,'yyyy-dd-mm') as tanggal,a.nomor,null as nosj,f.nama as nmbrand,e.barcode,e.nama as nmartikel,
case when b.jenis='AGN' then 'AGEN'
when b.jenis='SAG' then 'SUB AGEN'
when b.jenis='ONL' then 'ONLINE RETAIL'
when b.jenis='LAI' then 'LAINNYA' end as jenis,a.admin as nmadmin,h.nama as nmsales,d.qty*(-1) as qty,d.harga,(d.qty*(-1))*d.harga as subtotal,(d.disc2*d.qty)*(-1) as diskon,a.diskon_global*(-1) as diskon_global,(d.total-a.diskon_global)*(-1) as total,0 as ongkos_kirim,a.keterangan,null as alamat_kirim,a.user_id 
FROM retur_jual_mst a 
LEFT JOIN master_customer b ON b.seq=a.cust_seq
LEFT JOIN faktur_jual_mst c ON c.seq=a.faktur_seq
LEFT JOIN retur_jual_det d ON d.master_seq=a.seq
LEFT JOIN master_barang e ON e.seq=d.barang_seq
LEFT JOIN master_brand f ON f.seq=e.brand_seq
LEFT JOIN master_pegawai h ON h.seq=a.sales_seq
WHERE a.tanggal>='".$tglawal."' AND a.tanggal<='".$tglakhir."'
AND b.kode like '%".$idcus."%' AND h.kode like '%".$idsales."%'
AND e.type_produk like '%".$idtipeproduk."%' ".$sqlbrand." ".$sqlgudang." 

UNION ALL

SELECT case when b.nama is null then 'CUSTOMER PUTUS' else b.nama end as nmcustomer,FORMAT(a.tanggal,'yyyy-dd-mm') as tanggal,a.nomor,null as nosj,f.nama as nmbrand,e.barcode,e.nama as nmartikel,
case when b.jenis='AGN' then 'AGEN'
when b.jenis='SAG' then 'SUB AGEN'
when b.jenis='ONL' then 'ONLINE RETAIL'
when b.jenis='LAI' then 'LAINNYA' end as jenis,g.nama as nmadmin,h.nama as nmsales,d.qty,d.harga,d.qty*d.harga as subtotal,
0 as diskon,0 as diskon_global,d.total,0 as ongkos_kirim,a.keterangan,null as alamat_kirim,a.user_id 
FROM faktur_jual_bazar_mst a 
LEFT JOIN master_customer b ON b.seq=a.cust_seq
LEFT JOIN faktur_jual_bazar_det d ON d.master_seq=a.seq
LEFT JOIN master_barang e ON e.seq=d.barang_seq
LEFT JOIN master_brand f ON f.seq=e.brand_seq
LEFT JOIN master_pegawai g ON g.seq=a.admin_seq
LEFT JOIN master_pegawai h ON h.seq=a.sales_seq
WHERE a.tanggal>='".$tglawal."' AND a.tanggal<='".$tglakhir."'
AND e.type_produk like '%".$idtipeproduk."%'
ORDER BY nomor";
        $penjualan=DB::connection('mysql_orion')->select($sqlpenjualan);

        if($request->get('Cari')=='Cari'){
            return view('lap_penjualan', compact('penjualan','customer','admin','sales','brand','gudang','keagenan','tipeproduk','tglawal','tglakhir','idcus','idadmin','idsales','idbrand','idgudang','idtipeproduk'));
        }
        else if($request->get('Cari')=='Excel'){
            $nama_file = 'Laporan Penjualan '.date('d-m-Y', strtotime($tglawal)).' sampai '.date('d-m-Y', strtotime($tglakhir)).'.xlsx';
            $param['penjualan'] = $penjualan;
            //return Excel::download(new rpt_os_pokok_xls($param), $nama_file);
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
            $y = 0;
            $help = new Helper_function();

            $sheet->setCellValue($help->toAlpha($y) . '1', 'No');
            $y++;
            $sheet->getColumnDimension($help->toAlpha($y))->setAutoSize(true);
            $sheet->setCellValue($help->toAlpha($y) . '1', 'Customer');
            $y++;

            $sheet->getColumnDimension($help->toAlpha($y))->setAutoSize(true);
            $sheet->setCellValue($help->toAlpha($y) . '1', 'Tanggal');
            $y++;

            $sheet->getColumnDimension($help->toAlpha($y))->setAutoSize(true);
            $sheet->setCellValue($help->toAlpha($y) . '1', 'No. Transaksi');
            $y++;

            $sheet->getColumnDimension($help->toAlpha($y))->setAutoSize(true);
            $sheet->setCellValue($help->toAlpha($y) . '1', 'Nomor SO');
            $y++;

            $sheet->getColumnDimension($help->toAlpha($y))->setAutoSize(true);
            $sheet->setCellValue($help->toAlpha($y) . '1', 'Brand');
            $y++;

            $sheet->getColumnDimension($help->toAlpha($y))->setAutoSize(true);
            $sheet->setCellValue($help->toAlpha($y) . '1', 'Kode');
            $y++;

            $sheet->getColumnDimension($help->toAlpha($y))->setAutoSize(true);
            $sheet->setCellValue($help->toAlpha($y) . '1', 'Artikel');
            $y++;

            $sheet->getColumnDimension($help->toAlpha($y))->setAutoSize(true);
            $sheet->setCellValue($help->toAlpha($y) . '1', 'Jenis');
            $y++;

            $sheet->getColumnDimension($help->toAlpha($y))->setAutoSize(true);
            $sheet->setCellValue($help->toAlpha($y) . '1', 'Admin');
            $y++;

            $sheet->getColumnDimension($help->toAlpha($y))->setAutoSize(true);
            $sheet->setCellValue($help->toAlpha($y) . '1', 'Sales');
            $y++;

            $sheet->getColumnDimension($help->toAlpha($y))->setAutoSize(true);
            $sheet->setCellValue($help->toAlpha($y) . '1', 'Jumlah');
            $y++;

            $sheet->getColumnDimension($help->toAlpha($y))->setAutoSize(true);
            $sheet->setCellValue($help->toAlpha($y) . '1', 'Sub Total');
            $y++;

            $sheet->getColumnDimension($help->toAlpha($y))->setAutoSize(true);
            $sheet->setCellValue($help->toAlpha($y) . '1', 'Diskon');
            $y++;

            $sheet->getColumnDimension($help->toAlpha($y))->setAutoSize(true);
            $sheet->setCellValue($help->toAlpha($y) . '1', 'Diskon Global');
            $y++;

            $sheet->getColumnDimension($help->toAlpha($y))->setAutoSize(true);
            $sheet->setCellValue($help->toAlpha($y) . '1', 'Total');
            $y++;

            $sheet->getColumnDimension($help->toAlpha($y))->setAutoSize(true);
            $sheet->setCellValue($help->toAlpha($y) . '1', 'Ongkir');
            $y++;

            $sheet->getColumnDimension($help->toAlpha($y))->setAutoSize(true);
            $sheet->setCellValue($help->toAlpha($y) . '1', 'Keterangan');
            $y++;

            $sheet->getColumnDimension($help->toAlpha($y))->setAutoSize(true);
            $sheet->setCellValue($help->toAlpha($y) . '1', 'Alamat Kirim');
            $y++;

            $sheet->getColumnDimension($help->toAlpha($y))->setAutoSize(true);
            $sheet->setCellValue($help->toAlpha($y) . '1', 'User Id');
            $y++;


            $rows = 1;
            if(!empty($penjualan)){
                $no = 0;
                foreach ($penjualan as $data) {
                    $rows++;


                    $no++;
                    $y = 0;
                    $sheet->setCellValue($help->toAlpha($y) . $rows, $no);
                    $y++;
                    $sheet->setCellValue($help->toAlpha($y) . $rows, $data->nmcustomer);
                    $y++;
                    $sheet->setCellValue($help->toAlpha($y) . $rows, $data->tanggal);
                    $y++;
                    $sheet->setCellValue($help->toAlpha($y) . $rows, $data->nomor);
                    $y++;
                    $sheet->setCellValue($help->toAlpha($y) . $rows, $data->nosj);
                    $y++;
                    $sheet->setCellValue($help->toAlpha($y) . $rows, $data->nmbrand);
                    $y++;
                    $sheet->setCellValue($help->toAlpha($y) . $rows, $data->barcode);
                    $y++;
                    $sheet->setCellValue($help->toAlpha($y) . $rows, $data->nmartikel);
                    $y++;
                    $sheet->setCellValue($help->toAlpha($y) . $rows, $data->jenis);
                    $y++;
                    $sheet->setCellValue($help->toAlpha($y) . $rows, $data->nmadmin);
                    $y++;
                    $sheet->setCellValue($help->toAlpha($y) . $rows, $data->qty);
                    $y++;
                    $sheet->setCellValue($help->toAlpha($y) . $rows, $data->subtotal);
                    $y++;
                    $sheet->setCellValue($help->toAlpha($y) . $rows, $data->diskon);
                    $y++;
                    $sheet->setCellValue($help->toAlpha($y) . $rows, $data->diskon_global);
                    $y++;
                    $sheet->setCellValue($help->toAlpha($y) . $rows, $data->total);
                    $y++;
                    $sheet->setCellValue($help->toAlpha($y) . $rows, $data->ongkos_kirim);
                    $y++;
                    $sheet->setCellValue($help->toAlpha($y) . $rows, $data->keterangan);
                    $y++;
                    $sheet->setCellValue($help->toAlpha($y) . $rows, $data->alamat_kirim);
                    $y++;
                    $sheet->setCellValue($help->toAlpha($y) . $rows, $data->user_id);
                    $y++;
                }
            }

            $type = 'xlsx';
            $fileName = "Lap. Penjualan ." . $type;
            if ($type == 'xlsx') {
                $writer = new Xlsx($spreadsheet);
            } else if ($type == 'xls') {
                $writer = new Xls($spreadsheet);
            }
            $writer->save("export/" . $fileName);
            header("Content-Type: application/vnd.ms-excel");
            return redirect(url('/') . "/export/" . $fileName);
        }
    }

    public function export_penjualan_excel(Request $request){
        $idcus=$request->get('customer');
        $idadmin=$request->get('admin');
        $idsales=$request->get('sales');
        $idbrand=$request->get('brand');
        $idgudang=$request->get('gudang');
        //$idkeagenan=$request->get('keagenan');
        $idtipeproduk=$request->get('tipeproduk');
        $tglawal=date('Y-m-d',strtotime($request->get('tglawal')));
        $tglakhir=date('Y-m-d',strtotime($request->get('tglakhir')));


        if(!empty($idbrand)){
            $sqlbrand=" and f.kode IN('".$idbrand."')";
        }
        else{
            $sqlbrand="";
        }

        if(!empty($idgudang)){
            $sqlgudang=" and i.kode IN('".$idgudang."')";
        }
        else{
            $sqlgudang="";
        }

        $spreadsheet = new Spreadsheet;
        $sheet = $spreadsheet->getActiveSheet();
        $y = 0;
        $help = new Helper_function();

        $sheet->setCellValue($help->toAlpha($y) . '1', 'No');
        $y++;
        $sheet->getColumnDimension($help->toAlpha($y))->setAutoSize(true);
        $sheet->setCellValue($help->toAlpha($y) . '1', 'Customer');
        $y++;

        $sheet->getColumnDimension($help->toAlpha($y))->setAutoSize(true);
        $sheet->setCellValue($help->toAlpha($y) . '1', 'Tanggal');
        $y++;

        $sheet->getColumnDimension($help->toAlpha($y))->setAutoSize(true);
        $sheet->setCellValue($help->toAlpha($y) . '1', 'No. Transaksi');
        $y++;

        $sheet->getColumnDimension($help->toAlpha($y))->setAutoSize(true);
        $sheet->setCellValue($help->toAlpha($y) . '1', 'No. SO');
        $y++;

        $sheet->getColumnDimension($help->toAlpha($y))->setAutoSize(true);
        $sheet->setCellValue($help->toAlpha($y) . '1', 'Brand');
        $y++;

        $sheet->getColumnDimension($help->toAlpha($y))->setAutoSize(true);
        $sheet->setCellValue($help->toAlpha($y) . '1', 'Kode');
        $y++;

        $sheet->getColumnDimension($help->toAlpha($y))->setAutoSize(true);
        $sheet->setCellValue($help->toAlpha($y) . '1', 'Nama Artikel');
        $y++;

        $sheet->getColumnDimension($help->toAlpha($y))->setAutoSize(true);
        $sheet->setCellValue($help->toAlpha($y) . '1', 'Jenis');
        $y++;

        $sheet->getColumnDimension($help->toAlpha($y))->setAutoSize(true);
        $sheet->setCellValue($help->toAlpha($y) . '1', 'Admin');
        $y++;

        $sheet->getColumnDimension($help->toAlpha($y))->setAutoSize(true);
        $sheet->setCellValue($help->toAlpha($y) . '1', 'Sales');
        $y++;

        $sheet->getColumnDimension($help->toAlpha($y))->setAutoSize(true);
        $sheet->setCellValue($help->toAlpha($y) . '1', 'Jumlah');
        $y++;

        $sheet->getColumnDimension($help->toAlpha($y))->setAutoSize(true);
        $sheet->setCellValue($help->toAlpha($y) . '1', 'Sub Total');
        $y++;

        $sheet->getColumnDimension($help->toAlpha($y))->setAutoSize(true);
        $sheet->setCellValue($help->toAlpha($y) . '1', 'Diskon');
        $y++;

        $sheet->getColumnDimension($help->toAlpha($y))->setAutoSize(true);
        $sheet->setCellValue($help->toAlpha($y) . '1', 'Diskon Global');
        $y++;

        $sheet->getColumnDimension($help->toAlpha($y))->setAutoSize(true);
        $sheet->setCellValue($help->toAlpha($y) . '1', 'Total');
        $y++;

        $sheet->getColumnDimension($help->toAlpha($y))->setAutoSize(true);
        $sheet->setCellValue($help->toAlpha($y) . '1', 'Ongkir');
        $y++;

        $sheet->getColumnDimension($help->toAlpha($y))->setAutoSize(true);
        $sheet->setCellValue($help->toAlpha($y) . '1', 'Keterangan');
        $y++;

        $sheet->getColumnDimension($help->toAlpha($y))->setAutoSize(true);
        $sheet->setCellValue($help->toAlpha($y) . '1', 'Alamat Kirim');
        $y++;

        $sheet->getColumnDimension($help->toAlpha($y))->setAutoSize(true);
        $sheet->setCellValue($help->toAlpha($y) . '1', 'User Id');
        $y++;

        $sql="SELECT b.nama as nmcustomer,FORMAT(a.tanggal,'yyyy-dd-mm') as tanggal,a.nomor,c.nomor as nosj,f.nama as nmbrand,e.barcode,e.nama as nmartikel,
case when b.jenis='AGN' then 'AGEN'
when b.jenis='SAG' then 'SUB AGEN'
when b.jenis='ONL' then 'ONLINE RETAIL'
when b.jenis='LAI' then 'LAINNYA' end as jenis,g.nama as nmadmin,h.nama as nmsales,d.qty,d.harga,d.qty*d.harga as subtotal,
d.disc2*d.qty as diskon,a.diskon_global,d.total-a.diskon_global as total,a.ongkos_kirim,a.keterangan,a.alamat_kirim,a.user_id
FROM faktur_jual_mst a
LEFT JOIN master_customer b ON b.seq=a.cust_seq
LEFT JOIN surat_jalan_mst j ON j.seq=a.sj_seq
LEFT JOIN delivery_order_mst k ON k.seq=j.do_seq
LEFT JOIN sales_order_mst c ON c.seq=k.so_seq
LEFT JOIN faktur_jual_det d ON d.master_seq=a.seq
LEFT JOIN master_barang e ON e.seq=d.barang_seq
LEFT JOIN master_brand f ON f.seq=e.brand_seq
LEFT JOIN master_pegawai g ON g.seq=a.admin_seq
LEFT JOIN master_pegawai h ON h.seq=a.sales_seq
LEFT JOIN master_gudang i ON i.seq=c.gudang_seq
WHERE a.tanggal>='".$tglawal."' AND a.tanggal<='".$tglakhir."'
AND b.kode like '%".$idcus."%' AND g.kode like '%".$idadmin."%' AND h.kode like '%".$idsales."%'
AND e.type_produk like '%".$idtipeproduk."%' ".$sqlbrand." ".$sqlgudang." 

UNION all

SELECT b.nama as nmcustomer,FORMAT(a.tanggal,'yyyy-dd-mm') as tanggal,a.nomor,null as nosj,f.nama as nmbrand,e.barcode,e.nama as nmartikel,
case when b.jenis='AGN' then 'AGEN'
when b.jenis='SAG' then 'SUB AGEN'
when b.jenis='ONL' then 'ONLINE RETAIL'
when b.jenis='LAI' then 'LAINNYA' end as jenis,a.admin as nmadmin,h.nama as nmsales,d.qty*(-1) as qty,d.harga,(d.qty*(-1))*d.harga as subtotal,(d.disc2*d.qty)*(-1) as diskon,a.diskon_global*(-1) as diskon_global,(d.total-a.diskon_global)*(-1) as total,0 as ongkos_kirim,a.keterangan,null as alamat_kirim,a.user_id 
FROM retur_jual_mst a 
LEFT JOIN master_customer b ON b.seq=a.cust_seq
LEFT JOIN faktur_jual_mst c ON c.seq=a.faktur_seq
LEFT JOIN retur_jual_det d ON d.master_seq=a.seq
LEFT JOIN master_barang e ON e.seq=d.barang_seq
LEFT JOIN master_brand f ON f.seq=e.brand_seq
LEFT JOIN master_pegawai h ON h.seq=a.sales_seq
WHERE a.tanggal>='".$tglawal."' AND a.tanggal<='".$tglakhir."'
AND b.kode like '%".$idcus."%' AND h.kode like '%".$idsales."%'
AND e.type_produk like '%".$idtipeproduk."%' ".$sqlbrand." ".$sqlgudang." 

UNION ALL

SELECT case when b.nama is null then 'CUSTOMER PUTUS' else b.nama end as nmcustomer,FORMAT(a.tanggal,'yyyy-dd-mm') as tanggal,a.nomor,null as nosj,f.nama as nmbrand,e.barcode,e.nama as nmartikel,
case when b.jenis='AGN' then 'AGEN'
when b.jenis='SAG' then 'SUB AGEN'
when b.jenis='ONL' then 'ONLINE RETAIL'
when b.jenis='LAI' then 'LAINNYA' end as jenis,g.nama as nmadmin,h.nama as nmsales,d.qty,d.harga,d.qty*d.harga as subtotal,
0 as diskon,0 as diskon_global,d.total,0 as ongkos_kirim,a.keterangan,null as alamat_kirim,a.user_id 
FROM faktur_jual_bazar_mst a 
LEFT JOIN master_customer b ON b.seq=a.cust_seq
LEFT JOIN faktur_jual_bazar_det d ON d.master_seq=a.seq
LEFT JOIN master_barang e ON e.seq=d.barang_seq
LEFT JOIN master_brand f ON f.seq=e.brand_seq
LEFT JOIN master_pegawai g ON g.seq=a.admin_seq
LEFT JOIN master_pegawai h ON h.seq=a.sales_seq
WHERE a.tanggal>='".$tglawal."' AND a.tanggal<='".$tglakhir."'
AND e.type_produk like '%".$idtipeproduk."%'
ORDER BY nomor";
//echo $sql;die;
        $row=DB::connection('mysql_orion')->select($sql);

        $rows = 1;
        if(!empty($row)){
            $no = 0;
            foreach ($row as $data) {
                $rows++;
                $no++;
                $y = 0;
                $sheet->setCellValue($help->toAlpha($y) . $rows, $no);
                $y++;
                $sheet->setCellValue($help->toAlpha($y) . $rows, $data->nmcustomer);
                $y++;
                $sheet->setCellValue($help->toAlpha($y) . $rows, $data->tanggal);
                $y++;
                $sheet->setCellValue($help->toAlpha($y) . $rows, $data->nomor);
                $y++;
                $sheet->setCellValue($help->toAlpha($y) . $rows, $data->nosj);
                $y++;
                $sheet->setCellValue($help->toAlpha($y) . $rows, $data->nmbrand);
                $y++;
                $sheet->setCellValue($help->toAlpha($y) . $rows, $data->barcode);
                $y++;
                $sheet->setCellValue($help->toAlpha($y) . $rows, $data->nmartikel);
                $y++;
                $sheet->setCellValue($help->toAlpha($y) . $rows, $data->jenis);
                $y++;
                $sheet->setCellValue($help->toAlpha($y) . $rows, $data->nmadmin);
                $y++;
                $sheet->setCellValue($help->toAlpha($y) . $rows, $data->nmsales);
                $y++;
                $sheet->setCellValue($help->toAlpha($y) . $rows, $data->qty);
                $y++;
                $sheet->setCellValue($help->toAlpha($y) . $rows, $data->harga);
                $y++;
                $sheet->setCellValue($help->toAlpha($y) . $rows, $data->subtotal);
                $y++;
                $sheet->setCellValue($help->toAlpha($y) . $rows, $data->diskon);
                $y++;
                $sheet->setCellValue($help->toAlpha($y) . $rows, $data->diskon_global);
                $y++;
                $sheet->setCellValue($help->toAlpha($y) . $rows, $data->total);
                $y++;
                $sheet->setCellValue($help->toAlpha($y) . $rows, $data->ongkos_kirim);
                $y++;
                $sheet->setCellValue($help->toAlpha($y) . $rows, $data->keterangan);
                $y++;
                $sheet->setCellValue($help->toAlpha($y) . $rows, $data->alamat_kirim);
                $y++;
                $sheet->setCellValue($help->toAlpha($y) . $rows, $data->user_id);
                $y++;
            }
        }

        $type = 'xlsx';
        $fileName = "Lap_Penjualan." . $type;
        if ($type == 'xlsx') {
            $writer = new Xlsx($spreadsheet);
        } else if ($type == 'xls') {
            $writer = new Xls($spreadsheet);
        }
        $writer->save("export/" . $fileName);
        header("Content-Type: application/vnd.ms-excel");
        return redirect(url('/') . "/export/" . $fileName);
    }
}
