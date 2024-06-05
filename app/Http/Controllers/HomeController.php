<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class HomeController extends Controller
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
    $sqltotal = "
        with hole as (
        SELECT b.nama as nmcustomer,to_char(a.tanggal,'yyyy-dd-mm') as tanggal,a.nomor,c.nomor as nosj,f.nama as nmbrand,e.barcode,e.nama as nmartikel,
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
        WHERE to_char(a.tanggal,'yyyy-dd-mm')=to_char(now(),'yyyy-dd-mm')
        
        UNION all
        
        SELECT b.nama as nmcustomer,to_char(a.tanggal,'yyyy-dd-mm') as tanggal,a.nomor,null as nosj,f.nama as nmbrand,e.barcode,e.nama as nmartikel,
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
        WHERE to_char(a.tanggal,'yyyy-dd-mm')=to_char(now(),'yyyy-dd-mm')
        
        UNION ALL
        
        SELECT case when b.nama is null then 'CUSTOMER PUTUS' else b.nama end as nmcustomer,to_char(a.tanggal,'yyyy-dd-mm') as tanggal,a.nomor,null as nosj,f.nama as nmbrand,e.barcode,e.nama as nmartikel,
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
        WHERE to_char(a.tanggal,'yyyy-dd-mm')=to_char(now(),'yyyy-dd-mm')
        ORDER BY nomor)
        SELECT nmcustomer,sum(COALESCE (subtotal,0)) as subtotal,sum(COALESCE (total,0)) as total,sum(COALESCE (diskon,0)) as diskon,sum(COALESCE (qty,0)) as qty
        from hole where 1=1
        group by nmcustomer
        order by sum(COALESCE (total,0)) desc
        limit 10
        ";
    $today = DB::connection('mysql_orion')->select($sqltotal);
    $sql = "WITH hole3 AS (
      WITH hole2 AS (
      WITH hole AS (
      SELECT
        a.kode,
        a.nama,
        a.artikel,
        tgl_release,
        a.gambar,
        a.type_produk,
        ( COALESCE ( b.qty, 0 ) ) AS qty_terima,
        sum( COALESCE ( c.qty, 0 ) ) AS qty_kirim,
        pusat.qty_pusat,
        toko.qty_toko,
        REPLACE ( a.gambar, '^', '/' ) AS dgambar 
      FROM
        master_barang a
        LEFT JOIN terima_brg_jd_dr_supp_det b ON b.barang_seq = a.seq
        LEFT JOIN store_pengeluaran_brg_ke_store_det c ON c.barang_seq = a.seq
        LEFT JOIN (
      SELECT
        b.barang_seq,
        sum( b.qty ) AS qty_pusat 
      FROM
        faktur_jual_mst a
        LEFT JOIN faktur_jual_det b ON b.master_seq = a.seq 
      WHERE
        date_format (   a.tanggal ,'%Y-%m-%d') <= '" . date('Y-m-d') . "'   and date_format (   a.tanggal ,'%Y-%m-%d') >= '" . date("Y-m-d", strtotime("-1 months")) . "'  
      GROUP BY
        b.barang_seq 
        ) pusat ON pusat.barang_seq = a.seq
        LEFT JOIN (
      SELECT
        b.barang_seq,
        sum( b.qty ) AS qty_toko 
      FROM
        store_faktur_jual_mst a
        LEFT JOIN store_faktur_jual_det b ON b.master_seq = a.seq 
      WHERE
        date_format (   a.tanggal,'%Y-%m-%d' ) <= '" . date('Y-m-d') . "' and date_format (   a.tanggal ,'%Y-%m-%d') >= '" . date("Y-m-d", strtotime("-1 months")) . "'  
      GROUP BY
        b.barang_seq 
        ) toko ON toko.barang_seq = a.seq 
      WHERE
        1 = 1 
        AND date_format (  a.tgl_release,'%Y-%m-%d') <= '" . date('Y-m-d') . "' and date_format (   a.tgl_release ,'%Y-%m-%d') >= '" . date("Y-m-d", strtotime("-1 months")) . "'  
        AND b.qty > 0 
      GROUP BY
        a.kode,
        a.nama,
        a.artikel,
        tgl_release,
        a.gambar,
        a.type_produk,
        b.qty,
        qty_pusat,
        toko.qty_toko 
      ORDER BY
        a.nama 
        ) SELECT
        kode,
        nama,
        artikel,
        tgl_release,
        substring( hole.dgambar, 40 ) AS dgambar,
        type_produk,
        sum( qty_terima ) AS qty_terima,
        qty_kirim,
        COALESCE ( qty_pusat, 0 ) AS qty_pusat,
        COALESCE ( qty_toko, 0 ) AS qty_toko,
        sum( qty_terima ) - qty_kirim AS qty_sisa,
        gambar 
      FROM
        hole 
      WHERE
        1 = 1 
      GROUP BY
        kode,
        nama,
        artikel,
        tgl_release,
        dgambar,
        type_produk,
        qty_kirim,
        qty_pusat,
        qty_toko,
        gambar 
      ORDER BY
        nama 
        ) SELECT
        artikel,
        tgl_release,
        dgambar,
        type_produk,
        sum( qty_terima ) AS qty_terima,
        sum( qty_kirim ) AS qty_kirim,
        sum( qty_terima ) - sum( qty_kirim ) AS qty_sisa,
        qty_pusat,
        qty_toko,
        gambar 
      FROM
        hole2 
      WHERE
        1 = 1 

      GROUP BY
        artikel,
        tgl_release,
        dgambar,
        type_produk,
        qty_pusat,
        qty_toko,
        gambar 
      ORDER BY
        artikel ASC 
        ) SELECT
        artikel,
        type_produk,
        sum( qty_terima ) AS qty_terima,
        sum( qty_kirim ) AS qty_kirim,
        sum( qty_kirim ) AS qty_kirim,
        sum( qty_sisa ) AS qty_sisa,
        sum( qty_pusat ) AS qty_pusat,
        sum( qty_toko ) AS qty_toko,
      (sum( qty_pusat ) *100/sum( qty_sisa )) as penyerapan_pusat	,
      (sum( qty_toko ) *100/sum( qty_kirim )) as penyerapan_toko	
      FROM
        hole3 
      WHERE
        1 = 1 
      GROUP BY
        artikel,
        type_produk
      order by (sum( qty_pusat ) *100/sum( qty_sisa )) desc
      limit 10
      ";
    $penyerapan = DB::connection('mysql_orion')->select($sql);
    $sales = DB::connection('mysql_orion')->select("
        Select
  (
    SELECT
      sum(coalesce(total, 0)) as total_acc
    FROM
      sales_order_mst
    WHERE
      isaccso = 'T'
      and date_format (   tanggal ,'%Y-%m-%d') >= '" . date("Y-m-d", strtotime("-1 months")) . "'
  ) as total_acc, (
    SELECT
      sum(coalesce(total, 0)) as total_blm_acc
    FROM
      sales_order_mst
    WHERE
      isaccso = 'F'
      and date_format (   tanggal ,'%Y-%m-%d') >= '" . date("Y-m-d", strtotime("-1 months")) . "'
  ) as total_blm_acc, (
    SELECT
      sum(coalesce(total, 0)) as total_do
    FROM
      delivery_order_mst
    WHERE
      1 = 1
      and date_format (   tanggal ,'%Y-%m-%d') >= '" . date("Y-m-d", strtotime("-1 months")) . "'
  ) as total_do;
       
        ");

    $sqltotal = "
        with hole as (
        SELECT b.nama as nmcustomer,to_char(a.tanggal,'yyyy-dd-mm') as tanggal,a.nomor,c.nomor as nosj,f.nama as nmbrand,e.barcode,e.nama as nmartikel,
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
        WHERE to_char(a.tanggal,'yyyy-dd-mm')=to_char(now(),'yyyy-dd-mm')
        
        UNION all
        
        SELECT b.nama as nmcustomer,to_char(a.tanggal,'yyyy-dd-mm') as tanggal,a.nomor,null as nosj,f.nama as nmbrand,e.barcode,e.nama as nmartikel,
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
        WHERE to_char(a.tanggal,'yyyy-dd-mm')=to_char(now(),'yyyy-dd-mm')
        
        UNION ALL
        
        SELECT case when b.nama is null then 'CUSTOMER PUTUS' else b.nama end as nmcustomer,to_char(a.tanggal,'yyyy-dd-mm') as tanggal,a.nomor,null as nosj,f.nama as nmbrand,e.barcode,e.nama as nmartikel,
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
        WHERE to_char(a.tanggal,'yyyy-dd-mm')=to_char(now(),'yyyy-dd-mm')
        ORDER BY nomor)
        SELECT sum(COALESCE (subtotal,0)) as subtotal,sum(COALESCE (total,0)) as total,sum(COALESCE (diskon,0)) as diskon,sum(COALESCE (qty,0)) as qty
        from hole where 1=1 and hole.jenis in('AGEN','SUB AGEN'); ";
    $agen = DB::connection('mysql_orion')->select($sqltotal);
    $sqltotal = "
        with hole as (
        SELECT b.nama as nmcustomer,to_char(a.tanggal,'yyyy-dd-mm') as tanggal,a.nomor,c.nomor as nosj,f.nama as nmbrand,e.barcode,e.nama as nmartikel,
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
        WHERE to_char(a.tanggal,'yyyy-dd-mm')=to_char(now(),'yyyy-dd-mm')
        
        UNION all
        
        SELECT b.nama as nmcustomer,to_char(a.tanggal,'yyyy-dd-mm') as tanggal,a.nomor,null as nosj,f.nama as nmbrand,e.barcode,e.nama as nmartikel,
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
        WHERE to_char(a.tanggal,'yyyy-dd-mm')=to_char(now(),'yyyy-dd-mm')
        
        UNION ALL
        
        SELECT case when b.nama is null then 'CUSTOMER PUTUS' else b.nama end as nmcustomer,to_char(a.tanggal,'yyyy-dd-mm') as tanggal,a.nomor,null as nosj,f.nama as nmbrand,e.barcode,e.nama as nmartikel,
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
        WHERE to_char(a.tanggal,'yyyy-dd-mm')=to_char(now(),'yyyy-dd-mm')
        ORDER BY nomor)
        SELECT sum(COALESCE (subtotal,0)) as subtotal,sum(COALESCE (total,0)) as total,sum(COALESCE (diskon,0)) as diskon,sum(COALESCE (qty,0)) as qty
        from hole where 1=1 and hole.jenis in('ONLINE RETAIL','LAINNYA'); ";
    $retail = DB::connection('mysql_orion')->select($sqltotal);
    $sqltotal = "
        with hole as (
        
        
        SELECT 
       
        to_char(a.tanggal,'yyyy-dd-mm') as tanggal,
        a.nomor,null as nosj,
        f.nama as nmbrand,
        e.barcode,
        e.nama as nmartikel,
        d.qty,
        d.harga,d.qty*d.harga as subtotal,
        0 as diskon,0 as diskon_global,d.total,0 as ongkos_kirim,a.keterangan,null as alamat_kirim,
        a.user_id 
        FROM terima_brg_jd_dr_supp_mst a 
        LEFT JOIN terima_brg_jd_dr_supp_det d ON d.master_seq=a.seq
        LEFT JOIN master_barang e ON e.seq=d.barang_seq
        LEFT JOIN master_brand f ON f.seq=e.brand_seq
        WHERE to_char(a.tgl_approve,'yyyy-dd-mm')=to_char(now(),'yyyy-dd-mm')
        ORDER BY nomor)
        SELECT sum(COALESCE (subtotal,0)) as subtotal,sum(COALESCE (total,0)) as total,sum(COALESCE (diskon,0)) as diskon,sum(COALESCE (qty,0)) as qty
        from hole where 1=1  ";
    $barang_masuk = DB::connection('mysql_orion')->select($sqltotal);

    return view('home', compact('today', 'agen', 'retail', 'barang_masuk', 'penyerapan', 'sales'));
  }
  public function graph_laporan_harian_pusat(Request $request)
  {
    $sqltotal = "
        with hole as (
        SELECT b.nama as nmcustomer,a.tanggal,a.nomor,c.nomor as nosj,f.nama as nmbrand,e.barcode,e.nama as nmartikel,
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
        WHERE a.tanggal>='$request->tgl_awal' and a.tanggal<='$request->tgl_akhir'
        
        UNION all
        
        SELECT b.nama as nmcustomer,a.tanggal,a.nomor,null as nosj,f.nama as nmbrand,e.barcode,e.nama as nmartikel,
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
        WHERE a.tanggal>='$request->tgl_awal' and a.tanggal<='$request->tgl_akhir'
        
        UNION ALL
        
        SELECT case when b.nama is null then 'CUSTOMER PUTUS' else b.nama end as nmcustomer,a.tanggal,a.nomor,null as nosj,f.nama as nmbrand,e.barcode,e.nama as nmartikel,
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
        WHERE a.tanggal>='$request->tgl_awal' and a.tanggal<='$request->tgl_akhir'
        ORDER BY nomor)
        SELECT DATE_FORMAT(tanggal, '%d %M') as tanggal,sum(COALESCE (subtotal,0)) as subtotal,sum(COALESCE (total,0)) as total,sum(COALESCE (diskon,0)) as diskon,sum(COALESCE (qty,0)) as qty
        from hole where 1=1 and nmcustomer not like '%MOFAS%'
				GROUP BY tanggal";
    $today = DB::connection('mysql_orion')->select($sqltotal);
    $date = array();
    $qty = array();
    $total = array();
    $get_total =0;
    foreach ($today as $today) {
      $get_total +=$today->total;
      $qty[] = $today->qty;
      $total[] = $today->total;
      $date[] = $today->tanggal;
    }
    
    //type: 'column',

    $series[0]['type'] = 'spline';
    $series[0]['name'] = "Total Penjualan";
    // $series[1]['yAxis'] =2;
    $series[0]['data'] = $total;
    // $series[0]['name'] = "Qty";
    // $series[0]['yAxis'] = 1;
    // $series[0]['data'] = $qty;
    // $series[0]['type'] = 'line';
    $return['x_axis'] = $date;
    $return['y_axis'] = $series;
    $return['total'] = 'Rp. '.number_format($get_total,0);
    echo json_encode($return);
  }
  public function graph_laporan_harian_mofas(Request $request)
  {
    $sqltotal = "
        with hole as (
        SELECT b.nama as nmcustomer,a.tanggal,a.nomor,c.nomor as nosj,f.nama as nmbrand,e.barcode,e.nama as nmartikel,
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
        WHERE a.tanggal>='$request->tgl_awal' and a.tanggal<='$request->tgl_akhir'
        
        UNION all
        
        SELECT b.nama as nmcustomer,a.tanggal,a.nomor,null as nosj,f.nama as nmbrand,e.barcode,e.nama as nmartikel,
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
        WHERE a.tanggal>='$request->tgl_awal' and a.tanggal<='$request->tgl_akhir'
        
        UNION ALL
        
        SELECT case when b.nama is null then 'CUSTOMER PUTUS' else b.nama end as nmcustomer,a.tanggal,a.nomor,null as nosj,f.nama as nmbrand,e.barcode,e.nama as nmartikel,
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
        WHERE a.tanggal>='$request->tgl_awal' and a.tanggal<='$request->tgl_akhir'
        ORDER BY nomor)
        SELECT DATE_FORMAT(tanggal, '%d %M') as tanggal,sum(COALESCE (subtotal,0)) as subtotal,sum(COALESCE (total,0)) as total,sum(COALESCE (diskon,0)) as diskon,sum(COALESCE (qty,0)) as qty
        from hole where 1=1 and nmcustomer  like '%MOFAS%'
				GROUP BY tanggal";
    $today = DB::connection('mysql_orion')->select($sqltotal);
    $date = array();
    $qty = array();
    $total = array();
    $get_total =0;
    foreach ($today as $today) {
      $get_total +=$today->total;
      $qty[] = $today->qty;
      $total[] = $today->total;
      $date[] = $today->tanggal;
    }
    

    $series[0]['type'] = 'spline';
    $series[0]['name'] = "Total Penjualan";
    // $series[1]['yAxis'] =2;
    $series[0]['data'] = $total;
    // $series[0]['name'] = "Qty";
    // $series[0]['yAxis'] = 1;
    // $series[0]['data'] = $qty;
    // $series[0]['type'] = 'line';
    //type: 'column',
    $return['x_axis'] = $date;
    $return['y_axis'] = $series;
    $return['total'] = 'Rp. '.number_format($get_total,0);
    echo json_encode($return);
  }
  public function graph_laporan_own_store(Request $request)
  {
    $sqltotal = "
        with hole as (
        SELECT b.nama as nmcustomer,
        a.tanggal,
        a.nomor,
        f.nama as nmbrand,
        e.barcode,
        e.nama as nmartikel,
        d.qty,
        d.harga,d.qty*d.harga as subtotal,
       a.diskon_global,
       d.total-a.diskon_global as total,
       a.ongkos_kirim,a.keterangan,a.alamat_kirim,a.user_id
        FROM store_faktur_jual_mst a
        LEFT JOIN store_master_customer b ON b.seq=a.cust_seq
        LEFT JOIN store_faktur_jual_det d ON d.master_seq=a.seq
        LEFT JOIN master_barang e ON e.seq=d.barang_seq
        LEFT JOIN master_brand f ON f.seq=e.brand_seq
        WHERE a.tanggal>='$request->tgl_awal' and a.tanggal<='$request->tgl_akhir'
        
        UNION all
        
        SELECT b.nama as nmcustomer,
        a.tanggal,
        a.nomor,
        f.nama as nmbrand,
        e.barcode,
        e.nama as nmartikel,
        d.qty*(-1) as qty,d.harga,(d.qty*(-1))*d.harga as subtotal,
        0 as diskon_global,(d.total-0)*(-1) as total,
        0 as ongkos_kirim,a.keterangan,null as alamat_kirim,a.user_id 
        FROM store_retur_jual_mst a 
        LEFT JOIN store_master_customer b ON b.seq=a.cust_seq
        LEFT JOIN store_retur_jual_det d ON d.master_seq=a.seq
        LEFT JOIN master_barang e ON e.seq=d.barang_seq
        LEFT JOIN master_brand f ON f.seq=e.brand_seq
        WHERE a.tanggal>='$request->tgl_awal' and a.tanggal<='$request->tgl_akhir'
        
        UNION ALL
        
        SELECT case when b.nama is null then 'CUSTOMER PUTUS' else b.nama end as nmcustomer,
        a.tanggal,
        a.nomor,
        f.nama as nmbrand,
        e.barcode,
        e.nama as nmartikel,
        d.qty,d.harga,d.qty*d.harga as subtotal,
        0 as diskon_global,
        d.total,
        0 as ongkos_kirim,
        a.keterangan,null as alamat_kirim,a.user_id 
        FROM store_faktur_jual_bazar_mst a 
        LEFT JOIN store_master_customer b ON b.seq=a.cust_seq
        LEFT JOIN store_faktur_jual_bazar_det d ON d.master_seq=a.seq
        LEFT JOIN master_barang e ON e.seq=d.barang_seq
        LEFT JOIN master_brand f ON f.seq=e.brand_seq
        WHERE a.tanggal>='$request->tgl_awal' and a.tanggal<='$request->tgl_akhir'
        ORDER BY nomor)
        SELECT DATE_FORMAT(tanggal, '%d %M') as tanggal,sum(COALESCE (subtotal,0)) as subtotal,sum(COALESCE (total,0)) as total,sum(COALESCE (qty,0)) as qty
        from hole where 1=1 and nmcustomer  like '%MOFAS%'
				GROUP BY tanggal";
    $today = DB::connection('mysql_orion')->select($sqltotal);
    $date = array();
    $qty = array();
    $total = array();
    $get_total =0;
    foreach ($today as $today) {
      $get_total +=$today->total;
      $qty[] = $today->qty;
      $total[] = $today->total;
      $date[] = $today->tanggal;
    }
    
    //type: 'column',

    $series[0]['type'] = 'spline';
    $series[0]['name'] = "Total Penjualan";
    // $series[1]['yAxis'] =2;
    $series[0]['data'] = $total;
    // $series[0]['name'] = "Qty";
    // $series[0]['yAxis'] = 1;
    // $series[0]['data'] = $qty;
    // $series[0]['type'] = 'line';
    $return['x_axis'] = $date;
    $return['y_axis'] = $series;
    $return['total'] = 'Rp. '.number_format($get_total,0);
    echo json_encode($return);
  }
}
