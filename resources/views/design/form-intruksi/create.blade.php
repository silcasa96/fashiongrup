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
                            <label for="inputPassword4" class="form-label col-sm-3">Desain</label>
                            <input type="text" class="form-control form-control-sm border-dark" id="" placeholder="">
                        </div>
                        <div class="col-md-12 d-inline-flex mb-2">
                            <label for="inputAddress" class="form-label col-sm-3">Kode Desain</label>                            
                        </div>
                        <div class="col-md-12 d-inline-flex mb-2">
                            <label for="inputAddress" class="form-label col-sm-3">Grup Desain</label>                            
                        </div>
                        <div class="col-md-12 d-inline-flex mb-2">
                            <label for="inputAddress" class="form-label col-sm-3">Desainer</label>                            
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
                            <label for="inputState" class="form-label col-sm-3">Consumtion</label>
                            <input type="text" class="form-control form-control-sm border-dark" id="">
                        </div>
                        <div class="col-md-12 d-inline-flex mb-2">
                            <label for="inputZip" class="form-label col-sm-3">Bahan Utama</label>
                            <input type="text" class="form-control form-control-sm border-dark" id="">
                        </div>
                        <div class="col-md-12 d-inline-flex mb-2">
                            <label for="inputZip" class="form-label col-sm-3">Bahan Variasi 1</label>
                            <input type="text" class="form-control form-control-sm border-dark" id="">
                        </div>
                        <div class="col-md-12 d-inline-flex mb-2">
                            <label for="inputZip" class="form-label col-sm-3">Bahan Variasi 2</label>
                            <input type="text" class="form-control form-control-sm border-dark" id="">
                        </div>
                        <div class="col-md-12 d-inline-flex mb-2">
                            <label for="inputZip" class="form-label col-sm-3">Bahan Variasi 3</label>
                            <input type="text" class="form-control form-control-sm border-dark" id="">
                        </div>
                        <div class="col-md-12 d-inline-flex mb-2">
                            <label for="inputZip" class="form-label col-sm-3">Bahan Variasi 4</label>
                            <input type="text" class="form-control form-control-sm border-dark" id="">
                        </div>
                        <div class="col-md-12 d-inline-flex mb-2">
                            <label for="inputZip" class="form-label col-sm-3">Revisi</label>
                            <input type="text" class="form-control form-control-sm border-dark" id="">
                        </div>
                        <div class="col-md-12 d-inline-flex mb-2">
                            <label for="inputZip" class="form-label col-sm-3">Keterangan</label>
                            <textarea type="text" class="form-control form-control-sm border-dark" rows="2" id=""></textarea>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="col-sm-12 d-inline-flex">
                            <label for="inputZip" class="form-label col-sm-3">Upload Gambar</label>
                            <input type="file" class="form-control form-control-sm border-dark" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                        </div>
                    </div>
                </div>
                
                <div class="col-md-12 d-flex justify-content-end">
                    <a href="#" type="submit" class="btn btn-primary me-2">Tambah</a>
                    <a href="{{ route('f-intruksidesign') }}" type="submit" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
@endsection