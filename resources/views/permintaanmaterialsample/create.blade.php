@extends('layouts.template')

@section('content')
    <div class="card">
        <div class="card-header">
            <h1 class="card-title" style="float: left; font-size: 16pt">Tambah Worksheet</h1>
        </div>
        <form class="g-3">
            <div class="card-body">
                <div class="row" style="font-size: smaller">
                    <div class="col-sm-5">
                        <div class="col-md-12 d-inline-flex mb-2">
                            <label for="inputEmail4" class="form-label col-sm-4">No. BPM*</label>
                            <input type="text" class="form-control form-control-sm border-dark" id="" placeholder="">
                            <input class="form-check-input ms-3 me-1 ps-3" type="checkbox" value="" id="flexCheckChecked" checked> Auto
                        </div>
                        <div class="col-md-12 d-inline-flex mb-2">
                            <label for="inputPassword4" class="form-label col-sm-4">Organisasi*</label>
                            <select id="" class="form-select form-select-sm select2">
                                <option selected>Pilih</option>
                                <option>SALSA JARING PERSADA</option>
                            </select>
                        </div>
                        <div class="col-md-12 d-inline-flex mb-2">
                            <label for="inputEmail4" class="form-label col-sm-4">Tgl. Permintaan*</label>
                            <input type="date" class="form-control form-control-sm border-dark" id="" placeholder="">
                        </div>
                    </div>

                    <div class="col-sm-5">
                        <div class="col-md-12 d-inline-flex mb-2">
                            <label for="inputEmail4" class="form-label col-sm-4">Kode Sample</label>
                            <input type="text" class="form-control form-control-sm border-dark" id="" placeholder="">
                            <button class="btn btn-success btn-sm ms-1" type="submit"><i class="ti ti-search"></i></button>
                            <button class="btn btn-success btn-sm ms-1" type="submit"><i class="ti ti-reload"></i></button>
                        </div>
                        <div class="col-md-12 d-inline-flex mb-2">
                            <label for="inputEmail4" class="form-label col-sm-4">Departemen*</label>
                            <input type="date" class="form-control form-control-sm border-dark" id="" placeholder="">
                        </div>
                        <div class="col-md-12 d-inline-flex mb-2">
                            <label for="inputEmail4" class="form-label col-sm-4">Keterangan</label>
                            <input type="text" class="form-control form-control-sm border-dark" id="" placeholder="">
                        </div>
                    </div>
                </div>    
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h4 class="card-title" style="float: left;">List Detail BPM</h4>
                <a href="#" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#tambahBPM" style="text-decoration: none; float: right"><i class="ti ti-plus fw-bolder fs-2 text-light"> Tambah</i></a>
            </div>
            <div class="card-body">
                <table class="table table-bordered" id="example" style="font-size: smaller">
                    <thead>
                        <tr>
                            <th class="align-top">No.</th>
                            <th class="align-top">Kode Material</th>
                            <th class="align-top">Nama Material</th>
                            <th class="align-top">Qty</th>
                            <th class="align-top">Satuan</th>
                            <th class="align-top">Harga</th>
                            <th class="align-top">Jumlah</th>
                            <th class="align-top">Keterangan</th>
                            <th class="align-top">Hapus</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            {{-- <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td> --}}
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        
        <!-- Modal -->
        <div class="modal fade" id="tambahBPM" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Cari Barang</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title" style="float: left;">List Produk</h4>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered" id="example2" style="font-size: smaller">
                                    <thead>
                                        <tr>
                                            <th class="align-top">No.</th>
                                            <th class="align-top">Kode</th>
                                            <th class="align-top">Nama</th>
                                            <th class="align-top">HPJ</th>
                                            <th class="align-top">Brand</th>
                                            <th class="align-top">Kategori</th>
                                            <th class="align-top">Grup Jenis</th>
                                            <th class="align-top">Lokasi</th>
                                            <th class="align-top">Satuan</th>
                                            <th class="align-top">Qty</th>
                                            <th class="align-top">Pilih</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1.</td>
                                            <td>BB.00000692</td>
                                            <td>3G 07-180 MAROON 3B</td>
                                            <td>0</td>
                                            <td>Ethica</td>
                                            <td>Bahan Baku</td>
                                            <td>3G</td>
                                            <td>Ethica Fashion</td>
                                            <td>YARD</td>
                                            <td>0</td>
                                            <td>
                                                <label class="form-check-label" for="flexCheckChecked"></label>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-12 d-flex justify-content-end">
            <a href="#" type="submit" class="btn btn-primary me-2">Simpan</a>
            <a href="{{ route('permintaanmaterialsample') }}" type="submit" class="btn btn-secondary">Kembali</a>
        </div>
  
        </form>
@endsection

@push('script')
    <script>
        $(function () {
            $("#example").DataTable({
                "scrollX" : true,
                "scrollY" : true,
            });
        });
        $(function () {
            $("#example2").DataTable({
                
            });
        });
    </script>
@endpush