@extends('layouts.template')

@section('content')
    <div class="card">
        @include('flash-message')
        <div class="card-header">
            <h1 class="card-title" style="float: left; font-size: 16pt">Tambah Role</h1>
        </div>
        <div class="card-body">
            <form class="g-3" action="{!! route('store_role') !!}" method="post" id="store" enctype="multipart/form-data"  onsubmit="return confirm('Apakah data akan disimpan?');">
                @csrf
                <div class="row" style="font-size: smaller">
                    <div class="col-sm-12">
                        <div class="col-md-12 d-inline-flex mb-2">
                            <label for="inputState" class="form-label col-sm-3">Nama Role</label>
                            <input type="text" class="form-control form-control-sm border-dark" id="nama_role" name="nama_role">
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="col-md-12 d-inline-flex mb-2">
                            <label for="inputState" class="form-label col-sm-3">Cek All</label>
                            <input type="checkbox" id="checkAll" name="checkAll" style="cursor:pointer;" onchange="checkUncheckAll(this)">
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <!-- input -->
                        <div>
                            <label class="form-label">Role Detail</label>
                        </div>

                        <table style="width:100%; border:1px">
                            <tr>
                                <th>No</th>
                                <th>Menu</th>
                                <th>Read</th>
                                <th>Add</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                            <?php
                            $no=0;
                            $masmenu = DB::connection()->select('select * from m_menu_groups where active=1 order by no_urut');
                            foreach($masmenu as $item){
                            $no++;
                            ?>
                            <tr>
                                <td style="font-weight: bold;">{!! $no !!}</td>
                                <td style="font-weight: bold;" colspan="6"><h7><?=$item->nama?></h7></td>
                            </tr>
                            <?php
                            $no2=0;
                            $menu_detail = DB::connection()->select("select * from m_menu_details where m_menu_group_id='".$item->m_menu_group_id."' and active=1 order by no_urut");
                            $no2;
                            foreach($menu_detail as $value){
                            $no2++;

                            ?>

                            <tr>
                                <td></td>
                                <td>
                                    <h7> <?= $no2.'. '.$value->nama?></h7>
                                </td>

                                <td>
                                    <input type="checkbox" class="" id="read-<?=$value->m_menu_detail_id;?>"  name="read_[<?=$value->m_menu_detail_id;?>]" value="1">
                                </td>

                                <td>
                                    <input type="checkbox" class="" id="add-<?=$value->m_menu_detail_id;?>" name="add_[<?=$value->m_menu_detail_id;?>]" value="1">
                                </td>

                                <td>
                                    <input type="checkbox" class="" id="edit-<?=$value->m_menu_detail_id;?>" name="edit_[<?=$value->m_menu_detail_id;?>]" value="1">
                                </td>

                                <td>
                                    <input type="checkbox" class="" id="hapus-<?=$value->m_menu_detail_id;?>" name="delete_[<?=$value->m_menu_detail_id;?>]" value="1">
                                </td>

                            </tr>
                            <?php }?>
                            <?php }?>
                        </table>
                    </div>
                </div>
                <hr>
                <div class="col-md-12 d-flex justify-content-end">
                    <button class="btn btn-primary me-2"><i class="ti ti-device-floppy"></i> Simpan</button>
                    <a href="{{ route('role') }}" class="btn btn-secondary"><i class="ti ti-corner-up-left-double"></i> Kembali</a>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('script')
<script type="text/javascript">
    function checkUncheckAll(theElement) {
        var theForm = theElement.form, z = 0;
        for(z=0; z<theForm.length;z++){
            if(theForm[z].type == 'checkbox' && theForm[z].name != 'checkall'){
                theForm[z].checked = theElement.checked;
            }
        }
    }
</script>
@endpush