@extends('layouts.template')

@section('content')
    <div class="card">
        @include('flash-message')
        <div class="card-header">
            <h1 class="card-title" style="float: left; font-size: 20pt">Approval Design</h1>
        </div>
        <div class="card-body">
            <table class="table table-bordered" id="example1" style="font-size: smaller">
                <thead>
                <tr>
                    <th class="align-top">No</th>
                    <th class="align-top">Designer</th>
                    <th class="align-top">Brand</th>
                    <th class="align-top">Keterangan</th>
                    <th class="align-top">Design</th>
                    <th class="align-top">Status</th>
                    <th class="align-top">Status</th>
                    <th class="align-top">Appr Owner</th>
                    <th class="align-top" style="text-align: center">Lihat</th>
                    <th class="align-top" style="text-align: center">Approve</th>
                </tr>
                </thead>
                <tbody>
                <?php $no=0; ?>
                @if(!empty($apprdesign))
                    <?php $no ?>
                    @foreach($apprdesign as $data)
                        <?php $no++ ?>
                        <tr>
                            <td style="padding: 5px 5px !important;">{!! $no !!}</td>
                            <td style="padding: 5px 5px !important;">{!! $data->nmdesigner !!}</td>
                            <td style="padding: 5px 5px !important;">{!! $data->nmbrand !!}</td>
                            <td style="padding: 5px 5px !important;">{!! $data->nama !!}</td>
                            <td style="padding: 5px 5px !important;">{!! $data->keterangan !!}</td>
                            <td style="padding: 5px 5px !important;">{!! $data->status !!}</td>
                            <td style="padding: 5px 5px !important;"><img src="{{ asset('images/design/'.$data->foto ) }}" class="d-block mx-auto" alt="" style="height: 100px;"></td>
                            <td style="padding: 5px 5px !important;">{!! $data->status_appr2 !!}</td>
                            <td style="padding: 5px 5px !important; text-align: center">
                                <a href="{!! route('appr_design_show',$data->pr_design_id) !!}" title="lihat"><i class="ti ti-eye" style="font-size: 16pt"></i></a>
                            </td>
                            <td style="padding: 5px 5px !important; text-align: center">
                                <a href="{!! route('appr_design_approve',$data->pr_design_id) !!}" title="approve" ><i class="ti ti-check" style="font-size: 16pt"></i></a>
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