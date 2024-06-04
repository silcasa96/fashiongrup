<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class SyncProdukController extends Controller
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
        return view('produk.sync_produk');
    }

    public function start_sync_produk(Request $request){
        try {
            $nmproduk = $request->nama_produk;

            $sqlmaster="SELECT master_barang.*,master_brand.kode as kdbrand,master_brand.nama as nmbrand,master_sub_brand.kode as kdsubbrand,
master_sub_brand.nama as nmsubbrand,master_warna.kode as kdwarna,master_warna.nama as nmwarna,master_ukuran.kode as kdukuran,
master_ukuran.nama as nmukuran
FROM master_barang
LEFT JOIN master_brand on master_brand.seq=master_barang.brand_seq
LEFT JOIN master_sub_brand on master_sub_brand.seq=master_barang.sub_brand_seq
LEFT JOIN master_warna on master_warna.seq=master_barang.warna_seq
LEFT JOIN master_ukuran on master_ukuran.seq=master_barang.ukuran_seq
WHERE 1=1 and master_barang.barcode IN(SELECT barcode FROM master_barang where nama like '%".$nmproduk."%')
order by master_barang.nama";
            //echo $sqlmaster;die;

            $master=DB::connection('mysql')->select($sqlmaster);

            foreach($master AS $data){
                $sqlcek="select * from r_produk where kdproduk='".$data->barcode."' ";
                $cek=DB::connection()->select($sqlcek);
                //print_r($cek);die;

                if(empty($cek)){
                    //echo 'masuk';
                    $SqlId="SELECT COALESCE(MAX(r_produk_id),0)+1 AS counter FROM r_produk";
                    $rsCounter=DB::connection()->select($SqlId);

                    $Id=$rsCounter[0]->counter;
                    $sqlbrand="select * from r_brand where kdbrand='".$data->kdbrand."' limit 1";
                    $databrand=DB::connection()->select($sqlbrand);

                    $brand=$databrand[0]->r_brand_id;
                    $kategori=1000004;
                    $sqlsubbrand="select * from r_grupjenis where kdgrupjenis='".$data->kdsubbrand."' limit 1";
                    $datasubbrand=DB::connection()->select($sqlsubbrand);
                    $subbrand=$datasubbrand[0]->r_grupjenis_id;

                    $kdproduk=$data->barcode;
                    $artikel=str_replace("'","`",$data->artikel);
                    //$artikel=$master['artikel'][$x];
                    $nmproduk=str_replace("'","`",$data->nama);
                    //echo $nmproduk;die;
                    $hpp=$data->harga_pokok;
                    $hpj=$data->harga_jual;
                    $hargamutasi=$data->harga_beli;
                    $hpjlimit=0;
                    $tglmasuk=date('Y-m-d',strtotime($data->tgl_input));
                    $tglrelease=date('Y-m-d',strtotime($data->tgl_release));
                    $sqlkwartal="select * from r_kwartal where kdkwartal='".$data->katalog."' limit 1";
                    $datakwartal=DB::connection()->select($sqlkwartal);
                    $kwartal=$datakwartal[0]->r_kwartal_id;
                    //$kwartal=2;
                    /*echo '<pre>';
                    var_dump($datakwartal);
                    echo '</pre>';*/
                    $tax_kategori=0;
                    $uom=1000036;
                    $active=1;
                    $sqlwarna="select * from r_warna where kdwarna='".$data->kdwarna."' limit 1 ";
                    $datawarna=DB::connection()->select($sqlwarna);
                    //var_dump($datawarna);die;
                    $warna=0;
                    if(empty($datawarna)){
                        //echo $datawarna['r_warna_id'][0];die;
                        $warna=529;
                    }
                    else{
                        if(sizeof($datawarna)<1){
                            $warna=529;
                        }
                        else{
                            $warna=$datawarna[0]->r_warna_id;
                        }
                    }

                    $caracuci='NONE';
                    $deskripsi_produk=str_replace("'","`",$data->artikel);
                    $sqlsize="select * from r_size where kdsize='".$data->kdukuran."' limit 1";
                    $datasize=DB::connection()->select($sqlsize);
                    $size=$datasize[0]->r_size_id;
                    $berat=$data->berat;
                    $nmukuran=$data->nmukuran;
                    $kdukuran=$data->kdukuran;
                    $kdwarna=$data->kdwarna;
                    $lokasi=13;
                    $userid=Auth::user()->id;

                    DB::connection()->table("r_produk")
                        ->insert([
                            "r_produk_id"=>$Id,
                            "r_brand_id"=>$brand,
                            "r_produkkategori_id"=>$kategori,
                            "r_grupjenis_id"=>$subbrand,
                            "kdgrupjenis"=>$data->kdsubbrand,
                            "kdproduk"=>$kdproduk,
                            "nmproduk"=>$nmproduk,
                            "hpp"=>$hpp,
                            "hpj"=>$hpj,
                            "hpjlimit"=>$hpjlimit,
                            "tglmasuk"=>$tglrelease,
                            "kwartal"=>$kwartal,
                            "r_taxcategory_id"=>$tax_kategori,
                            "r_uom_id"=>$uom,
                            "active"=>$active,
                            "r_warna_id"=>$warna,
                            "createby"=>$userid,
                            "createdate"=>$tglmasuk,
                            "caracuci"=>$caracuci,
                            "deskripsi_produk"=>$deskripsi_produk,
                            "r_size_id"=>$size,
                            "berat"=>$berat,
                            "ukuran"=>$size,
                            "i_lokasi_id"=>$lokasi,
                            "hargamutasi"=>$hargamutasi,
                            "artikel"=>$artikel,
                            "diskon"=>0,
                            "type_produk"=>$data->type_produk,
                            "type_barang"=>$data->tipe_brg,
                            "tahun"=>date('Y',strtotime($tglrelease)),
                            "kdblnthn"=>date('m',strtotime($tglrelease)),
                        ]);
                }
                else{
                    //echo $data->harga_jual.'---'.$data->barcode;die;
                    /*echo '<pre>';
                    var_dump($data);die;
                    echo '</pre>';*/
                    $userid=Auth::user()->id;
                    DB::connection()->table("r_produk")
                        ->where('kdproduk',$data->barcode)
                        ->update([
                            "artikel"=>$data->artikel,
                            "nmproduk"=>$data->nama,
                            "r_grupjenis_id"=>$data->sub_brand_seq,
                            "r_warna_id"=>$data->warna_seq,
                            "r_size_id"=>$data->ukuran_seq,
                            "type_produk"=>$data->type_produk,
                            "type_barang"=>$data->tipe_brg,
                            "deskripsi_produk"=>$data->keterangan,
                            "hpj"=>$data->harga_jual,
                            "berat"=>$data->berat,
                            "active"=>1,
                            "tglmasuk"=>date('Y-m-d',strtotime($data->tgl_release)),
                            "updatedate"=>date('Y-m-d'),
                            "updateby"=>$userid,
                        ]);
                }
            }
            DB::commit();
            return redirect()->back()->with('success', 'Master Produk berhasil disinkronisasi');
        }

        catch (\Exeception $e) {
            DB::rollback();
            return redirect()->back()->with('error', $e);
        }
    }
}
