<?php 

namespace App\Http\Controllers;

use App\Helper_function;
use Illuminate\Http\Request;
use Auth;
use DB;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Xls;


class KeuanganRekapDepositController extends Controller
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
    public function index()
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

        return view('laporan.rekap_deposit',compact('brand','subbrand','artikel','vendor','gudang','tglawal','tglakhir','idartikel','idsubbrand','idbrand','idvendor','idgudang'));
    }
}
