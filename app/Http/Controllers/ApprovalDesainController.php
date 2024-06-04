<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class ApprovalDesainController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sql="SELECT pr_design.pr_design_id,
        pr_design.kddesign,
        pr_design.nmdesign,
        pr_design.tema,
        pr_design.foto,
        pr_design.kdblnthn,
        pr_design.nourut,
        pr_design.kdgrupjenis,
        pr_design.keterangan,
        r_brand.nmbrand,nmdesigner,status_appr1,status_appr2,status,appr1,appr2,
        r_nmdesign.nmdesign as nama
        FROM pr_design
        LEFT JOIN r_brand ON pr_design.r_brand_id=r_brand.r_brand_id
        LEFT JOIN r_designer ON pr_design.r_designer_id=r_designer.r_designer_id
        LEFT JOIN r_nmdesign ON r_nmdesign.nmdesign_id=pr_design.nmdesign_id
        LEFT JOIN r_grupjenis ON r_grupjenis.r_grupjenis_id=pr_design.r_grupjenis
        WHERE pr_design.active=1 and r_grupjenis.r_grupjenis_id not in(1001462,1001459,1001479,1001488)";
        $apprdesign=DB::connection()->select($sql);

        return view('design.appr_design.index',compact('apprdesign'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $sql="SELECT pr_design.pr_design_id,
                    pr_design.r_grupjenis,
                    r_grupjenis.kdgrupjenis,
                    pr_design.kddesign,
                    r_grupjenis.jenis_detail,
                    r_grupjenis.kode,
                    COALESCE(r_grupjenis.jenis_detail,r_grupjenis.nmgrupjenis) AS nmgrupjenis,
                    r_grupjenis.jenis,
                    pr_design.nmdesign,
                    pr_design.tema,
                    pr_design.r_designer_id,
                    r_designer.nmdesigner,
                    r_brand.nmbrand,
                    pr_design.r_brand_id,
                    pr_design.tahun,
                    pr_design.r_kwartal_id,
                    r_kwartal.kwartal as nmkwartal,
                    pr_design.tglplanapproval,
                    pr_design.qtyplan,
                    pr_design.hppplan,
                    pr_design.hpjplan,
                    pr_design.kategori,
                    pr_design.r_kwartal_id as r_kwartal_id_new,
                    pr_design.plankirimtoko,
                    pr_design.tglplankirimtoko,
                    pr_design.keterangan,
        pr_design.komentar,
        pr_design.createby,
        pr_design.createdate,
        pr_design.updateby,
        pr_design.updatedate,
        q.nmbp AS createby_nm,
        r.nmbp AS updateby_nm,
        pr_design.foto,
        r_nmdesign.nmdesign as nama,pr_design.kdblnthn,pr_design.nourut
                    FROM pr_design
                    LEFT JOIN r_grupjenis ON r_grupjenis.r_grupjenis_id=pr_design.r_grupjenis
                    LEFT JOIN r_designer ON r_designer.r_designer_id=pr_design.r_designer_id
                    LEFT JOIN r_brand ON r_brand.r_brand_id=pr_design.r_brand_id
                    LEFT JOIN r_kwartal ON r_kwartal.r_kwartal_id=pr_design.r_kwartal_id
LEFT JOIN r_bp q ON q.r_bp_id=pr_design.createby
LEFT JOIN r_bp r ON r.r_bp_id=pr_design.updateby
LEFT JOIN r_nmdesign ON r_nmdesign.nmdesign_id=pr_design.nmdesign_id
                    WHERE pr_design.pr_design_id=$id";
        $design=DB::connection()->select($sql);

        return view('design.appr_design.show', compact('design'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $sql="SELECT pr_design.pr_design_id,
                    pr_design.r_grupjenis,
                    r_grupjenis.kdgrupjenis,
                    pr_design.kddesign,
                    r_grupjenis.jenis_detail,
                    r_grupjenis.kode,
                    COALESCE(r_grupjenis.jenis_detail,r_grupjenis.nmgrupjenis) AS nmgrupjenis,
                    r_grupjenis.jenis,
                    pr_design.nmdesign,
                    pr_design.tema,
                    pr_design.r_designer_id,
                    r_designer.nmdesigner,
                    r_brand.nmbrand,
                    pr_design.r_brand_id,
                    pr_design.tahun,
                    pr_design.r_kwartal_id,
                    r_kwartal.kwartal as nmkwartal,
                    pr_design.tglplanapproval,
                    pr_design.qtyplan,
                    pr_design.hppplan,
                    pr_design.hpjplan,
                    pr_design.kategori,
                    pr_design.r_kwartal_id as r_kwartal_id_new,
                    pr_design.plankirimtoko,
                    pr_design.tglplankirimtoko,
                    pr_design.keterangan,
        pr_design.komentar,
        pr_design.createby,
        pr_design.createdate,
        pr_design.updateby,
        pr_design.updatedate,
        q.nmbp AS createby_nm,
        r.nmbp AS updateby_nm,
        pr_design.foto,
        r_nmdesign.nmdesign as nama,pr_design.kdblnthn,pr_design.nourut
                    FROM pr_design
                    LEFT JOIN r_grupjenis ON r_grupjenis.r_grupjenis_id=pr_design.r_grupjenis
                    LEFT JOIN r_designer ON r_designer.r_designer_id=pr_design.r_designer_id
                    LEFT JOIN r_brand ON r_brand.r_brand_id=pr_design.r_brand_id
                    LEFT JOIN r_kwartal ON r_kwartal.r_kwartal_id=pr_design.r_kwartal_id
LEFT JOIN r_bp q ON q.r_bp_id=pr_design.createby
LEFT JOIN r_bp r ON r.r_bp_id=pr_design.updateby
LEFT JOIN r_nmdesign ON r_nmdesign.nmdesign_id=pr_design.nmdesign_id
                    WHERE pr_design.pr_design_id=$id";
        $design=DB::connection()->select($sql);

        $sqlbrand="select * from r_brand where 1=1 AND  isactive=1 ORDER BY nmbrand";
        $brand=DB::connection()->select($sqlbrand);

        $sqlsubbrand="select * from r_grupjenis where 1=1 AND  is_active='Y' ORDER BY nmgrupjenis";
        $subbrand=DB::connection()->select($sqlsubbrand);

        return view('design.appr_design.edit', compact('design','brand','subbrand'));
    }

    function cari_kode_design($id){
        $sqlsubbrand="SELECT r_grupjenis_id,kode, kdgrupjenis, nmgrupjenis, jenis,(coalesce(id_odoo,0)+1) as urut 
                               FROM r_grupjenis
                               WHERE r_grupjenis_id=$id";
        $datasubbrand=DB::connection()->select($sqlsubbrand);
        $kdbln=date('m');
        $kdthn=date('y');
        $kdblnthn=$kdbln.'.'.$kdthn;
        var_dump($datasubbrand);die;

        return response()->json([
            'kodesub' => $datasubbrand[0]->kode,
            'blnthn' => $kdblnthn,
            'nourut' => $datasubbrand[0]->urut,
            'grup' => $datasubbrand[0]->jenis,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}
