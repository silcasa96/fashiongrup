@extends('layouts.template')

@section('title', 'Laporan Retur Penjualan | Ethica')
@section('content')
<div class="card">
    @include('flash-message')
    <div class="card-header">
        <h1 class="card-title" style="float: left; font-size: 20pt">Laporan Retur Penjualan</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                </button>
            </div>
    </div>
    <form id="penjualan" class="form-horizontal" method="get" action="{!! route('cari_retur_penjualan') !!}">
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
                        <label>Brand</label>
                        <div class="select2-purple">
                            <select class="select2" multiple="multiple" data-placeholder="Pilih Brand" data-dropdown-css-class="select2-purple" style="width: 100%;" id="brand[]" name="brand[]">
                                <?php
                                foreach ($brand as $brand) {
                                    if ($brand->seq == $idbrand) {
                                        echo '<option selected="selected" value="' . $brand->seq . '">' . $brand->kode . ' - ' . $brand->nama . '</option>';
                                    } else {
                                        echo '<option value="' . $brand->seq . '">' . $brand->kode . ' - ' . $brand->nama . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <!-- /.form-group -->
                    </div>
                    <!-- /.col -->
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Keagenan</label>
                        <div class="select2-purple">
                            <select class="select2" multiple="multiple" data-placeholder="Pilih Keagenan" data-dropdown-css-class="select2-purple" style="width: 100%;" name="keagenan[]">
                                <?php
                                foreach ($keagenan as $keagenan) {
                                    if ($keagenan->seq == $idkeagenan) {
                                        echo '<option selected="selected" value="' . $keagenan->seq . '">' . $keagenan->kode . ' - ' . $keagenan->nama . '</option>';
                                    } else {
                                        echo '<option value="' . $keagenan->seq . '">' . $keagenan->kode . ' - ' . $keagenan->nama . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <div class="row">
                <div class="col-md-2">
                    <!-- Date and time -->

                    <div class="form-group">
                        <label>Tanggal Awal</label>
                        <div class="input-group">
                            <input type="date" class="form-control tglawal" id="tglawal" name="tglawal" placeholder="Tanggal Awal" required value="{!! $tglawal !!}">
                        </div>
                        <!-- /.form-group -->
                    </div>
                    <!-- /.col -->
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label>Tanggal Akhir</label>
                        <div class="input-group">
                            <input type="date" class="form-control tglakhir" id="tglakhir" name="tglakhir" placeholder="Tanggal Akhir" required value="{!! $tglakhir !!}">
                        </div>
                        <!-- /.form-group -->
                    </div>
                    <!-- /.col -->
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <a href="{!! route('lap_retur_penjualan') !!}" class="btn btn-danger btn-sm"><span class="fa fa-times"></span> Reset</a>
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
                                <h3 class="card-title">Laporan Retur Penjualan</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table id="exam" class="table table-hover text-nowrap" style="font-size: x-small">
                                    <thead>
                                        <tr>
                                            <th class="bg-gradient-gray">No.</th>
                                            <th class="bg-gradient-gray">Customer</th>
                                            <th>Nomor</th>
                                            <th>Tanggal</th>
                                            <th>Nomor FJ</th>
                                            <th>Gudang</th>
                                            <th>Brand</th>
                                            <th>Jumlah</th>
                                            <th>Sub Total</th>
                                            <th>Diskon</th>
                                            <th>Diskon Global</th>
                                            <th>Total</th>
                                            <th>Keterangan</th>
                                            <th>User Id</th>
                                            <th>Tanggal Input</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 0;
                                        $subtotal = 0;
                                        $diskon = 0;
                                        $diskon_global = 0;
                                        $total = 0;
                                        $qty = 0;
                                        $nomor = '';
                                        ?>
                                        @if(!empty($retur_penjualan))
                                        @foreach($retur_penjualan as $retur_penjualans)
                                        <?php $no++; ?>
                                        <tr>
                                            <td class="bg-gradient-gray">{!! $no !!}</td>
                                            <td class="bg-gradient-gray">{!! $retur_penjualans->nmcustomer !!}</td>
                                            <td>{!! $retur_penjualans->nomor !!}</td>
                                            <td>{!! $retur_penjualans->tanggal !!}</td>
                                            <td>{!! $retur_penjualans->nomor_fj !!}</td>
                                            <td>{!! $retur_penjualans->nmgudang !!}</td>
                                            <td>{!! $retur_penjualans->nmbrand !!}</td>
                                            <td style="text-align: right">{!! number_format($retur_penjualans->qty,0) !!}</td>
                                            <td style="text-align: right">{!! number_format($retur_penjualans->subtotal,0) !!}</td>
                                            <td style="text-align: right">{!! number_format($retur_penjualans->diskon,0) !!}</td>
                                            <td style="text-align: right">{!! number_format($retur_penjualans->diskon_global,0) !!}</td>
                                            <td style="text-align: right">{!! number_format($retur_penjualans->total,0) !!}</td>
                                            <td>{!! $retur_penjualans->keterangan !!}</td>
                                            <td>{!! $retur_penjualans->user_id !!}</td>
                                            <td>{!! $retur_penjualans->tgl_input !!}</td>
                                        </tr>
                                        <?php
                                        $qty += ($retur_penjualans->qty);
                                        $subtotal += ($retur_penjualans->subtotal);
                                        $diskon += ($retur_penjualans->diskon);
                                        $diskon_global += ($retur_penjualans->diskon_global);
                                        $total += ($retur_penjualans->total);
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
                                            <th>Total :</th>
                                            <th style="text-align: right">{!! number_format($qty,2) !!}</th>
                                            <th style="text-align: right">{!! number_format($subtotal,2) !!}</th>
                                            <th style="text-align: right">{!! number_format($diskon,2) !!}</th>
                                            <th style="text-align: right">{!! number_format($diskon_global,2) !!}</th>
                                            <th style="text-align: right">{!! number_format($total,2) !!}</th>
                                            <th></th>
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
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
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