@extends('layouts.template')

@section('content')
<div class="card">
    <div class="card-header">
        <h1 class="card-title" style="float: left; font-size: 20pt">List Permintaan Material Sample</h1>
        <a href="{{ route('sample.store') }}" class="btn btn-primary" style="text-decoration: none; float: right"><i class="ti ti-plus fw-bolder fs-2 text-light"> Tambah</i></a>
    </div>
    <div class="card-body">
        <table class="table table-bordered" id="example" style="font-size: smaller">
            <thead>
                <tr>
                    <th class="align-top">No.</th>
                    <th class="align-top">Kode Sample</th>
                    <th class="align-top">Kode Design</th>
                    <th class="align-top">Brand</th>
                    <th class="align-top">Keterangan</th>
                    <th class="align-top">Foto</th>
                    <th class="align-top">Foto Revisi</th>
                    <th class="align-top">Foto Revisi 2</th>
                    <th class="align-top">Foto Revisi 3</th>
                    <th class="align-top">Foto Revisi 4</th>
                    <th class="align-top">Foto Revisi 5</th>
                    <th class="align-top">Status</th>
                    <th class="align-top">Approval</th>
                    <th class="align-top">Lihat</th>
                    <th class="align-top">Ubah</th>
                    <th class="align-top">Revisi</th>
                    <th class="align-top">Hapus</th>
                    <th class="align-top">Print</th>
                    <th class="align-top">Ubah Approval</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>1.SAM.04.24.1000026</td>
                    <td>NaN.KF.03.24.381</td>
                    <td>KF.03.24.381</td>
                    <td>KAHFI</td>
                    <td></td>
                    <td>Foto</td>
                    <td>Revisi Foto 1</td>
                    <td>Revisi Foto 2</td>
                    <td>Revisi Foto 3</td>
                    <td>Revisi Foto 4</td>
                    <td>Revisi Foto 5</td>
                    <td>NEW</td>
                    <td>Approve</td>
                    <td class="text-center">
                        <a href="#" title="lihat"><i class="ti ti-search" style="font-size: 16pt"></i></a>
                    </td>
                    <td class="text-center">
                        <a href="#" title="ubah"><i class="ti ti-edit" style="font-size: 16pt"></i></a>
                    </td>
                    <td class="text-center">
                        <a href="#" title="print"><i class="ti ti-x" style="font-size: 16pt"></i></a>
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