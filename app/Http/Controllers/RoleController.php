<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\Models\Role;

class RoleController extends Controller
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
        $sqlrole="select * from role where active=1 ORDER BY nama_role";
        $datarole=DB::connection()->select($sqlrole);
        return view('role.index',compact('datarole'));
    }

    public function create()
    {
        $role = Role::orderBy('id', 'asc')->get();
        return view('role.create',compact('role'));
    }

    public function store(Request $request){
        try{
            $id=Auth::user()->id;
            Role::create($request->all());
            $seq = DB::connection()->select('select last_value from role_id_seq');
            $read = $request->read_;
            $add = $request->add_;
            $edit = $request->edit_;
            $delete = $request->delete_;

            foreach($request->read_ as $key => $value){
                $data['read_'] = isset($read[$key])?1:0;
                $data['add_'] = isset($add[$key])?1:0;
                $data['update_'] = isset($edit[$key])?1:0;
                $data['delete_'] = isset($delete[$key])?1:0;
                $data['menu_detail_id'] = $key;
                $data['role_id'] = $seq[0]->last_value;
                $data['created_at'] = date('Y-m-d H:i:s');

                DB::connection()->table("role_detail")->insert($data);
            }
            DB::commit();
            return redirect()->back()->with('success', 'Role berhasil ditambahkan');
        }
        catch(\Exeception $e){
            DB::rollback();
            return redirect()->back()->with('error',$e);
        }
    }

    public function edit($id){
        $sql="select * from role WHERE id=$id";
        $datarole=DB::connection()->select($sql);

        $sql1="select * from role_detail WHERE id=$id";
        $dataroledetail=DB::connection()->select($sql1);
        return view('role.edit',compact('datarole','dataroledetail'));
    }

    public function update(Request $request, $id){
        try{
            //$id=Auth::user()->id;
            DB::connection()->table("role")->where('id',$id)->update(['nama_role'=>$request->nama_role]);
            DB::connection()->table("role_detail")->where('role_id',$id)->delete();

            $read = $request->read_;
            $add = $request->add_;
            $edit = $request->edit_;
            $delete = $request->delete_;

            foreach($request->read_ as $key => $value){
                $data['read_'] = isset($read[$key])?1:0;
                $data['add_'] = isset($add[$key])?1:0;
                $data['update_'] = isset($edit[$key])?1:0;
                $data['delete_'] = isset($delete[$key])?1:0;
                $data['menu_detail_id'] = $key;
                $data['role_id'] = $id;
                $data['updated_at'] = date('Y-m-d H:i:s');

                DB::connection()->table("role_detail")->insert($data);
            }
            DB::commit();
            return redirect(route('role'))->with('success', 'Role berhasil diubah');
        }
        catch(\Exeception $e){
            DB::rollback();
            return redirect()->back()->with('error',$e);
        }
    }
    public function destroy($id){
        try{
            $idu=Auth::user()->id;
            DB::connection()->table("role_detail")
                ->where("role_id",$id)
                ->update([
                    "active"=>0,
                    "updated_at"=>date('Y-m-d'),
                ]);

            DB::connection()->table("role")
                ->where("id",$id)
                ->update([
                    "active"=>0,
                    "updated_at"=>date('Y-m-d'),
                ]);
            DB::commit();
            return redirect()->back()->with('success', 'Role User Berhasil dihapus');
        }
        catch(\Exeception $e){
            DB::rollback();
            return redirect()->back()->with('error',$e);
        }
    }
}
