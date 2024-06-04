<?php

namespace App\Http\Controllers;

use App\Helper_function;
use Illuminate\Http\Request;
use Auth;
use DB;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Xls;


class LaporanRekapSarimbitController extends Controller
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
    public function lap_rekap_sarimbit()
    {
        $id=Auth::user()->id;
        $sqlsarimbit="SELECT * FROM setting_sarimbit_master  WHERE 1=1 AND tgl_hapus is null ORDER BY nama";
        $sarimbit=DB::connection('mysql_orion')->select($sqlsarimbit);

        $sqlgudang="SELECT * FROM master_gudang WHERE 1=1 AND tgl_hapus is null ORDER BY nama";
        $gudang=DB::connection('mysql_orion')->select($sqlgudang);

        $sqlkeagenan="SELECT * FROM master_keagenan WHERE 1=1 AND tgl_hapus is null ORDER BY nama";
        $keagenan=DB::connection('mysql_orion')->select($sqlkeagenan);

        $idgudang='';
        $idkeagenan='';
        $idsarimbit='';

        return view('laporan.lap_rekap_sarimbit',compact('gudang','keagenan','idgudang','idkeagenan','sarimbit','idsarimbit'));
    }

    public function cari_rekap_sarimbit(Request $request){

        if(!empty($request->get('gudang'))){
            $idgudang=implode(',',$request->get('gudang'));
        }else{
            $idgudang='';
        }

        if(!empty($request->get('keagenan'))){
            $idkeagenan=implode(',',$request->get('keagenan'));
        }else{
            $idkeagenan='';
        }

        $idsarimbit=$request->get('sarimbit');

        $sqlgudang="SELECT * FROM master_gudang WHERE 1=1 AND tgl_hapus is null ORDER BY nama";
        $gudang=DB::connection('mysql_orion')->select($sqlgudang);

        $sqlkeagenan="SELECT * FROM master_keagenan WHERE 1=1 AND tgl_hapus is null ORDER BY nama";
        $keagenan=DB::connection('mysql_orion')->select($sqlkeagenan);

        $sqlsarimbit="SELECT * FROM setting_sarimbit_master  WHERE 1=1 AND tgl_hapus is null ORDER BY nama";
        $sarimbit=DB::connection('mysql_orion')->select($sqlsarimbit);

        if(!empty($idkeagenan)){
            $sqlagen=" and h.seq IN(".$idkeagenan.")";
        }
        else{
            $sqlagen="";
        }

        if(!empty($idgudang)){
            $sqlgudang=" and i.seq IN('".$idgudang."')";
        }
        else{
            $sqlgudang="";
        }

        $sqlrekap_sarimbit="
SELECT  a.nama as nmsarimbit,c.barcode,c.nama as nmproduk,g.nama as nmsubbrand,c.artikel,e.nama as nmwarna,f.nama as nmukuran,c.tgl_release,0 as stok,a.keterangan
FROM setting_sarimbit_master a
LEFT JOIN setting_sarimbit_detail b ON b.master_seq=a.seq
LEFT JOIN master_barang c ON c.seq=b.barang_seq
LEFT JOIN master_brand d ON d.seq=c.brand_seq
LEFT JOIN master_warna e ON e.seq=c.warna_seq
LEFT JOIN master_ukuran f ON f.seq=c.ukuran_seq
LEFT JOIN master_sub_brand g ON g.seq=c.sub_brand_seq
LEFT JOIN master_keagenan h ON h.seq=a.keagenan_seq
WHERE 1=1 AND a.nama like '%".$idsarimbit."%' AND a.tgl_hapus is null
".$sqlagen."
ORDER BY a.nama,c.barcode,c.nama";
        $rekap_sarimbit=DB::connection('mysql_orion')->select($sqlrekap_sarimbit);

        if($request->get('Cari')=='Cari'){
            return view('laporan.lap_rekap_sarimbit', compact('gudang','keagenan','idsarimbit','idgudang','idkeagenan','sarimbit','rekap_sarimbit'));
        }
        else if($request->get('Cari')=='Excel'){
            $nama_file = 'Laporan Rekap Sarimbit.xlsx';
            $param['rekap_sarimbit'] = $rekap_sarimbit;
            //return Excel::download(new rpt_os_pokok_xls($param), $nama_file);
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
            $y = 0;
            $help = new Helper_function();

            $sheet->setCellValue($help->toAlpha($y) . '1', 'No');
            $y++;
            $sheet->getColumnDimension($help->toAlpha($y))->setAutoSize(true);
            $sheet->setCellValue($help->toAlpha($y) . '1', 'Nama Sarimbit');
            $y++;

            $sheet->getColumnDimension($help->toAlpha($y))->setAutoSize(true);
            $sheet->setCellValue($help->toAlpha($y) . '1', 'Barcode');
            $y++;

            $sheet->getColumnDimension($help->toAlpha($y))->setAutoSize(true);
            $sheet->setCellValue($help->toAlpha($y) . '1', 'Barang');
            $y++;

            $sheet->getColumnDimension($help->toAlpha($y))->setAutoSize(true);
            $sheet->setCellValue($help->toAlpha($y) . '1', 'Sub Brand');
            $y++;

            $sheet->getColumnDimension($help->toAlpha($y))->setAutoSize(true);
            $sheet->setCellValue($help->toAlpha($y) . '1', 'Artikel');
            $y++;

            $sheet->getColumnDimension($help->toAlpha($y))->setAutoSize(true);
            $sheet->setCellValue($help->toAlpha($y) . '1', 'Warna');
            $y++;

            $sheet->getColumnDimension($help->toAlpha($y))->setAutoSize(true);
            $sheet->setCellValue($help->toAlpha($y) . '1', 'Ukuran');
            $y++;

            $sheet->getColumnDimension($help->toAlpha($y))->setAutoSize(true);
            $sheet->setCellValue($help->toAlpha($y) . '1', 'Tgl Release');
            $y++;

            $sheet->getColumnDimension($help->toAlpha($y))->setAutoSize(true);
            $sheet->setCellValue($help->toAlpha($y) . '1', 'Stok');
            $y++;

            $sheet->getColumnDimension($help->toAlpha($y))->setAutoSize(true);
            $sheet->setCellValue($help->toAlpha($y) . '1', 'Keterangan');
            $y++;

            $rows = 1;
            if(!empty($rekap_sarimbit)){
                $no = 0;
                foreach ($rekap_sarimbit as $data) {
                    $rows++;


                    $no++;
                    $y = 0;
                    $sheet->setCellValue($help->toAlpha($y) . $rows, $no);
                    $y++;
                    $sheet->setCellValue($help->toAlpha($y) . $rows, $data->nmsarimbit);
                    $y++;
                    $sheet->setCellValue($help->toAlpha($y) . $rows, $data->barcode);
                    $y++;
                    $sheet->setCellValue($help->toAlpha($y) . $rows, $data->nmproduk);
                    $y++;
                    $sheet->setCellValue($help->toAlpha($y) . $rows, $data->nmsubbrand);
                    $y++;
                    $sheet->setCellValue($help->toAlpha($y) . $rows, $data->artikel);
                    $y++;
                    $sheet->setCellValue($help->toAlpha($y) . $rows, $data->nmwarna);
                    $y++;
                    $sheet->setCellValue($help->toAlpha($y) . $rows, $data->nmukuran);
                    $y++;
                    $sheet->setCellValue($help->toAlpha($y) . $rows, date('d-m-Y',strtotime($data->tgl_release)));
                    $y++;
                    $sheet->setCellValue($help->toAlpha($y) . $rows, $data->stok);
                    $y++;
                    $sheet->setCellValue($help->toAlpha($y) . $rows, $data->keterangan);
                    $y++;
                }
            }

            $type = 'xlsx';
            $fileName = "Lap. Rekap Sarimbit ." . $type;
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
