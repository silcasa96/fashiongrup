<?php

namespace App\Http\Controllers;

use App\Helper_function;
use Illuminate\Http\Request;
use Auth;
use DB;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Xls;


class LaporanBarangMasukVendorController extends Controller
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
    public function lap_barang_masuk_vendor()
    {
        $id=Auth::user()->id;
        /*$sqlpo="SELECT a.seq,nomor,nama FROM pesanan_master a
                LEFT JOIN master_customer b ON b.seq=a.customer_seq
                WHERE a.jenis_so='P' AND a.tgl_hapus is null 
                ORDER BY a.seq,nomor,nama";
        $po=DB::connection('mysql_orion')->select($sqlpo);*/

        $sqlbrand="SELECT * FROM master_brand  WHERE 1=1 AND tgl_hapus is null ORDER BY kode";
        $brand=DB::connection('mysql_orion')->select($sqlbrand);

        $sqlsubbrand="SELECT * FROM master_sub_brand  WHERE 1=1 AND tgl_hapus is null ORDER BY nama";
        $subbrand=DB::connection('mysql_orion')->select($sqlsubbrand);

        $sqlartikel="SELECT DISTINCT artikel FROM master_barang WHERE 1=1 AND tgl_hapus is null GROUP BY artikel ORDER BY artikel";
        $artikel=DB::connection('mysql_orion')->select($sqlartikel);

        $sqlvendor="SELECT * FROM master_supplier  WHERE 1=1 AND tgl_hapus is null ORDER BY nama";
        $vendor=DB::connection('mysql_orion')->select($sqlvendor);

        $sqlgudang="SELECT * FROM master_gudang WHERE 1=1 AND tgl_hapus is null ORDER BY nama";
        $gudang=DB::connection('mysql_orion')->select($sqlgudang);

        //$sqlwarna="SELECT * FROM master_warna WHERE 1=1 AND tgl_hapus is null ORDER BY nama";
        //$warna=DB::connection('mysql_orion')->select($sqlwarna);

        //$sqlukuran="SELECT * FROM master_ukuran WHERE 1=1 AND tgl_hapus is null ORDER BY nama";
        //$ukuran=DB::connection('mysql_orion')->select($sqlukuran);


        $tglawal=date('d-m-Y');
        $tglakhir=date('d-m-Y');
        $idartikel='';
        $idsubbrand='';
        $idbrand='';
        $idvendor='';
        $idgudang='';
        //$idpo='';

        return view('laporan.lap_barang_masuk_vendor',compact('brand','subbrand','artikel','vendor','gudang','tglawal','tglakhir','idartikel','idsubbrand','idbrand','idvendor','idgudang'));
    }

    public function cari_barang_masuk_vendor(Request $request){
        $idvendor=$request->get('vendor');
        $idartikel=$request->get('artikel');
        if(!empty($request->get('brand'))){
            $idbrand=implode(',',$request->get('brand'));
        }else{
            $idbrand='';
        }
        if(!empty($request->get('subbrand'))){
            $idsubbrand=implode(',',$request->get('subbrand'));
        }else{
            $idsubbrand='';
        }
        if(!empty($request->get('gudang'))){
            $idgudang=implode(',',$request->get('gudang'));
        }else{
            $idgudang='';
        }

        //echo $idadmin;die;
            //$idpo=$request->get('po');
        $tglawal=date('Y-m-d',strtotime($request->get('tglawal')));
        $tglakhir=date('Y-m-d',strtotime($request->get('tglakhir')));

        $sqlbrand="SELECT * FROM master_brand  WHERE 1=1 AND tgl_hapus is null ORDER BY kode";
        $brand=DB::connection('mysql_orion')->select($sqlbrand);

        $sqlsubbrand="SELECT * FROM master_sub_brand  WHERE 1=1 AND tgl_hapus is null ORDER BY nama";
        $subbrand=DB::connection('mysql_orion')->select($sqlsubbrand);

        $sqlartikel="SELECT DISTINCT artikel FROM master_barang WHERE 1=1 AND tgl_hapus is null GROUP BY artikel ORDER BY artikel";
        $artikel=DB::connection('mysql_orion')->select($sqlartikel);

        $sqlvendor="SELECT * FROM master_supplier  WHERE 1=1 AND tgl_hapus is null ORDER BY nama";
        $vendor=DB::connection('mysql_orion')->select($sqlvendor);

        $sqlgudang="SELECT * FROM master_gudang WHERE 1=1 AND tgl_hapus is null ORDER BY nama";
        $gudang=DB::connection('mysql_orion')->select($sqlgudang);

        if(!empty($idbrand)){
            $sqlbrand1=" and l.seq IN(".$idbrand.")";
        }
        else{
            $sqlbrand1="";
        }
        if(!empty($idsubbrand)){
            $sqlsubbrand1=" and l.seq IN(".$idsubbrand.")";
        }
        else{
            $sqlsubbrand1="";
        }
        if(!empty($idgudang)){
            $sqlgudang1=" and l.seq IN(".$idgudang.")";
        }
        else{
            $sqlgudang1="";
        }

        // $sqlbarangmasukvendor="";
        // $barangmasukvendor=DB::connection('mysql_orion')->select($sqlbarangmasukvendor);
        $barangmasukvendor="";
        if($request->get('Cari')=='Cari'){
            return view('laporan.lap_barang_masuk_vendor', compact('barangmasukvendor','brand','subbrand','artikel','vendor','gudang','tglawal','tglakhir','idartikel','idsubbrand','idbrand','idvendor','idgudang'));
        }
        else if($request->get('Cari')=='Excel'){
            $nama_file = 'Laporan Barang Masuk Vendor '.date('d-m-Y', strtotime($tglawal)).' sampai '.date('d-m-Y', strtotime($tglakhir)).'.xlsx';
            $param['barangmasukvendor'] = $barangmasukvendor;
            //return Excel::download(new rpt_os_pokok_xls($param), $nama_file);
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
            $y = 0;
            $help = new Helper_function();

            $sheet->setCellValue($help->toAlpha($y) . '1', 'No');
            $y++;
            $sheet->getColumnDimension($help->toAlpha($y))->setAutoSize(true);
            $sheet->setCellValue($help->toAlpha($y) . '1', 'Tanggal');
            $y++;

            $sheet->getColumnDimension($help->toAlpha($y))->setAutoSize(true);
            $sheet->setCellValue($help->toAlpha($y) . '1', 'Nomor');
            $y++;

            $sheet->getColumnDimension($help->toAlpha($y))->setAutoSize(true);
            $sheet->setCellValue($help->toAlpha($y) . '1', 'Customer/Store');
            $y++;

            $sheet->getColumnDimension($help->toAlpha($y))->setAutoSize(true);
            $sheet->setCellValue($help->toAlpha($y) . '1', 'Barcode');
            $y++;

            $sheet->getColumnDimension($help->toAlpha($y))->setAutoSize(true);
            $sheet->setCellValue($help->toAlpha($y) . '1', 'Nama');
            $y++;

            $sheet->getColumnDimension($help->toAlpha($y))->setAutoSize(true);
            $sheet->setCellValue($help->toAlpha($y) . '1', 'Brand');
            $y++;

            $sheet->getColumnDimension($help->toAlpha($y))->setAutoSize(true);
            $sheet->setCellValue($help->toAlpha($y) . '1', 'Sub Brand');
            $y++;

            $sheet->getColumnDimension($help->toAlpha($y))->setAutoSize(true);
            $sheet->setCellValue($help->toAlpha($y) . '1', 'Warna');
            $y++;

            $sheet->getColumnDimension($help->toAlpha($y))->setAutoSize(true);
            $sheet->setCellValue($help->toAlpha($y) . '1', 'Ukuran');
            $y++;

            $sheet->getColumnDimension($help->toAlpha($y))->setAutoSize(true);
            $sheet->setCellValue($help->toAlpha($y) . '1', 'Qty');
            $y++;

            $sheet->getColumnDimension($help->toAlpha($y))->setAutoSize(true);
            $sheet->setCellValue($help->toAlpha($y) . '1', 'Status');
            $y++;

            $sheet->getColumnDimension($help->toAlpha($y))->setAutoSize(true);
            $sheet->setCellValue($help->toAlpha($y) . '1', 'Admin');
            $y++;

            $rows = 1;
            if(!empty($preorder)){
                $no = 0;
                foreach ($preorder as $data) {
                    $rows++;


                    $no++;
                    $y = 0;
                    $sheet->setCellValue($help->toAlpha($y) . $rows, $no);
                    $y++;
                    $sheet->setCellValue($help->toAlpha($y) . $rows, $data->tanggal);
                    $y++;
                    $sheet->setCellValue($help->toAlpha($y) . $rows, $data->nomor);
                    $y++;
                    $sheet->setCellValue($help->toAlpha($y) . $rows, $data->nmcustomer);
                    $y++;
                    $sheet->setCellValue($help->toAlpha($y) . $rows, $data->barcode);
                    $y++;
                    $sheet->setCellValue($help->toAlpha($y) . $rows, $data->nmproduk);
                    $y++;
                    $sheet->setCellValue($help->toAlpha($y) . $rows, $data->nmbrand);
                    $y++;
                    $sheet->setCellValue($help->toAlpha($y) . $rows, $data->nmsubbrand);
                    $y++;
                    $sheet->setCellValue($help->toAlpha($y) . $rows, $data->nmwarna);
                    $y++;
                    $sheet->setCellValue($help->toAlpha($y) . $rows, $data->nmukuran);
                    $y++;
                    $sheet->setCellValue($help->toAlpha($y) . $rows, $data->qty);
                    $y++;
                    $sheet->setCellValue($help->toAlpha($y) . $rows, $data->nmadmin);
                    $y++;
                    $sheet->setCellValue($help->toAlpha($y) . $rows, $data->status);
                    $y++;
                }
            }

            $type = 'xlsx';
            $fileName = "Lap. Pre Order ." . $type;
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

}
