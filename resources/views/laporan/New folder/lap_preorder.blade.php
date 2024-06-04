@extends('layouts.template')

@section('title', 'Laporan Pre Order | Ethica')
@section('content')
<div class="card">
    @include('flash-message')
    <div class="card-header">
        <h1 class="card-title" style="float: left; font-size: 20pt">Laporan Pre Order</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                </button>
            </div>
    </div>
    <form id="penjualan" class="form-horizontal" method="get" action="{!! route('cari_preorder') !!}">
        <!-- /.card-header -->
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Customer</label>
                        <select class="select2bs4" data-placeholder="Pilih Customer" data-dropdown-css-class="select2-purple" style="width: 100%;" id="customer" name="customer">
                            <option value="">Pilih Customer</option>
                            <?php
                            foreach ($customer as $customer) {
                                if ($customer->seq == $idcus) {
                                    echo '<option selected="selected" value="' . $customer->seq . '">' . $customer->kode . ' - ' . $customer->nama . '</option>';
                                } else {
                                    echo '<option value="' . $customer->seq . '">' . $customer->kode . ' - ' . $customer->nama . '</option>';
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <!-- /.form-group -->
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Admin</label>
                        <div class="select2-purple">
                            <select class="select2" multiple="multiple" data-placeholder="Pilih Admin" data-dropdown-css-class="select2-purple" style="width: 100%;" name="admin[]">
                                <?php
                                foreach ($admin as $admin) {
                                    if ($admin->seq == $idadmin) {
                                        echo '<option selected="selected" value="' . $admin->seq . '">' . $admin->kode . ' - ' . $admin->nama . '</option>';
                                    } else {
                                        echo '<option value="' . $admin->seq . '">' . $admin->kode . ' - ' . $admin->nama . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <!-- /.form-group -->
                </div>

                <div class="col-md-2">
                    <!-- Date and time -->

                    <div class="form-group">
                        <label>Tanggal Awal</label>
                        <div class="input-group">
                            <input type="date" class="form-control tglawal input-group-sm" id="tglawal" name="tglawal" placeholder="Tanggal Awal" required value="{!! $tglawal !!}">
                        </div>
                        <!-- /.form-group -->
                    </div>
                    <!-- /.col -->
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label>Tanggal Akhir</label>
                        <div class="input-group">
                            <input type="date" class="form-control tglakhir input-group-sm" id="tglakhir" name="tglakhir" placeholder="Tanggal Akhir" required value="{!! $tglakhir !!}">
                        </div>
                        <!-- /.form-group -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
                <!-- /.row -->
            </div>

            <div class="row">

            </div>

            <div class="row">

            </div>

            <!-- /.card-body -->
            <div class="card-footer">
                <a href="{!! route('lap_preorder') !!}" class="btn btn-danger btn-sm"><span class="fa fa-times"></span> Reset</a>
                <button type="submit" name="Cari" class="btn btn-primary btn-sm" value="Cari"><span class="fa fa-search"></span> Cari
                </button>
                <button type="submit" name="Cari" class="btn btn-success btn-sm" value="Excel"><span class="fa fa-file-excel"></span> Excel
                </button>
            </div>
    </form>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="card card-primary card-tabs">
            <div class="card-header p-0 pt-1">
                <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">Format 1</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">Format 2</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-one-messages-tab" data-toggle="pill" href="#custom-tabs-one-messages" role="tab" aria-controls="custom-tabs-one-messages" aria-selected="false">Format 3</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content" id="custom-tabs-one-tabContent">
                    <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <!-- /.card-header -->
                                        <div class="card-body table-responsive p-0">
                                            <table id="exam" class="table table-hover text-nowrap" style="font-size: x-small">
                                                <thead>
                                                    <tr>
                                                        <th class="bg-gradient-gray">No.</th>
                                                        <th class="bg-gradient-gray">Tanggal</th>
                                                        <th>Nomor</th>
                                                        <th>Customer/Store</th>
                                                        <th>Barcode</th>
                                                        <th>Nama</th>
                                                        <th>Brand</th>
                                                        <th>Sub Brand</th>
                                                        <th>Warna</th>
                                                        <th>Ukuran</th>
                                                        <th>Qty PO</th>
                                                        <th>Status</th>
                                                        <th>Admin</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $no = 0;
                                                    $qty = 0;
                                                    ?>
                                                    @if(!empty($preorder))
                                                    @foreach($preorder as $preorders)
                                                    <?php $no++; ?>
                                                    <tr>
                                                        <td class="bg-gradient-gray">{!! $no !!}</td>
                                                        <td class="bg-gradient-gray">{!! $preorders->tanggal !!}</td>
                                                        <td>{!! $preorders->nomor !!}</td>
                                                        <td>{!! $preorders->nmcustomer !!}</td>
                                                        <td>{!! $preorders->barcode !!}</td>
                                                        <td>{!! $preorders->nmproduk !!}</td>
                                                        <td>{!! $preorders->nmbrand !!}</td>
                                                        <td>{!! $preorders->nmsubbrand !!}</td>
                                                        <td>{!! $preorders->nmwarna !!}</td>
                                                        <td>{!! $preorders->nmukuran !!}</td>
                                                        <td style="text-align: right">{!! number_format($preorders->qty,0) !!}</td>
                                                        <td>{!! $preorders->status !!}</td>
                                                        <td>{!! $preorders->nmadmin !!}</td>
                                                    </tr>
                                                    <?php
                                                    $qty += ($preorders->qty);
                                                    ?>
                                                    @endforeach
                                                    @endif
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                                                        <th>Total :</th>
                                                        <th style="text-align: right">{!! number_format($qty,0) !!}</th>
                                                        <th></th>
                                                        <th></th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                        <!-- /.card-body -->
                                    </div>
                                    <!-- /.card -->
                                </div>
                                <!-- /.col -->
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <!-- /.card-header -->
                                        <div class="card-body table-responsive p-0">
                                            <table id="exam" class="table table-hover text-nowrap" style="font-size: x-small">
                                                <thead>
                                                    <tr>
                                                        <th class="bg-gradient-gray">No.</th>
                                                        <th class="bg-gradient-gray">Periode</th>
                                                        <th>Barcode</th>
                                                        <th>Nama</th>
                                                        <th>Brand</th>
                                                        <th>Sub Brand</th>
                                                        <th>Warna</th>
                                                        <th>Ukuran</th>
                                                        <th>Qty Stok</th>
                                                        <th>Terpesan</th>
                                                        <th>Terpenuhi</th>
                                                        <th>Sisa</th>
                                                        <th>Tidak Terpenuhi</th>
                                                        <th>Keterangan</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $no = 0;
                                                    $qty = 0;
                                                    ?>
                                                    @if(!empty($preorder1))
                                                    @foreach($preorder1 as $preorders1)
                                                    <?php $no++; ?>
                                                    <tr>
                                                        <td class="bg-gradient-gray">{!! $no !!}</td>
                                                        <td class="bg-gradient-gray">{!! $preorders1->tanggal !!}</td>
                                                        <td>{!! $preorders1->barcode !!}</td>
                                                        <td>{!! $preorders1->nmproduk !!}</td>
                                                        <td>{!! $preorders1->nmbrand !!}</td>
                                                        <td>{!! $preorders1->nmsubbrand !!}</td>
                                                        <td>{!! $preorders1->nmwarna !!}</td>
                                                        <td>{!! $preorders1->nmukuran !!}</td>
                                                        <td style="text-align: right">{!! number_format($preorders1->qty_stok,0) !!}</td>
                                                        <td style="text-align: right">{!! number_format($preorders1->terpesan,0) !!}</td>
                                                        <td style="text-align: right">{!! number_format($preorders1->terpenuhi,0) !!}</td>
                                                        <td style="text-align: right">{!! number_format($preorders1->sisa,0) !!}</td>
                                                        <td style="text-align: right">{!! number_format($preorders1->tidak_terpenuhi,0) !!}</td>
                                                        <td>{!! $preorders1->keterangan !!}</td>
                                                    </tr>
                                                    <?php
                                                    $qty += ($preorders1->qty_stok);
                                                    ?>
                                                    @endforeach
                                                    @endif
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                                                        <th>Total :</th>
                                                        <th style="text-align: right">{!! number_format($qty,0) !!}</th>
                                                        <th style="text-align: right">{!! number_format(0) !!}</th>
                                                        <th style="text-align: right">{!! number_format(0) !!}</th>
                                                        <th style="text-align: right">{!! number_format(0) !!}</th>
                                                        <th style="text-align: right">{!! number_format(0) !!}</th>
                                                        <th></th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                        <!-- /.card-body -->
                                    </div>
                                    <!-- /.card -->
                                </div>
                                <!-- /.col -->
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="custom-tabs-one-messages" role="tabpanel" aria-labelledby="custom-tabs-one-messages-tab">
                        Belum Ada Data
                    </div>
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>
</div>


<!-- /.container-fluid -->
@endsection

@push('script')

<script type="text/javascript">
    $(function() {
        $("#example1").DataTable({
            "responsive": false,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });

        new DataTable('#tablefreeze', {
            fixedColumns: {
                left: 2
            },
            paging: false,
            scrollCollapse: true,
            scrollX: true,
            scrollY: 300,
        });
    });
</script>

<script>
    function load() {
        var table = $('#example_res').DataTable({
            'processing': true,
            'serverSide': true,
            'serverMethod': 'post',
            "bDestroy": true,
            "scrollX": true,
            "scrollY": true,
            "searching": true,
            "ordering": true,
            "paging": true,
            "lengthChange": true,
            "columnDefs": [{
                    width: 300,
                    targets: 1
                },
                {
                    width: 100,
                    targets: 2
                },
                {
                    width: 100,
                    targets: 3
                },
                {
                    width: 100,
                    targets: 4
                },
                {
                    width: 100,
                    targets: 5
                },
                {
                    width: 100,
                    targets: 6
                },
                {
                    width: 200,
                    targets: 7
                },
                {
                    width: 100,
                    targets: 8
                },
                {
                    width: 100,
                    targets: 9
                },
                {
                    width: 100,
                    targets: 10
                },
                {
                    width: 100,
                    targets: 11
                },
                {
                    width: 100,
                    targets: 12
                },
                {
                    width: 100,
                    targets: 13
                },
                {
                    width: 100,
                    targets: 14
                },
                {
                    width: 100,
                    targets: 15
                },
                {
                    width: 100,
                    targets: 16
                },
                {
                    width: 100,
                    targets: 17
                },
                {
                    width: 100,
                    targets: 18
                },
                {
                    width: 100,
                    targets: 19
                },
                {
                    width: 100,
                    targets: 20
                },
            ],
            "headers": {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    }
</script>
@endpush