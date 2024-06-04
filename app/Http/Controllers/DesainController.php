<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class DesainController extends Controller
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
        pr_design.kdblnthn,
        pr_design.nourut,
        pr_design.foto,
        pr_design.kdgrupjenis,
        pr_design.keterangan,
        pr_design.createdate,
        case when tgl_appr2 is null then null else tgl_appr2 end as tgl_appr2,
        r_brand.nmbrand,nmdesigner,pr_design.status_appr1,pr_design.status_appr2,pr_design.status,
        r_nmdesign.nmdesign as nama
        FROM pr_design
        LEFT JOIN r_brand ON pr_design.r_brand_id=r_brand.r_brand_id
        LEFT JOIN r_designer ON pr_design.r_designer_id=r_designer.r_designer_id
        LEFT JOIN r_grupjenis ON r_grupjenis.r_grupjenis_id=pr_design.r_grupjenis
        LEFT JOIN r_nmdesign ON r_nmdesign.nmdesign_id=pr_design.nmdesign_id
        WHERE pr_design.active=1 ORDER BY pr_design_id asc";
        $design=DB::connection()->select($sql);


        return view('design.desain.index',compact('design'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sqlbrand="select * from r_brand where 1=1 AND  isactive=1 ORDER BY nmbrand";
        $brand=DB::connection()->select($sqlbrand);

        $sqlsubbrand="select * from r_grupjenis where 1=1 AND  is_active='Y' ORDER BY nmgrupjenis";
        $subbrand=DB::connection()->select($sqlsubbrand);

        $sqldesign="SELECT * FROM r_nmdesign WHERE aktif='Y' ORDER BY nmdesign";
        $design=DB::connection()->select($sqldesign);

        $sqldesigner="SELECT * FROM r_designer WHERE active=1 ORDER BY nmdesigner";
        $designer=DB::connection()->select($sqldesigner);

        $sqlkwartal="SELECT * FROM r_kwartal WHERE 1=1 ORDER BY kwartal";
        $kwartal=DB::connection()->select($sqlkwartal);

        return view('design.desain.create',compact('brand','subbrand','design','designer','kwartal'));
    }

    /**
     * Store a newly created resource in storage.
     */

    function cari_kode($id){
        $sqlsubbrand="SELECT r_grupjenis_id,kode, kdgrupjenis, nmgrupjenis, jenis,(coalesce(id_odoo,0)+1) as urut 
                               FROM r_grupjenis
                               WHERE r_grupjenis_id=$id";
        $datasubbrand=DB::connection()->select($sqlsubbrand);
        $kdbln=date('m');
        $kdthn=date('y');
        $kdblnthn=$kdbln.'.'.$kdthn;

        return response()->json([
            'kodesub' => $datasubbrand[0]->kode,
            'blnthn' => $kdblnthn,
            'nourut' => $datasubbrand[0]->urut,
            'grup' => $datasubbrand[0]->jenis,
        ]);
    }

    public function store(Request $request)
    {
        try{
            $brand=$request->get('brand');
            $subbrand=$request->get('subbrand');
            $kodesub=$request->get('kodesub');
            $blnthn=$request->get('blnthn');
            $nourut=$request->get('nourut');
            $grup=$request->get('grup');
            $nama_desain=$request->get('nama_desain');
            $tema_desain=$request->get('tema_desain');
            $desainer=$request->get('desainer');
            $tahun=$request->get('tahun');
            $kwartal=$request->get('kwartal');
            $tgl_plan_appr=$request->get('tgl_plan_appr');
            $keterangan=$request->get('keterangan');

            $plankirimtoko=null;
            $tglplankirimtoko=date('Y-m-d');
            $qtyplan=0;
            $hppplan=0;
            $hpjplan=0;
            $App_Dir=108;
            $App_Owner=109;


            $SqlCount="SELECT MAX(COALESCE(pr_design_id,0))+1 AS counter FROM pr_design WHERE 1=1";
            $dataId=DB::connection()->select($SqlCount);
            if($dataId[0]->counter==null || $dataId[0]->counter==''){
                $Id=1;
            }
            else{
                $Id=$dataId[0]->counter;
            }

            $kdDesain=$kodesub.'.'.$blnthn.'.'.$nourut;
            $sqlCek="SELECT * FROM pr_design where kddesign='".$kdDesain."' ";
            //echo $sqlCek;die;
            $datacek=DB::connection()->select($sqlCek);
            if(!empty($datacek)){
                //return redirect()->back()->with(['warning' => 'Kode Design '.$kdDesain.' sudah ada']);
            }

            if($brand==1001459 || $brand==1001462 || $brand==1001479 || $brand==1001488 ) {
                DB::connection()->table("pr_design")
                    ->insert([
                        "pr_design_id" => $Id,
                        "r_designer_id" => $desainer,
                        "kddesign" => $kdDesain,
                        "nmdesign" => $nama_desain,
                        "tema" => $tema_desain,
                        "r_grupjenis" => $subbrand,
                        "kdgrupjenis" => $kodesub,
                        "r_brand_id" => $brand,
                        "tahun" => $tahun,
                        "r_kwartal_id" => $kwartal,
                        "tglplanapproval" => $tgl_plan_appr,
                        "qtyplan" => 0,
                        "hppplan" => 0,
                        "hpjplan" => 0,
                        "plankirimtoko" => null,
                        "tglplankirimtoko" => $tglplankirimtoko,
                        "createby" => Auth::user()->id,
                        "createdate" => date('Y-m-d'),
                        "appr1" => $App_Dir,
                        "appr2" => $App_Dir,
                        "status" => 'Approved',
                        "current_appr" => $App_Owner,
                        "tgl_resend" => date('Y-m-d'),
                        "keterangan" => $keterangan,
                        "nmdesign_id" => $nama_desain,
                        "kdblnthn" => $blnthn,
                        "nourut" => $nourut,
                    ]);
            }
            else{
                DB::connection()->table("pr_design")
                    ->insert([
                        "pr_design_id" => $Id,
                        "r_designer_id" => $desainer,
                        "kddesign" => $kdDesain,
                        "nmdesign" => $nama_desain,
                        "tema" => $tema_desain,
                        "r_grupjenis" => $subbrand,
                        "kdgrupjenis" => $kodesub,
                        "r_brand_id" => $brand,
                        "tahun" => $tahun,
                        "r_kwartal_id" => $kwartal,
                        "tglplanapproval" => $tgl_plan_appr,
                        "qtyplan" => 0,
                        "hppplan" => 0,
                        "hpjplan" => 0,
                        "plankirimtoko" => null,
                        "tglplankirimtoko" => $tglplankirimtoko,
                        "createby" => Auth::user()->id,
                        "createdate" => date('Y-m-d'),
                        "appr1" => $App_Owner,
                        "appr2" => $App_Dir,
                        "status" => 'PR',
                        "current_appr" => $App_Owner,
                        "tgl_resend" => date('Y-m-d'),
                        "keterangan" => $keterangan,
                        "nmdesign_id" => $nama_desain,
                        "kdblnthn" => $blnthn,
                        "nourut" => $nourut,
                    ]);
            }

            if($request->file('foto')){//echo 'masuk';die;

                $file = $request->file('foto');
                $destination="images/design/";
                $path=$kdDesain.'-'.$file->getClientOriginalName();
                $file->move($destination,$path);

                //echo $path;die;
                DB::connection()->table("pr_design")->where("pr_design_id",$Id)
                    ->update([
                        "foto" => $path,
                    ]);
            }

            DB::connection()->table("r_grupjenis")
                ->where("r_grupjenis_id",$subbrand)
                ->update([
                    "id_odoo" => $nourut
                ]);

            DB::commit();

            return redirect()->route('design')->with('success', 'Design Berhasil disimpan');
        }
        catch(\Exeception $e){
            DB::rollback();
            return redirect()->back()->with('error',$e);
        }
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


        return view('design.desain.show',compact('design'));
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
                    COALESCE(r_grupjenis.jenis_detail,r_grupjenis.nmgrupjenis) AS nmgrupjenis,
                    r_grupjenis.jenis,
                    r_grupjenis.kode,
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
        $designs=DB::connection()->select($sql);

        $sqlbrand="select * from r_brand where 1=1 AND  isactive=1 ORDER BY nmbrand";
        $brand=DB::connection()->select($sqlbrand);

        $sqlsubbrand="select * from r_grupjenis where 1=1 AND  is_active='Y' ORDER BY nmgrupjenis";
        $subbrand=DB::connection()->select($sqlsubbrand);

        $sqldesign="SELECT * FROM r_nmdesign WHERE aktif='Y' ORDER BY nmdesign";
        $design=DB::connection()->select($sqldesign);

        $sqldesigner="SELECT * FROM r_designer WHERE active=1 ORDER BY nmdesigner";
        $designer=DB::connection()->select($sqldesigner);

        $sqlkwartal="SELECT * FROM r_kwartal WHERE 1=1 ORDER BY kwartal";
        $kwartal=DB::connection()->select($sqlkwartal);

        return view('design.desain.edit',compact('designs','design','brand','subbrand','designer','kwartal'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try{
            $brand=$request->get('brand');
            $subbrand=$request->get('subbrand');
            $kodesub=$request->get('kodesub');
            $blnthn=$request->get('blnthn');
            $nourut=$request->get('nourut');
            $grup=$request->get('grup');
            $nama_desain=$request->get('nama_desain');
            $tema_desain=$request->get('tema_desain');
            $desainer=$request->get('desainer');
            $tahun=$request->get('tahun');
            $kwartal=$request->get('kwartal');
            $tgl_plan_appr=$request->get('tgl_plan_appr');
            $keterangan=$request->get('keterangan');

            $plankirimtoko=null;
            $tglplankirimtoko=date('Y-m-d');

            $kdDesain=$kodesub.'.'.$blnthn.'.'.$nourut;
            $sqlCek="SELECT * FROM pr_design where kddesign='".$kdDesain."' ";
            //echo $sqlCek;die;
            $datacek=DB::connection()->select($sqlCek);
            if(!empty($datacek)){
                //return redirect()->back()->with(['warning' => 'Kode Design '.$kdDesain.' sudah ada']);
            }

            DB::connection()->table("pr_design")
                ->where("pr_design_id",$id)
                ->update([
                        "r_designer_id" => $desainer,
                        "kddesign" => $kdDesain,
                        "nmdesign" => $nama_desain,
                        "tema" => $tema_desain,
                        "r_grupjenis" => $subbrand,
                        "kdgrupjenis" => $kodesub,
                        "r_brand_id" => $brand,
                        "tahun" => $tahun,
                        "r_kwartal_id" => $kwartal,
                        "tglplanapproval" => $tgl_plan_appr,
                        "tglplankirimtoko" => $tglplankirimtoko,
                        "updateby" => Auth::user()->id,
                        "updatedate" => date('Y-m-d'),
                        "keterangan" => $keterangan,
                        "nmdesign_id" => $nama_desain,
                        "kdblnthn" => $blnthn,
                        "nourut" => $nourut,
                    ]);

            if($request->file('foto')){//echo 'masuk';die;

                $file = $request->file('foto');
                $destination="images/design/";
                $path=$kdDesain.'-'.$file->getClientOriginalName();
                $file->move($destination,$path);

                //echo $path;die;
                DB::connection()->table("pr_design")->where("pr_design_id",$id)
                    ->update([
                        "foto" => $path,
                    ]);
            }
            DB::commit();

            return redirect()->route('design')->with('success', 'Design Berhasil diubah');
        }
        catch(\Exeception $e){
            DB::rollback();
            return redirect()->back()->with('error',$e);
        }
    }

    /**
     * Remove the specified resource from storage.
     */

    public function edit_designer($id)
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

        $sqldesigner="SELECT * FROM r_designer WHERE active=1 ORDER BY nmdesigner";
        $designer=DB::connection()->select($sqldesigner);

        return view('design.desain.edit_designer',compact('design','designer'));
    }

    public function edit_nama_designer(Request $request, $id)
    {
        try{
            $desainer=$request->get('desainer');
            DB::connection()->table("pr_design")
                ->where("pr_design_id",$id)
                ->update([
                    "r_designer_id" => $desainer
                ]);

            DB::commit();

            return redirect()->route('design')->with('success', 'Nama Designer Berhasil diubah');
        }
        catch(\Exeception $e){
            DB::rollback();
            return redirect()->back()->with('error',$e);
        }
    }

    public function destroy($id)
    {
        try{
            DB::connection()->table("pr_design")
                ->where("pr_design_id",$id)
                ->delete();

            DB::commit();

            return redirect()->route('design')->with('success', 'Design Berhasil dihapus');
        }
        catch(\Exeception $e){
            DB::rollback();
            return redirect()->back()->with('error',$e);
        }
    }
}
