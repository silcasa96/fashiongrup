@extends('layouts.template')

@section('content')
    <div class="card">
        <div class="card-header">
            <h1 class="card-title" style="float: left; font-size: 16pt">Tambah Desain</h1>
        </div>
        <div class="card-body">
            <form class="g-3">
                <div class="row" style="font-size: smaller">
                    <div class="col-sm-6">
                        <div class="col-md-12 d-inline-flex mb-2">
                            <label for="inputEmail4" class="form-label col-sm-3">Tgl Intruksi</label>
                            <input type="text" class="form-control form-control-sm border-dark" id="" placeholder="">
                        </div>
                        <div class="col-md-12 d-inline-flex mb-2">
                            <label for="inputPassword4" class="form-label col-sm-3">No. Sample</label>
                            <input type="text" class="form-control form-control-sm border-dark" id="" placeholder="">
                        </div>
                        <div class="col-md-12 d-inline-flex mb-2">
                            <label for="inputAddress" class="form-label col-sm-3">Desain</label>                            
                        </div>
                        <div class="col-md-12 d-inline-flex mb-2">
                            <label for="inputAddress" class="form-label col-sm-3">Kode Desain</label>                            
                        </div>
                        <div class="col-md-12 d-inline-flex mb-2">
                            <label for="inputAddress" class="form-label col-sm-3">Jenis</label>                            
                        </div>
                        <div class="col-md-12 d-inline-flex mb-2">
                            <label for="inputAddress" class="form-label col-sm-3">Grup Jenis</label>                            
                        </div>
                        <div class="col-md-12 d-inline-flex mb-2">
                            <label for="inputAddress" class="form-label col-sm-3">Kode Produksi</label>                            
                        </div>
                        <div class="col-md-12 d-inline-flex mb-2">
                            <label for="inputAddress" class="form-label col-sm-3">Brand</label>                            
                        </div>
                        <div class="col-md-12 d-inline-flex mb-2">
                            <label for="inputAddress" class="form-label col-sm-3">Warna</label>                            
                        </div>
                        <div class="col-md-12 d-inline-flex mb-2">
                            <label for="inputCity" class="form-label col-sm-3">Size</label>
                            <select id="" class="form-select form-select-sm select2">
                                <option selected>Pilih</option>
                                <option>XS</option>
                                <option>S</option>
                                <option>M</option>
                                <option>L</option>
                                <option>XL</option>
                            </select>
                        </div>
                        <div class="col-md-12 d-inline-flex mb-2">
                            <label for="inputState" class="form-label col-sm-3">Keterangan</label>
                            <input type="text" class="form-control form-control-sm border-dark" id="">
                        </div>
                        <div class="col-md-12 d-inline-flex mb-2">
                            <label for="inputCity" class="form-label col-sm-3">Size</label>
                            <select id="" class="form-select form-select-sm select2">
                                <option selected>Pilih</option>
                                <option>A Yusuf Ariyadi</option>
                                <option>AA Andriyansyah</option>
                                <option>Aang</option>
                                <option>L</option>
                                <option>XL</option>
                            </select>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-12 d-flex justify-content-end">
                    <a href="#" type="submit" class="btn btn-primary me-2">Tambah</a>
                    <a href="{{ route('f-intruksippic') }}" type="submit" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
@endsection