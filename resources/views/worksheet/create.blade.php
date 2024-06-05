@extends('layouts.template')

@section('content')
    <div class="card">
        <div class="card-header">
            <h1 class="card-title" style="float: left; font-size: 16pt">Tambah Worksheet</h1>
        </div>
        <div class="card-body">
            <form class="g-3">
                <div class="row" style="font-size: smaller">
                    <div class="col-sm-4">
                        <div class="col-md-12 d-inline-flex mb-2">
                            <label for="inputEmail4" class="form-label col-sm-4">No. JOB*</label>
                            <input type="text" class="form-control form-control-sm border-dark" id="" placeholder="">
                            <input class="form-check-input ms-3 me-1 ps-3" type="checkbox" value="" id="flexCheckChecked" checked> Auto
                        </div>
                        <div class="col-md-12 d-inline-flex mb-2">
                            <label for="inputState" class="form-label col-sm-4">Kode Sample</label>
                            <input type="text" class="form-control form-control-sm border-dark" id="">
                            <button class="btn btn-success btn-sm ms-1" type="submit"><i class="ti ti-search"></i></button>
                            <button class="btn btn-success btn-sm ms-1" type="submit"><i class="ti ti-reload"></i></button>
                        </div>
                        <div class="col-md-12 d-inline-flex mb-2">
                            <label for="inputPassword4" class="form-label col-sm-4">Organisasi</label>
                            <select id="" class="form-select form-select-sm select2">
                                <option selected>Pilih</option>
                                <option>SALSA JARING PERSADA</option>
                            </select>
                        </div>
                        <div class="col-md-12 d-inline-flex mb-2">
                            <label for="inputState" class="form-label col-sm-4">Desain</label>
                            <input type="text" class="form-control form-control-sm border-dark" id="">
                            <button class="btn btn-success btn-sm ms-1" type="submit"><i class="ti ti-search"></i></button>
                            <button class="btn btn-success btn-sm ms-1" type="submit"><i class="ti ti-reload"></i></button>
                        </div>
                        <div class="col-md-12 d-inline-flex mb-2">
                            <label for="inputState" class="form-label col-sm-4">Kategori Produk</label>
                            <input type="text" class="form-control form-control-sm border-dark" id="">
                        </div>
                        <div class="col-md-12 d-inline-flex mb-2">
                            <label for="inputState" class="form-label col-sm-4">Grup Jenis</label>
                            <input type="text" class="form-control form-control-sm border-dark" id="">
                        </div>
                        <div class="col-md-12 d-inline-flex mb-2">
                            <label for="inputState" class="form-label col-sm-4">Kode Desain</label>
                            <input type="text" class="form-control form-control-sm border-dark" id="">
                        </div>
                        <div class="col-md-12 d-inline-flex mb-2">
                            <label for="inputState" class="form-label col-sm-4">Nama Artikel</label>
                            <input type="text" class="form-control form-control-sm border-dark" id="">
                        </div>
                        <div class="col-md-12 d-inline-flex mb-2">
                            <label for="inputAddress" class="form-label col-sm-4">Brand</label>
                            <select id="" class="form-select form-select-sm select2">
                                <option selected>Pilih</option>
                                <option>AL QURAN</option>
                                <option>ETHICA</option>
                                <option>ETHICA HIJAB</option>
                                <option>KAGUMI</option>
                                <option>KAHFI</option>
                            </select>                            
                        </div>
                        <div class="col-md-12 d-inline-flex mb-2">
                            <label for="inputAddress" class="form-label col-sm-4">Status Desain</label>
                            <select id="" class="form-select form-select-sm select2">
                                <option selected>Pilih</option>
                                <option>NEW</option>
                                <option>REPEAT</option>
                                <option>PARTIAL</option>
                            </select>                            
                        </div>
                        <div class="col-md-12 d-inline-flex mb-2">
                            <label for="inputAddress" class="form-label col-sm-4">Triwulan</label>
                            <select id="" class="form-select form-select-sm select2">
                                <option selected>Pilih</option>
                                <option>Basic</option>
                                <option>01</option>
                                <option>02</option>
                                <option>03</option>
                                <option>04</option>
                                <option>05</option>
                                <option>06</option>
                                <option>07</option>
                                <option>08</option>
                            </select>                            
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="col-md-12 d-inline-flex mb-2">
                            <label for="inputEmail4" class="form-label col-sm-4">Tahun*</label>
                            <input type="text" class="form-control form-control-sm border-dark" id="" placeholder="">
                        </div>
                        <div class="col-md-12 d-inline-flex mb-2">
                            <label for="inputEmail4" class="form-label col-sm-4">Occation</label>
                            <input type="text" class="form-control form-control-sm border-dark" id="" placeholder="">
                        </div>
                        <div class="col-md-12 d-inline-flex mb-2">
                            <label for="inputEmail4" class="form-label col-sm-4" style="font-size: 8pt">Bahan Baku Utama*</label>
                            <input type="text" class="form-control form-control-sm border-dark" id="" placeholder="">
                        </div>
                        <div class="col-md-12 d-inline-flex mb-2">
                            <label for="inputCity" class="form-label col-sm-4">Warna</label>
                            <select id="" class="form-select form-select-sm select2">
                                <option selected>Pilih</option>
                                <option>ABU</option>
                                <option>ABU MAROON</option>
                                <option>ABU MISTY</option>
                                <option>ABU MUDA</option>
                                <option>ABU TUA</option>
                            </select>
                        </div>
                        <div class="col-md-12 d-inline-flex mb-2">
                            <label for="inputCity" class="form-label col-sm-4">Status Bhn Warna</label>
                            <select id="" class="form-select form-select-sm select2">
                                <option selected>Pilih</option>
                                <option>IN ORDER</option>
                                <option>LAP DIP</option>
                                <option>READY STOK</option>
                            </select>
                        </div>
                        <div class="col-md-12 d-inline-flex mb-2">
                            <label for="inputCity" class="form-label col-sm-4">Keterangan</label>
                            <textarea type="text" class="form-control form-control-sm border-dark" rows="3" id="" placeholder=""></textarea>
                        </div>
                        <div class="col-md-12 d-inline-flex mb-2">
                            <label for="inputCity" class="form-label col-sm-4">PIC*</label>
                            <select id="" class="form-select form-select-sm select2">
                                <option selected>Pilih</option>
                                <option>Aang</option>
                                <option>Ade</option>
                                <option>Adiba Nur</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="col-sm-12 d-inline-flex">
                            <label for="inputZip" class="form-label col-sm-4">Upload Gambar</label>
                            <input type="file" class="form-control form-control-sm border-dark" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                        </div>
                    </div>
                </div>
                
                <div class="col-md-12 d-flex justify-content-end">
                    <a href="#" type="submit" class="btn btn-primary me-2">Tambah</a>
                    <a href="{{ route('worksheet') }}" type="submit" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $(function () {
            $("#example").DataTable({
                "scrollX" : true,
                "scrollY" : true,
            });
        });
    </script>
@endpush