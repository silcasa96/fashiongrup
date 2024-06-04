@extends('layouts.template')

@section('content')
<div class="card">
    @include('flash-message')
    <div class="card-header">
        <h1 class="card-title" style="float: left; font-size: 20pt"> Design</h1>
        <a href="{{ route('create_design') }}" class="btn btn-primary" style="text-decoration: none; float: right"><i class="ti ti-plus fw-bolder fs-2 text-light"> Tambah</i></a>
    </div>
    <div class="card-body">
        <table class="table table-bordered" id="example1" style="font-size: smaller">
            <thead>
                <tr>
                    <th class="align-top">No</th>
                    <th class="align-top">Designer</th>
                    <th class="align-top">Brand</th>
                    <th class="align-top">Kode Grup</th>
                    <th class="align-top">Kode Desain</th>
                    <th class="align-top">Nama Desain</th>
                    <th class="align-top">Keterangan</th>
                    <th class="align-top">Tanggal Buat</th>
                    <th class="align-top">Tanggal Approval</th>
                    <th class="align-top">Gambar</th>
                    <th class="align-top">Status</th>
                    <th class="align-top">Approval Direktur</th>
                    <th class="align-top">Approval Owner</th>
                    <th class="align-top" style="text-align: center">Lihat</th>
                    <th class="align-top" style="text-align: center">Ubah</th>
                    <th class="align-top" style="text-align: center">Ubah Desainer</th>
                    <th class="align-top" style="text-align: center">Hapus</th>
                    <th class="align-top" style="text-align: center">Download</th>
                </tr>
            </thead>
            <tbody>
            <?php $no=0; ?>
            @if(!empty($design))
                <?php $no ?>
                @foreach($design as $data)
                    <?php
                        $no++;
                    ?>
                    <tr>
                        <td style="padding: 5px 5px !important;">{!! $no !!}</td>
                        <td style="padding: 5px 5px !important;">{!! $data->nmdesigner !!}</td>
                        <td style="padding: 5px 5px !important;">{!! $data->nmbrand !!}</td>
                        <td style="padding: 5px 5px !important;">{!! $data->kdgrupjenis !!}</td>
                        <td style="padding: 5px 5px !important;">{!! $data->kddesign !!}</td>
                        <td style="padding: 5px 5px !important;">{!! $data->nama !!}</td>
                        <td style="padding: 5px 5px !important;">{!! $data->keterangan !!}</td>
                        <td style="padding: 5px 5px !important;">{!! $data->createdate !!}</td>
                        <td style="padding: 5px 5px !important;">{!! $data->tgl_appr2 !!}</td>
                        <td style="padding: 5px 5px !important;"><img src="{{ asset('images/design/'.$data->foto ) }}" class="d-block mx-auto" alt="" style="height: 50px;"></td>
                        <td style="padding: 5px 5px !important;">{!! $data->status !!}</td>
                        <td style="padding: 5px 5px !important;">{!! $data->status_appr1 !!}</td>
                        <td style="padding: 5px 5px !important;">{!! $data->status_appr2 !!}</td>
                        <td style="padding: 5px 5px !important; text-align: center">
                            <a href="{!! route('lihat_design',$data->pr_design_id) !!}" title="lihat"><i class="ti ti-eye" style="font-size: 16pt"></i></a>
                        </td>
                        <td style="padding: 5px 5px !important; text-align: center">
                            <a href="{!! route('edit_design',$data->pr_design_id) !!}" title="ubah"><i class="ti ti-edit" style="font-size: 16pt"></i></a>
                        </td>
                        <td style="padding: 5px 5px !important; text-align: center">
                            <a href="{!! route('edit_designer',$data->pr_design_id) !!}" title="ubah designer"><i class="ti ti-user" style="font-size: 16pt"></i></a>
                        </td>
                        <td style="padding: 5px 5px !important; text-align: center">
                            @if($data->status=='Approved')
                                <a href="#" title="" ><i class="ti ti-minus" style="font-size: 16pt"></i></a>
                            @else
                                <a href="{!! route('destroy_design',$data->pr_design_id) !!}" onclick="return confirm('Apakah Data akan dihapus?');" title="hapus"><i class="ti ti-x" style="font-size: 16pt"></i></a>
                            @endif
                        </td>
                        <td style="padding: 5px 5px !important; text-align: center">
                            <a href="{!! URL::to('/images/design/'.$data->foto) !!}" target="_blank" title="download"><i class="ti ti-download" style="font-size: 16pt"></i></a>
                        </td>
                    </tr>
                    @endforeach
                    @endif
                </tr>
            </tbody>
        </table>
    </div>
</div>

@endsection

@push('script')
<script>
    $(function () {
        $("#example1").DataTable({
            "scrollX" : true,
            "scrollY" : true,
            "footer"  : true,
            "autoWidth"  : false,
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
  </script>
@endpush