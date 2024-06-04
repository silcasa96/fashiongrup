@extends('layouts.template')

@section('content')
    <div class="card">
        @include('flash-message')
        <div class="card-header">
            <h1 class="card-title" style="float: left; font-size: 16pt">Sync Produk</h1>
        </div>
        <div class="card-body">
            <form class="g-3" method="post" action="{!! route('start_sync_produk') !!}" onsubmit="return confirm('Apakah data akan disinkronisasi?');">
                @csrf
                <div class="row" style="font-size: smaller">
                    <div class="col-sm-6">
                        <div class="col-md-12 d-inline-flex mb-2">
                            <label for="inputEmail4" class="form-label col-sm-3">Nama Produk</label>
                            <input type="text" class="form-control form-control-sm border-dark" id="nama_produk" name="nama_produk" placeholder="Nama Produk" autocomplete="on">
                        </div>
                    </div>
                </div>
                
                <div class="col-md-12 d-flex justify-content-start">
                    <button class="btn btn-primary me-2"><i class="ti ti-database-import"></i> Sync Produk ES-iOS</button>
                    <a href="{{ route('sync_produk') }}" type="submit" class="btn btn-secondary"><i class="ti ti-refresh"></i> Reset</a>
                </div>
            </form>
        </div>
    </div>
@endsection