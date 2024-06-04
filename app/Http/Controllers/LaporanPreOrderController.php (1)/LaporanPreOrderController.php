<?php

namespace App\Http\Controllers;

use App\Helper_function;
use Illuminate\Http\Request;
use Auth;
use DB;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Xls;


class LaporanPreOrderController extends Controller
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
    public function lap_preorder()
    {
        $id=Auth::user()->id;
        /*$sqlpo="SELECT a.seq,nomor,nama FROM pesanan_master a
                LEFT JOIN master_customer b ON b.seq=a.customer_seq
                WHERE a.jenis_so='P' AND a.tgl_hapus is null 
                ORDER BY a.seq,nomor,nama";
        $po=DB::connection()->select($sqlpo);*/

        //$sqlbrand="SELECT * FROM master_brand  WHERE 1=1 AND tgl_hapus is null ORDER BY kode";
        //$brand=DB::connection()->select($sqlbrand);

        //$sqlsubbrand="SELECT * FROM master_sub_brand  WHERE 1=1 AND tgl_hapus is null ORDER BY nama";
        //$subbrand=DB::connection()->select($sqlsubbrand);

        //$sqlbarang="SELECT * FROM master_barang WHERE 1=1 AND tgl_hapus is null ORDER BY nama";
        //$barang=DB::connection()->select($sqlbarang);

        $sqlcustomer="SELECT * FROM master_customer  WHERE 1=1 AND tgl_hapus is null ORDER BY nama";
        $customer=DB::connection()->select($sqlcustomer);

        $sqladmin="SELECT * FROM master_pegawai  WHERE 1=1 AND tgl_hapus is null AND jenis_pegawai='ADMIN' ORDER BY nama";
        $admin=DB::connection()->select($sqladmin);

        //$sqlwarna="SELECT * FROM master_warna WHERE 1=1 AND tgl_hapus is null ORDER BY nama";
        //$warna=DB::connection()->select($sqlwarna);

        //$sqlukuran="SELECT * FROM master_ukuran WHERE 1=1 AND tgl_hapus is null ORDER BY nama";
        //$ukuran=DB::connection()->select($sqlukuran);


        $tglawal=date('d-m-Y');
        $tglakhir=date('d-m-Y');
        $idcus='';
        $idadmin='';
        //$idbarang='';
        //$idsubbrand='';
        //$idbrand='';
        //$idwarna='';
        //$idukuran='';
        //$idpo='';

        return view('lap_preorder',compact('customer','admin','tglawal','tglakhir','idcus','idadmin'));
    }

    public function cari_preorder(Request $request){
        $idcus=$request->get('customer');
        if(!empty($request->get('admin'))){
            $idadmin=implode(',',$request->get('admin'));
        }else{
            $idadmin='';
        }

        //echo $idadmin;die;
            //$idpo=$request->get('po');
        $tglawal=date('Y-m-d',strtotime($request->get('tglawal')));
        $tglakhir=date('Y-m-d',strtotime($request->get('tglakhir')));

        $sqlcustomer="SELECT * FROM master_customer  WHERE 1=1 AND tgl_hapus is null ORDER BY nama";
        $customer=DB::connection()->select($sqlcustomer);

        $sqladmin="SELECT * FROM master_pegawai  WHERE 1=1 AND tgl_hapus is null AND jenis_pegawai='ADMIN' ORDER BY nama";
        $admin=DB::connection()->select($sqladmin);

        if(!empty($idadmin)){
            $sqladm=" and l.seq IN(".$idadmin.")";
        }
        else{
            $sqladm="";
        }

        $sqlpreorder="
SELECT 
DATE_FORMAT(d.tanggal, '%Y %m %d')
 as tanggal,d.nomor,e.nama as nmcustomer,f.barcode,f.nama as nmproduk,g.nama as nmbrand,h.nama as nmsubbrand,i.nama as nmwarna,j.nama as nmukuran,c.qty,l.nama as nmadmin,case when k.isaccso='F' then 'Sudah ACC' when k.isaccso='T' then 'Belum ACC' else 'Proses' end as status
FROM preorder_master a
LEFT JOIN preorder_detail b ON b.master_seq=a.seq
LEFT JOIN pesanan_detail c ON c.barang_seq=b.barang_seq
LEFT JOIN pesanan_master d ON d.seq=c.master_seq
LEFT JOIN master_customer e ON e.seq=d.customer_seq
LEFT JOIN master_barang f ON f.seq=c.barang_seq
LEFT JOIN master_brand g ON g.seq=f.brand_seq
LEFT JOIN master_sub_brand h ON h.seq=f.sub_brand_seq
LEFT JOIN master_warna i ON i.seq=f.warna_seq
LEFT JOIN master_ukuran j ON j.seq=f.ukuran_seq
LEFT JOIN sales_order_mst k ON k.nomor=d.nomor
LEFT JOIN master_pegawai l ON l.seq=k.admin_seq
WHERE 1=1 AND a.berlaku_dari>='".$tglawal."' AND a.berlaku_sampai<='".$tglakhir."' AND d.jenis_so='P' 
AND d.status IN('P') ".$sqladm." AND e.kode like '%".$idcus."%'
ORDER BY d.nomor";
        $preorder=DB::connection()->select($sqlpreorder);

        $sqlpreorder1="
SELECT 
FORMAT(a.berlaku_dari,'dd-mm-yyyy hh:ii') ||' - '|| FORMAT(a.berlaku_sampai,'dd-mm-yyyy hh:ii') as tanggal,f.barcode,f.nama as nmproduk,g.nama as nmbrand,h.nama as nmsubbrand,i.nama as nmwarna,j.nama as nmukuran, 0 as qty_stok,0 as terpesan,0 as terpenuhi,0 as sisa,0 as tidak_terpenuhi,a.keterangan
FROM preorder_master a
LEFT JOIN preorder_detail b ON b.master_seq=a.seq
LEFT JOIN master_barang f ON f.seq=b.barang_seq
LEFT JOIN master_brand g ON g.seq=f.brand_seq
LEFT JOIN master_sub_brand h ON h.seq=f.sub_brand_seq
LEFT JOIN master_warna i ON i.seq=f.warna_seq
LEFT JOIN master_ukuran j ON j.seq=f.ukuran_seq
WHERE 1=1 AND a.berlaku_dari>='".$tglawal."' AND a.berlaku_sampai<='".$tglakhir."' 
ORDER BY a.berlaku_dari";
        $preorder1=DB::connection()->select($sqlpreorder1);

        if($request->get('Cari')=='Cari'){
            return view('lap_preorder', compact('preorder','preorder1','customer','admin','tglawal','tglakhir','idcus','idadmin'));
        }
        else if($request->get('Cari')=='Excel'){
            $nama_file = 'Laporan Pre Order '.date('d-m-Y', strtotime($tglawal)).' sampai '.date('d-m-Y', strtotime($tglakhir)).'.xlsx';
            $param['preorder'] = $preorder;
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
