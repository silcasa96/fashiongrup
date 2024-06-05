@extends('layouts.template')

@section('content')
<div class="card">
    <div class="card-header">
        <h1 class="card-title" style="float: left; font-size: 20pt">Jadwal Produksi</h1>
        <a href="{{ route('poproduksi.store') }}" class="btn btn-primary" style="text-decoration: none; float: right"><i class="ti ti-plus fw-bolder fs-2 text-light"> Tambah</i></a>
    </div>
    <div class="card-body">
        <table class="table table-bordered" id="example" style="font-size: smaller">
            <thead>
                <tr>
                    <th class="align-top">No.</th>
                    <th class="align-top">No. Jadwal Produksi</th>
                    <th class="align-top">Tanggal</th>
                    <th class="align-top">No. Worksheet</th>
                    <th class="align-top">Nama Artikel</th>
                    <th class="align-top">Qty Produksi</th>
                    <th class="align-top">PIC</th>
                    <th class="align-top">Status</th>
                    <th class="align-top">Lihat</th>
                    <th class="align-top">Ubah</th>
                    <th class="align-top">Cetak</th>
                    <th class="align-top">Copy Faktur</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>1.JPR.06.24.1000019</td>
                    <td>04-06-2024</td>
                    <td>1.WSH.05.24.1000031</td>
                    <td>VESTY 03 ARMY</td>
                    <td>55</td>
                    <td>Novita Damayanti Zakkiy</td>
                    <td>DRAFT</td>
                    <td class="text-center">
                        <a href="#" title="lihat"><i class="ti ti-search" style="font-size: 16pt"></i></a>
                    </td>
                    <td class="text-center">
                        <a href="#" title="ubah"><i class="ti ti-edit" style="font-size: 16pt"></i></a>
                    </td>
                    <td class="text-center">
                        <a href="#" title="cetak"><i class="ti ti-x" style="font-size: 16pt"></i></a>
                    </td>
                    <td class="text-center">
                        <a href="#" title="copy faktur"><i class="ti ti-printer" style="font-size: 16pt"></i></a>
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