<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class NamaDesainController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sql="SELECT * FROM r_nmdesign
        WHERE aktif='Y' ORDER BY nmdesign asc";
        $nmdesign=DB::connection()->select($sql);
        return view('design.namadesain.index',compact('nmdesign'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('design.namadesain.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            $request->validate([
                'nama_design' => 'required',
            ]);

            $namadesign=$request->get('nama_design');
            $SqlCount="SELECT MAX(nmdesign_id)+1 AS counter FROM r_nmdesign ";
            $dataId=DB::connection()->select($SqlCount);
            $Id=$dataId[0]->counter;

            DB::connection()->table("r_nmdesign")
                ->insert([
                    "nmdesign_id"=>$Id,
                    "nmdesign"=>$namadesign,
                    "aktif"=>'Y',
                ]);

            DB::commit();

            return redirect()->route('namadesign')->with('success', 'Nama Design Berhasil disimpan');
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
        $sql="SELECT * FROM r_nmdesign
        WHERE nmdesign_id=$id ORDER BY nmdesign asc";
        $nmdesign=DB::connection()->select($sql);

        return view('design.namadesain.edit',compact('nmdesign'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try{
            $request->validate([
                'nama_design' => 'required',
            ]);

            $namadesign=$request->get('nama_design');

            DB::connection()->table("r_nmdesign")
                ->where("nmdesign_id",$id)
                ->update([
                    "nmdesign"=>$namadesign,
                    "aktif"=>'Y',
                ]);

            DB::commit();

            return redirect()->route('namadesign')->with('success', 'Nama Design Berhasil diubah');
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
            DB::connection()->table("r_nmdesign")
                ->where("nmdesign_id",$id)
                ->update([
                    "aktif"=>'N'
                ]);
            DB::commit();
            return redirect()->back()->with('success', 'Nama Design Berhasil dihapus');
        }
        catch(\Exeception $e){
            DB::rollback();
            return redirect()->back()->with('error',$e);
        }
    }
}
