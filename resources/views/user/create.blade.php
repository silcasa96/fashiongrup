@extends('layouts.template')

@section('content')
    <div class="card">
        @include('flash-message')
        <div class="card-header">
            <h1 class="card-title" style="float: left; font-size: 16pt">Tambah User</h1>
        </div>
        <div class="card-body">
            <form class="g-3" action="{!! route('store_user') !!}" method="post" id="store" enctype="multipart/form-data"  onsubmit="return confirm('Apakah data akan disimpan?');">
                @csrf
                <div class="row" style="font-size: smaller">
                    <div class="col-sm-12">
                        <div class="col-md-12 d-inline-flex mb-2">
                            <label for="inputState" class="form-label col-sm-3">Username</label>
                            <input type="text" class="form-control form-control-sm border-dark" id="username" name="username" required>
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
                            <input type="text" class="form-control form-control-sm border-dark" id="nama" name="nama" required>
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
                            <input type="email" class="form-control form-control-sm border-dark" id="email" name="email" required>
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
                                    echo '<option value="'.$data->r_bp_id.'">'.$data->kdbp.' - '.$data->nmbp.'</option>';
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
                                    echo '<option value="'.$roles->id.'">'.$roles->nama_role.'</option>';
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
                            <input type="password" class="form-control form-control-sm border-dark" id="password" name="password" required>
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
                    <button class="btn btn-primary me-2"><i class="ti ti-device-floppy"></i> Simpan</button>
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