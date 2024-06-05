@extends('layouts.template')

@section('content')
    <div class="card">
        <div class="card-header">
            <h1 class="card-title" style="float: left; font-size: 16pt">Tambah Jadwal Produksi</h1>
        </div>
        <form class="g-3">
            <div class="card-body">
                <div class="row" style="font-size: smaller">
                    <div class="col-sm-4">
                        <div class="col-md-12 d-inline-flex mb-2">
                            <label for="inputEmail4" class="form-label col-sm-4">Jadwal Produksi*</label>
                            <input type="text" class="form-control form-control-sm border-dark" id="" placeholder="">
                            <input class="form-check-input ms-3 me-1 ps-3" type="checkbox" value="" id="flexCheckChecked" checked> Auto
                        </div>
                        <div class="col-md-12 d-inline-flex mb-2">
                            <label for="inputEmail4" class="form-label col-sm-4">No. Worksheet</label>
                            <input type="text" class="form-control form-control-sm border-dark" id="" placeholder="">
                            <button class="btn btn-success btn-sm ms-1" type="submit"><i class="ti ti-search"></i></button>
                            <button class="btn btn-success btn-sm ms-1" type="submit"><i class="ti ti-reload"></i></button>
                        </div>
                        <div class="col-md-12 d-inline-flex mb-2">
                            <label for="inputEmail4" class="form-label col-sm-4">Kode Intruksi</label>
                            <input type="text" class="form-control form-control-sm border-dark" id="" placeholder="">
                        </div>
                        <div class="col-md-12 d-inline-flex mb-2">
                            <label for="inputEmail4" class="form-label col-sm-4">Keterangan</label>
                            <input type="text" class="form-control form-control-sm border-dark" id="" placeholder="">
                        </div>
                        <div class="col-md-12 d-inline-flex mb-2">
                            <label for="inputEmail4" class="form-label col-sm-4">Warna</label>
                            <input type="text" class="form-control form-control-sm border-dark" id="" placeholder="">
                        </div>
                        <div class="col-md-12 d-inline-flex mb-2">
                            <label for="inputEmail4" class="form-label col-sm-4">Brand</label>
                            <input type="text" class="form-control form-control-sm border-dark" id="" placeholder="">
                        </div>
                        <div class="col-md-12 d-inline-flex mb-2">
                            <label for="inputEmail4" class="form-label col-sm-4">Organisasi</label>
                            <input type="text" class="form-control form-control-sm border-dark" id="" placeholder="">
                        </div>
                        <div class="col-md-12 d-inline-flex mb-2">
                            <label for="inputEmail4" class="form-label col-sm-4">Design</label>
                            <input type="text" class="form-control form-control-sm border-dark" id="" placeholder="">
                        </div>
                        <div class="col-md-12 d-inline-flex mb-2">
                            <label for="inputPassword4" class="form-label col-sm-4">Kategori Design</label>
                            <select id="" class="form-select form-select-sm select2">
                                <option selected>Pilih</option>
                                <option>NEW</option>
                                <option>REPEAT</option>
                                <option>PARTIAL</option>
                                <option>KHUSUS</option>
                            </select>
                        </div>
                        <div class="col-md-12 d-inline-flex mb-2">
                            <label for="inputEmail4" class="form-label col-sm-4">Kategori Produk</label>
                            <input type="text" class="form-control form-control-sm border-dark" id="" placeholder="">
                        </div>
                        <div class="col-md-12 d-inline-flex mb-2">
                            <label for="inputEmail4" class="form-label col-sm-4">Grup Jenis</label>
                            <input type="text" class="form-control form-control-sm border-dark" id="" placeholder="">
                        </div>
                        <div class="col-md-12 d-inline-flex mb-2">
                            <label for="inputEmail4" class="form-label col-sm-4">Fabric</label>
                            <input type="text" class="form-control form-control-sm border-dark" id="" placeholder="">
                        </div>
                        <div class="col-md-12 d-inline-flex mb-2">
                            <label for="inputEmail4" class="form-label col-sm-4">Nama Artikel</label>
                            <input type="text" class="form-control form-control-sm border-dark" id="" placeholder="">
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="col-md-12 d-inline-flex mb-2">
                            <label for="inputEmail4" class="form-label col-sm-4">Kategori</label>
                            <input type="text" class="form-control form-control-sm border-dark" id="" placeholder="">
                        </div>
                        <div class="col-md-12 d-inline-flex mb-2">
                            <label for="inputEmail4" class="form-label col-sm-4">Tgl. Pengiriman</label>
                            <input type="date" class="form-control form-control-sm border-dark" id="" placeholder="">
                        </div>
                        <div class="col-md-12 d-inline-flex mb-2">
                            <label for="inputEmail4" class="form-label col-sm-4">Catatan</label>
                            <textarea type="text" class="form-control form-control-sm border-dark" id="" placeholder=""></textarea>
                        </div>
                        <div class="col-md-12 d-inline-flex mb-2">
                            <label for="inputEmail4" class="form-label col-sm-4">Triwulan</label>
                            <input type="text" class="form-control form-control-sm border-dark" id="" placeholder="">
                        </div>
                        <div class="col-md-12 d-inline-flex mb-2">
                            <label for="inputEmail4" class="form-label col-sm-4">Tahun</label>
                            <input type="text" class="form-control form-control-sm border-dark" id="" placeholder="">
                        </div>
                        <div class="col-md-12 d-inline-flex mb-2">
                            <label for="inputEmail4" class="form-label col-sm-4">Keterangan</label>
                            <textarea type="text" class="form-control form-control-sm border-dark" id="" placeholder=""></textarea>
                        </div>
                        <div class="col-md-12 d-inline-flex mb-2">
                            <label for="inputEmail4" class="form-label col-sm-4">Tanggal*</label>
                            <input type="date" class="form-control form-control-sm border-dark" id="" placeholder="">
                        </div>
                        <div class="col-md-12 d-inline-flex mb-2">
                            <label for="inputEmail4" class="form-label col-sm-4">Persone Incharge*</label>
                            <input type="date" class="form-control form-control-sm border-dark" id="" placeholder="">
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <label for="inputEmail4" class="form-label col-sm-4">Foto</label>
                        <input type="file" class="form-control form-control-sm" id="inputGroupFile01">
                    </div>

                </div>    
            </div>
        </div>

        <div class="card">
            {{-- <div class="card-header">
                <h4 class="card-title" style="float: left;">List Size Body & Varian</h4>
                <a href="#" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#tambahSizeBody" style="text-decoration: none; float: right"><i class="ti ti-plus fw-bolder fs-2 text-light"> Tambah</i></a>
            </div> --}}
            <div class="card-body">
                <table class="table table-bordered" id="example" style="font-size: smaller">
                    <thead>
                        <tr>
                            <th class="align-top">No.</th>
                            <th class="align-top">Tambah</th>
                            <th class="align-top">Hapus</th>
                            <th class="align-top">HPP</th>
                            <th class="align-top">Warna</th>
                            <th class="align-top">Size</th>
                            <th class="align-top">Qty Produksi</th>
                            <th class="align-top">Bahan Baku Utama</th>
                            <th class="align-top">Cons/Pcs</th>
                            <th class="align-top">Variasi I</th>
                            <th class="align-top">Cons/Pcs</th>
                            <th class="align-top">Variasi II</th>
                            <th class="align-top">Cons/Pcs</th>
                            <th class="align-top">Variasi III</th>
                            <th class="align-top">Cons/Pcs</th>
                            <th class="align-top">Acc I</th>
                            <th class="align-top">Cons/Pcs</th>
                            <th class="align-top">Acc II</th>
                            <th class="align-top">Cons/Pcs</th>
                            <th class="align-top">Acc III</th>
                            <th class="align-top">Cons/Pcs</th>
                            <th class="align-top">Acc IV</th>
                            <th class="align-top">Cons/Pcs</th>
                            <th class="align-top">Acc V</th>
                            <th class="align-top">Cons/Pcs</th>
                            <th class="align-top">Acc VI</th>
                            <th class="align-top">Cons/Pcs</th>
                            <th class="align-top">Acc VII</th>
                            <th class="align-top">Cons/Pcs</th>
                            <th class="align-top">Acc VIII</th>
                            <th class="align-top">Cons/Pcs</th>
                            <th class="align-top">Kancing</th>
                            <th class="align-top">Cons/Pcs</th>
                            <th class="align-top">Zipper</th>
                            <th class="align-top">Cons/Pcs</th>
                            <th class="align-top">Logo</th>
                            <th class="align-top">Cons/Pcs</th>
                            <th class="align-top">Label</th>
                            <th class="align-top">Cons/Pcs</th>
                            <th class="align-top">Plastik</th>
                            <th class="align-top">Cons/Pcs</th>
                            <th class="align-top">Hantag</th>
                            <th class="align-top">Cons/Pcs</th>
                            <th class="align-top">Loopin</th>
                            <th class="align-top">Cons/Pcs</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        
        <div class="card">
            <div class="card-header">
                <h4 class="card-title" style="float: left;">List Color Way</h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered" id="example" style="font-size: smaller">
                    <thead>
                        <tr>
                            <th class="align-top">No.</th>
                            <th class="align-top">Nama Bahan</th>
                            <th class="align-top">Cons Total</th>
                            <th class="align-top">Qty All Lokasi</th>
                            <th class="align-top">Qty Internal</th>
                            <th class="align-top">Qty Eksternal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h4 class="card-title" style="float: left;">List Pekerjaan dan Biaya</h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered" id="example" style="font-size: smaller">
                    <thead>
                        <tr>
                            <th class="align-top">No.</th>
                            <th class="align-top">Jenis Pekerjaan</th>
                            <th class="align-top">Biaya</th>
                            <th class="align-top">Keterangan</th>
                            <th class="align-top">Hapus</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        
        <div class="col-md-12 d-flex justify-content-end">
            <a href="#" type="submit" class="btn btn-primary me-2">Simpan</a>
            <a href="{{ route('jadwalproduksi') }}" type="submit" class="btn btn-secondary">Kembali</a>
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
    </script>
@endpush