@extends('layouts.template')

@section('content')
<div class="card">
    <div class="card-header">
        <h1 class="card-title" style="float: left; font-size: 20pt">Worksheet</h1>
        <a href="{{ route('worksheet.store') }}" class="btn btn-primary" style="text-decoration: none; float: right"><i class="ti ti-plus fw-bolder fs-2 text-light"> Tambah</i></a>
    </div>
    <div class="card-body">
        <table class="table table-bordered" id="example" style="font-size: smaller">
            <thead>
                <tr>
                    <th class="align-top">No.</th>
                    <th class="align-top">Kode Job</th>
                    <th class="align-top">Brand</th>
                    <th class="align-top">Grup Jenis</th>
                    <th class="align-top">Design</th>
                    <th class="align-top">Artikel</th>
                    <th class="align-top">Warna</th>
                    <th class="align-top">Kwartal</th>
                    <th class="align-top">Tahun</th>
                    <th class="align-top">PIC</th>
                    <th class="align-top">Status Design</th>
                    <th class="align-top">Design</th>
                    <th class="align-top">Sampel</th>
                    <th class="align-top">Seri Warna</th>
                    <th class="align-top">Lihat</th>
                    <th class="align-top">Ubah</th>
                    <th class="align-top">Ubah Status</th>
                    <th class="align-top">Print</th>
                    <th class="align-top">Hapus</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>1.WSH.05.24.1000025</td>
                    <td>ETHICA</td>
                    <td>077</td>
                    <td>MSI.01.24.39</td>
                    <td>MASAMI 16</td>
                    <td>EGGPLANT</td>
                    <td>02</td>
                    <td>2024</td>
                    <td>Novita Damayanti Zakkiyah</td>
                    <td>NEW</td>
                    <td>NEW</td>
                    <td>
                        <img src="" alt="">
                    </td>
                    <td>
                        <a href="#" title="lihat"><i class="ti ti-plus" style="font-size: 16pt"></i></a>
                    </td>
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