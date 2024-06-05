@extends('layouts.template')

@section('content')
<div class="card">
    <div class="card-header">
        <h1 class="card-title" style="float: left; font-size: 20pt">Approval Sample</h1>
        {{-- <a href="{{ route('worksheet.store') }}" class="btn btn-primary" style="text-decoration: none; float: right"><i class="ti ti-plus fw-bolder fs-2 text-light"> Tambah</i></a> --}}
    </div>
    <div class="card-body">
        <table class="table table-bordered" id="example" style="font-size: smaller">
            <thead>
                <tr>
                    <th class="align-top">No.</th>
                    <th class="align-top">Kode Sample</th>
                    <th class="align-top">Kode Prod. Sample</th>
                    <th class="align-top">Brand</th>
                    <th class="align-top">Images</th>
                    <th class="align-top">Status</th>
                    <th class="align-top">Approval</th>
                    <th class="align-top">Lihat</th>
                    <th class="align-top">Ubah Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>1.SAM.05.24.1000039</td>
                    <td>NaN.MYL.04.24.35</td>
                    <td>MYLIA</td>
                    <td>
                        <img src="" alt="">
                    </td>
                    <td>NEW</td>
                    <td>Approve</td>
                    <td>
                        <a href="#" title="lihat"><i class="ti ti-plus" style="font-size: 16pt"></i></a>
                    </td>
                    <td class="text-center">
                        <a href="#" title="ubah status"><i class="ti ti-edit" style="font-size: 16pt"></i></a>
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