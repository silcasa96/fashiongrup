@extends('layouts.template')

@section('content')
    <div class="card">
        <div class="card-header">
            <h1 class="card-title" style="float: left; font-size: 20pt">Form Intruksi Desain</h1>
            <a href="{{ route('f-intruksidesign.store') }}" class="btn btn-primary" style="text-decoration: none; float: right"><i class="ti ti-plus fw-bolder fs-2 text-light"> Tambah</i></a>
        </div>
        <div class="card-body">
            <table class="table table-bordered" id="example" style="font-size: smaller">
                <thead>
                    <tr>
                        <th class="align-top">No</th>
                        <th class="align-top">Kode</th>
                        <th class="align-top">Tanggal</th>
                        <th class="align-top">Kode Desain</th>
                        <th class="align-top">Jenis</th>
                        <th class="align-top">Desainer</th>
                        <th class="align-top">Size</th>
                        <th class="align-top">Foto</th>
                        <th class="align-top">Lihat</th>
                        <th class="align-top">Ubah</th>
                        <th class="align-top">Hapus</th>
                        <th class="align-top">Print</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>1.IDS.05.24.1000054</td>
                        <td>16-05-2024</td>
                        <td>AY.04.24.785</td>
                        <td>Dress Dewasa</td>
                        <td>ANISA FUZIANTI</td>
                        <td>S MODEL</td>
                        <td>
                            <img src="{{ asset('dist/images/K.05.24.1279.png') }}" class="d-block mx-auto" alt="" width="100">
                        </td>
                        <td class="text-center">
                            <a href="#" title="lihat"><i class="ti ti-search" style="font-size: 16pt"></i></a>
                        </td>
                        <td class="text-center">
                            <a href="#" title="ubah"><i class="ti ti-edit" style="font-size: 16pt"></i></a>
                        </td>
                        <td class="text-center">
                            <a href="#" title="hapus"><i class="ti ti-x" style="font-size: 16pt"></i></a>
                        </td>
                        <td class="text-center">
                            <a href="#" title="print"><i class="ti ti-printer" style="font-size: 16pt"></i></a>
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