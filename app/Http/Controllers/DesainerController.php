<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use DB;
use Auth;

class DesainerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sql="SELECT r_designer_id,nmdesigner FROM r_designer
        WHERE active=1 ORDER BY nmdesigner asc";
        $designer=DB::connection()->select($sql);
        return view('design.desainer.index',compact('designer'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sql="SELECT r_bp_id,kdbp,nmbp FROM r_bp
        WHERE aktif='Y' AND r_bpgrup_id =1000002 ORDER BY nmbp asc";
        $designer=DB::connection()->select($sql);
        return view('design.desainer.create',compact('designer'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            $request->validate([
                'designer' => 'required',
            ]);

            $IdBP=$request->get('designer');
            $SqlCount="SELECT MAX(r_designer_id)+1 AS counter FROM r_designer ";
            $dataId=DB::connection()->select($SqlCount);
            $Id=$dataId[0]->counter;

            $Sqlbp="SELECT * FROM r_bp WHERE r_bp_id=$IdBP";
            $databp=DB::connection()->select($Sqlbp);
            $NamaBP=$databp[0]->nmbp;

            DB::connection()->table("r_designer")
                ->insert([
                    "r_designer_id"=>$Id,
                    "r_bp_id"=>$request->get('designer'),
                    "nmdesigner"=>$NamaBP,
                    "active"=>1,
                ]);

            DB::commit();

            return redirect()->route('m_designer')->with('success', 'Nama Designer Berhasil disimpan');
        }
        catch(\Exeception $e){
            DB::rollback();
            return redirect()->back()->with('error',$e);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $sql="SELECT r_bp_id,kdbp,nmbp FROM r_bp
        WHERE aktif='Y' AND r_bpgrup_id =1000002 ORDER BY nmbp asc";
        $bp=DB::connection()->select($sql);

        $sql="SELECT r_designer.r_designer_id,r_designer.nmdesigner,r_designer.r_bp_id,r_bp.nmbp                       
                       FROM r_designer LEFT JOIN r_bp ON r_designer.r_bp_id = r_bp.r_bp_id                                   
                       where r_designer.r_designer_id=$id";
        $designer=DB::connection()->select($sql);

        return view('design.desainer.edit',compact('designer','bp'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try{
            $request->validate([
                'designer' => 'required',
            ]);

            $IdBP=$request->get('designer');
            $Sqlbp="SELECT * FROM r_bp WHERE r_bp_id=$IdBP";
            $databp=DB::connection()->select($Sqlbp);
            $NamaBP=$databp[0]->nmbp;

            DB::connection()->table("r_designer")
                ->where("r_designer_id",$id)
                ->update([
                    "r_bp_id"=>$request->get('designer'),
                    "nmdesigner"=>$NamaBP,
                    "active"=>1,
                ]);

            DB::commit();

            return redirect()->route('m_designer')->with('success', 'Nama Designer Berhasil diubah');
        }
        catch(\Exeception $e){
            DB::rollback();
            return redirect()->back()->with('error',$e);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try{
            //$idu=Auth::user()->id;
            DB::connection()->table("r_designer")
                ->where("r_designer_id",$id)
                ->update([
                    "active"=>0
                ]);
            DB::commit();
            return redirect()->back()->with('success', 'Nama Designer Berhasil dihapus');
        }
        catch(\Exeception $e){
            DB::rollback();
            return redirect()->back()->with('error',$e);
        }
    }
}
