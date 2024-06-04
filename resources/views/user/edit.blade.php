@extends('layouts.template')

@section('content')
    <div class="card">
        @include('flash-message')
        <div class="card-header">
            <h1 class="card-title" style="float: left; font-size: 16pt">Edit User</h1>
        </div>
        <div class="card-body">
            <form class="g-3" action="{!! route('update_user',$user[0]->id) !!}" method="post" id="store" enctype="multipart/form-data"  onsubmit="return confirm('Apakah data akan diubah?');">
                @csrf
                <div class="row" style="font-size: smaller">
                    <div class="col-sm-12">
                        <div class="col-md-12 d-inline-flex mb-2">
                            <label for="inputState" class="form-label col-sm-3">Username</label>
                            <input type="text" class="form-control form-control-sm border-dark" id="username" name="username" value="{!! $user[0]->username!!}" required>
                            @error('username')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="col-md-12 d-inline-flex mb-2">
                            <label for="inputState" class="form-label col-sm-3">Nama</label>
                            <input type="text" class="form-control form-control-sm border-dark" id="nama" name="nama" value="{!! $user[0]->nama !!}" required>
                            @error('nama')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="col-md-12 d-inline-flex mb-2">
                            <label for="inputState" class="form-label col-sm-3">Email</label>
                            <input type="email" class="form-control form-control-sm border-dark" id="email" name="email" value="{!! $user[0]->email !!}" required>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="col-md-12 d-inline-flex mb-2">
                            <label for="inputState" class="form-label col-sm-3">Bisnis Partner</label>
                            <select name="bp" class="form-control select2bs4" required>
                                <option value="" selected="selected" value="">Pilih Bisnis Partner</option>
                                <?php
                                foreach($bp AS $data){
                                    if($data->r_bp_id==$user[0]->r_bp_id){
                                        echo '<option selected="selected" value="'.$data->r_bp_id.'">'.$data->kdbp.' - '.$data->nmbp.'</option>';
                                    }
                                    else{
                                        echo '<option value="'.$data->r_bp_id.'">'.$data->kdbp.' - '.$data->nmbp.'</option>';
                                    }
                                }
                                ?>
                            </select>
                            @error('role')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="col-md-12 d-inline-flex mb-2">
                            <label for="inputState" class="form-label col-sm-3">Role</label>
                            <select name="role" class="form-control select2bs4" required>
                                <option value="" selected="selected" value="">Pilih Role</option>
                                <?php
                                foreach($role AS $roles){
                                    if($roles->id==$user[0]->role_id){
                                        echo '<option selected="selected" value="'.$roles->id.'">'.$roles->nama_role.'</option>';
                                    }
                                    else{
                                        echo '<option value="'.$roles->id.'">'.$roles->nama_role.'</option>';
                                    }
                                }
                                ?>
                            </select>
                            @error('role')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="col-md-12 d-inline-flex mb-2">
                            <label for="inputState" class="form-label col-sm-3">Password</label>
                            <input type="password" class="form-control form-control-sm border-dark" id="password" name="password">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <hr>
                <div class="col-md-12 d-flex justify-content-end">
                    <button class="btn btn-primary me-2"><i class="ti ti-edit-circle"></i> Ubah</button>
                    <a href="{{ route('user') }}" class="btn btn-secondary"><i class="ti ti-corner-up-left-double"></i> Kembali</a>
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