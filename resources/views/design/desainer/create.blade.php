@extends('layouts.template')

@section('content')
    <div class="card">
        @include('flash-message')
        <div class="card-header">
            <h1 class="card-title" style="float: left; font-size: 16pt">Tambah Designer</h1>
        </div>
        <div class="card-body">
            <form class="g-3" method="post" action="{!! route('store_designer') !!}" onsubmit="return confirm('Apakah data akan disimpan?');">
                @csrf
                <div class="row" style="font-size: smaller">
                    <div class="col-sm-6">
                        <div class="col-md-12 d-inline-flex mb-2">
                            <label for="inputState" class="form-label col-sm-3">Designer</label>
                            <select name="designer" class="form-control select2bs4" required>
                                <option value="" selected="selected" value="">Pilih Designer</option>
                                <?php
                                foreach($designer AS $data){
                                    echo '<option value="'.$data->r_bp_id.'">'.$data->nmbp.' - '.$data->kdbp.'</option>';
                                }
                                ?>
                            </select>
                            @error('designer')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="col-md-12 d-flex justify-content-start">
                    <button class="btn btn-primary me-2"><i class="ti ti-device-floppy"></i> Simpan</button>
                    <a href="{{ route('m_designer') }}" type="submit" class="btn btn-secondary"><i class="ti ti-corner-up-left-double"></i> Kembali</a>
                </div>
            </form>
        </div>
    </div>
@endsection