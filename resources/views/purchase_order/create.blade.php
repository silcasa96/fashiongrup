@extends('layouts.template')

@section('content')
    <div class="card">
        <div class="card-header">
            <h1 class="card-title" style="float: left; font-size: 16pt">Tambah PO Produksi</h1>
        </div>
        <form class="g-3">
            <div class="card-body">
                <div class="row" style="font-size: smaller">
                    <div class="col-sm-6">
                        <div class="col-md-12 d-inline-flex mb-2">
                            <label for="inputEmail4" class="form-label col-sm-4">Auto*</label>
                            <input type="text" class="form-control form-control-sm border-dark" id="" placeholder="">
                            <input class="form-check-input ms-3 me-1 ps-3" type="checkbox" value="" id="flexCheckChecked" checked> Auto
                        </div>
                        <div class="col-md-12 d-inline-flex mb-2">
                            <label for="inputEmail4" class="form-label col-sm-4">Organisasi</label>
                            <select id="" class="form-select form-select-sm select2">
                                <option selected>Pilih</option>
                                <option>SALSA JARING PERSADA</option>
                            </select>
                        </div>
                        <div class="col-md-12 d-inline-flex mb-2">
                            <label for="inputEmail4" class="form-label col-sm-4">Bisnis Partner</label>
                            <input type="text" class="form-control form-control-sm border-dark" id="" placeholder="">
                        </div>
                        <div class="col-md-12 d-inline-flex mb-2">
                            <label for="inputEmail4" class="form-label col-sm-4">Alamat Bisnis Partner</label>
                            <textarea type="text" class="form-control form-control-sm border-dark" id="" placeholder=""></textarea>
                        </div>
                        <div class="col-md-12 d-inline-flex mb-2">
                            <label for="inputEmail4" class="form-label col-sm-4">Keterangan</label>
                            <textarea type="text" class="form-control form-control-sm border-dark" id="" placeholder=""></textarea>
                        </div>
                        <div class="col-md-12 d-inline-flex mb-2">
                            <label for="inputEmail4" class="form-label col-sm-4">Triwulan</label>
                            <input type="text" class="form-control form-control-sm border-dark" id="" placeholder="">
                        </div>
                        <div class="col-md-12 d-inline-flex mb-2">
                            <label for="inputEmail4" class="form-label col-sm-4">Tahun Anggaran</label>
                            <input type="text" class="form-control form-control-sm border-dark" id="" placeholder="">
                        </div>
                        <div class="col-md-12 d-inline-flex mb-2">
                            <label for="inputEmail4" class="form-label col-sm-4">Nilai PD</label>
                            <input type="text" class="form-control form-control-sm border-dark" id="" placeholder="">
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="col-md-12 d-inline-flex mb-2">
                            <label for="inputEmail4" class="form-label col-sm-4">Tgl. Order</label>
                            <input type="date" class="form-control form-control-sm border-dark" id="" placeholder="">
                        </div>
                        <div class="col-md-12 d-inline-flex mb-2">
                            <label for="inputEmail4" class="form-label col-sm-4">Tgl. Rencana Datang</label>
                            <input type="date" class="form-control form-control-sm border-dark" id="" placeholder="">
                        </div>
                        <div class="col-md-12 d-inline-flex mb-2">
                            <label for="inputEmail4" class="form-label col-sm-4">Departemen</label>
                            <select id="" class="form-select form-select-sm select2">
                                <option selected>Pilih</option>
                                <option>Area Manager</option>
                                <option>Banelling OPR</option>
                                <option>Cutting</option>
                                <option>Driver</option>
                                <option>FGW</option>
                            </select>
                        </div>
                        <div class="col-md-12 d-inline-flex mb-2">
                            <label for="inputEmail4" class="form-label col-sm-4">Mata Uang</label>
                            <select id="" class="form-select form-select-sm select2">
                                <option>IDR</option>
                            </select>
                        </div>
                        <div class="col-md-12 d-inline-flex mb-2">
                            <label for="inputEmail4" class="form-label col-sm-4">Nilai Tukar</label>
                            <input type="text" class="form-control form-control-sm border-dark" id="" placeholder="">
                        </div>
                        <div class="col-md-12 d-inline-flex mb-2">
                            <label for="inputEmail4" class="form-label col-sm-4">Payment Term</label>
                            <input type="text" class="form-control form-control-sm border-dark me-2" id="" placeholder="">Hari
                        </div>
                        <div class="col-md-12 d-inline-flex mb-2">
                            <label for="inputEmail4" class="form-label col-sm-4">Jatuh Tempo</label>
                            <input type="date" class="form-control form-control-sm border-dark" id="" placeholder="">
                        </div>
                        <div class="col-md-12 d-inline-flex mb-2">
                            <label for="inputEmail4" class="form-label col-sm-4">Kesepakatan Supplier</label>
                            <select id="" class="form-select form-select-sm select2">
                                <option selected>Pilih</option>
                                <option>Terima Tanpa Diskon</option>
                                <option>Terima Dgn Diskon</option>
                                <option>Retur</option>
                            </select>
                        </div>
                        <div class="col-md-12 d-inline-flex mb-2">
                            <label for="inputEmail4" class="form-label col-sm-4">Diskon</label>
                            <input type="date" class="form-control form-control-sm border-dark" id="" placeholder="">
                        </div>
                        <div class="col-md-12 d-inline-flex mb-2">
                            <label for="inputEmail4" class="form-label col-sm-4">Konfirmasi QC</label>
                            <input type="date" class="form-control form-control-sm border-dark" id="" placeholder="">
                        </div>
                        <div class="col-md-12 d-inline-flex mb-2">
                            <label for="inputEmail4" class="form-label col-sm-4">Kategori PO</label>
                            <select id="" class="form-select form-select-sm select2">
                                <option selected>Pilih</option>
                                <option>Accessories</option>
                                <option>Bahan Baku</option>
                                <option>Bahan Pembantu</option>
                                <option>Barang Jadi</option>
                            </select>
                        </div>
                    </div>

                </div>    
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h4 class="card-title" style="float: left;">Detail Order</h4>
                <a href="#" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#tambahDetailOrder" style="text-decoration: none; float: right"><i class="ti ti-plus fw-bolder fs-2 text-light"> Tambah</i></a>
            </div>
            <div class="card-body">
                <table class="table table-bordered" id="example" style="font-size: smaller">
                    <thead>
                        <tr>
                            <th class="align-top">No.</th>
                            <th class="align-top">Kode</th>
                            <th class="align-top">Nama</th>
                            <th class="align-top">Satuan</th>
                            <th class="align-top">Qty</th>
                            <th class="align-top">Harga</th>
                            <th class="align-top">Bruto</th>
                            <th class="align-top">Diskon</th>
                            <th class="align-top">Nominal Diskon</th>
                            <th class="align-top">Netto</th>
                            <th class="align-top">Requisition</th>
                            <th class="align-top">On Hand</th>
                            <th class="align-top">Ubah</th>
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
        
        <div class="col-md-12 d-flex justify-content-end">
            <a href="#" type="submit" class="btn btn-primary me-2">Simpan</a>
            <a href="{{ route('jadwalproduksi') }}" type="submit" class="btn btn-secondary">Kembali</a>
        </div>



        <!-- Modal -->
        <div class="modal fade" id="tambahDetailOrder" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Cari Requisition</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h6 class="modal-title" id="staticBackdropLabel">List Requisition</h6>
                        <table class="table table-bordered" id="example" style="font-size: smaller">
                            <thead>
                                <tr>
                                    <th class="align-top">No.</th>
                                    <th class="align-top">Kode</th>
                                    <th class="align-top">Activity</th>
                                    <th class="align-top">Pengaju</th>
                                    <th class="align-top">Tanggal</th>
                                    <th class="align-top">Status</th>
                                    <th class="align-top">Kategori PR</th>
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
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
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