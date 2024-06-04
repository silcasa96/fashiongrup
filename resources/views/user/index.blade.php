@extends('layouts.template')

@section('content')
    <div class="card">
        @include('flash-message')
        <div class="card-header">
            <h1 class="card-title" style="float: left; font-size: 20pt">Master Users</h1>
            <a href="{{ route('add_user') }}" class="btn btn-primary" style="text-decoration: none; float: right"><i class="ti ti-plus fw-bolder fs-2 text-light"> </i> Tambah</a>
        </div>
        <div class="card-body">
            <table class="table table-bordered" id="example1" style="font-size: smaller">
                <thead>
                    <tr>
                        <th class="align-top">No</th>
                        <th class="align-top">Username</th>
                        <th class="align-top">Nama</th>
                        <th class="align-top">Email</th>
                        <th class="align-top">Role</th>
                        <th class="align-top" style="text-align: center">Ubah</th>
                        <th class="align-top" style="text-align: center">Hapus</th>
                    </tr>
                </thead>
                <tbody>
                <?php $no=0; ?>
                @if(!empty($user))
                    <?php $no ?>
                    @foreach($user as $data)
                        <?php $no++ ?>
                        <tr>
                            <td style="padding: 5px 5px !important;">{!! $no !!}</td>
                            <td style="padding: 5px 5px !important;">{!! $data->username !!}</td>
                            <td style="padding: 5px 5px !important;">{!! $data->nama !!}</td>
                            <td style="padding: 5px 5px !important;">{!! $data->email!!}</td>
                            <td style="padding: 5px 5px !important;">{!! $data->nama_role!!}</td>
                            <td style="padding: 5px 5px !important; text-align: center">
                                <a href="{!! route('edit_user',$data->id) !!}" title="ubah"><i class="ti ti-edit" style="font-size: 16pt"></i></a>
                            </td>
                            <td style="padding: 5px 5px !important; text-align: center">
                                <a href="{!! route('destroy_user',$data->id) !!}" title="hapus" onclick="return confirm('Apakah Data akan dihapus?');"><i class="ti ti-x" style="font-size: 16pt"></i></a>
                            </td>
                        </tr>
                    @endforeach
                @endif
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