@extends('layouts.template')

@section('content')
<div class="card">
    <div class="card-header">
        <h1 class="card-title" style="float: left; font-size: 20pt">Jadwal Produksi</h1>
        <a href="{{ route('jadwalproduksi.store') }}" class="btn btn-primary" style="text-decoration: none; float: right"><i class="ti ti-plus fw-bolder fs-2 text-light"> Tambah</i></a>
    </div>
    <div class="card-body">
        <table class="table table-bordered" id="example" style="font-size: smaller">
            <thead>
                <tr>
                    <th class="align-top">No.</th>
                    <th class="align-top">No. Purchase Order</th>
                    <th class="align-top">Tanggal</th>
                    <th class="align-top">Organisasi</th>
                    <th class="align-top">Kategori PO</th>
                    <th class="align-top">Bisnis Partner</th>
                    <th class="align-top">Status</th>
                    <th class="align-top">Closed</th>
                    <th class="align-top">Total</th>
                    <th class="align-top">Lihat</th>
                    <th class="align-top">Ubah</th>
                    <th class="align-top">Ubah Status</th>
                    <th class="align-top">Cetak</th>
                    <th class="align-top">Close PO</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>1.PPO.06.24.1000013</td>
                    <td>2024-06-04</td>
                    <td>SALSA JARING PERSADA</td>
                    <td>BAHAN BAKU</td>
                    <td>CV SHAREEN JAYA ABADI</td>
                    <td>DRAFT</td>
                    <td>N</td>
                    <td>43.999.978,00</td>
                    <td class="text-center">
                        <a href="#" title="lihat"><i class="ti ti-search" style="font-size: 16pt"></i></a>
                    </td>
                    <td class="text-center">
                        <a href="#" title="ubah"><i class="ti ti-edit" style="font-size: 16pt"></i></a>
                    </td>
                    <td class="text-center">
                        <a href="#" title="ubah status"><i class="ti ti-edit" style="font-size: 16pt"></i></a>
                    </td>
                    <td class="text-center">
                        <a href="#" title="cetak"><i class="ti ti-x" style="font-size: 16pt"></i></a>
                    </td>
                    <td class="text-center">
                        <a href="#" title="close PO"><i class="ti ti-folder" style="font-size: 16pt"></i></a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('script')
    <script>
        $(function () {
            $("#example").DataTable({
                "scrollX" : true,
                "scrollY" : true,
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });
    </script>
@endpush