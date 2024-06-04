@extends('layouts.template')

@section('content')
    <div class="card">
        @include('flash-message')
        <div class="card-header">
            <h1 class="card-title" style="float: left; font-size: 16pt">Edit Nama Design</h1>
        </div>
        <div class="card-body">
            <form class="g-3" method="post" action="{!! route('update_namadesign',$nmdesign[0]->nmdesign_id) !!}" onsubmit="return confirm('Apakah data akan diubah?');">
                @csrf
                <div class="row" style="font-size: smaller">
                    <div class="col-sm-6">
                        <div class="col-md-12 d-inline-flex mb-2">
                            <label for="inputEmail4" class="form-label col-sm-3">Nama Desain</label>
                            <input type="text" class="form-control form-control-sm border-dark" id="nama_design" name="nama_design" required autocomplete="on" value="{!! $nmdesign[0]->nmdesign !!}">
                        </div>
                    </div>
                </div>

                <div class="col-md-12 d-flex justify-content-start">
                    <button class="btn btn-primary me-2"><i class="ti ti-edit-circle"></i> Ubah</button>
                    <a href="{{ route('namadesign') }}" type="submit" class="btn btn-secondary"><i class="ti ti-corner-up-left-double"></i> Kembali</a>
                </div>
            </form>
        </div>
    </div>
@endsection